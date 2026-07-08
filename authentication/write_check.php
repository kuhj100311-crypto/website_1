<?php
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

$query = "INSERT INTO `post` (`user`,`title`,`content`,`date`) values (?,?,?,?)";
$stmt = $db_conn_prepared->prepare($query);
$stmt->bind_param("ssss",$user,$title,$content,$date);
$stmt->execute();

echo "<script> alert('Upload Complete!');</script>";
echo "<script>location.href='../protected/prepared_post.php';</script>";
?>