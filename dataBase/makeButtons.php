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
        'email' => $arr['email'] != false ? $arr['email'] : 'No data'
    );
}
function emails($emailsFound){
    if ($emailsFound->num_rows > 0) {
        while ($row2 = $emailsFound->fetch_assoc()) {
            $arr = doesItExistEmail($row2);
            $emailForButton =  $row2['email'];
            $formattedEmail = stristr($emailForButton, "@");
            $formattedEmailForButton = array();
            if (!$formattedEmailForButton.e)
                echo "<button onclick='findByFormattedButon();'> " . $formattedEmail . "</button> <br>";

        }
    }else{
        echo "no data";
    }

}
function findByFormattedButon(){

}
emails($result2);