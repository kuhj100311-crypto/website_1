<?php
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();
$id = $_GET['id'];

$post_data_query = "SELECT * FROM `post` where id = '$id'";
$post_data_set = mysqli_query($db_conn,$post_data_query);
$post_data_arr = mysqli_fetch_assoc($post_data_set);
$post_data_rows = mysqli_num_rows($post_data_set);
if(!$id || !$post_data_rows){
    echo "<script> alert('Cannot Find Posts by that id.');</script>";
    echo "<script>location.href='./post.php';</script>";
}

$title = $post_data_arr['title'];
$content = $post_data_arr['content'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <h1>Edit & Upload</h1>
    <form action = "../authentication/update_post.php?id=<?=$id?>" method = "post">
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
                <td colspan="2" align = "right"><button type = "submit">EDIT AND UPLOAD</button></td>
            </tr>
        </table>
    </form>
    <a href = "./view_post.php?id=<?=$id?>">Cancel</a>
</body>
</html>