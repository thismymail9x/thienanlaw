<?php
namespace Config;
use CodeIgniter\Config\BaseConfig;

class CustomConfig extends BaseConfig
{
    // configMAIL
	public $SETTING_EMAIL = array(
        'EMAIL_SERVDER_ADDRESS' => 'smtp.gmail.com',
        'EMAIL_SERVDER_PORT' => '465',
        'EMAIL_SENDER_NAME' => 'Hostingviet.vi',
        //'USERNAME' => 'this.mymail9x@gmail.com',
        'USERNAME' => 'intovpn.net@gmail.com',
        'PASSWORD' => 'ybtwymyznnoquqje',
        //'PASSWORD' => 'fore ver1',
        'FROM' => 'intovpn.net@gmail.com',
        //'FROM' => 'this.mymail9x@gmail.com',
        'FROM_NAME' => 'Hostingviet.vi',
        'AUTH_BY_PASS' => 'true',
        'PROTOCOL' => 'smtp',
        'ENCRYPTION_TYPE' => 'ssl',
	);

	public $EMAIL_VERIFY_MAPPINGS = array(
		"{full_name}"=>"user_name",
		"{email_verification_links}"=> "email_verification_links",
	);
    public $VERIFY_EMAIL_CHANGEMAIL_MAPPINGS = array(
        "{full_name}"=>"user_name",
        "{email_verification_links}"=> "email_verification_links",
    );
	public $VERIFY_EMAIL_REGISTER_MAPPINGS = array(
		"{full_name}"=>"user_name",
		"{email_verification_links}"=> "email_verification_links",
	);
	public $VERIFY_EMAIL_RESETPASSWORD_MAPPINGS = array(
		"{full_name}"=>"user_name",
		"{user_password}"=> "user_password",
	);
    public $VERIFY_2FACODE_MAPPINGS = array(
        "{full_name}"=>"user_name",
        "{2fa_code}"=> "2fa_code",
    );
} 