<?php
//local
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DSN', 'mysql:host=localhost; dbname=php_testdb; charset=utf8');

function db_connect(){
    $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
    return $pdo;
}
?>