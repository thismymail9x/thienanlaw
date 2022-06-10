<?php
namespace App\Validations;
use App\Models\AdminsModel;

class AdminsRules{
	/*check email & password of admin is mapping on the database
	* true; not mapped
	* false: mapped
	* use for validate of login-admin
	*/
	public function verifyAdmin(string $str, string $fields, array $data){
		$model = new AdminsModel();
		$admin = $model->where('admin_email', $data['admin_email'])
					  ->first();
		if(!$admin)
		  return false;
		return password_verify($data['admin_password'], $admin['admin_password']);
	}
    public function activeAccount(string $str, string $fields, array $data){
        $model = new AdminsModel();
        $admin = $model->where('admin_email', $data['admin_email'])->where('active',1)->where('deleted_at',null)
            ->first();
        if(!$admin)
            return false;
        return true;
    }
	
	/*check user_email exists on the database
	* true; exist
	* false: not exist
	* use for validate of login-user
	*/
	public function existEmail(string $str, string $fields, array $data){
		$model = new AdminsModel();
		$admin = $model->where('admin_email', $data['admin_email'])
					  ->first();
		if(!$admin)
		  return false;
		return true;
	}
    public function existEmailAdmin(string $str, string $fields, array $data){
        $model = new AdminsModel();
        $admin = $model->where('admin_email', $data['admin_email'])
            ->first();
        if($admin)
            return false;
        return true;
    }
    public function confirmOldPassword(string $str, string $fields, array $data){
        $model = new AdminsModel();
        $str = password_hash($str);
        $admin = $model->where('admin_password', $str)
            ->first();
        if(!$admin)
            return false;
        return true;
    }


}