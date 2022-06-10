<?php

namespace App\Controllers;

use App\Models\LanguagesCodeModel;
use App\Models\PostCategoriesModel;
use App\Models\PostsModel;
use App\Models\SeosModel;
use PhpParser\ParserAbstract;

class DynamicPageController extends BaseController
{
    public function index()
    {
        $currentPageNumber = 1;
        $data = [];
        $allParams = [];
        $postsModel = new PostsModel();
        if ($this->request->getVar('for_search') != false) {
            $allParams = $this->request->getGet();
            //keep search conditions on session
            session()->set('page.search', $allParams);
        } else {
            // when click on page, clear session if exists
            if ($this->request->getVar('for_menu') != false) {
                if (isset($_SESSION['page.dynamic_page']) == true) {
                    session()->remove('page.dynamic_page');
                }
                if (isset($_SESSION['page.search']) == true) {
                    session()->remove('page.search');
                }
            }
            if (isset($_SESSION['page.search']) == true) {
                //get conditions from session
                $allParams = session()->get('page.search');
            }
        }
        $postsModel->search($allParams,false,false,true);
        $totals = $postsModel->countAllResults(false);
        $countPages = $this->utils->getCountPages($totals);
        //get current page number

        if ($this->request->getVar('page_dynamic_page') != false) {
            //changed page => set session
            $currentPageNumber = $this->request->getVar('page_dynamic_page');
            $_SESSION['page.dynamic_page'] = $currentPageNumber;
        } else {
            if (session()->get('page.dynamic_page') == true
                && $this->request->getVar('for_menu') == false) {
                $sessionPage = session()->get('page.dynamic_page');
                if ($sessionPage <= $countPages) {
                    $currentPageNumber = $sessionPage;
                }
            }
        }
        $languagesCodeModel = new LanguagesCodeModel();

        $data = [
            'dynamic_pages' => $postsModel->paginate(ITEM_PERPAGE, 'dynamic_page', $currentPageNumber),
            'pager' => $postsModel->pager,
            'totals' => $totals,
            'dataSearch' => $allParams,
            'langCode'=>$languagesCodeModel->getByConditions(['deleted_at'=>null]),
            'category'=>$postsModel->getById(DYNAMIC_PAGE_ID),
        ];
        return view("Admin/Dynamic-page/index", $data);
    }

