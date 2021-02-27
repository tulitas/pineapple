<?php
require_once("../dataBase/config.php");

$dbn = new PDO('mysql:dbname=php;host=localhost:3340', 'root', 'root');
$query = $dbn->query("SELECT * FROM pineapple ORDER BY id DESC");

if($query->rowCount() > 0){
    $delimiter = ",";
    $filename = "members_" . date('Y-m-d') . ".csv";

    //create a file pointer
    $f = fopen('php://memory', 'w');

    //set column headers
    $fields = array('id', 'email', 'createDate');
    fputcsv($f, $fields, $delimiter);

    //output each row of the data, format line as csv and write to file pointer
    while($row = $query){
        $lineData = array($row['id'], $row['email'], $row['creatDate']);
        fputcsv($f, $lineData, $delimiter);
    }

    //move back to beginning of file
    fseek($f, 0);

    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

