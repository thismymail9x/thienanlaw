<?php


namespace App\Controllers;


use App\Models\LanguagesCodeModel;
use App\Models\MailsModel;
use CodeIgniter\Model;

class MailController extends BaseController
{

    public function index()
    {
        $currentPageNumber = 1;
        $data = [];
        $allParams = [];
        $mailModel = new MailsModel();
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at' => null]);
        if ($this->request->getVar('for_search') != false) {
            $allParams = $this->request->getGet();
            //keep search conditions on session
            session()->set('mail.search', $allParams);
        } else {
            // when click on menu, clear session if exists
            if ($this->request->getVar('for_menu') != false) {
                if (isset($_SESSION['mail.page']) == true) {
                    session()->remove('mail.page');
                }
                if (isset($_SESSION['mail.search']) == true) {
                    session()->remove('mail.search');
                }
            }
            if (isset($_SESSION['mail.search']) == true) {
                //get conditions from session
                $allParams = session()->get('mail.search');
            }
        }

        $mailModel->search($allParams);
        $totals = $mailModel->countAllResults(false);
        $countPages = $this->utils->getCountPages($totals);
        //get current page number

        if ($this->request->getVar('page_mail') != false) {
            //changed page => set session
            $currentPageNumber = $this->request->getVar('page_mail');
            $_SESSION['mail.page'] = $currentPageNumber;
        } else {
            if (session()->get('mail.page') == true
                && $this->request->getVar('for_menu') == false) {
                $sessionPage = session()->get('mail.page');
                if ($sessionPage <= $countPages) {
                    $currentPageNumber = $sessionPage;
                }
            }
        }
        $languagesCodeModel = new LanguagesCodeModel();
        $data = [
            'mails' => $mailModel->paginate(ITEM_PERPAGE, 'mail', $currentPageNumber),
            'pager' => $mailModel->pager,
            'totals' => $totals,
            'dataSearch' => $allParams,
            'langCode' => $languagesCodeModel->getByConditions(['deleted_at' => null])
        ];

        return view("Admin/Mail/index", $data);
    }


    public function register()
    {

        $data = [];
        $mailModel = new MailsModel();
        $mail = [];
        $data['title_page'] = 'Thêm mới Mail';
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at' => null]);


        if ($this->request->getMethod() == 'post') {
            //set data for validating
            $dataForms = $this->request->getPost(null, FILTER_SANITIZE_STRING);
            $startId = $this->utils->getTimeStampAsId();
            // check ngôn ngữ ấy đã tồn tại chưa
            foreach ($dataForms['lang'] as $value) {
                $dataFormCheck = [
                    'mail_code' => $dataForms['mail_code'],
                    'lang' => $value,
                    'deleted_at' => null
                ];
                $mailCheck = $mailModel->getFirstByConditions($dataFormCheck);
                if (!empty($mailCheck)) {
                    $data["mail"] = $dataForms;
                    session()->setFlashdata('msg_mail_duplicate', 'Lỗi có dữ liệu trùng');
                    return view('Admin/Mail/register', $data);
                }
            }
            $is_error_validate = false;
            //Should reset from previous running
            $this->validation->reset();
            foreach ($dataForms['lang'] as $key => $value) {
                $dataFormkey = [
                    'mail_type' => $dataForms['mail_type'],
                    'mail_status' => $dataForms['mail_status'],
                    'mail_code' => $dataForms['mail_code'],
                    'mail_title' => $dataForms['mail_title'][$key],
                    'mail_content' => $dataForms['mail_content'][$key],
                    'lang' => $value,
                ];
                if (!$this->validation->run($dataFormkey, 'rulesMail')) {
                    $is_error_validate = true;
                    $data["errors"] = $this->validation->getErrors();
                }
                if ($is_error_validate == true) {
                    $data["mail"] = $dataForms;
                    session()->setFlashdata('msg_error_mail', 'Lỗi');
                    return view('Admin/Mail/register', $data);
                } else {
                    $startId++;
                    $mailModel->saveData($dataFormkey, 0, $startId);
                }
            }
            session()->setFlashdata('msg_success_mail', 'Thành công');
            return redirect()->to(base_url('mail?for_menu=1'));
        }

        return view('Admin/Mail/register', $data);
    }


