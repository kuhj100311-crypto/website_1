<?php
session_start();
if(!$_SESSION['login_flag']){
    echo "<script> alert('You need to be logged in to view this site.');</script>";
    echo "<script>location.href='../index.html';</script>";
}
?>

<h2>Hello, <?=$_SESSION['user']?></h2>
<fieldset>
    Menu:<br>
    <a href = "prepared_post.php">View Posts</a><br>
    <a href = 'my_page.php'>MY PAGE</a><br>
    <a href = '../authentication/logout.php'>LOG OUT</a><br>
</fieldset>