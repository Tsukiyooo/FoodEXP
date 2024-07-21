<?php
require_once 'db_con.php';

$kind = isset($_POST['kind']) ? $_POST['kind'] : '';
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'asc';

// 構建 SQL 查詢語句
$query = "SELECT * FROM myfood";
if ($kind !== "") {
    $query .= " WHERE kind = ?";
}
$query .= " ORDER BY date $sort";

$stmt = mysqli_prepare($link, $query);
if ($kind !== "") {
    mysqli_stmt_bind_param($stmt, 's', $kind);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$response = '';

while ($product = mysqli_fetch_assoc($result)) {
    $expiryDate = strtotime($product['date']);
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

    $response .= "<p style='$backgroundColor'>品名：" . htmlspecialchars($product['name']) . "<br/> 有效日期：" . htmlspecialchars($product['date']) . "<br/> </p>";
}

echo $response;
echo "<p style='#fff8dc;font-size: 36px'><br/> <br/><br/></p>";

mysqli_stmt_close($stmt);
mysqli_close($link);
?>
