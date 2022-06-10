<?php


namespace App\Controllers;


use App\Models\ContactsModel;
use App\Models\RegionsModel;
use CodeIgniter\Model;

class ContactController extends BaseController
{

    public function index()
    {

        $currentPageNumber = 1;
        $data = [];
        $allParams = [];
        $contactModel = new ContactsModel();


        if ($this->request->getVar('for_search') != false) {
            $allParams = $this->request->getGet();
            //keep search conditions on session
            session()->set('contact.search', $allParams);
        } else {
            // when click on menu, clear session if exists
            if ($this->request->getVar('for_menu') != false) {
                if (isset($_SESSION['contact.page']) == true) {
                    session()->remove('contact.page');
                }
                if (isset($_SESSION['contact.search']) == true) {
                    session()->remove('contact.search');
                }
            }
            if (isset($_SESSION['contact.search']) == true) {
                //get conditions from session
                $allParams = session()->get('contact.search');
            }
        }


        $contactModel->search($allParams);

        $totals = $contactModel->countAllResults(false);

        $countPages = $this->utils->getCountPages($totals);
        //get current page number

        if ($this->request->getVar('page_contact') != false) {
            //changed page => set session
            $currentPageNumber = $this->request->getVar('page_contact');
            $_SESSION['contact.page'] = $currentPageNumber;
        } else {
            if (session()->get('contact.page') == true
                && $this->request->getVar('for_menu') == false) {
                $sessionPage = session()->get('contact.page');
                if ($sessionPage <= $countPages) {
                    $currentPageNumber = $sessionPage;
                }
            }
        }
        $data = [
            'contacts' => $contactModel->paginate(ITEM_PERPAGE, 'contact', $currentPageNumber),
            'pager' => $contactModel->pager,
            'totals' => $totals,
            'dataSearch' => $allParams,
        ];

        return view("Admin/Contact/index", $data);
    }

    /**
     * @param string $contactGroup
     * @return string
     * hiển thị thông tin details dịch vụ
     */
    public function detail($contactId = '')
    {
        $data = [];
        $contactModel = new ContactsModel();
        $regionModel = new RegionsModel();

        //get param
        if ($contactId != '') {
            $data['contact'] = $contactModel->getById($contactId);
        }
        $data['region'] = $regionModel->getById([$data['contact']['location']]);
        return view('Admin/Contact/detail', $data);
    }

    /**
     * @return \CodeIgniter\HTTP\RedirectResponse
     * hàm delete multi dịch vụ
     */
    public function delete_contact()
    {
        try {
            $params = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $contactModel = new ContactsModel();
            $values = explode(',', $params['contact_list']);
            $dataUpdate = [
                'deleted_at' => date('Y-m-d H:i:s')
            ];
            $contactModel->updateDataByIds($values, $dataUpdate);

            session()->setFlashdata('msg_delete_contact', 'Thành công');
            return redirect()->to(base_url('contact-user?for_menu=1'));
        } catch (\Exception $ex) {
            session()->setFlashdata('msg_delete_contact_error', 'Xóa thất bại');
            return redirect()->to(base_url('contact-user?for_menu=1'));
        }

    }

    /**
     * hàm cập nhật trạng thái dịch sẽ lấy theo điều kiện contact_group
     */
    public function ajax_contact_status()
    {

        try {
                $params = $this->request->getGet();
                $contactModel = new ContactsModel();
                $dataUpdate = [
                    'status' => 1
                ];
                $countUpdated = $contactModel->saveData($dataUpdate,$params['contact_id']);

                $data["countUpdated"] = $countUpdated;
                echo json_encode($data);
                exit(1);
        } catch (\Exception $ex) {
            $data["countUpdated"] = "error";
            echo json_encode($data);
            exit(1);
        }
    }


    public function download_file()
    {
        if ($this->request->getMethod(false) == 'get' && $this->request->getVar('filename') != false) {
            $file = PUBLIC_HTML_PATH . 'public/' . FOLDER_CONTACT . '/' .  $this->request->getVar('filename');
            // Process download
            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($file) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                readfile($file);
                exit;
            } else {
                http_response_code(404);
                die();
            }
        }
    }


}