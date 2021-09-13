<?php
define('DB_USERNAME', 'b8066086384ba2');
define('DB_PASSWORD', '0a7497aa');
define('DSN', 'mysql:host=us-cdbr-east-04.cleardb.com; dbname=php_testdb; charset=utf8');

function db_connect(){
    $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
    return $pdo;
}