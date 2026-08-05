<?php
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();

$id = $_GET['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$post_update_query = "
UPDATE post
SET title = ? , content = ?, files = ?
WHERE id = ?
";

//파일 업로드 여부 확인
if(($_FILES['upload_file']['name']) != ''){
    $tmpfile = $_FILES['upload_file']['tmp_name'];
    $true_file_name = $_FILES['upload_file']['name'];
    $save_folder = "../protected/uploads/".$true_file_name;
    move_uploaded_file($tmpfile,$save_folder);
}else{
    $true_file_name = 'none';
}
$stmt = $db_conn_prepared->prepare($post_update_query);
$stmt->bind_param("ssss",$title,$content,$true_file_name,$id);
$stmt->execute();

echo "<script> alert('Edit Complete');</script>";
echo "<script>location.href='../protected/prepared_post.php';</script>";
?>
