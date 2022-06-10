<?php

namespace App\Controllers;

use App\Models\LanguagesCodeModel;
use App\Models\PostCategoriesModel;
use App\Models\PostsModel;
use App\Models\SeosModel;
use CodeIgniter\Model;

class PostCategoryController extends BaseController
{


    public function index()
    {
        $currentPageNumber = 1;
        $allParams = [];
        $postModel = new PostsModel();
        if ($this->request->getVar('for_search') != false) {
            $allParams = $this->request->getGet();
            //keep search conditions on session
            session()->set('post_category.search', $allParams);
        } else {
            // when click on menu, clear session if exists
            if ($this->request->getVar('for_menu') != false) {
                if (isset($_SESSION['post_category.page']) == true) {
                    session()->remove('post_category.page');
                }
                if (isset($_SESSION['post_category.search']) == true) {
                    session()->remove('post_category.search');
                }
            }
            if (isset($_SESSION['post_category.search']) == true) {
                //get conditions from session
                $allParams = session()->get('post_category.search');
            }
        }
        if (isset($allParams['status']) && $allParams['status'] == '-1') {
            unset($allParams['status']);
        }

        $postModel->searchCategory($allParams);

        $totals = $postModel->countAllResults(false);
        $countPages = $this->utils->getCountPages($totals);
        //get current page number

        if ($this->request->getVar('page_post_category') != false) {
            //changed page => set session
            $currentPageNumber = $this->request->getVar('page_post_category');
            $_SESSION['post_category.page'] = $currentPageNumber;
        } else {
            if (session()->get('post_category.page') == true
                && $this->request->getVar('for_menu') == false) {
                $sessionPage = session()->get('post_category.page');
                if ($sessionPage <= $countPages) {
                    $currentPageNumber = $sessionPage;
                }
            }
        }
        $languagesCodeModel = new LanguagesCodeModel();
        $data = [
            'post_categories' => $postModel->paginate(ITEM_PERPAGE, 'post_category', $currentPageNumber),
            'pager' => $postModel->pager,
            'totals' => $totals,
            'dataSearch' => $allParams,
            'langCode'=>$languagesCodeModel->getByConditions(['deleted_at'=>null])
        ];


        return view("Admin/PostCategory/index", $data);
    }


