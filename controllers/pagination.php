<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/pages/subscribesList.php";

$sql = "SELECT COUNT(*) FROM pineapple";
$rs_result = mysqli_query($link, $sql);
$row1 = mysqli_fetch_row($rs_result);
$total_records = $row1[0];

echo "</br>";
// Number of pages required.
$total_pages = ceil($total_records / $per_page_record);
$pagLink = "";

if ($page >= 2) {
    echo "<a href='subscribesList.php?page=" . ($page - 1) . "'>  Prev </a>";
}

for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        $pagLink .= "<a class = 'active' href='subscribesList.php?page="
            . $i . "'>" . $i . " </a>";
    } else {
        $pagLink .= "<a href='subscribesList.php?page=" . $i . "'>   
                                                " . $i . " </a>";
    }
};
echo $pagLink;

if ($page < $total_pages) {
    echo "<a href='subscribesList.php?page=" . ($page + 1) . "'>  Next </a>";
}
?>
