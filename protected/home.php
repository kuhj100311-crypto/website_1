<?php
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();
?>

<h1>Umbrella Cafe</h1>
<fieldset>
    <a href = "prepared_post.php">새 게시글 보러가기</a><br>
    <a href = 'my_page.php?latest_login=<?php echo date('y-m-d H:i:s',time())?>'>마이페이지</a><br>
    <a href = '../authentication/logout.php'>로그 아웃</a><br>
</fieldset>
