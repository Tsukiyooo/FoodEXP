<?php
require_once 'db_con.php';

session_start(); // 確保已經啟用了 session

if (!isset($_SESSION['user'])) {
    echo "<script>
            alert('請先登入');
            window.location.href = 'Login.html';
          </script>";
    exit();
}

$user = $_SESSION['user']; // 當前登入用戶
$kind = isset($_POST['kind']) ? $_POST['kind'] : '';
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'asc';

// 使用 prepared statement 防止 SQL 注入
$query = "SELECT * FROM history WHERE user = ?"; // 只查詢當前用戶的記錄
if ($kind !== "") {
    $query .= " AND kind = ?";
}
$query .= " ORDER BY date $sort";

$stmt = mysqli_prepare($link, $query);
if ($kind !== "") {
    mysqli_stmt_bind_param($stmt, 'ss', $user, $kind); // 綁定兩個參數，user 和 kind
} else {
    mysqli_stmt_bind_param($stmt, 's', $user); // 只綁定 user
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$response = '';

while ($product = mysqli_fetch_assoc($result)) {
    $expiryDate = strtotime($product['date']);
    $currentDate = strtotime(date('Y-m-d'));
    $dateDifference = $expiryDate - $currentDate;
    $kindImage = "pic/" . $product['kind'] . ".png"; // 替換為實際的圖片路徑
    $class = '';

    if ($dateDifference > 0 && $dateDifference <= 3 * 24 * 60 * 60) {
        continue; // 忽略即將過期的物品
    } elseif ($dateDifference > 0) {
        continue; // 忽略尚未過期的物品
    } else {
        $class = 'expired'; // 已過期的物品
    }

    $response .= "
     <div class='product-card $class'>
        <div class='product-image'>
            <img src='$kindImage' alt='" . $product['kind'] . "'>
        </div>
        <div class='product-info'>
            <p>品名：<span class='Arial'>" . $product['name'] . "</span></br>有效日期：<span class='Arial'>" . $product['date'] . "</span></p>
        </div>
    </div>
    ";
}

echo $response;
echo "<p style='#fff8dc;font-size: 36px'><br/><br/><br/></p>";

mysqli_stmt_close($stmt);
mysqli_close($link);
?>
