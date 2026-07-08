<?php
include 'db.php';
session_start();
$user = $_SESSION['user'];
$old_pass = $_POST['old_pass'];
$new_pass = $_POST['new_pass'];
$new_pass_hash = hash('sha256',$new_pass);

$old_pass_query = "
        SELECT * 
        from account_info
        where PW = '$old_pass' and ID = '$user'
        ";
$result = mysqli_query($db_conn,$old_pass_query);
$old_pass_check = mysqli_num_rows($result);

if(!$old_pass_check){
    echo "<script> alert('Wrong Password. Try Again.');</script>";
    echo "<script>location.href='../protected/my_page.php';</script>";
    exit();
}else if (mb_strlen($new_pass) > 12){
    echo "<script> alert('Too long Password. You should set them below 12 letters.');</script>";
    echo "<script>location.href='../protected/my_page.php';</script>";
    exit();
}

$new_pass_query = "
    UPDATE account_info
    SET PW='$new_pass' , PASS_HASH='$new_pass_hash' 
    WHERE ID='$user'
";
mysqli_query($db_conn,$new_pass_query);
echo "<script> alert('Password Changed!');</script>";
echo "<script>location.href='../protected/home.php';</script>";
exit();
?>