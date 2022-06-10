<?php

namespace App\Controllers;

use App\Models\AdminsModel;
use App\Models\SeosModel;

class AdminController extends BaseController
{
    public function index()
    {
        $currentPageNumber = 1;
        $data = [];
        $allParams = [];
        $adminModel = new AdminsModel();
        if ($this->request->getVar('for_search') != false) {
            $allParams = $this->request->getGet();
            //keep search conditions on session
            session()->set('admins.search', $allParams);
        } else {
            // when click on admin, clear session if exists
            if ($this->request->getVar('for_menu') != false) {
                if (isset($_SESSION['admins.page']) == true) {
                    session()->remove('admins.page');
                }
                if (isset($_SESSION['admins.search']) == true) {
                    session()->remove('admins.search');
                }
            }
            if (isset($_SESSION['admins.search']) == true) {
                //get conditions from session
                $allParams = session()->get('admins.search');
            }
        }

        $adminModel->search($allParams);

        $totals = $adminModel->countAllResults(false);
        $countPages = $this->utils->getCountPages($totals);
        //get current page number

        if ($this->request->getVar('page_admins') != false) {
            //changed page => set session
            $currentPageNumber = $this->request->getVar('page_admins');
            $_SESSION['admins.page'] = $currentPageNumber;
        } else {
            if (session()->get('admins.page') == true
                && $this->request->getVar('for_menu') == false) {
                $sessionPage = session()->get('admins.page');
                if ($sessionPage <= $countPages) {
                    $currentPageNumber = $sessionPage;
                }
            }
        }

        $data = [
            'admins' => $adminModel->paginate(ITEM_PERPAGE, 'admins', $currentPageNumber),
            'pager' => $adminModel->pager,
            'totals' => $totals,
            'dataSearch' => $allParams,
        ];

        return view("Admin/Admin/index", $data);
    }

    /**
     * register Page for this controller.
     */
    public function register()
    {
        $data = [];
        $adminModel = new AdminsModel();
        $data['title_page'] = 'Thêm mới Admin';

        if ($this->request->getMethod() == 'post') {
            $dataForms = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $is_error_validate = false;
            //Should reset from previous running

            $this->validation->reset();
            if (!$this->validation->run($dataForms, 'rulesAdmin')) {
                $is_error_validate = true;
                $data["errors"] = $this->validation->getErrors();
            }
            if ($is_error_validate == true) {
                $data["admin"] = $dataForms;
                session()->setFlashdata('msg_error_register_admin', 'Lỗi');
                return view('Admin/Admin/register', $data);
            }
            $adminModel->saveData($dataForms, 0);
            session()->setFlashdata('msg_success', 'Thành công');
            return redirect()->to(base_url('admins?for_menu=1'));
        }
        return view('Admin/Admin/register', $data);
    }

    public function detail($id)
    {
        $data = [];
        $model = new AdminsModel();
        $data['admin'] = $model->where('admin_id', $id)->first();
        return view('Admin/Admin/detail', $data);
    }

    public function edit($id = '')
    {
        $data = [];
        $adminModel = new AdminsModel();
        $data['title_page'] = 'Chỉnh sửa Admin';
        if ($id != '') {
            $data['admin'] = $adminModel->getById($id);
        }
        if ($this->request->getMethod() == 'post') {
            $dataForms = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $is_error_validate = false;
            //Should reset from previous running
            $this->validation->reset();
            if (!$this->validation->run($dataForms, 'rulesAdminEdit')) {
                $is_error_validate = true;
                $data["errors"] = $this->validation->getErrors();
            }
            if ($is_error_validate == true) {
                $data["admin"] = $dataForms;
                session()->setFlashdata('msg_error_register_admin', 'Lỗi');
                return view('Admin/Admin/edit', $data);
            }
            $adminModel->saveData($dataForms, $dataForms['admin_id']);
            session()->setFlashdata('msg_success', 'Thành công');
            return redirect()->to(base_url('admins?for_menu=1'));
        }
        return view('Admin/Admin/edit', $data);
    }

    /**
     * changePassword Page for this controller.
     */
    public function change_pass()
    {
        if ($this->request->getMethod() == 'post') {
            // get data request
            $allParams = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $adminModel = new AdminsModel();
            $this->validation->reset();
            if (!$this->validation->run($allParams, 'rulesChangePassword')) {
                $data["errorsPassword"] = $this->validation->getErrors();
                $data["dataPassword"] = $allParams;
                session()->setFlashdata('error-password', 'Cập nhật thất bại');
                return redirect()->back();
            } else {
                $adminModel->update($allParams['admin_id'], $allParams);
                session()->setFlashdata('msg_success_password', 'Thành công');
                return redirect()->back();
            }
        }
    }

    public function ajax_active_admin()
    {
        try {
            $params = $this->request->getGet();
            $adminModel = new AdminsModel();

            $dataUpdate = [
                'active' => $params['active']
            ];
            $countUpdated = $adminModel->update($params['admin_id'], $dataUpdate);
            $data["countUpdated"] = $countUpdated;
            echo json_encode($data);
            exit(1);
        } catch (\Exception $ex) {
            $data["countUpdated"] = "error";
            echo json_encode($data);
            exit(1);
        }
    }

    public function delete_admin()
    {
        try {
            $params = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $adminModel = new AdminsModel();
            $values = explode(',', $params['list_admin_id']);
            $dataUpdate = [
                'deleted_at' => date('Y-m-d H:i:s')
            ];
            $adminModel->updateDataByIds($values, $dataUpdate);
            session()->setFlashdata('msg_delete_admin', 'Thành công');
            return redirect()->to(base_url('admins?for_menu=1'));

        } catch (\Exception $ex) {
            session()->setFlashdata('msg_delete_error', 'Xóa thất bại');
            return redirect()->to(base_url('admins?for_menu=1'));
        }
    }

}