<?php


namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Utils;

class ServicesModel extends BaseModel
{
    protected $table = 'tbl_services';
    protected $primaryKey = 'service_id';
    protected $allowedFields = ['service_id', 'service_timeline', 'service_price', 'service_introduce',
        'service_content', 'service_status', 'number_order', 'lang','service_name',
        'created_at', 'deleted_at', 'updated_at'];

    /*processing before insert into database*/
    protected function beforeInsert(array $data)
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
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
        if (isset($data['service_timeline']) && $data['service_timeline'] != '') {
            $this->where('service_timeline', $data['service_timeline']);
        }
        if (isset($data['service_status']) && $data['service_status'] != '') {
            $this->where('service_status', $data['service_status']);
        }
        if (isset($data['service_name']) && $data['service_name'] != '') {
            $this->like('service_name', $data['service_name']);
        }
        $this->where('deleted_at', null);
//        $this->where('lang', 'VN');
        $this->orderBy('service_timeline', 'asc');
        $this->orderBy('number_order', 'asc');
    }

}