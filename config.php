<?php
require_once('./createClass.php');

define("MYSQL_USER",'root');
define("MYSQL_PASSWORD",'');
define("MYSQL_HOST",'localhost');
define("MYSQL_DATABASE",'td');

$pdoOption = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);

$pdo = new PDO(
    'mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DATABASE,
    MYSQL_USER,MYSQL_PASSWORD,
    $pdoOption
);

$postClass = new Post($pdo);
$imageClass = new Image();
$userClass = new User($pdo);