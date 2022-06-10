<?php

namespace App\Controllers;

use App\Models\LanguagesCodeModel;
use App\Models\PostCategoriesModel;
use App\Models\PostsModel;

class MenuController extends BaseController
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
            session()->set('menu.search', $allParams);
        } else {
            // when click on menu, clear session if exists
            if ($this->request->getVar('for_menu') != false) {
                if (isset($_SESSION['menu.page']) == true) {
                    session()->remove('menu.page');
                }
                if (isset($_SESSION['menu.search']) == true) {
                    session()->remove('menu.search');
                }
            }
            if (isset($_SESSION['menu.search']) == true) {
                //get conditions from session
                $allParams = session()->get('menu.search');
            }
        }
        if (isset($allParams['status']) && $allParams['status'] == '-1') {
            unset($allParams['status']);
        }

        $postsModel->search($allParams,true,false);

        $totals = $postsModel->countAllResults(false);
        $countPages = $this->utils->getCountPages($totals);
        //get current page number

        if ($this->request->getVar('page_menu') != false) {
            //changed page => set session
            $currentPageNumber = $this->request->getVar('page_menu');
            $_SESSION['menu.page'] = $currentPageNumber;
        } else {
            if (session()->get('menu.page') == true
                && $this->request->getVar('for_menu') == false) {
                $sessionPage = session()->get('menu.page');
                if ($sessionPage <= $countPages) {
                    $currentPageNumber = $sessionPage;
                }
            }
        }
        $languagesCodeModel = new LanguagesCodeModel();
        $data = [
            'menus' => $postsModel->paginate(ITEM_PERPAGE, 'menu', $currentPageNumber),
            'pager' => $postsModel->pager,
            'totals' => $totals,
            'dataSearch' => $allParams,
            'langCode'=>$languagesCodeModel->getByConditions(['deleted_at'=>null]),
            'category'=>$postsModel->getById(MENU_ID),
        ];

        return view("Admin/Menu/index", $data);
    }

    public function register()
    {
        $data = [];
        $postsModel = new PostsModel();
        $data['title_page'] = 'Thêm mới Menu';
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        // id cua danh mục menu = 22010920181163 là 1 số cố định
        $postCategory = $postsModel->getById(MENU_ID);
        if ($this->request->getMethod() == 'post') {
            $dataForms = $this->request->getPost();
            $dataForms['category_id'] = $postCategory['post_id'];
            $dataForms['post_type'] = $postCategory['post_type'];
            $dataForms['attachment'] = DEFAULT_IMAGE;
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
                return view('Admin/Menu/register', $data);
            }
            // tao slug bai viet
            $slug = $this->convert_vi_to_en_slug($dataForms['post_title']);
            $dataForms['slug'] = $slug;
            $postsModel->saveData($dataForms, 0);
            session()->setFlashdata('msg_success', 'Thành công');
            return redirect()->to(base_url('menu?for_menu=1'));
        }
        return view('Admin/Menu/register', $data);
    }
    public function edit($postId = '')
    {
        $data = [];
        $postsModel = new PostsModel();
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        $postCategory = $postsModel->getById(MENU_ID);
        $data['title_page'] = 'Sửa thông tin menu';
        if ($postId != '') {
            $data['post'] = $postsModel->getById($postId);
//            $data['post_categories'] = $this->get_category();
        }
        if ($this->request->getMethod() == 'post') {
            $dataForms = $this->request->getPost();
            $dataForms['category_id'] = $postCategory['post_id'];
            $dataForms['post_type'] = $postCategory['post_type'];
            $dataForms['attachment'] = DEFAULT_IMAGE;
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
                return view('Admin/Menu/edit', $data);
            }
            // tao slug bai viet
            $slug = $this->convert_vi_to_en_slug($dataForms['post_title']);
            $dataForms['slug'] = $slug;

            $postsModel->saveData($dataForms, $dataForms['post_id']);
            session()->setFlashdata('msg_success', 'Thành công');
            return redirect()->to(base_url('menu?for_menu=1'));
        }

        return view('Admin/Menu/edit', $data);
    }
    public function delete_menu()
    {
        try {
            $params = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $postsModel = new PostsModel();
            $values = explode(',', $params['list_menu_id']);
            $dataUpdate = [
                'deleted_at' => date('Y-m-d H:i:s')
            ];
            $postsModel->updateDataByIds($values,$dataUpdate);
            session()->setFlashdata('msg_delete-menu', 'Thành công');
            return redirect()->to(base_url('menu?for_menu=1'));

        } catch (\Exception $ex) {
            session()->setFlashdata('msg_delete_error', 'Xóa thất bại');
            return redirect()->to(base_url('menu?for_menu=1'));
        }
    }
}