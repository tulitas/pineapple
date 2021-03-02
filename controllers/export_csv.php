<?php
require_once("../dataBase/config.php");

$dbn = new PDO('mysql:dbname=php;host=localhost:3340', 'root', 'root');
$query = $dbn->query("SELECT * FROM pineapple ORDER BY id DESC");

if($query->rowCount() > 0){
    $delimiter = ",";
    $filename = "members_" . date('Y-m-d') . ".csv";

    $f = fopen('php://memory', 'w');

    $fields = array('id', 'email', 'createDate');
    fputcsv($f, $fields, $delimiter);

    while($row = $query){
        $lineData = array($row['id'], $row['email'], $row['creatDate']);
        fputcsv($f, $lineData, $delimiter);
    }

    fseek($f, 0);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    fpassthru($f);
}
exit;

