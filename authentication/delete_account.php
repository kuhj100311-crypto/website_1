<?php
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();

$user = $_SESSION['user'];
$query = "DELETE FROM `account_info` WHERE ID = ?";
$stmt = $db_conn_prepared->prepare($query);
$stmt->bind_param('s',$user);
$stmt->execute();
session_destroy();
?>

<script>alert("Account Deleted.");</script>
<script>location.href=('../index.html');</script>