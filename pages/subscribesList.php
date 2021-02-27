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

$sql = "SELECT * FROM pineapple";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Id</th>";
        echo "<th>email</th>";
        echo "<th>date</th>";

        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['createDate'] . "</td>";

            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        mysqli_free_result($result);
    } else {
        echo "<p class='lead'><em>No records were found.</em></p>";
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

mysqli_close($link);
?>
</body>
</html>