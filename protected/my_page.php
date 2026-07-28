<?php #adjusted redirection pages
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();

$latest_login = $_GET['latest_login'];
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
<h1><a href="home.php">Umbrella Cafe</a></h1>
<h2>마이페이지</h2>
<p>
    <fieldset>

        <fieldset><legend>기본 정보</legend>
            <p>
                이름: <?=$user_data['Name']?><br>
                아이디: <?=$user_data['ID']?><br>
                최근 로그인: <?=$latest_login?>
            </p>
        </fieldset>

        <fieldset><legend>개인정보수정</legend>
        <form action = "../authentication/change_pass.php" method = "post">
            Current Pass: <input type = 'password' name = old_pass><br>
            New Pass: <input type = 'password' name = new_pass><br>
            <button type="submit">Change Password</button><br>
        </form>
        </fieldset>

        <fieldset><legend>계정 삭제</legend>
        <form action="../authentication/delete_account.php" method='post' onsubmit="return confirm('Really delete your account? This action is irreversable.')">
            <button type="submit">DELETE ACCOUNT</button>
        </form>
        </fieldset>

    </fieldset>
</p>