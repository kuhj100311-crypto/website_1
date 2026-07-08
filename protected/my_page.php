<?php #adjusted redirection pages
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();

$user = $_SESSION['user'];
$query = "
        SELECT *
        from account_info
        where ID=?
        ";
$stmt = $db_conn_prepared->prepare($query);
$stmt->bind_param("s",$user);
$stmt->execute();
$user_data_set = $stmt->get_result();
$user_data = $user_data_set->fetch_assoc();

?>
<h1>MY PAGE</h1>
<p>
    Name: <?php echo $user_data['Name'];?><br>
    ID: <?php echo $user_data['ID'];?><br>
    <fieldset>
        Change Password: <br>
        <form action = "../authentication/change_pass.php" method = "post">
            Current Pass: <input type = 'password' name = old_pass><br>
            New Pass: <input type = 'password' name = new_pass><br>
            <button type="submit">Change Password</button><br>
        </form>
    </fieldset>
</p>