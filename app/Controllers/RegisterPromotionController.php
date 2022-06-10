<?php

namespace App\Controllers;

use App\Models\LanguagesCodeModel;
use App\Models\MailsModel;
use App\Models\RegisterPromotionsModel;
use CodeIgniter\Model;
use GeoIp2\Database\Reader;

class RegisterPromotionController extends BaseController
{


    public function index()
    {
        $currentPageNumber = 1;
        $data = [];
        $allParams = [];
        $mailModel = new MailsModel();
        $registerPromotionsModel = new RegisterPromotionsModel();
        if ($this->request->getVar('for_search') != false) {
            $allParams = $this->request->getGet();
            //keep search conditions on session
            session()->set('register_promotion.search', $allParams);
        } else {
            // when click on menu, clear session if exists
            if ($this->request->getVar('for_menu') != false) {
                if (isset($_SESSION['register_promotion.page']) == true) {
                    session()->remove('register_promotion.page');
                }
                if (isset($_SESSION['register_promotion.search']) == true) {
                    session()->remove('register_promotion.search');
                }
            }
            if (isset($_SESSION['register_promotion.search']) == true) {
                //get conditions from session
                $allParams = session()->get('register_promotion.search');
            }
        }
        if (isset($allParams['status']) && $allParams['status'] == '-1') {
            unset($allParams['status']);
        }
        $registerPromotionsModel->search($allParams);

        $totals = $registerPromotionsModel->countAllResults(false);
        $countPages = $this->utils->getCountPages($totals);
        //get current page number

        if ($this->request->getVar('page_register_promotion') != false) {
            //changed page => set session
            $currentPageNumber = $this->request->getVar('page_register_promotion');
            $_SESSION['register_promotion.page'] = $currentPageNumber;
        } else {
            if (session()->get('register_promotion.page') == true
                && $this->request->getVar('for_menu') == false) {
                $sessionPage = session()->get('register_promotion.page');
                if ($sessionPage <= $countPages) {
                    $currentPageNumber = $sessionPage;
                }
            }
        }
        $languagesCodeModel = new LanguagesCodeModel();
        $data = [
            'register_promotions' => $registerPromotionsModel->paginate(ITEM_PERPAGE, 'register_promotion', $currentPageNumber),
            'pager' => $registerPromotionsModel->pager,
            'totals' => $totals,
            'dataSearch' => $allParams,
            'mail_templates' =>$mailModel->getByConditions(['deleted_at' => null,'mail_type' => 'KM', 'mail_status' => 1]),
            'langCode' =>$languagesCodeModel->getByConditions(['deleted_at'=>null])
        ];
        return view("Admin/RegisterPromotion/index", $data);
    }

    public function customer_register()
    {
        // get ip user
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
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
        $data = [];
        $registerPromotionsModel = new RegisterPromotionsModel();
        if ($this->request->getMethod() == 'post') {
            //set data for validating
            $dataForms = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $dataForms['lang']=$lang;
            $is_error_validate = false;
            //Should reset from previous running
            $this->validation->reset();
            if (!$this->validation->run($dataForms, 'rulesRegisterPromotion')) {
                $is_error_validate = true;
                $data["errors"] = $this->validation->getErrors();
            }
            //Should reset from previous running
            $this->validation->reset();
            //Run validating
            if ($is_error_validate == true) {
                session()->setFlashdata('msg_register_promotion_error', $data["errors"]['email']);
                return redirect()->to(base_url());
            } else {
                 $registerPromotionsModel->saveData($dataForms, 0);
                //redirect to plan detail
                session()->setFlashdata('msg_register_promotion', 'Success!');
                return redirect()->to(base_url());
            }
        }
    }

    public function delete_register_promotion()
    {

        try {
            $params = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $registerPromotionsModel = new RegisterPromotionsModel();
            $values = explode(',', $params['register_promotion_list']);
            $dataUpdate = [
                'deleted_at' => date('Y-m-d H:i:s')
            ];
            $registerPromotionsModel->updateDataByIds( $values, $dataUpdate);

            session()->setFlashdata('msg_delete_register_promotion', 'Thành công');
            return redirect()->to(base_url('register_promotion?for_menu=1'));

        } catch (\Exception $ex) {
            session()->setFlashdata('msg_delete_register_promotion_error', 'Xóa thất bại');
            return redirect()->to(base_url('register_promotion?for_menu=1'));
        }

    }

    public function send_register_promotion()
    {

        try {
            $params = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $registerPromotionsModel = new RegisterPromotionsModel();
            $values = explode(',', $params['send_promotion_list']);

            $dataUpdate = [
                'send_email_status' => 1,
                'template_mail_id' =>$params['template_mail_id']
            ];
            $registerPromotionsModel->updateDataByIds($values, $dataUpdate);

            session()->setFlashdata('msg_send_promotion', 'Thành công, mail sẽ được gửi sau đó');
            return redirect()->to(base_url('register_promotion?for_menu=1'));

        } catch (\Exception $ex) {
            session()->setFlashdata('msg_send_promotion_error', 'Gửi mail thất bại');
            return redirect()->to(base_url('register_promotion?for_menu=1'));
        }

    }

}