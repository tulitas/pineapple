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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <title>pineapple</title>

</head>
<body>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/dataBase/config.php";
//sort
$sort_list = array(
    'createDate_asc'   => '`createDate`',
    'createDate_desc'  => '`createDate` DESC',
    'email_asc'  => '`email`',
    'email_desc' => '`email` DESC',
    'id_asc'  => '`id`',
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
function sort_link_th($title, $a, $b) {
    $sort = @$_GET['sort'];

    if ($sort == $a) {
        return '<a class="active" href="?sort=' . $b . '">' . $title . ' <i>▲</i></a>';
    } elseif ($sort == $b) {
        return '<a class="active" href="?sort=' . $a . '">' . $title . ' <i>▼</i></a>';
    } else {
        return '<a href="?sort=' . $a . '">' . $title . '</a>';
    }
}

?>
<table>
    <thead>
    <tr>
        <th><?php echo sort_link_th('Id', 'id_asc', 'id_desc'); ?></th>
        <th><?php echo sort_link_th('Email', 'email_asc', 'email_desc'); ?></th>
        <th><?php echo sort_link_th('Create Date', 'createDate_asc', 'createDate_desc'); ?></th>

    </tr>
    </thead>
    <tbody>
    <?php foreach ($list as $row): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['createDate']; ?></td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>