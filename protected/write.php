<?php
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write</title>
</head>
<body>
    <h1>Write & Upload</h1>
    <form action = "../authentication/write_check.php" method = "post">
        <table width = 800 border = "1">
            <tr>
                <th>Title</th>
                <td><input type = "text" name = "title" placeholder="Title" style = "width:100%"></td>
            </tr>
            <tr>
                <th>Contents</th>
                <td><textarea name = "content" style = "height: 500px; width:100%"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align = "right"><button type = "submit">SAVE and UPLOAD</button></td>
            </tr>
        </table>
    </form>
</body>
</html>