<?php

namespace App\Models;

class RegionsModel extends BaseModel
{
    protected $table      = 'tbl_regions';
    protected $primaryKey = 'region_id';
    protected $returnType     = 'array';// or 'object'
    protected $protectFields        = true;
    protected $allowedFields = ['region_id','name','code','created_at','deleted_at','updated_at'];
    protected function beforeInsert(array $data)
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }
    protected function beforeUpdate(array $data)
    {
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }
}