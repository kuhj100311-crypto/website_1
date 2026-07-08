<?php
function session_check(){
session_start();
if(!$_SESSION['login_flag']){
    echo "<script> alert('You need to be logged in to view this site.');</script>";
    echo "<script>location.href='../index.html';</script>";
}
}
?>