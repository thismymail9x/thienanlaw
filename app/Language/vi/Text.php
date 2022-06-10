<?php
/*Note: lang_key is not the same*/
use \App\Models\LanguagesModel;
$langModel = new LanguagesModel();
$data = $langModel->where('lang','vi')->where('deleted_at',null)
                  ->findAll();
$offerArray = array();
foreach ($data as $key => $value) {
	$offerArray[$value['lang_key']] = $value['lang_value'];
}
return $offerArray;