    public function register()
    {
        $data = [];
        $postsModel = new PostsModel();
        $data['title_page'] = 'Thêm mới trang động';
        $seosModel = new SeosModel();
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        if ($this->request->getMethod() == 'post') {
            $postCategory = $postsModel->getById(DYNAMIC_PAGE_ID);
            $dataForms = $this->request->getPost();
            $dataForms['category_id'] = $postCategory['post_id'];
            $dataForms['post_type'] = $postCategory['post_type'];
            $is_error_validate = false;
            //Should reset from previous running
            $this->validation->reset();
            if (!$this->validation->run($dataForms, 'rulesDynamicPage')) {
                $is_error_validate = true;
                $data["errors"] = $this->validation->getErrors();
            }
            if ($is_error_validate == true) {
                $data["post"] = $dataForms;
                session()->setFlashdata('msg_error_register_post', 'Lỗi');
                return view('Admin/Dynamic-page/register', $data);
            }

            $targetFolder = PUBLIC_HTML_PATH . 'public/' . FOLDER_UPLOAD . '/';
            $upload_path = $this->media_path( [
                date( 'Y' ),
                date( 'm' ),
            ], $targetFolder );
            // save image file
            if (!empty($_FILES["file"]["name"])) {
                // Get file info
                $attachments = [];
                $fileType = pathinfo(basename($_FILES["file"]["name"]), PATHINFO_EXTENSION);
                $fileName = $this->random(16,'0123456789abcdefghikml').'.'.$fileType;
                $targetFile = $upload_path . $fileName;
                // Allow certain file formats
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif','webp');
                $currentName = explode('.',$fileName);
                // nếu tồn tại cắt ảnh thì check sau đó tạo chiều cao, chiều rộng
                if (!empty($dataForms['crop_photo'])) {
                    $wh = explode('x',$dataForms['crop_photo']);
                    // check input crop_photo không đúng định dạng
                    if (count($wh) != 2){
                        $data["post"] = $dataForms;
                        session()->setFlashdata('msg_error_crop_image', 'Lỗi');
                        return view('Admin/Dynamic-page/register', $data);
                    }
                    foreach ($wh as $value) {
                        if (!is_numeric(trim($value))) {
                            $data["post"] = $dataForms;
                            session()->setFlashdata('msg_error_crop_image', 'Lỗi');
                            return view('Admin/Dynamic-page/register', $data);
                        }
                    }
                    $width = trim($wh[0]);
                    $height = trim($wh[1]);
                }

                if (in_array($fileType, $allowTypes)) {
                    // mặc định bạn đầu sẽ sinh ra 2 ảnh medium (300 x 300), large (1024 x 1024) resize  cho file ảnh đó
                    if (!file_exists($targetFile)) {
                        $array = [300,1024];
                        for($i = 0;$i<count($array);$i++){
                            $fileNameResize = $currentName[0].'-'.$array[$i].'x'.$array[$i].'.'.$currentName[1];
                            $targetFileResize = $upload_path . $fileNameResize;
                            $this->resize_image($_FILES["file"]["tmp_name"],$array[$i],$array[$i],$targetFileResize);
                            $attachment = BASE_URL_GLOBAL . '/public/' . FOLDER_UPLOAD . '/' .date( 'Y' ).'/'.date( 'm' ).'/' . $fileNameResize;
                            array_push($attachments,$attachment);
                        }
                        // khi tồn tại action resize ảnh thì sẽ resize ảnh đó và upload lên server
                        if (!empty($dataForms['crop_photo'])) {
                            $this->resize_image($_FILES["file"]["tmp_name"],$width,$height,$targetFile);
                            $attachment = BASE_URL_GLOBAL . '/public/' . FOLDER_UPLOAD . '/' .date( 'Y' ).'/'.date( 'm' ).'/' . $fileName;
                            array_push($attachments,$attachment);
                        } else {
                            move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);
                            $attachment = BASE_URL_GLOBAL . '/public/' . FOLDER_UPLOAD . '/'.date( 'Y' ).'/'.date( 'm' ).'/'  . $fileName;
                            array_push($attachments,$attachment);
                        }
                    }
                    $dataAttachment = implode(',',$attachments);
                }
            } else {
                $dataAttachment = DEFAULT_IMAGE;
            }

            // tao slug bai viet
            $slug = $this->convert_vi_to_en_slug($dataForms['post_title']);
            // chuan bi data seo
            $dataFormSeo = [
                'canonical'=> isset($dataForms['canonical'])?$dataForms['canonical']:'',
                'og_locale'=> $dataForms['lang'],
                'og_type'=> 'article',
                'og_title'=> isset($dataForms['og_title'])? $dataForms['og_title'] : '',
                'og_description'=> isset($dataForms['og_description'])? $dataForms['og_description'] :'',
                'og_url'=> isset($dataForms['og_url'])? $dataForms['og_url'] :'',
                'og_site_name'=> isset($dataForms['og_site_name'])? $dataForms['og_site_name'] :'',
                'fb_app_id'=> isset($dataForms['fb_app_id'])? $dataForms['fb_app_id'] :'',
                'seo_google'=> isset($dataForms['seo_google'])? $dataForms['seo_google'] :'',
                'alternate'=> BASE_URL_GLOBAL.'/'.$dataForms['lang'],
                'seo_status'=>$dataForms['post_status'],
                'keywords'=> isset($dataForms['keywords'])? $dataForms['keywords'] :'',
            ];
            $seo_id = $seosModel->saveData($dataFormSeo, 0);
            $dataFormPost = [
                'post_type' => $postCategory['post_type'],
                'category_id' => $postCategory['post_id'],
                'post_title' => $dataForms['post_title'],
                'number_order' => isset($dataForms['number_order'])? $dataForms['number_order'] :0,
                'lang' => $dataForms['lang'],
                'post_status' => $dataForms['post_status'],
                'post_introduce' => 'Mặc định',
                'post_content' => 'Mặc định',
                'seo_id' => $seo_id,
                'slug' => $slug,
                'attachment' => $dataAttachment,
                'seo_status'=> $dataForms['post_status'],
            ];
            $postsModel->saveData($dataFormPost, 0);
            session()->setFlashdata('msg_success', 'Thành công');
            return redirect()->to(base_url('dynamic-page?for_menu=1'));
        }
        return view('Admin/Dynamic-page/register', $data);
    }

    public function edit($postId = '')
    {
        $data = [];
        $postsModel = new PostsModel();
        $seosModel = new SeosModel();
        $data['title_page'] = 'Sửa thông tin trang';
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        if ($postId != '') {
            $data['post'] = $postsModel->getById($postId,'*', 'tbl_seos', 'tbl_posts.seo_id = tbl_seos.seo_id','inner');
        }
        if ($this->request->getMethod() == 'post') {
            $postCategory = $postsModel->getById(DYNAMIC_PAGE_ID);
            $dataForms = $this->request->getPost();
            $dataForms['category_id'] = $postCategory['post_id'];
            $dataForms['post_type'] = $postCategory['post_type'];
            $is_error_validate = false;
            //Should reset from previous running
            $this->validation->reset();
            if (!$this->validation->run($dataForms, 'rulesDynamicPage')) {
                $is_error_validate = true;
                $data["errors"] = $this->validation->getErrors();
            }
            if ($is_error_validate == true) {
                $data["post"] = $dataForms;
                session()->setFlashdata('msg_error_register_post', 'Lỗi');
                return view('Admin/Dynamic-page/edit', $data);
            }
            $post_old = $postsModel->getById($dataForms['post_id'],'*', 'tbl_seos', 'tbl_posts.seo_id = tbl_seos.seo_id','inner');

            $targetFolder = PUBLIC_HTML_PATH . 'public/' . FOLDER_UPLOAD . '/';
            // save image file_en
            $upload_path = $this->media_path( [
                date( 'Y' ),
                date( 'm' ),
            ], $targetFolder );

            if (!empty($_FILES["file"]["name"])) {
                // Get file info
                $attachments = [];
                $fileType = pathinfo(basename($_FILES["file"]["name"]), PATHINFO_EXTENSION);
                $fileName = $this->random(16,'0123456789abcdefghikml').'.'.$fileType;
                $targetFile = $upload_path . $fileName;
                // Allow certain file formats
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif','webp');
                $currentName = explode('.',$fileName);
                // nếu tồn tại cắt ảnh thì check sau đó tạo chiều cao, chiều rộng
                if (!empty($dataForms['crop_photo'])) {
                    $wh = explode('x',$dataForms['crop_photo']);
                    // check input crop_photo không đúng định dạng
                    if (count($wh) != 2){
                        $data["post"] = $dataForms;
                        session()->setFlashdata('msg_error_crop_image', 'Lỗi');
                        return view('Admin/Dynamic-page/edit', $data);
                    }
                    foreach ($wh as $value) {
                        if (!is_numeric(trim($value))) {
                            $data["post"] = $dataForms;
                            session()->setFlashdata('msg_error_crop_image', 'Lỗi');
                            return view('Admin/Dynamic-page/edit', $data);
                        }
                    }
                    $width = trim($wh[0]);
                    $height = trim($wh[1]);
                }
                if (in_array($fileType, $allowTypes)) {
                    // mặc định bạn đầu sẽ sinh ra 2 ảnh medium (300 x 300), large (1024 x 1024) resize  cho file ảnh đó
                    if (!file_exists($targetFile)) {
                        $array = [300,1024];
                        for($i = 0;$i<count($array);$i++){
                            $fileNameResize = $currentName[0].'-'.$array[$i].'x'.$array[$i].'.'.$currentName[1];
                            $targetFileResize = $upload_path . $fileNameResize;
                            $this->resize_image($_FILES["file"]["tmp_name"],$array[$i],$array[$i],$targetFileResize);
                            $attachment = BASE_URL_GLOBAL . '/public/' . FOLDER_UPLOAD . '/' .date( 'Y' ).'/'.date( 'm' ).'/' . $fileNameResize;
                            array_push($attachments,$attachment);
                        }
                        // khi tồn tại action resize ảnh thì sẽ resize ảnh đó và upload lên server
                        if (!empty($dataForms['crop_photo'])) {
                            $this->resize_image($_FILES["file"]["tmp_name"],$width,$height,$targetFile);
                            $attachment = BASE_URL_GLOBAL . '/public/' . FOLDER_UPLOAD . '/'.date( 'Y' ).'/'.date( 'm' ).'/' . $fileName;
                            array_push($attachments,$attachment);
                        } else {
                            move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);
                            $attachment = BASE_URL_GLOBAL . '/public/' . FOLDER_UPLOAD . '/'.date( 'Y' ).'/'.date( 'm' ).'/' . $fileName;
                            array_push($attachments,$attachment);
                        }
                    } else {
                        $data["post"] = $dataForms;
                        session()->setFlashdata('msg_error_img_exist', 'Lỗi');
                        return view('Admin/Dynamic-page/edit', $data);
                    }
                    $dataForms['attachment'] = implode(',',$attachments);
                }else{
                    $data["post"] = $dataForms;
                    session()->setFlashdata('msg_error_img_post', 'Lỗi');
                    return view('Admin/Dynamic-page/edit', $data);
                }
            } else {
                $dataForms['attachment'] = $post_old['attachment'];
            }
            // tao slug bai viet
            $slug = $this->convert_vi_to_en_slug($dataForms['post_title']);
            $dataForms['slug'] = $slug;

            // chuan bi data seo
            $dataFormSeo = [
                'canonical'=> isset($dataForms['canonical'])?$dataForms['canonical']:'',
                'og_locale'=> $dataForms['lang'],
                'og_title'=> isset($dataForms['og_title'])? $dataForms['og_title'] : '',
                'og_description'=> isset($dataForms['og_description'])? $dataForms['og_description'] :'',
                'og_url'=> isset($dataForms['og_url'])? $dataForms['og_url'] :'',
                'og_site_name'=> isset($dataForms['og_site_name'])? $dataForms['og_site_name'] :'',
                'fb_app_id'=> isset($dataForms['fb_app_id'])? $dataForms['fb_app_id'] :'',
                'seo_google'=> isset($dataForms['seo_google'])? $dataForms['seo_google'] :'',
                'alternate'=> BASE_URL_GLOBAL.'/'.$dataForms['lang'],
                'seo_status'=> $dataForms['post_status'],
                'keywords'=> isset($dataForms['keywords'])? $dataForms['keywords'] :'',
            ];
             $seosModel->saveData($dataFormSeo, $dataForms['seo_id']);
            $postsModel->saveData($dataForms, $dataForms['post_id']);
            session()->setFlashdata('msg_success', 'Thành công');
            return redirect()->to(base_url('dynamic-page?for_menu=1'));
        }

        return view('Admin/Dynamic-page/edit', $data);
    }
    public function delete_page()
    {
        try {
            $params = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $postsModel = new PostsModel();
            $values = explode(',', $params['list_page_id']);
            $dataUpdate = [
                'deleted_at' => date('Y-m-d H:i:s')
            ];
            $seosModel = new SeosModel();
            $posts = $postsModel->getByIds($values);
            $id_seos = [];
            foreach ($posts as $value) {
                if ($value['seo_id'] != false){
                    array_push($id_seos,$value['seo_id']);
                }
            }
            $seosModel->updateDataByIds($id_seos,$dataUpdate);
            $postsModel->updateDataByIds($values,$dataUpdate);
            session()->setFlashdata('msg_delete-page', 'Thành công');
            return redirect()->to(base_url('dynamic-page?for_menu=1'));

        } catch (\Exception $ex) {
            session()->setFlashdata('msg_delete_error', 'Xóa thất bại');
            return redirect()->to(base_url('dynamic-page?for_menu=1'));
        }
    }
}