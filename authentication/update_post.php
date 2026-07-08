<?php
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();

$id = $_GET['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$post_update_query = "
UPDATE post
SET title = ? , content = ?
WHERE id = ?
";

$stmt = $db_conn_prepared->prepare($post_update_query);
$stmt->bind_param("sss",$title,$content,$id);
$stmt->execute();

echo "<script> alert('Edit Complete');</script>";
echo "<script>location.href='../protected/prepared_post.php';</script>";
?>
