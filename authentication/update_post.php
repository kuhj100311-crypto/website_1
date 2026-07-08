<?php
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();

$id = $_GET['id'];
$title = $_POST['title'];
$content = $_POST['content'];

echo $id,$title,$content;
$post_update_query = "
UPDATE post
SET title = '$title' , content = '$content'
WHERE id = '$id'
";

mysqli_query($db_conn,$post_update_query);

echo "<script> alert('Edit Complete');</script>";
echo "<script>location.href='../protected/post.php';</script>";
?>
