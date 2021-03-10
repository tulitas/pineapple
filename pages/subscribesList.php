<!DOCTYPE html>
<html lang="eng">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/sidebar.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/icons.css">
    <link rel="stylesheet" type="text/css" href="../styles/devices.css">
    <link rel="stylesheet" type="text/css" href="../styles/subscribesList.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <title>Subscribers List</title>

</head>
<body>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/dataBase/config.php";
//sort
$sort_list = array(
    'createDate_asc' => '`createDate`',
    'createDate_desc' => '`createDate` DESC',
    'email_asc' => '`email`',
    'email_desc' => '`email` DESC',
    'id_asc' => '`id`',
    'id_desc' => '`id` DESC'
);
$sort = @$_GET['sort'];
if (array_key_exists($sort, $sort_list)) {
    $sort_sql = $sort_list[$sort];
} else {
    $sort_sql = reset($sort_list);
}
$dbh = new PDO('mysql:dbname=php;host=localhost:3340', 'root', 'root');
$sth = $dbh->prepare("SELECT * FROM `pineapple` ORDER BY {$sort_sql}");
$sth->execute();
$list = $sth->fetchAll(PDO::FETCH_ASSOC);
function sort_link_th($title, $a, $b)
{
    $sort = @$_GET['sort'];

    if ($sort == $a) {
        return '<a class="active" href="?sort=' . $b . '">' . $title . ' <i>▲</i></a>';
    } elseif ($sort == $b) {
        return '<a class="active" href="?sort=' . $a . '">' . $title . ' <i>▼</i></a>';
    } else {
        return '<a href="?sort=' . $a . '">' . $title . '</a>';
    }
}

$per_page_record = 10;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $per_page_record;

$sql = "SELECT * FROM pineapple LIMIT $start_from, $per_page_record";
$rs_result = mysqli_query($link, $sql);
?>
<form action="../controllers/export_csv.php" method="post" name="data_table">
<div class="container">
    <br>
    <div>
        <table class="table table-striped table-condensed
                                          table-bordered">
            <thead>
            <tr>
                <th><?php echo sort_link_th('Id', 'id_asc', 'id_desc'); ?></th>
                <th><?php echo sort_link_th('Email', 'email_asc', 'email_desc'); ?></th>
                <th><?php echo sort_link_th('Create Date', 'createDate_asc', 'createDate_desc'); ?></th>
                <td>Action</td>
                <td>To CSV</td>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($list as $row): ?>

            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['createDate']; ?></td>
                    <td> <a href="deletePage.php?id=<?php $row1 = mysqli_fetch_array($rs_result);
                        echo $row1['id'];?>">delete</></td>
                    <td><input type="checkbox" value="<?php echo $row1['id']; ?>" name="data[]" id="data"></td>
            </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
            require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/pagination.php";
            ?>
        </div>
        <div class="inline">
            <input id="page" type="number" min="1" max="<?php echo $total_pages ?>"
                   placeholder="<?php echo $page . "/" . $total_pages; ?>">
            <button onClick="go2Page();">Go</button>
        </div>
    </div>
</div>
    <input name="submit" type="submit" value="Export" id="submit">

</form>
<form action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="post">
    <p>Find by email: <input type="text" name="search" id="search">
        <input type="submit" value="Find by email"></p>
    <hr>
</form>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/dataBase/search.php";
?>

<script>
    function go2Page() {
        let page = document.getElementById("page").value;
        page = ((page ><?php echo $total_pages; ?>) ?<?php echo $total_pages; ?>: ((page < 1) ? 1 : page));
        window.location.href = 'subscribesList.php?page=' + page;
    }
</script>
<br>
<a href="../pages/index.php">Home</a>

</body>
</html>