<?php
ini_set('display_errors',1);
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();
$id = $_GET['id'];
##
$delete_post_query = "delete from post where id = ?"; #trying '?' will treat ? as text, not parameter bind.
$stmt = $db_conn_prepared->prepare($delete_post_query);
$stmt->bind_param("s",$id);
$stmt->execute();

#mysqli_query($db_conn,$delete_post_query);

echo "<script> alert('Delete Complete.');</script>";
echo "<script>location.href='../protected/post.php';</script>";
?>