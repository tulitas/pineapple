<?php
require_once("../dataBase/config.php");

$dbn = new PDO('mysql:dbname=php;host=localhost:3340', 'root', 'root');
$query = "SELECT * FROM pineapple ORDER BY id DESC";
$result = mysqli_query($link, $query);





    $delimiter = ",";
    $filename = "members_" . date('Y-m-d') . ".csv";

    $f = fopen('php://memory', 'w');

    $fields = array('id', 'email', 'createDate');
    fputcsv($f, $fields, $delimiter);

    while($row = $result->fetch_array()){

        $lineData = array('id' => $row['id'],'email' =>  $row['email'], 'createDate' => $row['createDate']);
        fputcsv($f, $lineData, $delimiter);

    }

    fseek($f, 0);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    fpassthru($f);

exit;



//$result = $dbn->query($query);
//if (!$result) die('Couldn\'t fetch records');
//$headers = $result;
//foreach($headers as $header) {
//    $head[] = $header->id;
//}
//$fp = fopen('php://output', 'w');
//
//if ($fp && $result) {
//    header('Content-Type: text/csv');
//    header('Content-Disposition: attachment; filename="export.csv"');
//    header('Pragma: no-cache');
//    header('Expires: 0');
//    fputcsv($fp, array_values($head));
//    while ($row = $result->fetch_array(MYSQLI_NUM)) {
//        fputcsv($fp, array_values($row));
//    }
//    die;
//}



