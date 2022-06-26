<?php 
	$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    const DB_HOST = $cleardb_url["host"];
    const DB_USERNAME = $cleardb_url["user"];
    const DB_PASSWORD = $cleardb_url["pass"];
    const DB_NAME = substr($cleardb_url["path"],1);
    const DB_CHARSET = 'utf8mb4';
?>