    /**
     * @param string $mail_group
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     * hàm thêm mới + edit dịch vụ, kết hợp cả view giao diện, validate
     */
    public function edit($mail_id = '')
    {

        $data = [];
        $mailModel = new MailsModel();
        $mail = [];
        $data['title_page'] = 'Thêm mới/Sửa thông tin Mail';
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at' => null]);

        if ($mail_id != '') {
            //get by type and lang=en
            $dataSearch = [
                'mail_id' => $mail_id,
            ];
            $mail = $mailModel->getFirstByConditions($dataSearch);
        }
        $data['mail'] = $mail;


        if ($this->request->getMethod() == 'post') {
            //set data for validating
            $dataForms = $this->request->getPost(null, FILTER_SANITIZE_STRING);
            // check ngôn ngữ ấy đã tồn tại chưa

            $dataFormCheck = [
                'mail_code' => $dataForms['mail_code'],
                'lang' => $dataForms['lang'],
                'deleted_at' => null
            ];
            $mailCheck = $mailModel->getFirstByConditions($dataFormCheck);
            if (!empty($mailCheck) && $mailCheck['mail_id'] != $dataForms['mail_id']) {
                $data["mail"] = $dataForms;
                session()->setFlashdata('msg_mail_duplicate_exist', 'Lỗi có dữ liệu trùng');
                return view('Admin/Mail/edit', $data);
            }

            $is_error_validate = false;
            //Should reset from previous running
            $this->validation->reset();
            //Run validating with rules with EN
            if (!$this->validation->run($dataForms, 'rulesMail')) {
                $is_error_validate = true;
                $data["errors"] = $this->validation->getErrors();
            }

            if ($is_error_validate == true) {
                $data["mail"] = $dataForms;
                session()->setFlashdata('msg_error_edit_mail', 'Thành công');
                return view('Admin/Mail/edit', $data);
            } else {
                $mailModel->saveData($dataForms, $dataForms['mail_id']);
                //redirect to plan detail
                session()->setFlashdata('msg_success_edit_mail', 'Thành công');
                return redirect()->to(base_url('mail?for_menu=1'));
            }
        }

        return view('Admin/Mail/edit', $data);
    }

    /**
     * @param string $mailGroup
     * @return string
     * hiển thị thông tin details dịch vụ
     */
    public function detail($mailId = '')
    {
        $data = [];
        $mailModel = new MailsModel();
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at' => null]);
        //get param
        if ($mailId != '') {
            $data['mailId'] = $mailId;
            //get by type and lang=en
            $dataSearch = [
                'mail_id' => $mailId,
                'deleted_at' => null
            ];
            $data['mail'] = $mailModel->getFirstByConditions($dataSearch);
        }
        return view('Admin/Mail/detail', $data);
    }

    /**
     * @return \CodeIgniter\HTTP\RedirectResponse
     * hàm delete multi dịch vụ
     */
    public function delete_mail()
    {
        try {
            $params = $this->request->getPost(null, FILTER_SANITIZE_STRING);
            $mailModel = new MailsModel();
            $condition = 'mail_id';
            $values = explode(',', $params['list_mail_id']);
            $dataUpdate = [
                'deleted_at' => date('Y-m-d H:i:s')
            ];
            $mailModel->updateMultiCondition($condition, $values, $dataUpdate);

            session()->setFlashdata('msg_delete_mail', 'Thành công');
            return redirect()->to(base_url('mail?for_menu=1'));
        } catch (\Exception $ex) {
            session()->setFlashdata('msg_delete_mail_error', 'Xóa thất bại');
            return redirect()->to(base_url('mail?for_menu=1'));
        }

    }

    /**
     * hàm cập nhật trạng thái dịch sẽ lấy theo điều kiện mail_group
     */
    public function ajax_mail_status()
    {
        try {
            $params = $this->request->getGet();
            $mailModel = new MailsModel();
            $conditions = [
                'mail_id' => $params['mail_id'],
            ];
            $dataUpdate = [
                'mail_status' => $params['mail_status']
            ];
            $countUpdated = $mailModel->updateDataByConditions($conditions, $dataUpdate);
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