<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Utils;
class LanguagesModel extends BaseModel
{
    protected $table      = 'tbl_langs';
    protected $primaryKey = 'lang_id';
    protected $allowedFields = ['lang_value','lang_key','lang_id','lang','created_at', 'deleted_at', 'updated_at'];
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

    /*processing before insert into database*/
    public function search($data)
    {
        if (isset($data['lang_key']) && $data['lang_key'] != '') {
            $this->like('lang_key', $data['lang_key']);
        }
        if (isset($data['lang_value']) && $data['lang_value'] != '') {
            $this->like('lang_value', $data['lang_value']);
        }
        if (isset($data['lang']) && $data['lang'] != '') {
            $this->where('lang', $data['lang']);
        }
        $this->where('deleted_at', null);
        //$this->orderBy('lang', 'desc');
        $this->orderBy('created_at', 'desc');
    }
}