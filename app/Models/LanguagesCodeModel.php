<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Utils;
class LanguagesCodeModel extends BaseModel
{
    protected $table      = 'tbl_lang_codes';
    protected $primaryKey = 'lang_code_id';
    protected $allowedFields = ['lang_code_description','lang_code_key','lang_code_id','currency_symbol','created_at', 'deleted_at', 'updated_at'];
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
        if (isset($data['lang_code_key']) && $data['lang_code_key'] != '') {
            $this->like('lang_code_key', $data['lang_code_key']);
        }
        $this->where('deleted_at', null);
        $this->orderBy('lang_code_id', 'desc');
    }
}