<?php

namespace App\Controllers;

use App\Libraries\Captcha;
use App\Models\ContactsModel;
use App\Models\PostsModel;
use App\Models\RegionsModel;
use App\Models\SeosModel;
use App\Models\ServicesModel;
use CodeIgniter\Model;
use GeoIp2\Database\Reader;
use GeoIp2\WebService\Client;

class Home extends BaseController
{

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        // get ip user
        if ($this->request->getServer('HTTP_CLIENT_IP') != false) {
            $ip = $this->request->getServer('HTTP_CLIENT_IP');
        } elseif ($this->request->getServer('HTTP_X_FORWARDED_FOR')) {
            $ip = $this->request->getServer('HTTP_X_FORWARDED_FOR');
        } else {
            $ip = $this->request->getServer('REMOTE_ADDR');
        }
        // get country user
        $reader = new Reader(PUBLIC_HTML_PATH.'/public/GeoIP2/GeoLite2-Country.mmdb');
        $record = $reader->country($ip);
        $locale = $record->country->isoCode;
        if ($locale == 'VN') {
            $lang = 'vi';
        } else {
            $lang = 'en';
        }
        if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }
        $current_url = 'https://'.$this->request->getServer('HTTP_HOST').$this->request->getServer('REQUEST_URI');
        $base_url = BASE_URL_GLOBAL.'/';
        if ($current_url == $base_url) {
            $url = BASE_URL_GLOBAL.'/'.$lang;
            return redirect()->to($url);
        }
        $postsModel = new PostsModel();
        if($lang=='vi') {
            $slug = SLUG_HOME_VN;
            $blog_bottom_slug = BLOG_BOTTOM_SLUG_VN;
        } else {
            $slug = SLUG_HOME_EN;
            $blog_bottom_slug = BLOG_BOTTOM_SLUG_EN;
        }
        $tableJoin = 'tbl_seos';
        $withJoinConditions = 'tbl_posts.seo_id = tbl_seos.seo_id';
        $data['page'] = $postsModel->getFirstByConditions([
            'tbl_posts.slug' => $slug,'tbl_posts.lang'=>$lang,'tbl_posts.post_status' => 1],
            '','','','',
            $tableJoin, $withJoinConditions);
        $data['menu']=$this->get_menu();
        $data['menu_footer']=$this->get_menu(2);
        $data['seos'] = $this->make_data_seo($data['page']);
        $data['home_seo'] = $this->get_home_seo();
        $data['blog_bottom'] = $postsModel->getFirstByConditions(['slug'=>$blog_bottom_slug]);
        $data['customer_reviews'] = $postsModel->getByConditions(['post_type'=>'CUSTOMER_REVIEW','category_id !='=>null,'lang'=>$lang],9);
        return view('Home/page', $data);
    }

    /**
     * @param $slug
     * @return string
     * hiển thị các bài viết của từng danh mục của blog
     */
    public function blogs($slug)
    {
        $data=[];
        $postsModel = new PostsModel();
        $lang = 'vi';
        if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }
        if($lang=='vi') {
            $blog_bottom_slug = BLOG_BOTTOM_SLUG_VN;
        } else {
            $blog_bottom_slug = BLOG_BOTTOM_SLUG_EN;
        }
        $data['category'] = $postsModel->getFirstByConditions(['tbl_posts.slug'=>$slug],'','','','*','tbl_seos','tbl_seos.seo_id = tbl_posts.seo_id');

        $conditionBlogs = [
            'post_type'=>'BLOG',
            'category_id'=>null,
            'deleted_at'=>null,
            'lang'=>$lang
        ];
        $data['categories'] = $postsModel->getByConditions($conditionBlogs,'','number_order','desc');
        $params =[
            'category_id'=> isset($data['category']) ? $data['category']['post_id'] : 1,
            'post_status'=>1,
        ];
        $data['seos'] = $this->make_data_seo($data['category']);
        $data['menu']=$this->get_menu();
        $data['menu_footer']=$this->get_menu(2);
        $data['blog_bottom'] = $postsModel->getFirstByConditions(['slug'=>$blog_bottom_slug]);
        $data['home_seo'] = $this->get_home_seo();
        $postsModel->paginate_custom($params);
        $totals = $postsModel->countAllResults(false);
        $countPages = $this->utils->getCountPages($totals);
        $currentPageNumber=1;
        if ($this->request->getVar('page_blogs') != false) {
            //changed page => set session
            $currentPageNumber = $this->request->getVar('page_blogs');
            $_SESSION['page.blogs'] = $currentPageNumber;
        } else {
            if (session()->get('page.blogs') == true) {
                $sessionPage = session()->get('page.blogs');
                if ($sessionPage <= $countPages) {
                    $currentPageNumber = $sessionPage;
                }
            }
        }
        $data['blogs'] = $postsModel->paginate(ITEM_PERPAGE_HOME, 'blogs', $currentPageNumber);
        $data['pager'] = $postsModel->pager;
        return view('Home/blogs', $data);
    }

    /**
     * @return string
     * hiển thị 1 bài viết cụ thể blog
     */
    public function blog()
    {
        $uri = service('uri');
        $slug = $uri->getSegment(2);
        $category_slug = $uri->getSegment(1);
        $postsModel = new PostsModel();
        $tableJoin = 'tbl_seos';
        $lang = 'vi';
        if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }
        $withJoinConditions = 'tbl_seos.seo_id = tbl_posts.seo_id';
        $data['blog'] = $postsModel->getFirstByConditions(['tbl_posts.slug' => $slug,'tbl_posts.lang'=>$lang,'tbl_posts.post_status' => 1,'tbl_posts.deleted_at'=>null], '','','','', $tableJoin, $withJoinConditions);
        // get blog more
        $conditions = [
            'post_id !=' => $data['blog']['post_id'],
            'lang'=>$lang,
            'category_id'=>$data['blog']['category_id'],
            'deleted_at' => null,
            'post_status' => 1
        ];
        $data['blogs_more'] = $postsModel->getByConditions($conditions, 3, 'RAND()');
        if($lang=='vi') {
            $blog_bottom_slug = BLOG_BOTTOM_SLUG_VN;
        } else {
            $blog_bottom_slug = BLOG_BOTTOM_SLUG_EN;
        }
        $data['category'] = $postsModel->getFirstByConditions(['tbl_posts.slug'=>$category_slug],'','','','*','tbl_seos','tbl_seos.seo_id = tbl_posts.seo_id');
        $data['menu']=$this->get_menu();
        $data['menu_footer']=$this->get_menu(2);
        $data['blog_bottom'] = $postsModel->getFirstByConditions(['slug'=>$blog_bottom_slug]);
        $data['seos'] = $this->make_data_seo($data['blog']);
        $data['home_seo'] = $this->get_home_seo();
        // nếu slug của danh mục bị chỉnh sửa và sai thì sẽ suất lỗi
        if (empty($data['category']) || empty($data['blog'])) {
            return view('errors/html/production');
        }

        return view('Home/blog-child', $data);
    }

    /**
     * @param $slug
     * @return string
     * hiển thị view trang tĩnh
     */
    public function page($slug)
    {
        $postsModel = new PostsModel();
        $lang = 'vi';
        if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }
        if($lang=='vi') {
            $blog_bottom_slug = BLOG_BOTTOM_SLUG_VN;
        } else {
            $blog_bottom_slug = BLOG_BOTTOM_SLUG_EN;
        }
        $tableJoin = 'tbl_seos';
        $withJoinConditions = 'tbl_posts.seo_id = tbl_seos.seo_id';
        $data['page'] = $postsModel->getFirstByConditions([
            'tbl_posts.slug' => $slug,'tbl_posts.lang'=>$lang,'tbl_posts.post_status' => 1],
            '','','','', $tableJoin, $withJoinConditions);
        $data['menu']=$this->get_menu();
        $data['menu_footer']=$this->get_menu(2);
        $data['seos'] = $this->make_data_seo($data['page']);
        $data['home_seo'] = $this->get_home_seo();
        $data['blog_bottom'] = $postsModel->getFirstByConditions(['slug'=>$blog_bottom_slug]);
        return view('Home/page', $data);
    }

    /**
     * @return string
     * trang main support
     */
    public function support()
    {
        $data=[];
        $postsModel = new PostsModel();
        $lang = 'vi';
        if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }
        if($lang=='vi') {
            $blog_bottom_slug = BLOG_BOTTOM_SLUG_VN;
            $support_slug = SUPPORT_PAGE_SLUG_VN;
        } else {
            $blog_bottom_slug = BLOG_BOTTOM_SLUG_EN;
            $support_slug = SUPPORT_PAGE_SLUG_EN;
        }
        $conditionBlogs = [
            'post_type'=>'SUPPORT',
            'category_id'=>null,
            'deleted_at'=>null,
            'lang'=>$lang
        ];
        $data['blogCategories'] = $postsModel->getByConditions($conditionBlogs,'','number_order','asc');

        if (!empty($data['blogCategories'])) {
            foreach ($data['blogCategories'] as $k => $v) {
                $postConditions = [
                    'deleted_at' => null,
                    'lang'=> $lang,
                    'category_id' => $v['post_id'],
                    'post_status' => 1
                ];
                $data['blogCategories'][$k]['posts'] = $postsModel->getByConditions($postConditions, 4);
            }
        }
        $data['page'] = $postsModel->getFirstByConditions([
            'tbl_posts.slug' => $support_slug,
            'tbl_posts.lang'=>$lang,'tbl_posts.post_status' => 1],
            '','','','', 'tbl_seos',
            'tbl_seos.seo_id=tbl_posts.seo_id');
        $data['seos'] = $this->make_data_seo($data['page']);
        $data['home_seo'] = $this->get_home_seo();
        $data['menu']=$this->get_menu();
        $data['menu_footer']=$this->get_menu(2);
        $data['blog_bottom'] = $postsModel->getFirstByConditions(['slug'=>$blog_bottom_slug]);
        return view('Home/support', $data);
    }

    /**
     * @param $slug_category
     * @return string
     * lấy thông tin từng danh mục của phần support
     */
    public function support_category($slug_category)
    {
        $data=[];
        $postsModel = new PostsModel();
        $lang = 'vi';
        if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }
        if($lang=='vi') {
            $blog_bottom_slug = BLOG_BOTTOM_SLUG_VN;
        } else {
            $blog_bottom_slug = BLOG_BOTTOM_SLUG_EN;
        }
        $data['category'] = $postsModel->getFirstByConditions(['tbl_posts.slug'=>$slug_category],'','','','*','tbl_seos','tbl_seos.seo_id = tbl_posts.seo_id');
        $params =[
            'category_id'=>$data['category']['post_id'],
            'post_status'=>1,
        ];
        $data['seos'] = $this->make_data_seo($data['category']);
        $data['home_seo'] = $this->get_home_seo();
        $data['menu']=$this->get_menu();
        $data['menu_footer']=$this->get_menu(2);
        $data['blog_bottom'] = $postsModel->getFirstByConditions(['slug'=>$blog_bottom_slug]);
        // phân trang
        $postsModel->paginate_custom($params);
        $totals = $postsModel->countAllResults(false);
        $countPages = $this->utils->getCountPages($totals);
        $currentPageNumber=1;
        if ($this->request->getVar('page_supports') != false) {
            //changed page => set session
            $currentPageNumber = $this->request->getVar('page_supports');
            $_SESSION['page.supports'] = $currentPageNumber;
        } else {
            if (session()->get('page.supports') == true) {
                $sessionPage = session()->get('page.supports');
                if ($sessionPage <= $countPages) {
                    $currentPageNumber = $sessionPage;
                }
            }
        }
        $data['supports'] = $postsModel->paginate(ITEM_PERPAGE_HOME, 'supports', $currentPageNumber);
        $data['pager'] = $postsModel->pager;
        $data['menu']=$this->get_menu();
        $data['menu_footer']=$this->get_menu(2);
        return view('Home/category-support', $data);
    }

    /**
     * @param $search
     * @return string
     * hàm tìm kiếm bài viết trong phần hướng dẫn
     */
    public function support_search($search)
    {
        $postsModel = new PostsModel();
        $lang = 'vi';
        if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }
        if($lang=='vi') {
            $support_slug = SUPPORT_PAGE_SLUG_VN;
        } else {
            $support_slug = SUPPORT_PAGE_SLUG_EN;
        }

