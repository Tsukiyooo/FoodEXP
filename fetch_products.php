<?php
require_once 'db_con.php';

$kind = $_GET['kind'];
$sort = $_GET['sort'];

// 構建 SQL 查詢語句
$query = "SELECT * FROM myfood";
if ($kind !== "") {
    $query .= " WHERE kind = '$kind'";
}
$query .= " ORDER BY date $sort";

$result = mysqli_query($link, $query);

$response = '';

while ($product = mysqli_fetch_assoc($result)) {
    $expiryDate = strtotime(date('Y-m-d', strtotime($product['date'])));
    $currentDate = strtotime(date('Y-m-d'));
    $dateDifference = $expiryDate - $currentDate;

    $backgroundColor = '';
    if ($dateDifference > 0 && $dateDifference <= 3 * 24 * 60 * 60) {
        $backgroundColor = 'background-color: #ffef9f; font-size: 36px;';
    } elseif ($dateDifference > 0) {
        $backgroundColor = 'background-color: #C0F7A4; font-size: 36px;';
    } else {
        $backgroundColor = 'background-color: #FBC3BC; font-size: 36px;';
    }

    $response .= "<p style='$backgroundColor'>品名：" . $product['name'] . "<br/> 有效日期：" . $product['date'] . "<br/> </p>";
}

echo $response;

mysqli_close($link);
?>
<script src="Script.js"></script>