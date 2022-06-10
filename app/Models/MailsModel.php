<?php


namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Utils;

class MailsModel extends BaseModel
{
    protected $table = 'tbl_mails';
    protected $primaryKey = 'mail_id';
    protected $allowedFields = ['mail_id', 'mail_title',
        'mail_content', 'mail_status', 'lang','mail_type',
        'created_at', 'deleted_at', 'updated_at','mail_code'];

    /*processing before insert into database*/
    protected function beforeInsert(array $data)
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    /*processing after insert into database*/
    protected function beforeUpdate(array $data)
    {
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }
    public function search($data)
    {
        if (isset($data['mail_type']) && $data['mail_type'] != '') {
            $this->where('mail_type', $data['mail_type']);
        }
        if (isset($data['mail_title']) && $data['mail_title'] != '') {
            $this->like('mail_title', $data['mail_title']);
        }
        if (isset($data['mail_code']) && $data['mail_code'] != '') {
            $this->like('mail_code', $data['mail_code']);
        }
        if (isset($data['mail_status']) && $data['mail_status'] != '') {
            $this->where('mail_status', $data['mail_status']);
        }
        $this->where('deleted_at', null);
        $this->orderBy('updated_at', 'asc');
    }

}