    public function register()
    {

        $data = [];
        $postsModel = new PostsModel();
        $seosModel = new SeosModel();
        $data['title_page'] = 'Thêm mới danh mục';
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        if ($this->request->getMethod() == 'post') {
            $dataForms = $this->request->getPost(null,FILTER_SANITIZE_STRING);
//            print_r(DEFAULT_IMAGE);
//            die('sas');
            $is_error_validate = false;
            //Should reset from previous running
            $this->validation->reset();

                if (!$this->validation->run($dataForms, 'rulesCategory')) {
                    $is_error_validate = true;
                    $data["errors"] = $this->validation->getErrors();
                }
                if ($is_error_validate == true) {
                    $data["post"] = $dataForms;
                    session()->setFlashdata('msg_error_register_post_category', 'Lỗi');
                    return view('Admin/PostCategory/register', $data);
                } else {

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
                                return view('Admin/PostCategory/register', $data);
                            }
                            foreach ($wh as $value) {
                                if (!is_numeric(trim($value))) {
                                    $data["post"] = $dataForms;
                                    session()->setFlashdata('msg_error_crop_image', 'Lỗi');
                                    return view('Admin/PostCategory/register', $data);
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
                    $slug = $dataForms['slug'];
                   if ($dataForms['slug'] == '') {
                       $slug = $this->convert_vi_to_en_slug($dataForms['post_title']);
                   }

                    // check lại slug lần nữa vì mới chỉ check qua js k tin tưởng được
                    $isTrue = $this->utils->checkSlug($postsModel,$slug);
                    if ($isTrue != true) {
                        $data["post"] = $dataForms;
                        session()->setFlashdata('msg_error_register_post_category', 'Lỗi');
                        return view('Admin/PostCategory/register', $data);
                    }


                    // chuan bi data seo

                    $seo_status = $dataForms['post_status'];
                    if ($dataForms['post_type']=='CUSTOMER_REVIEW') {
                        $seo_status = 0;
                    }
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
                            'seo_status'=> $seo_status,
                            'keywords'=> isset($dataForms['keywords'])? $dataForms['keywords'] :'',
                        ];
                        $seo_id = $seosModel->saveData($dataFormSeo, 0);


                    $dataFormPost = [
                        'post_type' => $dataForms['post_type'],
                        'post_title' => $dataForms['post_title'],
                        'number_order' => isset($dataForms['number_order'])? $dataForms['number_order'] :0,
                        'lang' => $dataForms['lang'],
                        'post_status' => $dataForms['post_status'],
                        'post_introduce' => $dataForms['post_introduce'],
                        'post_content' => $dataForms['post_content'],
                        'seo_id' => $seo_id,
                        'slug' => $slug,
                        'attachment' => $dataAttachment,
                    ];
                    $postsModel->saveData($dataFormPost, 0);
                }
            session()->setFlashdata('msg_success_register_post_category', 'Thành công');
            return redirect()->to(base_url('post_category?for_menu=1'));
        }

        return view('Admin/PostCategory/register', $data);
    }
    /**
     * @param string $post_category_group
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     * hàm+ edit
     */
    public function edit($post_id)
    {

        $data = [];
        $postsModel = new PostsModel();
        $seosModel = new SeosModel();
        $data['title_page'] = 'Sửa thông tin danh mục';
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        if ($post_id != '') {
            $post = $postsModel->getById($post_id,'*', $withJoinTable = 'tbl_seos', $withJoinConditions = 'tbl_posts.seo_id = tbl_seos.seo_id','inner');
        }
        $data['post'] = $post;
//        print_r($post);
//        die('xxx');
        if ($this->request->getMethod() == 'post') {
            //set data for validating
            $dataForms = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $is_error_validate = false;
            //Should reset from previous running
            $this->validation->reset();
            //Run validating with rules with EN
            if (!$this->validation->run($dataForms, 'rulesCategory')) {
                $is_error_validate = true;
                $data["errors"] = $this->validation->getErrors();
            }
            //Should reset from previous running
            $this->validation->reset();

            if ($is_error_validate == true) {
                $data["post"] = $dataForms;
                return view('Admin/PostCategory/edit', $data);
            } else {

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
                            return view('Admin/PostCategory/register', $data);
                        }
                        foreach ($wh as $value) {
                            if (!is_numeric(trim($value))) {
                                $data["post"] = $dataForms;
                                session()->setFlashdata('msg_error_crop_image', 'Lỗi');
                                return view('Admin/PostCategory/register', $data);
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

                $slug = $dataForms['slug'];
                // check lại slug lần nữa vì mới chỉ check qua js k tin tưởng được
                $isTrue = $this->utils->checkSlug($postsModel,$slug,$dataForms['post_id']);
                if ($isTrue != true) {
                    $data["post"] = $dataForms;
                    return view('Admin/PostCategory/edit', $data);
                }

                // chuan bi data seo
                $seo_status = $dataForms['post_status'];
                if ($dataForms['post_type']=='CUSTOMER_REVIEW') {
                    $seo_status = 0;
                }
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
                    'seo_status'=> $seo_status,
                    'keywords'=> isset($dataForms['keywords'])? $dataForms['keywords'] :'',
                ];
                $seo_id = $seosModel->saveData($dataFormSeo, $dataForms['seo_id']);
                $dataFormPost = [
                    'post_type' => $dataForms['post_type'],
                    'post_title' => $dataForms['post_title'],
                    'number_order' => isset($dataForms['number_order'])? $dataForms['number_order'] :0,
                    'lang' => $dataForms['lang'],
                    'post_status' => $dataForms['post_status'],
                    'post_introduce' => $dataForms['post_introduce'],
                    'post_content' => $dataForms['post_content'],
                    'seo_id' => $seo_id,
                    'slug' => $slug,
                    'attachment' => $dataAttachment,
                    'seo_status'=> $seo_status,
                ];
                $postsModel->saveData($dataFormPost, $dataForms['post_id']);
                //redirect to plan detail
                session()->setFlashdata('msg_success', 'Thành công');
                return redirect()->to(base_url('post_category?for_menu=1'));
            }
        }
        return view('Admin/PostCategory/edit', $data);
    }


    public function delete_category()
    {
        try {
            $params = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $postsModel = new PostsModel();
            $values = explode(',', $params['list_category_id']);
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
            $postsModel->updateDataByIds($values, $dataUpdate);

            session()->setFlashdata('msg_delete_category', 'Thành công');
            return redirect()->to(base_url('post_category?for_menu=1'));
        } catch (\Exception $ex) {
            session()->setFlashdata('msg_delete_category_error', 'Xóa thất bại');
            return redirect()->to(base_url('post_category?for_menu=1'));
        }

    }

    public function get_category_by_type($category_type)
    {
        $postsModel = new PostsModel();
        $conditions = [
            'deleted_at' => null,
            'post_type' => $category_type,
            'category_id'=>null,
            'post_status'=>1
        ];
        $data['post_categories'] = $postsModel->getByConditions($conditions,'','lang');
        return view('Admin/PostCategory/select_category',$data);
    }

    public function get_category_type($category_type,$lang)
    {
        $postsModel = new PostsModel();
            $conditions = [
                'deleted_at' => null,
                'post_type' => $category_type,
                'category_id'=> null,
                'lang'=> $lang,
                'post_status'=>1
            ];
        $post_categories = $postsModel->getByConditions($conditions,'','number_order');
        return view('Admin/PostCategory/select_category',array('post_categories'=>$post_categories));
    }

}