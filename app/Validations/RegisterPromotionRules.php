<?php
namespace App\Validations;

use App\Models\RegisterPromotionsModel;
use CodeIgniter\Model;

class RegisterPromotionRules{
	
	/*check user_email exists on the database
	* true; exist
	* false: not exist
	* use for validate of login-user
	*/
	public function existEmailPromotion(string $str, string $fields, array $data){

        $model = new RegisterPromotionsModel();
		$email = $model->where('email', $data['email'])->where('deleted_at',null)
					  ->first();
		if($email)
		  return false;
		return true;
	}
}