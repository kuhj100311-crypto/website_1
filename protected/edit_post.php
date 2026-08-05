<?php
ini_set('display_errors',1);
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();
$id = $_GET['id'];

$post_data_query = "SELECT * FROM `post` where id = ?";
$stmt = $db_conn_prepared->prepare($post_data_query);
$stmt->bind_param("s",$id);
$stmt->execute(); 
$post_data_result = $stmt->get_result();
$post_data_arr = $post_data_result->fetch_assoc();
$post_data_rows = mysqli_num_rows($post_data_result);

if(!$id || !$post_data_rows){
    echo "<script> alert('Cannot Find Posts by that id.');</script>";
    echo "<script>location.href='./prepared_post.php';</script>";
}

$title = $post_data_arr['title'];
$content = $post_data_arr['content'];
$file = $post_data_arr['files'];

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <h1>Edit & Upload</h1>
    <form action = "../authentication/update_post.php?id=<?=$id?>" method = "post" enctype="multipart/form-data">
        <table width = 800 border = "1">
            <tr>
                <th>Title</th>
                <td><input type = "text" name = "title" placeholder="Title" style = "width:100%" value = "<?=$title?>"></td>
            </tr>
            <tr>
                <th>Contents</th>
                <td><textarea name = "content" style = "height: 500px; width:100%"><?=$content?></textarea></td>
            </tr>
            <tr>
                <th>Files:</th>
                <?php prev_file_check() ?>
            </tr>
            <tr>
                <td colspan="2" align = "right"><button type = "submit">EDIT AND UPLOAD</button></td>
            </tr>
        </table>
    </form>
    <a href = "./view_post.php?id=<?=$id?>">Cancel</a>
</body>
</html>

<?php
    function prev_file_check(){
        global $file;
        if($file == 'none'){
            echo "<td><input type='file' name='upload_file' value='0' accept='.txt'></td>";
        }else{
            echo "<td>".$file."  <input type='file' name='upload_file' value='0' accept='.txt'></td>";
        }
    }
?>