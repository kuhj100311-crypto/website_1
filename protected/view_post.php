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

<script>
    function double_check(){
        var double_chk = confirm("Really delete this comment?");
        if(double_chk){return true}
        else{return false};
    }
</script>

<fieldset>
<h1><?php echo $post_data_arr['title']?></h1>
<p>
    <?php echo nl2br($post_data_arr['content']) ?> <!-- nl2br: new line to br tag, interal function -->
</p>
</fieldset>

<!-- delete,edit post if login user is owner of this post -->
<?php if($_SESSION['user'] == $post_data_arr['user']): ?>
    <a href = "../authentication/delete_post.php?id=<?php echo $id ?>">DELETE</a>
    <a href = "./edit_post.php?id=<?php echo $id ?>">EDIT</a>
<?php endif; ?>

<!-- comment if editing mode-->
<?php
$edit = isset($_POST['edit']) ? $_POST['edit'] : false ;
$comment_id = isset($_POST['comment_id']) ? $_POST['comment_id'] : false ;
$prev_comment = isset($_POST['comment']) ? $_POST['comment'] : false ;
 if($edit && $comment_id && $prev_comment):?>
<form action = "../authentication/comment_update.php" method = "post"> 
    <textarea name = "comment" style = "height: 50px; width:30%"><?=$prev_comment?></textarea>
    <input type='hidden' name='comment_id' value='<?php echo $comment_id;?>'/> <br>
    <input type='hidden' name='post_id' value='<?php echo $id;?>'/> <br>
    <button type = "submit">Update comment</button>
</form>
<?php else: ?>
<!-- adding comment section, no edit mode-->
<form action = "../authentication/comment_check.php" method = "post"> 
    <textarea name = "comment" style = "height: 50px; width:30%" placeholder="write comments here!"></textarea>
    <input type='hidden' name='id' value='<?php echo $id;?>'/> <br>
    <button type = "submit">Upload comment</button>
</form>
<?php endif ?>


<a href = "prepared_post.php">Back to post page</a><br>

<!-- comment table  -->
 <?php while($comment_arr = mysqli_fetch_assoc($comment_data_set)): ?>
    <div style="border: 5px solid azure;">
        <?php echo $comment_arr['user'] ?>: <br>
        <?php echo nl2br($comment_arr['comment']); ?> <br>
        Upload Date: <?php echo $comment_arr['date'];?>

 <!--delete,edit comments if login user is identical to writer of the comment -->
        <?php if($_SESSION['user'] == $comment_arr['user']): ?>
            <form action="./view_post.php?id=<?=$id?>" method="post">
                <input type="hidden" name="edit" value="true">
                <input type="hidden" name="comment" value="<?=$comment_arr['comment']?>">
                <input type="hidden" name="comment_id" value="<?=$comment_arr['comment_id']?>">
                <button type = "submit">Edit Comment</button>
            </form>

            <form action="../authentication/delete_comment.php" method="post" onsubmit="return confirm('Really delete this comment?');">
                <input type='hidden' name='post_id' value='<?php echo $id;?>'/> <br>
                <input type="hidden" name="comment_id" value="<?=$comment_arr['comment_id']?>">
                <button type = "submit">Delete Comment</button>
            </form>
        <?php endif; ?>
    </div>
    <?php endwhile; ?>