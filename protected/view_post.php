<?php
ini_set('display_errors',1);
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();
$id = $_GET['id'];

//fetching post data from db
$post_data_query = "select * from post where id = ?";
$stmt = $db_conn_prepared->prepare($post_data_query); 
$stmt->bind_param("s",$id);
$stmt->execute();
$post_data_set = $stmt->get_result();
$post_data_arr = $post_data_set->fetch_assoc();

//fetching comment data from db
$comment_data_query = "select * from comment where post_id = ?";
$stmt = $db_conn_prepared->prepare($comment_data_query);
$stmt->bind_param("i",$id);
$stmt->execute();
$comment_data_set=$stmt->get_result();
?>

<fieldset>
<h1><?php echo $post_data_arr['title']?></h1>
<p>
    <?php echo nl2br($post_data_arr['content']) ?> <!-- nl2br: new line to br tag, interal function -->
</p>
</fieldset>
<?php
if($_SESSION['user'] == $post_data_arr['user']): ?>
    <a href = "../authentication/delete_post.php?id=<?php echo $id ?>">DELETE</a>
    <a href = "./edit_post.php?id=<?php echo $id ?>">EDIT</a>
<?php endif; ?>

<form action = "../authentication/comment_check.php" method = "post">
    <textarea name = "comment" style = "height: 50px; width:30%" placeholder="write comments here!"></textarea>
    <input type='hidden' name='id' value='<?php echo $id;?>'/> <br>
    <button type = "submit">Upload coment</button>
</form>
<a href = "prepared_post.php">Back to post page</a><br>
<!-- comment table here -->

 <?php while($comment_arr = mysqli_fetch_assoc($comment_data_set)): ?>
    <div style="border: 5px solid azure;">
        <?php echo $comment_arr['user'] ?>: <br>
        <?php echo nl2br($comment_arr['comment']); ?> <br>
        Upload Date: <?php echo $comment_arr['date'];?>
        <a href = "#">Edit</a>|<a href = "#">Delete</a>
    </div>
    <?php endwhile; ?>