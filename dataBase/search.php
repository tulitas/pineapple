<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/dataBase/config.php";


if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
function search ($query)
{
    $sql = "SELECT id, email, createDate FROM pineapple where email like '%$query%'";
    $result = mysqli_query($link, $sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Name: " . $row["email"] . " " . $row["createDate"] . "<br>";
        }
    } else {
        echo "0 results";
    }
    $link->close();
}
