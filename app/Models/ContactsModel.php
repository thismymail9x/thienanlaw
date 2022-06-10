<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Utils;

class ContactsModel extends BaseModel
{
    protected $table      = 'tbl_contacts';
    protected $primaryKey = 'contact_id';
    protected $returnType     = 'array';// or 'object'
    protected $protectFields        = true;
    protected $allowedFields = ['contact_id','full_name','email','phone','roles','company','location','address','title','content','attachment','status','created_at','deleted_at','updated_at'];
    protected function beforeInsert(array $data)
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }
    protected function beforeUpdate(array $data)
    {
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }
    public function search($data)
    {
        if (isset($data['title']) && $data['title'] != '') {
            $this->like('title', $data['title']);
        }
        if (isset($data['content']) && $data['content'] != '') {
            $this->like('content', $data['content']);
        }
        if (isset($data['status']) && $data['status'] != '') {
            $this->where('status', $data['status']);
        }
        $this->where('deleted_at', null);
        $this->orderBy('status', 'asc');

    }

}