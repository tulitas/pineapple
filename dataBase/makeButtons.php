<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/dataBase/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/pages/subscribesList.php";
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
$sql2 = "SELECT *  FROM pineapple ";
$result2 = $link -> query($sql2);
function doesItExistEmail(array $arr) {
    return array(
        'email' => $arr['email'] != false ? $arr['email'] : 'No data',
        'id' => $arr['id'] != false ? $arr['id'] : 'No data',
        'createDate' => $arr['createDate'] != false ? $arr['createDate'] : 'No data'
    );
}
function emails($emailsFound){
    if ($emailsFound->num_rows > 0) {
        while ($row2 = $emailsFound->fetch_assoc()) {
            $arr = doesItExistEmail($row2);
            $emailForButton =  $row2['email'];
            $formattedButton = stristr($emailForButton, "@");
            echo "<button onclick='findByFormattedButon();'> " . $formattedButton . "</button> <br>";

        }
    }else{
        echo "no data";
    }

}
function findByFormattedButon(){

}
emails($result2);