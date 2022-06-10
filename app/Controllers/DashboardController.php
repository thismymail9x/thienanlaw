<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\AdminsModel;

class DashboardController extends BaseController
{
    public function index()

    {
        $data = [];
        return view('Admin/dashboard',$data);
    }
    public function dashboard()
    {
        try{

            if ($this->request->getMethod() == 'post') {
                //set data for validating
                $dataData = [];
                $dataData['admin_email']=$this->request->getVar('adminEmail',FILTER_SANITIZE_STRING);
                $dataData['admin_password']=$this->request->getVar('adminPassword',FILTER_SANITIZE_STRING);
                $dataData['remember_me']=$this->request->getVar('rememberMe',FILTER_SANITIZE_STRING);

                //Should reset from previous running
                $this->validation->reset();
                //Run validating with rules
                if (!$this->validation->run($dataData,'rulesAdminLogin')){
                    $data["errors"] = $this->validation->getErrors();
                    //remove password to keep form
                    if(isset($dataData['admin_password'])){
                        $dataData['admin_password'] = "";
                    }
                    $data["adminObj"] = $dataData;
                    return view('Admin/login',$data);
                } else {

                    //set cookie for remember me 1 tháng
                    if(isset($dataData['remember_me'])) {
                        setcookie('admin_email',$dataData['admin_email'],time()+2592000,'/');
                        setcookie('admin_password',$dataData['admin_password'],time()+2592000,'/');
                    }  else {
                        // nếu hủy tính năng remember me thì xóa cookie
                        unset($_COOKIE['admin_email']);
                        unset($_COOKIE['admin_password']);
                        setcookie('admin_email', null, -1, '/');
                        setcookie('admin_password', null, -1, '/');
                    }
                    $adminModel = new AdminsModel();
                    $admin = $adminModel->where('admin_email', $this->request->getVar('adminEmail',FILTER_SANITIZE_STRING))
                        ->first();
                    // Storing session values
                    $adminModel->setAdminSession($admin);
                    return redirect()->to(base_url('dashboard'));
                }
            }
        }
        catch(\Exception $e){
            $data['msg'] = 'Something went wrong';
        }
       return view("Admin/dashboard");
    }
    public function login()
    {
        $data = [];
        return view('Admin/login',$data);
    }


    /*Logout
    * destroy all admin data from session and do admin logged out
    */
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/admin'));
    }
}