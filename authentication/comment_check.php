<?php
ini_set('display_errors',1);
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();

$user = $_SESSION['user'];
$id = empty($_POST['id']) ? 'none': $_POST['id'];
$comment = empty($_POST['comment']) ? 'none': $_POST['comment'];
$date = date("y-m-d");

//checks comment or id is empty
if($id == 'none' || $comment == 'none'){ 
    echo "<script> alert('Upload Failed. Write something on comment or try again');</script>";
    echo "<script>location.href='../protected/view_post.php?id=$id';</script>";
    exit();
}

//insert data to comment table
$query = "INSERT INTO `comment` (`post_id`,`user`,`comment`,`date`,`likes`) values (?,?,?,?,0)";
$stmt = $db_conn_prepared->prepare($query);
$stmt->bind_param("isss",$id,$user,$comment,$date);
$stmt->execute();

echo "<script> alert('Upload Complete!');</script>";
echo "<script>location.href='../protected/view_post.php?id=$id';</script>";
?>