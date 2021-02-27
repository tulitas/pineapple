<?php
require_once("../dataBase/config.php");


if(isset($_POST['submit'])) {

    $id_array = 	  $_POST['data']; // return array
    $id_count = count($_POST['data']); // count array

    $out = '';



    $out .= "\n"; // echo new line

    for($j = 0; $j < $id_count; $j++) { // each checked

        $id = $id_array[$j];
        $sql = ("SELECT * FROM pineapple WHERE `id` = '$id'");

        while ($row = $sql) {
            for($i = 0; $i < $id_count; $i++) {
                $out .= $row["$i"] . ', '; // echo data,
            }
            $out .= "\n";  // echo new line per data
        }
    } 	// Output to browser with appropriate mime type.
    header("Content-type: ../text/x-csv");
    header("Content-Disposition: attachment; filename=".time().".csv");
    echo $out; // output 	exit;
}
