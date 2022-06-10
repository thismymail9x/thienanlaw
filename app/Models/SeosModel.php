<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Utils;

class SeosModel extends BaseModel
{
    protected $table      = 'tbl_seos';
    protected $primaryKey = 'seo_id';
    protected $returnType     = 'array';// or 'object'
    protected $protectFields        = true;
    protected $allowedFields = [
        'seo_id','canonical','og_locale','og_type','og_title',
        'og_description','og_url','og_site_name',
        'fb_app_id','seo_google','alternate','created_at',
        'deleted_at','updated_at','seo_status','keywords'];
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

}