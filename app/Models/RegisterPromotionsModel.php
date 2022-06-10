<?php


namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Utils;

class RegisterPromotionsModel extends BaseModel
{
    protected $table = 'tbl_register_promotions';
    protected $primaryKey = 'register_promotion_id';
    protected $allowedFields = ['register_promotion_id', 'email', 'created_at', 'deleted_at','send_email_status','template_mail_id','lang'];

    /*processing before insert into database*/
    protected function beforeInsert(array $data)
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    /*processing after insert into database*/
    protected function beforeUpdate(array $data)
    {
        return $data;
    }
    public function search($data)
    {
        if (isset($data['email']) && $data['email'] != '') {
            $this->like('email', $data['email']);
        }
        if (isset($data['lang']) && $data['lang'] != '') {
            $this->like('lang', $data['lang']);
        }
        if (isset($data['send_email_status']) && $data['send_email_status'] != '') {
            $this->where('send_email_status', $data['send_email_status']);
        }
        $this->where('deleted_at', null);
        $this->orderBy('register_promotion_id', 'desc');
    }
}