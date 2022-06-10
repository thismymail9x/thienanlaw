<?php


namespace App\Controllers;

use App\Models\LanguagesCodeModel;
use App\Models\LanguagesModel;

class LanguageController extends BaseController
{
    public function index_lang($lang='vi')
    {
        $locale = $this->request->getLocale();
        $time = time() + 31536000;
        $time_remove = time() - 3600;
        setcookie('lang', $locale, $time_remove,'/');
        setcookie('lang', $lang, $time,'/');
        $url = BASE_URL_GLOBAL.'/'.$lang;
        return redirect()->to($url);
    }

    public function index()
    {
        $currentPageNumber = 1;
        $data = [];
        $allParams = [];
        $languageModel = new LanguagesModel();
        if ($this->request->getVar('for_search') != false) {
            $allParams = $this->request->getGet();
            //keep search conditions on session
            session()->set('language.search', $allParams);
        } else {
            // when click on menu, clear session if exists
            if ($this->request->getVar('for_menu') != false) {
                if (isset($_SESSION['language.page']) == true) {
                    session()->remove('language.page');
                }
                if (isset($_SESSION['language.search']) == true) {
                    session()->remove('language.search');
                }
            }
            if (isset($_SESSION['language.search']) == true) {
                //get conditions from session
                $allParams = session()->get('language.search');
            }
        }

        $languageModel->search($allParams);

        $totals = $languageModel->countAllResults(false);
        $countPages = $this->utils->getCountPages($totals);
        //get current page number

        if ($this->request->getVar('page_language') != false) {
            //changed page => set session
            $currentPageNumber = $this->request->getVar('page_language');
            $_SESSION['language.page'] = $currentPageNumber;
        } else {
            if (session()->get('language.page') == true
                && $this->request->getVar('for_menu') == false) {
                $sessionPage = session()->get('language.page');
                if ($sessionPage <= $countPages) {
                    $currentPageNumber = $sessionPage;
                }
            }
        }

        $languagesCodeModel = new LanguagesCodeModel();
        $data = [
            'languages' => $languageModel->paginate(ITEM_PERPAGE, 'language', $currentPageNumber),
            'pager' => $languageModel->pager,
            'totals' => $totals,
            'dataSearch' => $allParams,
            'langCode' =>$languagesCodeModel->getByConditions(['deleted_at'=>null])
        ];

        return view("Admin/Language/index", $data);
    }

    public function register()
    {
        $data = [];
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        $languageModel = new LanguagesModel();
        $data['title_page'] = 'Thêm mới ngôn ngữ';

        if ($this->request->getMethod() == 'post') {
            //set data for validating
            $dataForms = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $startId = $this->utils->getTimeStampAsId();

            // check ngôn ngữ ấy đã tồn tại chưa
            foreach ($dataForms['lang'] as $key=>$value) {
                $dataFormCheck = [
                    'lang_key' => $dataForms['lang_key'],
                    'lang' => $value,
                    'deleted_at' => null
                ];
                $langCheck = $languageModel->getFirstByConditions($dataFormCheck);
                if (!empty($langCheck)) {
                    $data["lang"] = $dataForms;
                    session()->setFlashdata('msg_lang_duplicate', 'Lỗi có dữ liệu trùng');
                    return view('Admin/Language/register', $data);
                }
            }
            // check dữ liệu trùng (trùng ngôn ngữ en =en)
            if (count($dataForms['lang']) !== count(array_unique($dataForms['lang']))) {
                $data["lang"] = $dataForms;
                session()->setFlashdata('msg_lang_duplicate_in_form', 'Lỗi có dữ liệu trùng');
                return view('Admin/Language/register', $data);
            }
            foreach ($dataForms['lang'] as $key=>$value) {
                $dataFormkey = [
                    'lang_key' => $dataForms['lang_key'],
                    'lang_value' => $dataForms['lang_value'][$key],
                    'lang' => $value,
                ];
                $startId++;
                $languageModel->saveData($dataFormkey, 0, $startId);
            }
            session()->setFlashdata('msg_success_lang', 'Thành công');
            return redirect()->to(base_url('language?for_menu=1'));
        }
        return view('Admin/Language/register', $data);
    }

    public function edit($lang_id = '')
    {
        $data = [];
        $lang = [];
        $languagesCodeModel = new LanguagesCodeModel();
        $data['langCode'] = $languagesCodeModel->getByConditions(['deleted_at'=>null]);
        $languageModel = new LanguagesModel();
        $data['title_page'] = 'Sửa ngôn ngữ';
        if ($lang_id != '') {
            //get by type and lang=en
            $dataSearch = [
                'lang_id' => $lang_id,
                'deleted_at' => null
            ];
            $lang = $languageModel->getFirstByConditions($dataSearch);
        }
        $data['lang'] = $lang;
        if ($this->request->getMethod() == 'post') {
            $dataForms = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            // check dữ liệu trùng
            $dataFormCheck = [
                'lang_key' => $dataForms['lang_key'],
                'lang' => $dataForms['lang'],
                'deleted_at' => null
            ];
          $langCheck = $languageModel->getFirstByConditions($dataFormCheck);
          // trường hợp tồn tại lang key với ngôn ngữ ấy rồi thì không cho edit(trường hợp giữ nguyên key thay đổi lang)
          if (!empty($langCheck) && $langCheck['lang_id'] != $dataForms['lang_id']) {
              $data['lang'] = $dataForms;
              session()->setFlashdata('msg_error_edit_lang', 'Lỗi trùng lang');
              return view('Admin/Language/edit', $data);
          }

            $languageModel->saveData($dataForms, $dataForms['lang_id']);
            //redirect to plan detail
            session()->setFlashdata('msg_success_edit_lang', 'Thành công');
            return redirect()->to(base_url('language?for_menu=1'));
        }

        return view('Admin/Language/edit', $data);
    }


    public function delete_language()
    {
        try {
            $params = $this->request->getPost(null,FILTER_SANITIZE_STRING);
            $languageModel = new LanguagesModel();
            $condition = 'lang_id';
            $values = explode(',', $params['list_language_id']);
            $dataUpdate = [
                'deleted_at' => date('Y-m-d H:i:s')
            ];
            $languageModel->updateMultiCondition($condition, $values, $dataUpdate);

            session()->setFlashdata('msg_delete_language', 'Thành công');
            return redirect()->to(base_url('language?for_menu=1'));
        } catch (\Exception $ex) {
            session()->setFlashdata('msg_delete_language_error', 'Xóa thất bại');
            return redirect()->to(base_url('language?for_menu=1'));
        }
    }


}