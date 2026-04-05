<?php

//start session
session_start([
    'cookie_httponly' => true, //prevents js xxs
    'cookie_secure' => true, //ensure https
    'cookie_samesite' =>'strict'  //Prevents CSRF attacks
]);
// database con using POD safer than mysqli
try{
    $pdo= new PDO("mysql:host=localhost;dbname=user_login;charset=utf8mb4","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    die("DB Connection Failed: ".$e->getMessage());
}
//CSRF token generation
//server generates random tokens
if(empty($_SESSION['csrf_token'])){
    $_SESSION['csrf_token']=bin2hex(random_bytes(32));
}






?>