//        $blogConditions = [
//            'lang'=> $lang,
//            'post_type' => 'SUPPORT',
//           'post_title' => $search,
//           'post_status' => 1,
//        ];


        $conditionBlogCategories = [
            'post_type'=>'SUPPORT',
            'category_id'=>null,
            'deleted_at'=>null,
            'lang'=>$lang
        ];
        $data['blogCategories'] = $postsModel->getByConditions($conditionBlogCategories,'','number_order','asc');

        if (!empty($data['blogCategories'])) {
            foreach ($data['blogCategories'] as $k => $v) {
                $postConditions = [
                    'lang'=> $lang,
                    'category_id' => $v['post_id'],
                    'post_status' => 1,
                    'post_title' => $search,
                    'post_type'=> 'SUPPORT',
                ];
                $post = $postsModel->searchByConditions($postConditions);
                if (!empty($post)) {
                    $data['blogCategories'][$k]['posts'] = $post;
                }
            }
        }
        // duyệt lại để check xem có kết quả không, nếu k có thì loại bỏ category đi
        if (!empty($data['blogCategories'])) {
        foreach ($data['blogCategories'] as $key => $value) {
            if(!isset($value['posts'])) {
                unset($data['blogCategories'][$key]);
            }
        }
        }
        $data['page'] = $postsModel->getFirstByConditions([
            'tbl_posts.slug' => $support_slug,
            'tbl_posts.lang'=>$lang,'tbl_posts.post_status' => 1],
            '','','','', 'tbl_seos',
            'tbl_seos.seo_id=tbl_posts.seo_id');

        $data['menu']=$this->get_menu();
        $data['menu_footer']=$this->get_menu(2);
        $data['lang'] = $lang;
        return view('Home/support-search',$data);
    }

    /**
     * @return string
     * view  trang liên hệ
     */
