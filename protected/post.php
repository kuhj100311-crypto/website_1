<?php
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();

$search_text = isset($_GET['search_text']) ? $_GET['search_text'] : '';

$blacklist = ['select','union',"'",'"'];
$i = 0;
while($i < 4){
    if(!(strpos($search_text,$blacklist[$i]) === false)){ // using === check booleans,null values (can distinguish 0 and false)
        echo "detected blacklist words!";
        $search_text = "";
        break;
    }
    $i++;
}

if($search_text == ""){ /* comparision ==, insert =  */
    $content_list_query = "select * from post order by id desc";
}else{
    $content_list_query = "select * from post where title like '%$search_text%' order by id desc";
}
$result = mysqli_query($db_conn,$content_list_query);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>

<body>
    <h1>Posts</h1>
    <form action = "./post.php" method = "get">
        <input type = "text" name="search_text">
        <button type="submit">Search By Title</button><br>
    </form>

<fieldset>
    Searched Text: <?=$search_text?>
<table border="1">
    <tr>
        <th>ID</th><th>TITLE</th><th>WRITER</th><th>UPLOAD DATE</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><a href="view_post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></td>
        <td><?php echo $row['user']; ?></td>
        <td><?php echo $row['date']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>
</fieldset>
<a href = "home.php">back to home</a><br>
<a href = 'write.php'>Write Posts</a>
</body>
</html>