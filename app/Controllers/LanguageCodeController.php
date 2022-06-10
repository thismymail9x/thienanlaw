<?php


namespace App\Controllers;

use App\Models\LanguagesCodeModel;

class LanguageCodeController extends BaseController
{
    
    public function index()
    {
        $currentPageNumber = 1;
        $data = [];
        $allParams = [];
        $languagesCodeModel = new LanguagesCodeModel();
        if ($this->request->getVar('for_search') != false) {
            $allParams = $this->request->getGet();
            //keep search conditions on session
            session()->set('language_code.search', $allParams);
        } else {
            // when click on menu, clear session if exists
            if ($this->request->getVar('for_menu') != false) {
                if (isset($_SESSION['language_code.page']) == true) {
                    session()->remove('language_code.page');
                }
                if (isset($_SESSION['language_code.search']) == true) {
                    session()->remove('language_code.search');
                }
            }
            if (isset($_SESSION['language_code.search']) == true) {
                //get conditions from session
                $allParams = session()->get('language_code.search');
            }
        }

        $languagesCodeModel->search($allParams);

        $totals = $languagesCodeModel->countAllResults(false);
        $countPages = $this->utils->getCountPages($totals);
        //get current page number

        if ($this->request->getVar('page_language_code') != false) {
            //changed page => set session
            $currentPageNumber = $this->request->getVar('page_language_code');
            $_SESSION['language_code.page'] = $currentPageNumber;
        } else {
            if (session()->get('language_code.page') == true
                && $this->request->getVar('for_menu') == false) {
                $sessionPage = session()->get('language_code.page');
                if ($sessionPage <= $countPages) {
                    $currentPageNumber = $sessionPage;
                }
            }
        }

        $data = [
            'language_codes' => $languagesCodeModel->paginate(ITEM_PERPAGE, 'language_code', $currentPageNumber),
            'pager' => $languagesCodeModel->pager,
            'totals' => $totals,
            'dataSearch' => $allParams,
        ];

        return view("Admin/Language_code/index", $data);
    }


    public function edit($lang_code_id = '')
    {
        $data = [];
        $langCode =[];
        $languagesCodeModel = new LanguagesCodeModel();
        $data['title_page'] = 'Thêm mới/Sửa thông tin mã ngôn ngữ';
        if ($lang_code_id != '') {
            //get by type and lang=en
            $dataSearch = [
                'lang_code_id' => $lang_code_id,
            ];
            $langCode = $languagesCodeModel->getFirstByConditions($dataSearch);
        }
        $data['langCode'] = $langCode;
        if ($this->request->getMethod() == 'post') {
            //set data for validating
            $dataForms = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $is_error_validate = false;
            //Should reset from previous running
            $this->validation->reset();
            //Run validating with rules with EN
            if (!$this->validation->run($dataForms, 'rulesLangCode')) {
                $is_error_validate = true;
                $data["errors"] = $this->validation->getErrors();
            }
            //Should reset from previous running
            $this->validation->reset();
            //Run validating with rules with VN

            if ($is_error_validate == true) {
                $data["langCode"] = $dataForms;
                return view('Admin/Language_code/edit', $data);
            } else {
                //save to database
                $langCodeId = (!empty($dataForms['lang_code_id'])) ? $dataForms['lang_code_id'] : 0;

                $languagesCodeModel->saveData($dataForms, $langCodeId);
                //redirect to plan detail
                session()->setFlashdata('msg_success_lang_code', 'Thành công');
                return redirect()->to(base_url('language_code?for_menu=1'));
            }
        }
        return view('Admin/Language_code/edit', $data);
    }


    public function delete_lang_code()
    {
        try {

            $params = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $languagesCodeModel = new LanguagesCodeModel();
            $condition = 'lang_code_id';
            $values = explode(',', $params['list_language_code_id']);
            $dataUpdate = [
                'deleted_at' => date('Y-m-d H:i:s')
            ];
            $languagesCodeModel->updateMultiCondition($condition, $values, $dataUpdate);

            session()->setFlashdata('msg_delete_lang_code', 'Thành công');
            return redirect()->to(base_url('language_code?for_menu=1'));
        } catch (\Exception $ex) {
            session()->setFlashdata('msg_delete_lang_code_error', 'Xóa thất bại');
            return redirect()->to(base_url('language_code?for_menu=1'));
        }

    }
    public function get_lang($post_type)
    {
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        $data['post_type'] = $post_type;
        return view('Admin/Language_code/select_lang',$data);

    }

}