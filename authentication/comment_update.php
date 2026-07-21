<?php
ini_set('display_errors',1);
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();

$updated_comment = isset($_POST['comment']) ? $_POST['comment'] : false;
$comment_id =isset($_POST['comment_id']) ? $_POST['comment_id'] : false;
$date = date('y-m-d').'edited';
$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : false;

$query = 'UPDATE comment SET comment=? , `date`=? WHERE comment_id=?';
$stmt = $db_conn_prepared->prepare($query);
$stmt->bind_param('ssi',$updated_comment,$date,$comment_id);
$stmt->execute();

echo $post_id;
echo "<script> alert('Comment Edited!');</script>";
echo "<script>location.href='../protected/view_post.php?id=".$post_id."';</script>";
?>