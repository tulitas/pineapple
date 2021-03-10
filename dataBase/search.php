<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/dataBase/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/pages/subscribesList.php";


if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

$inputSearch = $_REQUEST['search'];

$sql1 = "SELECT * FROM `pineapple` where email  like '%$inputSearch%'";

$result = $link -> query($sql1);

function doesItExist(array $arr) {

    return array(
        'email' => $arr['email'] != false ? $arr['email'] : 'Нет данных',
        'id' => $arr['id'] != false ? $arr['id'] : 'Нет данных',
        'createDate' => $arr['createDate'] != false ? $arr['createDate'] : 'Нет данных'
    );
}
function countPeople($resultFind)
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
?>
<?php
countPeople($result);

?>




