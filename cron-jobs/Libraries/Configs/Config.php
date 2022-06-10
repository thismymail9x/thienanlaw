<?php

/**************************************************/
/* Setting connect to database */
$db = [
	'DSN'      => '',
	'hostname' => 'localhost',
	'username' => 'vpn_db',
	'password' => 'htluHIY9NJHy',
	'database' => 'vpn_db',
	'DBDriver' => 'MySQLi',
	'DBPrefix' => '',
	'pConnect' => false,
	'charset'  => 'utf8',
	'DBCollat' => 'utf8_general_ci',
	'swapPre'  => '',
	'encrypt'  => false,
	'compress' => false,
	'strictOn' => false,
	'failover' => [],
	'port'     => 3306,
];



/*Email-Settings*/
//Using email-login by thunn84@gmail.com
//$EMAIL_SETTINGS = [
//	'EMAIL_SERVDER_ADDRESS'      => 'smtp.gmail.com',
//	'EMAIL_SERVDER_PORT' => '465',
//	'EMAIL_SENDER_NAME' => 'Hostingviet.vi',
//	'USERNAME'	=>	'srtc.dungnk@gmail.com',
//	'PASSWORD'	=>	'dnkDNK@#3483',
//	'FROM'	=>	'srtc.dungnk@gmail.com',
//	'FROM_NAME'	=>	'Hostingviet.vi',
//	'AUTH_BY_PASS'	=>	'true',
//	'PROTOCOL'	=>	'smtp',
//    'ENCRYPTION_TYPE'	=>	'ssl',
//];

    $SETTING_EMAIL = array(
    'EMAIL_SERVDER_ADDRESS'      => 'smtp.gmail.com',
    'EMAIL_SERVDER_PORT' => '465',
    'EMAIL_SENDER_NAME' => 'Hostingviet.vi',
    'USERNAME'	=>	'this.mymail9x@gmail.com',
    'PASSWORD'	=>	'fore ver1',
    'FROM'	=>	'this.mymail9x@gmail.com',
    'FROM_NAME'	=>	'Hostingviet.vi',
    'AUTH_BY_PASS'	=>	'true',
    'PROTOCOL'	=>	'smtp',
    'ENCRYPTION_TYPE'   => 'ssl',
);


/*******************End-of**************************/
