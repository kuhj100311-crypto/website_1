<?php
ini_set('display_errors',1);
require '../authentication/db.php';
require '../authentication/session_check.php';
session_check();

$search_text = isset($_GET['search_text']) ? $_GET['search_text'] : '';

$whitelist = ["title","user","date","id"];
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$search_field = isset($_GET['search_field']) ? $_GET['search_field'] : 'title';

if(!in_array($sort,$whitelist)){
    $sort="id";
}

// if(!in_array($search_field,$whitelist)){
//     $search_field="title";
// }

if($search_field == "id"){
    $content_list_query = "select * from post where $search_field = ? order by $sort desc";
}else{
    $content_list_query = "select * from post where $search_field like ? order by $sort desc";
    $search_text = '%'.$search_text.'%';
}

echo $content_list_query;
$stmt = $db_conn_prepared->prepare($content_list_query);
$stmt->bind_param('s',$search_text);
$stmt->execute();
$query_result_set=$stmt->get_result();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>

<body>
    <h1>Prepared Posts</h1>
    <form action = "./prepared_post.php" method = "get">
        <input type = "text" name="search_text" placeholder="Search here">

    <select name="search_field" >
        <option value="">Search from...</option>
        <option value="id">ID</option>
        <option value="title">Title</option>
        <option value="user">Writer</option>
        <option value="date">Upload date</option>
    </select>

    <select name="sort" >
        <option value="">Order by...</option>
        <option value="id">ID</option>
        <option value="title">Title</option>
        <option value="user">Writer</option>
        <option value="date">Upload date</option>
    </select>
    <button type="submit">Search</button>
    </form>

<fieldset>
    Searched Text: <?=$search_text?>
<table border="1">
    <tr>
        <th>ID</th><th>TITLE</th><th>WRITER</th><th>UPLOAD DATE</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($query_result_set)): ?>
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