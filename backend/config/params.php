<?php
return [
    'adminEmail' => 'admin@example.com',
    'developerInfo'=>[
    	'name'=>'意随心',
    	'email'=>'huwangming321@163.com',
    ],
    'systemInfo'=>[
    	'system'=>php_uname('s'),
    	'php_verson'=>PHP_VERSION,
    	// 'mysql_verson'=>mysql_get_server_info,
    	'max_upload'=> ini_get("file_uploads") ? ini_get("upload_max_filesize") : "Disabled"
    ]


];
