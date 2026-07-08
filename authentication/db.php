<?php
$DB_SERVER = getenv('DB_SERVER');
$DB_ID = getenv('DB_ID');
$DB_PW = getenv('DB_PW');
$DB_NAME = getenv('DB_NAME');

$db_conn_prepared = new mysqli($DB_SERVER,$DB_ID,$DB_PW,$DB_NAME);
?>