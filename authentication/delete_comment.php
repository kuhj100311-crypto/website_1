<?php
ini_set('display_errors',1);
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();

$comment_id = isset($_POST['comment_id']) ? $_POST['comment_id'] : false ;
$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : false;

$query = "DELETE from comment where comment_id=?";
$stmt = $db_conn_prepared->prepare($query);
$stmt->bind_param('i',$comment_id);
$stmt->execute();

echo "<script> alert('Comment deleted!');</script>";
echo "<script>location.href='../protected/view_post.php?id=".$post_id."';</script>";
?>