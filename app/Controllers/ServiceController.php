<?php


namespace App\Controllers;


use App\Models\LanguagesCodeModel;
use App\Models\MailsModel;
use App\Models\ServicesModel;

class ServiceController extends BaseController
{
    public function index()
    {
        $currentPageNumber = 1;
        $data = [];
        $allParams = [];
        $serviceModel = new ServicesModel();
        if ($this->request->getVar('for_search') != false) {
            $allParams = $this->request->getGet();
            //keep search conditions on session
            session()->set('service.search', $allParams);
        } else {
            // when click on menu, clear session if exists
            if ($this->request->getVar('for_menu') != false) {
                if (isset($_SESSION['service.page']) == true) {
                    session()->remove('service.page');
                }
                if (isset($_SESSION['service.search']) == true) {
                    session()->remove('service.search');
                }
            }
            if (isset($_SESSION['service.search']) == true) {
                //get conditions from session
                $allParams = session()->get('service.search');
            }
        }

        $serviceModel->search($allParams);

        $totals = $serviceModel->countAllResults(false);
        $countPages = $this->utils->getCountPages($totals);
        //get current page number

        if ($this->request->getVar('page_service') != false) {
            //changed page => set session
            $currentPageNumber = $this->request->getVar('page_service');
            $_SESSION['service.page'] = $currentPageNumber;
        } else {
            if (session()->get('service.page') == true
                && $this->request->getVar('for_menu') == false) {
                $sessionPage = session()->get('service.page');
                if ($sessionPage <= $countPages) {
                    $currentPageNumber = $sessionPage;
                }
            }
        }
        $languagesCodeModel = new LanguagesCodeModel();
        $data = [
            'services' => $serviceModel->paginate(ITEM_PERPAGE, 'service', $currentPageNumber),
            'pager' => $serviceModel->pager,
            'totals' => $totals,
            'dataSearch' => $allParams,
            'langCode'=>$languagesCodeModel->getByConditions(['deleted_at'=>null])
        ];
        
        return view("Admin/Service/index", $data);
    }

    public function register()
    {

        $data = [];
        $serviceModel = new ServicesModel();
        $data['title_page'] = 'Thêm mới dịch vụ';
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        if ($this->request->getMethod() == 'post') {
            $dataForms = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $startId = $this->utils->getTimeStampAsId();
            $is_error_validate = false;
            //Should reset from previous running
            $this->validation->reset();
            foreach ($dataForms['lang'] as $key=>$value) {
                $dataFormkey = [
                    'service_name' => $dataForms['service_name'][$key],
                    'service_status' => $dataForms['service_status'],
                    'number_order' => $dataForms['number_order'][$key],
                    'service_timeline' => $dataForms['service_timeline'],
                    'service_price' => $dataForms['service_price'][$key],
                    'service_introduce' => $dataForms['service_introduce'][$key],
                    'service_content' => $dataForms['service_content'][$key],
                    'lang' => $value,
                ];
                if (!$this->validation->run($dataFormkey, 'rulesService')) {
                    $is_error_validate = true;
                    $data["errors"] = $this->validation->getErrors();
                }
                if ($is_error_validate == true) {
                    $data["service"] = $dataForms;
                    session()->setFlashdata('msg_error_register_service', 'Lỗi');
                    return view('Admin/Service/register', $data);
                } else {
                    $startId++;
                    $serviceModel->saveData($dataFormkey, 0, $startId);
                }
            }
            session()->setFlashdata('msg_success_register_service', 'Thành công');
            return redirect()->to(base_url('service?for_menu=1'));
        }

        return view('Admin/Service/register', $data);
    }
    /**
     * @param string $service_group
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     * hàm thêm mới + edit dịch vụ, kết hợp cả view giao diện, validate
     */
    public function edit($service_id = '')
    {

        $data = [];
        $service = [];
        $serviceModel = new ServicesModel();
        $data['title_page'] = 'Sửa thông tin dịch vụ';
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        if ($service_id != '') {
            $service = $serviceModel->getById($service_id);
        }
        $data['service'] = $service;
        if ($this->request->getMethod() == 'post') {
            //set data for validating

            $dataForms = $this->request->getPost(null,FILTER_SANITIZE_STRING);

            $is_error_validate = false;
            //Should reset from previous running
            $this->validation->reset();
            //Run validating with rules with EN
            if (!$this->validation->run($dataForms, 'rulesService')) {
                $is_error_validate = true;
                $data["errors"] = $this->validation->getErrors();
            }
            //Should reset from previous running
            $this->validation->reset();

            if ($is_error_validate == true) {
                $data["service"] = $dataForms;
                return view('Admin/Service/edit', $data);
            } else {
                $serviceModel->saveData($dataForms, $dataForms['service_id']);
                //redirect to plan detail
                session()->setFlashdata('msg_success', 'Thành công');
                return redirect()->to(base_url('service?for_menu=1'));
            }
        }

        return view('Admin/Service/edit', $data);
    }

    /**
     * @param string $serviceGroup
     * @return string
     * hiển thị thông tin details dịch vụ
     */
    public function detail($service_id = '')
    {
        $data = [];
        $serviceModel = new ServicesModel();
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        //get param
        if ($service_id != '') {
            $data['service'] = $serviceModel->getById($service_id);
        }
        return view('Admin/Service/detail', $data);
    }

    /**
     * @return \CodeIgniter\HTTP\RedirectResponse
     * hàm delete multi dịch vụ
     */
    public function delete_service()
    {
        try {
            $params = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $serviceModel = new ServicesModel();
            $condition = 'service_group';
            $values = explode(',', $params['list_service_group']);
            $dataUpdate = [
                'deleted_at' => date('Y-m-d H:i:s')
            ];
            $serviceModel->updateMultiCondition($condition, $values, $dataUpdate);

            session()->setFlashdata('msg_delete_service', 'Thành công');
            return redirect()->to(base_url('service?for_menu=1'));
        } catch (\Exception $ex) {
            session()->setFlashdata('msg_delete_service_error', 'Xóa thất bại');
            return redirect()->to(base_url('service?for_menu=1'));
        }

    }
    /**
     * hàm cập nhật trạng thái dịch sẽ lấy theo điều kiện service_group
     */
    public function ajax_service_status()
    {
        try {
            $params = $this->request->getGet();
            $serviceModel = new ServicesModel();
            $conditions = [
                'service_group' => $params['service_group'],
            ];
            $dataUpdate = [
                'service_status' => $params['service_status']
            ];
            $countUpdated = $serviceModel->updateDataByConditions($conditions, $dataUpdate);
            $data["countUpdated"] = $countUpdated;
            echo json_encode($data);
            exit(1);
        } catch (\Exception $ex) {
            $data["countUpdated"] = "error";
            echo json_encode($data);
            exit(1);
        }
    }
    
}