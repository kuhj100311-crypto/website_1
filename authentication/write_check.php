<?php
ini_set('display_errors',1);
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();

$user = $_SESSION['user'];
$title = $_POST['title'];
$content = $_POST['content'];
$date = date("y-m-d");

 if(mb_Strlen($title) > 30){
    echo "<script> alert('Title is too long. You should set it below 30 letters.');</script>";
    echo "<script>location.href='../protected/write.php';</script>";
    exit();
}else if (!$content){
    echo "<script> alert('Content is empty. Write something in the content section.');</script>";
    echo "<script>location.href='../protected/write.php';</script>";
    exit();
}

$query = "INSERT INTO `post` (`user`,`title`,`content`,`date`) values ('$user','$title','$content','$date')";
mysqli_query($db_conn,$query);
echo "<script> alert('Upload Complete!');</script>";
echo "<script>location.href='../protected/post.php';</script>";
?>