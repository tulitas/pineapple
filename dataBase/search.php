<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/dataBase/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/pages/subscribesList.php";

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
$inputSearch = $_REQUEST['search'];
$sql1 = "SELECT * FROM `pineapple` where email  like '%$inputSearch%'";
$sql2 = "SELECT *  FROM pineapple ";
$result2 = $link -> query($sql2);
$result = $link -> query($sql1);
function doesItExist(array $arr) {
    return array(
        'email' => $arr['email'] != false ? $arr['email'] : 'No data',
        'id' => $arr['id'] != false ? $arr['id'] : 'No data',
        'createDate' => $arr['createDate'] != false ? $arr['createDate'] : 'No data'
    );
}
function countEmails($resultFind)
{
    if ($resultFind->num_rows > 0) {
        while ($row = $resultFind->fetch_assoc()) {
            $arr = doesItExist($row);
            echo "ID: " . $row['id'] . "<br>
                  Email: " . $row['email'] . "<br>
                  Create Date: " . $row['createDate'] . "<br>
                  ";
        }
    } else {
        echo "No data";
    }
}
function emails($emailsFound){
    if ($emailsFound->num_rows > 0) {
        while ($row2 = $emailsFound->fetch_assoc()) {
            $arr = doesItExist($row2);
            $emailForButton =  $row2['email'];
            $formatedButton = stristr($emailForButton, "@");
//            echo stristr($emailForButton, "@");
            echo "<button> " . $formatedButton . "</button> <br>";

        }
    }else{
        echo "no data";
    }

}
?>
<?php
countEmails($result);
emails($result2);
?>




