<?php
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();
$id = $_GET['id'];

$file_data_query = "select files from post where id = ?";
$stmt = $db_conn_prepared->prepare($file_data_query);
$stmt->bind_param('s',$id);
$stmt->execute();
$file_data_result = $stmt->get_result();
$file_data_arr = $file_data_result->fetch_assoc();

//해당 게시글로 업로드된 파일 삭제
if($file_data_arr['files'] != 'none' || $file_data_arr['files'] != NULL){
    $filename = $file_data_arr['files'];
    unlink("../protected/uploads/".$filename); //Unlink 파일 삭제 함수
}

$delete_post_query = "delete from post where id = ?"; #trying '?' will treat ? as text, not parameter bind.
$stmt = $db_conn_prepared->prepare($delete_post_query);
$stmt->bind_param("s",$id);
$stmt->execute();

#mysqli_query($db_conn,$delete_post_query);

echo "<script> alert('Delete Complete.');</script>";
echo "<script>location.href='../protected/prepared_post.php';</script>";
?>