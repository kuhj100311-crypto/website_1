<?php
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();
$id = $_GET['id'];

$post_data_query = "select * from post where id = '$id'";
$post_data_set = mysqli_query($db_conn,$post_data_query);
$post_data_arr = mysqli_fetch_assoc($post_data_set);
?>

<fieldset>
<h1><?php echo $post_data_arr['title']?></h1>
<p>
    <?php echo nl2br($post_data_arr['content']) ?> <!-- nl2br: new line to br tag, interal function -->
</p>
</fieldset>

<a href = "post.php">Back to post page</a><br>
<?php
if($_SESSION['user'] == $post_data_arr['user']): ?>
    <a href = "../authentication/delete_post.php?id=<?php echo $id ?>">DELETE</a>
    <a href = "./edit_post.php?id=<?php echo $id ?>">EDIT</a>
<?php endif; ?>