//    public function contact()
//    {
//        $lang = 'vi';
//        if (isset($_COOKIE['lang'])) {
//            $lang = $_COOKIE['lang'];
//        }
//        if($lang=='vi') {
//            $blog_bottom_slug = BLOG_BOTTOM_SLUG_VN;
//        } else {
//            $blog_bottom_slug = BLOG_BOTTOM_SLUG_EN;
//        }
//        $postsModel = new PostsModel();
//        $data['blog_bottom'] = $postsModel->getFirstByConditions(['slug'=>$blog_bottom_slug]);
//        $data['code'] = $this->utils->genCodeByMd5(15, 5);
//        $regionModel = new RegionsModel();
//        $data['regions'] = $regionModel->getByConditions([]);
//        $data['menu']=$this->get_menu();
//        $data['menu_footer']=$this->get_menu(2);
//        $data['home_seo'] = $this->get_home_seo();
//        $this->captcha->phpcaptcha('#FFF','#00802b',120,31,0,5);
//        return view('Home/contact', $data);
//    }

    /**
     * @return string
     * lưu bài phần liên hệ của khach hang
     */
    public function register_contact()
    {
        $lang = 'vi';
        if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }
        if($lang=='vi') {
            $blog_bottom_slug = BLOG_BOTTOM_SLUG_VN;
        } else {
            $blog_bottom_slug = BLOG_BOTTOM_SLUG_EN;
        }
        $data["lang"] = $lang;
        $contactModel = new ContactsModel();
        $regionModel = new RegionsModel();
        $regions = $regionModel->getByConditions([]);
        if ($this->request->getMethod() == 'post') {
            //set data for validating
            $dataForms = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            if (isset($_SESSION['value_captcha'])) {
                $dataForms['security_code']= $_SESSION['value_captcha'];
            }
            $is_error_validate = false;
            //Should reset from previous running
            $this->validation->reset();
            if (!$this->validation->run($dataForms, 'rulesContactRegister')) {
                $is_error_validate = true;
                $data["errors"] = $this->validation->getErrors();
            }
            //Should reset from previous running
            if ($is_error_validate == true) {
                $data["contact"] = $dataForms;
                $data["regions"] = $regions;
                $data['menu']=$this->get_menu();
                $data['menu_footer']=$this->get_menu(2);
                $this->captcha->phpcaptcha('#FFF','#00802b',120,31,0,5);
                session()->setFlashdata('msg_error_contact', 'Loi');
                return view('Home/contact', $data);
            } else {
                $upload_path = PUBLIC_HTML_PATH . 'public/' . FOLDER_CONTACT . '/';
                // save image file
                if (!empty($_FILES["file"]["name"])) {
                    // Get file info
                    $fileName = basename($_FILES["file"]["name"]);
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                    $fileName = date('Y-m-d-H-i-s').'_'.$fileName;
                    $targetFile = $upload_path . $fileName;
                    // tối đa 10mb;
                    $maxfilesize = 10000000;
                    // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
                    $errorUpload = ['php','htaccess'];
                    if (!in_array($fileType,$errorUpload) && $_FILES["file"]["size"] < $maxfilesize) {
                         if (!file_exists($targetFile)) {
                             move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);
                         }
                    } else {
                        $data["contact"] = $dataForms;
                        $data["regions"] = $regions;
                        $data['menu']=$this->get_menu();
                        $data['menu_footer']=$this->get_menu(2);
                        session()->setFlashdata('msg_error_file', 'Loi');
                        return view('Home/contact', $data);
                    }
                    //put content into db
                    $dataForms['attachment'] = $fileName;
                }
                $dataForms['status'] = 0;
                $contactModel->saveData($dataForms, 0);
                //redirect to plan detail
                session()->setFlashdata('msg_success_contact', 'Thành công');
                return redirect()->to(base_url('').'/contact');
            }
        }
        $postsModel = new PostsModel();
        $data['blog_bottom'] = $postsModel->getFirstByConditions(['slug'=>$blog_bottom_slug]);
        $data['code'] = $this->utils->genCodeByMd5(15, 5);
        $data['regions'] = $regionModel->getByConditions([]);
        $data['menu']=$this->get_menu();
        $data['menu_footer']=$this->get_menu(2);
        $data['home_seo'] = $this->get_home_seo();
        $this->captcha->phpcaptcha('#FFF','#00802b',120,31,0,5);
        return view('Home/contact', $data);

    }

    /**
     * hàm lấy mã capcha trang contact
     */
    public function get_captcha()
    {
        $this->captcha->phpcaptcha('#FFF','#00802b',120,31,0,5);
    }

    /**
     * @param int $menu
     * @return array|object|null
     *
     * hàm lấy data bài viết là menu (hiện tại có 2 menu, menu navbar =1, menu footer =2)
     */
    public function get_menu($menu = 1)
    {
        $lang = 'vi';
        if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }
        $postsModel = new PostsModel();
        $condition = [
            'lang'=>$lang,
            'number_order'=>$menu,
            'category_id'=>MENU_ID,
            'post_status'=> 1,
            'deleted_at'=>null
        ];
        return $postsModel->getFirstByConditions($condition);
    }

    /**
     * @param $post
     * @return array
     * hàm tạo data seo
     */
    public function make_data_seo($post)
    {
        $attachments = explode(',',$post['attachment']);
        return [
            'canonical'=> $post['canonical'],
            'og_locale'=>$post['og_locale'],
            'og_type'=>$post['og_type'],
            'og_title'=>$post['og_title'],
            'og_description'=>$post['og_description'],
            'og_url '=>$post['og_url'],
            'og_site_name'=>$post['og_site_name'],
            'fb_app_id'=>$post['fb_app_id'],
            'seo_google'=>$post['seo_google'],
            'alternate'=>$post['alternate'],
            'og_image'=>$attachments[2],
            'keywords'=>$post['keywords'],
        ];
    }

    /**
     * hàm tạo sitemap
     */
    function sitemap()
    {
        $lang = 'vi';
        if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }
        $seosModel = new SeosModel();
        $data['data'] = $seosModel->getByConditions(['deleted_at'=>null,'seo_status'=>1,'og_locale'=>$lang]);
        echo view("sitemap",$data);
    }

    /**
     * lấy thông tin seo của trang chủ
     */
    public function get_home_seo()
    {
        $postsModel = new PostsModel();
        $lang = 'vi';
        if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }
        if($lang=='vi') {
            $slug = SLUG_HOME_VN;
        } else {
            $slug = SLUG_HOME_EN;
        }
        $tableJoin = 'tbl_seos';
        $withJoinConditions = 'tbl_posts.seo_id = tbl_seos.seo_id';
        $page = $postsModel->getFirstByConditions([
            'tbl_posts.slug' => $slug,'tbl_posts.lang'=>$lang,'tbl_posts.post_status' => 1,'tbl_posts.deleted_at'=>null],
            '','','','',
            $tableJoin, $withJoinConditions);
        return $this->make_data_seo($page);
    }
    public function getCaptcha()
    {

        $data=[];
        try{
            $data = $this->captcha->phpcaptcha('#FFF','#00802b',120,31,0,5,'#00995c',true);
            $data['csrf'] = csrf_hash();
            $data['exit_code'] = "0";
            echo json_encode($data);
            exit(1);
        } catch (\Exception $ex){
            $data['csrf'] = csrf_hash();
            $data['exit_code'] = "1";
            echo json_encode($data);
            exit(1);
        }
    }
}

