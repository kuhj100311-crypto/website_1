<?php
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();

$user = $_SESSION['user'];
$title = $_POST['title'];
$content = $_POST['content'];
$date = date("y-m-d");

//파일 업로드 여부 확인
if(($_FILES['upload_file']['name']) != ''){
    $tmpfile = $_FILES['upload_file']['tmp_name'];
    $true_file_name = $_FILES['upload_file']['name'];
    $save_folder = "../protected/uploads/".$true_file_name;
    move_uploaded_file($tmpfile,$save_folder);
}else{
    $true_file_name = 'none';
}

//제목이 너무 길거나 내용이 없는 경우 거부
 if(mb_Strlen($title) > 30){
    echo "<script> alert('Title is too long. You should set it below 30 letters.');</script>";
    echo "<script>location.href='../protected/write.php';</script>";
    exit();
}else if (!$content){
    echo "<script> alert('Content is empty. Write something in the content section.');</script>";
    echo "<script>location.href='../protected/write.php';</script>";
    exit();
}

//데이터 업로드
$query = "INSERT INTO `post` (`user`,`title`,`content`,`date`,`post_view`,`files`) values (?,?,?,?,0,?)";
$stmt = $db_conn_prepared->prepare($query);
$stmt->bind_param("sssss",$user,$title,$content,$date,$true_file_name);
$stmt->execute();

echo "<script> alert('Upload Complete!');</script>";
echo "<script>location.href='../protected/prepared_post.php';</script>";
?>