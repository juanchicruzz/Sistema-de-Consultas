<?php 

	$cleardb_url = parse_url("mysql://be1c98da14aa83:377a3952@us-cdbr-east-05.cleardb.net/heroku_24549face6fa079?reconnect=true");
	const DB_HOST = $cleardb_url["host"];
    	const DB_USERNAME = $cleardb_url["user"];
    	const DB_PASSWORD = $cleardb_url["pass"];
    	const DB_NAME = substr($cleardb_url["path"],1);
    	const DB_CHARSET = 'utf8mb4';
?>
