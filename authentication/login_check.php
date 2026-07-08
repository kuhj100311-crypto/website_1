<?php
require 'db.php';
session_start();
$user = $_POST['username'];
$pass = $_POST['password'];
$pass_hash = hash('sha256', $pass);

$query = "
        SELECT ID,PASS_HASH 
        from account_info
        where ID=? and PASS_HASH=?
        ";

$stmt = $db_conn_prepared->prepare($query); // main method to block most of the sql injection
$stmt->bind_param("ss",$user,$pass_hash);
$stmt->execute(); //when this code runs, result is stored at stmt instance.
$query_result_set = $stmt->get_result(); // we can get results stroed from stmt by using method get_result(object format)
$query_result_arr = $query_result_set->fetch_assoc();

if(!$query_result_arr){ //id, password not correct
    echo "<script> alert('Log in Failed!');</script>";
    echo "<script>location.href='../index.html';</script>";
    exit();
}
    header("location: ../protected/home.php");
    $_SESSION['user'] = $user;
    $_SESSION['login_flag'] = true;

?>