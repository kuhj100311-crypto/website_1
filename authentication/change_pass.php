<?php #commit: prepared statement applied
include 'db.php';
session_start();
$user = $_SESSION['user'];
$old_pass = $_POST['old_pass'];
$new_pass = $_POST['new_pass'];
$new_pass_hash = hash('sha256',$new_pass);

$old_pass_query = "
        SELECT * 
        from account_info
        where PW = ? and ID = ?
        ";

$stmt = $db_conn_prepared->prepare($old_pass_query);
$stmt->bind_param("ss",$old_pass,$user);
$stmt->execute();

$result_set = $stmt->get_result();
$result_arr_old = $result_set->fetch_assoc();

if(!$result_arr_old){
    echo "<script> alert('Wrong Password. Try Again.');</script>";
    echo "<script>location.href='../protected/my_page.php';</script>";
    exit();
}else if (mb_strlen($new_pass) > 12){
    echo "<script> alert('Too long Password. You should set them below 12 letters.');</script>";
    echo "<script>location.href='../protected/my_page.php';</script>";
    exit();
}

$new_pass_query = "
    UPDATE account_info
    SET PW=? , PASS_HASH=? 
    WHERE ID=?
";

$stmt = $db_conn_prepared->prepare($new_pass_query);
$stmt->bind_param("sss",$new_pass,$new_pass_hash,$user);
$stmt->execute();
echo "<script> alert('Password Changed!');</script>";
echo "<script>location.href='../protected/home.php';</script>";
exit();
?>