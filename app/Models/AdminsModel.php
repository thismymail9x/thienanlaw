<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Utils;

class AdminsModel extends BaseModel
{
    protected $table      = 'tbl_admins';
    protected $primaryKey = 'admin_id';

    protected $returnType     = 'array';// or 'object'
    protected $protectFields        = true;
    /*This array should be updated with the field names
    * that can be set during save, insert, or update methods
    */
    protected $allowedFields = ['admin_id','admin_email', 'admin_password', 'phone_number','full_name','admin_role','active','created_at','updated_at','deleted_at'];


    /*processing before insert into database*/
    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        $data['data']['created_at'] = date('Y-m-d H:i:s');

        return $data;
    }

    /*processing before update into database*/
    protected function beforeUpdate(array $data){
        $data = $this->passwordHash($data);
        $data['data']['updated_at'] = date('Y-m-d H:i:s');

        return $data;
    }

    protected function passwordHash(array $data)
    {
        if (isset($data['data']['admin_password'])) {
            $data['data']['admin_password'] = password_hash($data['data']['admin_password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
    /*Set session for admin when login
    * storing admin data into session
    */
    public function setAdminSession($admin)
    {
        $data = [
            'admin_id' => $admin['admin_id'],
            'admin_email' => $admin['admin_email'],
            'admin_full_name' => $admin['full_name'],
            'admin_role' => $admin['admin_role'],
            'isLoggedIn' => true,
        ];
        session()->set($data);
        return true;
    }
    public function search($data)
    {
        if (isset($data['admin_role']) && $data['admin_role']!=''){
            $this->where('admin_role', $data['admin_role']);
        }
        if (isset($data['admin_email']) && $data['admin_email']!=''){
            $this->like('admin_email', $data['admin_email']);
        }
        if (isset($data['full_name']) && $data['full_name']!=''){
            $this->like('full_name', $data['full_name']);
        }
        $this->where('deleted_at', null);
        $this->orderBy('admin_role', 'asc');
    }
}