<?php
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();

$user = $_SESSION['user'];
$query = "
        SELECT *
        from account_info
        where ID='$user'
        ";
$result = mysqli_query($db_conn,$query);
$user_data = mysqli_fetch_array($result);

?>
<h1>MY PAGE</h1>
<p>
    Name: <?php echo $user_data['Name'];?><br>
    ID: <?php echo $user_data['ID'];?><br>
    <fieldset>
        Change Password: <br>
        <form action = "change_pass.php" method = "post">
            Current Pass: <input type = 'password' name = old_pass><br>
            New Pass: <input type = 'password' name = new_pass><br>
            <button type="submit">Change Password</button><br>
        </form>
    </fieldset>
</p>