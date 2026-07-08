<?php
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();
$id = $_GET['id'];

$delete_post_query = "delete from post where id = '$id'";
mysqli_query($db_conn,$delete_post_query);

echo "<script> alert('Delete Complete.');</script>";
echo "<script>location.href='../protected/post.php';</script>";
?>