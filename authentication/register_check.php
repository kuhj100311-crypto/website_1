<?php
require 'db.php';
$user = $_POST['username'];
$pass = $_POST['password'];
$name = $_POST['realname'];
$pass_hash = hash('sha256',$pass);

$dupe_check_query = "select ID from account_info where ID = '$user'";
$dupe_result = mysqli_query($db_conn,$dupe_check_query);
$dupe_flag = mysqli_num_rows($dupe_result);

if($dupe_flag){
    echo "<script> alert('Someone already have ID with that name! Try with another one!');</script>";
    echo "<script>location.href='../register.html';</script>";
    exit();
}

if(mb_strlen($user) > 12 || mb_strlen($pass) > 12){
    echo "<script> alert('Too long ID/Password. You should set them below 12 letters.');</script>";
    echo "<script>location.href='../register.html';</script>";
    exit();
}

$register_data_query = "INSERT INTO `account_info` (`Name`, `ID`, `PW`,`PASS_HASH`) VALUES ('$name', '$user', '$pass','$pass_hash')";
mysqli_query($db_conn,$register_data_query);
echo "<script> alert('Register Succeed!');</script>";
echo "<script>location.href='../index.html';</script>";
?>