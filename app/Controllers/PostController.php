<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LanguagesCodeModel;
use App\Models\PostCategoriesModel;
use App\Models\PostsModel;
use App\Models\SeosModel;
use CodeIgniter\Model;

class PostController extends BaseController
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
            session()->set('posts.search', $allParams);
        } else {
            // when click on menu, clear session if exists
            if ($this->request->getVar('for_menu') != false) {
                if (isset($_SESSION['posts.page']) == true) {
                    session()->remove('posts.page');
                }
                if (isset($_SESSION['posts.search']) == true) {
                    session()->remove('posts.search');
                }
            }
            if (isset($_SESSION['posts.search']) == true) {
                //get conditions from session
                $allParams = session()->get('posts.search');
            }
        }

        // k lay post có category_id = menu + trang tĩnh
        $conditionNotIn = [MENU_ID,PAGE_ID];
        $whereNotInBy = 'post_id';
        if (isset($allParams['post_type']) && $allParams['post_type'] != '') {
            $conditions['post_type'] = $allParams['post_type'];
        }
        if (isset($allParams['lang']) && $allParams['lang'] != '') {
            $conditions['lang'] = $allParams['lang'];
        }
        $conditions['deleted_at'] = null;
        $conditions['category_id'] = null;
        $conditions['post_status'] = 1;
        $post_categories = $postsModel->getByConditions_v2($conditions,'','','','','',$conditionNotIn,$whereNotInBy);
        $postsModel->search($allParams,false,false);
        $totals = $postsModel->countAllResults(false);
        $countPages = $this->utils->getCountPages($totals);
        //get current page number

        if ($this->request->getVar('page_posts') != false) {
            //changed page => set session
            $currentPageNumber = $this->request->getVar('page_posts');
            $_SESSION['posts.page'] = $currentPageNumber;
        } else {
            if (session()->get('posts.page') == true
                && $this->request->getVar('for_menu') == false) {
                $sessionPage = session()->get('posts.page');
                if ($sessionPage <= $countPages) {
                    $currentPageNumber = $sessionPage;
                }
            }
        }

        $languagesCodeModel = new LanguagesCodeModel();

        $data = [
            'posts' => $postsModel->paginate(ITEM_PERPAGE, 'posts', $currentPageNumber),
            'pager' => $postsModel->pager,
            'totals' => $totals,
            'dataSearch' => $allParams,
            'post_categories' => $post_categories,
            'langCode'=>$languagesCodeModel->getByConditions(['deleted_at'=>null])
        ];

        return view("Admin/Post/index", $data);
    }

    public function register()
    {
        $data = [];
        $postsModel = new PostsModel();
        $data['title_page'] = 'Thêm mới bài viết';
        $languagesCodeModel = new LanguagesCodeModel();
        $seosModel = new SeosModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        $post_categories = $this->get_category();
        $data['post_categories'] = $post_categories;
        if ($this->request->getMethod() == 'post') {
            $dataForms = $this->request->getPost();
            $is_error_validate = false;
            //Should reset from previous running
            $this->validation->reset();
                if (!$this->validation->run($dataForms, 'rulesPost')) {
                    $is_error_validate = true;
                    $data["errors"] = $this->validation->getErrors();
                }
                if ($is_error_validate == true) {
                    $data["post"] = $dataForms;
                    session()->setFlashdata('msg_error_register_post', 'Lỗi');
                    return view('Admin/Post/register', $data);
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
                        return view('Admin/Post/register', $data);
                    }
                    foreach ($wh as $value) {
                        if (!is_numeric(trim($value))) {
                            $data["post"] = $dataForms;
                            session()->setFlashdata('msg_error_crop_image', 'Lỗi');
                            return view('Admin/Post/register', $data);
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
                    $dataForms['attachment'] = implode(',',$attachments);
                }
            } else {
                $dataForms['attachment'] = DEFAULT_IMAGE;
            }

            //26/05/2022 sẽ không lấy slug theo tiêu đề mặc định nữa mà sẽ cho chỉnh sửa theo nhu cầu
            // k có slug thì sẽ lấy theo tiêu đề
            if ($dataForms['slug'] == '') {
                // tao slug bai viet
                $slug = $this->convert_vi_to_en_slug($dataForms['post_title']);
                $dataForms['slug'] = $slug;
            }

            // check lại slug lần nữa vì mới chỉ check qua js k tin tưởng được
            $isTrue = $this->utils->checkSlug($postsModel,$dataForms['slug']);
            if ($isTrue != true) {
                $data["post"] = $dataForms;
                session()->setFlashdata('msg_error_register_post', 'Lỗi');
                return view('Admin/Post/register', $data);
            }

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
                $dataForms['seo_id'] = $seo_id;

            $postsModel->saveData($dataForms, 0);
            session()->setFlashdata('msg_success', 'Thành công');
            return redirect()->to(base_url('post?for_menu=1'));
        }
        return view('Admin/Post/register', $data);
    }


    public function edit($postId = '')
    {
        $data = [];
        $postsModel = new PostsModel();
        $seosModel = new SeosModel();
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        $data['title_page'] = 'Sửa thông tin bài viết';
        if ($postId != '') {
            $data['post'] = $postsModel->getById($postId,'*', 'tbl_seos', 'tbl_posts.seo_id = tbl_seos.seo_id','inner');
            $data['category'] = $postsModel->getById($data['post']['category_id']);
            $data['post_categories'] = $postsModel->getByConditions(['post_type'=>$data['post']['post_type'],'lang'=>$data['post']['lang'],'category_id'=>null,'deleted_at'=>null]);
        }
        if ($this->request->getMethod() == 'post') {
            $dataForms = $this->request->getPost();
            // lấy thông tin cũ của bài viết trước khi update
            $post_old = $postsModel->getById($dataForms['post_id'],'*', 'tbl_seos', 'tbl_posts.seo_id = tbl_seos.seo_id','inner');
            $is_error_validate = false;
            //Should reset from previous running
            $this->validation->reset();
            if (!$this->validation->run($dataForms, 'rulesPost')) {
                $is_error_validate = true;
                $data["errors"] = $this->validation->getErrors();
            }
            if ($is_error_validate == true) {
                $data["post"] = $dataForms;
                if ($dataForms['post_type'] !='' && $dataForms['lang'] != '') {
                    $data['post_categories'] = $postsModel->getByConditions(['post_type'=>$dataForms['post_type'],'lang'=>$dataForms['lang'],'category_id'=>null,'deleted_at'=>null]);
                }
                session()->setFlashdata('msg_error_register_post', 'Lỗi');
                return view('Admin/Post/edit', $data);
            }
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
                $data['post_categories'] = $postsModel->getByConditions(['post_type'=>$dataForms['post_type'],'lang'=>$dataForms['lang'],'category_id'=>null,'deleted_at'=>null]);
                // nếu tồn tại cắt ảnh thì check sau đó tạo chiều cao, chiều rộng
                if (!empty($dataForms['crop_photo'])) {

                    $wh = explode('x',$dataForms['crop_photo']);
                    // check input crop_photo không đúng định dạng
                    if (count($wh) != 2){
//                        $data["post"] = $dataForms;
                        $data['post'] = $postsModel->getById($dataForms['post_id'],'*', 'tbl_seos', 'tbl_posts.seo_id = tbl_seos.seo_id','inner');
                        session()->setFlashdata('msg_error_crop_image', 'Lỗi');
                        return view('Admin/Post/edit', $data);
                    }
                    foreach ($wh as $value) {
                        if (!is_numeric(trim($value))) {
//                            $data["post"] = $dataForms;
                            $data['post'] = $postsModel->getById($dataForms['post_id'],'*', 'tbl_seos', 'tbl_posts.seo_id = tbl_seos.seo_id','inner');
                            session()->setFlashdata('msg_error_crop_image', 'Lỗi');
                            return view('Admin/Post/edit', $data);
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
                        return view('Admin/Post/edit', $data);
                    }
                    $dataForms['attachment'] = implode(',',$attachments);
                }else{
                    $data["post"] = $dataForms;
                    session()->setFlashdata('msg_error_img_post', 'Lỗi');
                    return view('Admin/Post/edit', $data);
                }

            } else {
                $dataForms['attachment'] = $post_old['attachment'];
            }

            // check lại slug lần nữa vì mới chỉ check qua js k tin tưởng được
            $isTrue = $this->utils->checkSlug($postsModel,$dataForms['slug'],$dataForms['post_id']);
            if ($isTrue != true) {
                $data["post"] = $dataForms;
                if ($dataForms['post_type'] !='' && $dataForms['lang'] != '') {
                    $data['post_categories'] = $postsModel->getByConditions(['post_type'=>$dataForms['post_type'],'lang'=>$dataForms['lang'],'category_id'=>null,'deleted_at'=>null]);
                }
                session()->setFlashdata('msg_error_register_post', 'Lỗi');
                return view('Admin/Post/edit', $data);
            }

            // 26/05/2022 : cho phép sửa slug k lấy slug theo tiêu đề nữa
            // tao slug bai viet
            //$slug = $this->convert_vi_to_en_slug($dataForms['post_title']);
            //$dataForms['slug'] = $slug;
            $seo_status = $dataForms['post_status'];
            if ($dataForms['post_type']=='CUSTOMER_REVIEW') {
                $seo_status = 0;
            }
                // chuan bi data seo
                $dataFormSeo = [
                    'canonical' => isset($dataForms['canonical']) ? $dataForms['canonical'] : '',
                    'og_locale' => $dataForms['lang'],
                    'og_type' => 'article',
                    'og_title' => isset($dataForms['og_title']) ? $dataForms['og_title'] : '',
                    'og_description' => isset($dataForms['og_description']) ? $dataForms['og_description'] : '',
                    'og_url' => isset($dataForms['og_url']) ? $dataForms['og_url'] : '',
                    'og_site_name' => isset($dataForms['og_site_name']) ? $dataForms['og_site_name'] : '',
                    'fb_app_id' => isset($dataForms['fb_app_id']) ? $dataForms['fb_app_id'] : '',
                    'seo_google' => isset($dataForms['seo_google']) ? $dataForms['seo_google'] : '',
                    'alternate' => BASE_URL_GLOBAL . '/' . $dataForms['lang'],
                    'seo_status'=> $seo_status,
                    'keywords'=> isset($dataForms['keywords'])? $dataForms['keywords'] :'',
                ];
                $seosModel->saveData($dataFormSeo, $dataForms['seo_id']);


            $postsModel->saveData($dataForms, $dataForms['post_id']);
            session()->setFlashdata('msg_success', 'Thành công');
            return redirect()->to(base_url('post?for_menu=1'));
        }
        return view('Admin/Post/edit', $data);
    }


    public function detail($postId = '')
    {
        $data = [];
        $languagesCodeModel = new LanguagesCodeModel();
        $postsModel = new PostsModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        //get param
        if ($postId != '') {
            $data['post'] = $postsModel->getById($postId,'*', 'tbl_seos', 'tbl_posts.seo_id = tbl_seos.seo_id','inner');
            $data['category'] = $postsModel->getById($data['post']['category_id']);
            $data['post_categories'] = $this->get_category();
        }
        return view('Admin/Post/detail', $data);
    }

    public function delete_post()
    {
        try {
            $params = $this->request->getPost();
            $postsModel = new PostsModel();
            $seosModel = new SeosModel();
            $values = explode(',', $params['list_group_post']);
            $dataUpdate = [
                'deleted_at' => date('Y-m-d H:i:s')
            ];
            $posts = $postsModel->getByIds($values);
            $id_seos = [];
            foreach ($posts as $value) {
                if ($value['seo_id'] != false){
                    array_push($id_seos,$value['seo_id']);
                }
            }
            $seosModel->updateDataByIds($id_seos,$dataUpdate);
            $postsModel->updateDataByIds($values,$dataUpdate);
            session()->setFlashdata('msg_delete', 'Thành công');
            return redirect()->to(base_url('post?for_menu=1'));

        } catch (\Exception $ex) {
            session()->setFlashdata('msg_delete_error', 'Xóa thất bại');
            return redirect()->to(base_url('post?for_menu=1'));
        }
    }

    /**
     * hàm cập nhật trạng thái bài viết sẽ lấy theo điều kiện group_post
     */
    public function ajax_status_post()
    {
        try {
            $params = $this->request->getGet();
            $postsModel = new PostsModel();
            $seosModel = new SeosModel();
            $post = $postsModel->getById($params['post_id']);
            if ($post['seo_id'] != false && $params['post_status']==0){
                $seosModel->update($post['seo_id'],['seo_status'=>0]);
            } elseif ($post['seo_id'] != false && $params['post_status']==1) {
                $seosModel->update($post['seo_id'],['seo_status'=>1]);
            }
            $dataUpdate = [
                'post_status' => $params['post_status']
            ];
            $countUpdated = $postsModel->update($params['post_id'], $dataUpdate);
            $data["countUpdated"] = $countUpdated;
            echo json_encode($data);
            exit(1);
        } catch (\Exception $ex) {
            $data["countUpdated"] = "error";
            echo json_encode($data);
            exit(1);
        }
    }

    public function uploaded_image_tinymce()
    {
        $accepted_origins = array(BASE_URL_GLOBAL);
        $imgFolder = PUBLIC_HTML_PATH . 'public/' . FOLDER_UPLOAD . '/';
        $upload_path = $this->media_path( [
            date( 'Y' ),
            date( 'm' ),
        ], $imgFolder );
        reset($_FILES);
        $tmp = current($_FILES);
        // Allow certain file formats
        if (is_uploaded_file($tmp['tmp_name'])) {

            if (isset($_SERVER['HTTP_ORIGIN'])) {
                if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
                } else {
                    header("HTTP/1.1 403 Origin Denied");
                    return;
                }
            }

            // check valid file name
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $tmp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }
            // check and Verify extension
            if (!in_array(strtolower(pathinfo($tmp['name'], PATHINFO_EXTENSION)), array("gif", "jpg","jpeg", "png", "webp"))) {
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }
            // Accept upload if there was no origin, or if it is an accepted origin
            $fileType = pathinfo(basename($tmp["name"]), PATHINFO_EXTENSION);
            $fileName = $this->random(16,'0123456789abcdefghikml').'.'.$fileType;
            $targetFile = $upload_path . $fileName;
            move_uploaded_file($tmp['tmp_name'], $targetFile);
            $attachment = BASE_URL_GLOBAL . '/public/' . FOLDER_UPLOAD . '/'.date( 'Y' ).'/'.date( 'm' ).'/'  . $fileName;
            echo json_encode(array(
                'file_path' => $attachment
            ));
        } else {
            header("HTTP/1.1 500 Server Error");
        }
    }




    //ajax check slug
    public function check_slug_isset($slug,$id)
    {
        $slug = $this->convert_vi_to_en_slug($slug);
        $postsModel = new PostsModel();
        $check_post = $postsModel->getFirstByConditions(['slug'=>$slug,'deleted_at'=>null]);

        //register
        if ($id == 0) {
            if (!empty($check_post)) {
                echo 1;
            } else {
                echo 2;
            }
        }
        //edit
        if ($id != 0) {

            if (!empty($check_post) && $check_post['post_id'] != $id) {
                echo 1;
            } else {
                echo 2;
            }
        }
        exit();
    }
    // ajax delete image
    public function delete_image($id)
    {
        $default_img = DEFAULT_IMAGE;
        $postsModel = new PostsModel();
        $postsModel->saveData(['attachment'=>$default_img],$id);
    }

    public function get_category()
    {
        $postsModel = new PostsModel();
        $conditionNotIn = [MENU_ID,PAGE_ID];
        $whereNotInBy = 'post_id';
        $conditions['deleted_at'] = null;
        $conditions['category_id'] = null;
        $conditions['post_status'] = 1;
        return $postsModel->getByConditions_v2($conditions,'','','','','',$conditionNotIn,$whereNotInBy);

    }

    public function duplicate($post_id,$menu)
    {
        $postsModel = new PostsModel();
        $seosModel = new SeosModel();
        $post_old = $postsModel->getById($post_id);
        if ($post_old['seo_id'] != false) {
            $seo_old = $seosModel->getById($post_old['seo_id']);
            $seoData=[
                'canonical'=>$seo_old['canonical'],
                'og_locale'=>$seo_old['og_locale'],
                'og_type'=>$seo_old['og_type'],
                'og_title'=>$seo_old['og_title'],
                'og_description'=>$seo_old['og_description'],
                'og_url'=>$seo_old['og_url'],
                'og_site_name'=>$seo_old['og_site_name'],
                'fb_app_id'=>$seo_old['fb_app_id'],
                'seo_google'=>$seo_old['seo_google'],
                'alternate'=>$seo_old['alternate'],
                'seo_status'=>0,
                'keywords'=> $seo_old['alternate'],
            ];
            $seo_id = $seosModel->saveData($seoData,0);
        }
        $post_title = $post_old['post_title'].' duplicate '.date('Ymd His');
        $postData = [
            'post_title'=>$post_title,
            'post_content'=>$post_old['post_content'],
            'post_introduce'=>$post_old['post_introduce'],
            'category_id'=>$post_old['category_id'],
            'post_status'=> 0,
            'post_type'=>$post_old['post_type'],
            'attachment'=>$post_old['attachment'],
            'lang'=>$post_old['lang'],
            'post_creator'=>$post_old['post_creator'],
            'role_creator'=>$post_old['role_creator'],
            'slug'=>$this->convert_vi_to_en_slug($post_title),
            'seo_id'=>isset($seo_id)? $seo_id : $post_old['seo_id'],
        ];
        $postsModel->saveData($postData,0);
        session()->setFlashdata('msg_success', 'Thành công');
        return redirect()->to(base_url(MENU_ADMIN[$menu]));
    }
}