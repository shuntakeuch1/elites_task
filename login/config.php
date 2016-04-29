<?php
//接続に必要な情報(DSN,ユーザー名,パスワード)を定着
//エラーレベルの設定
//DB接続に必要な情報

define("DSN","mysql:host=localhost;dbname=nowall_login;charset=utf8");
define("USER","testuser");
define("PASSWORD","1234");

//エラーレベルの設定
error_reporting(E_ALL &~E_NOTICE);

?>