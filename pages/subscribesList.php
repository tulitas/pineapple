<!DOCTYPE html>
<html lang="eng">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/sidebar.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/icons.css">
    <link rel="stylesheet" type="text/css" href="../styles/devices.css">
    <link rel="stylesheet" type="text/css" href="../styles/subscribesList.css">
    <link rel="stylesheet" type="text/css" href="/js/sort.js">
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
            <?php
            while ($row1 = mysqli_fetch_array($rs_result)) {
                ?>
                <tr>
                    <td><?php echo $row1["id"]; ?></td>
                    <td><?php echo $row1["email"]; ?></td>
                    <td><?php echo $row1["createDate"]; ?></td>
                    <td> <a href="deletePage.php?id=<?php echo $row1['id'];?>">delete</></td>
                    <td><input type="checkbox" value="<?php echo $row1['id']; ?>" name="pineapple[]" id="data"></td>


                </tr>
                <?php
            };
            ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
            $sql = "SELECT COUNT(*) FROM pineapple";
            $rs_result = mysqli_query($link, $sql);
            $row1 = mysqli_fetch_row($rs_result);
            $total_records = $row1[0];

            echo "</br>";
            // Number of pages required.
            $total_pages = ceil($total_records / $per_page_record);
            $pagLink = "";

            if ($page >= 2) {
                echo "<a href='subscribesList.php?page=" . ($page - 1) . "'>  Prev </a>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    $pagLink .= "<a class = 'active' href='subscribesList.php?page="
                        . $i . "'>" . $i . " </a>";
                } else {
                    $pagLink .= "<a href='subscribesList.php?page=" . $i . "'>   
                                                " . $i . " </a>";
                }
            };
            echo $pagLink;

            if ($page < $total_pages) {
                echo "<a href='subscribesList.php?page=" . ($page + 1) . "'>  Next </a>";
            }
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
<script>
    function go2Page() {
        let page = document.getElementById("page").value;
        page = ((page ><?php echo $total_pages; ?>) ?<?php echo $total_pages; ?>: ((page < 1) ? 1 : page));
        window.location.href = 'subscribesList.php?page=' + page;
    }
</script>
<a href="../pages/index.php">Home</a>
</body>
</html>