<?php
require_once 'db_con.php';

session_start(); // 確保 session 已啟用

if (!isset($_SESSION['user'])) {
    echo "<script>
            alert('請先登入');
            window.location.href = 'Login.html';
          </script>";
    exit();
}

$user = $_SESSION['user']; // 當前登入的用戶名
$kind = isset($_POST['kind']) ? $_POST['kind'] : '';
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'asc';

// 構建 SQL 查詢語句，只查詢當前用戶的記錄
$query = "SELECT * FROM myfood WHERE user = ?"; // 查詢與當前用戶相關的數據
if ($kind !== "") {
    $query .= " AND kind = ?"; // 如果有選擇分類，則加上分類過濾條件
}
$query .= " ORDER BY date $sort";

$stmt = mysqli_prepare($link, $query);
if ($kind !== "") {
    mysqli_stmt_bind_param($stmt, 'ss', $user, $kind); // 綁定用戶和分類參數
} else {
    mysqli_stmt_bind_param($stmt, 's', $user); // 只綁定用戶參數
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$response = '';

while ($product = mysqli_fetch_assoc($result)) {
    $expiryDate = strtotime($product['date']);
    $currentDate = strtotime(date('Y-m-d'));
    $dateDifference = $expiryDate - $currentDate;
    $kindImage = "pic/" . $product['kind'] . ".png"; // 替換為您實際的圖片路徑
    $class = '';

    if ($dateDifference > 0 && $dateDifference <= 3 * 24 * 60 * 60) {
        $class = 'warning'; // 即將過期
    } elseif ($dateDifference > 0) {
        $class = 'safe'; // 尚未過期
    } else {
        $class = 'expired'; // 已過期
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
echo "<p style='#fff8dc;font-size: 36px'><br/> <br/><br/></p>";

mysqli_stmt_close($stmt);
mysqli_close($link);
?>
