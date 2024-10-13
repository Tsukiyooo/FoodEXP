<?php
require_once 'db_con.php';

session_start(); // 確保 session 已啟用

// 確認用戶是否已登入
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

// 構建 SQL 查詢語句，過濾當前用戶的記錄
$query = "SELECT * FROM myfood WHERE user= ?"; // 限制查詢範圍為當前用戶
if ($kind !== "") {
    $query .= " AND kind = ?"; // 如果有選擇分類，則加上分類過濾條件
}
$query .= " ORDER BY date $sort";

// 準備 SQL 語句
$stmt = mysqli_prepare($link, $query);
if ($kind !== "") {
    // 綁定用戶名和分類參數
    mysqli_stmt_bind_param($stmt, 'ss', $user, $kind);
} else {
    // 只綁定用戶名參數
    mysqli_stmt_bind_param($stmt, 's', $user);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$response = '';

// 循環顯示每個產品
while ($product = mysqli_fetch_assoc($result)) {
    $expiryDate = strtotime($product['date']);
    $currentDate = strtotime(date('Y-m-d'));
    $dateDifference = $expiryDate - $currentDate;
    $kindImage = "pic/" . $product['kind'] . ".png"; // 替換為實際圖片路徑
    $productClass = '';

    // 根據日期計算設置樣式
    if ($dateDifference > 0 && $dateDifference <= 3 * 24 * 60 * 60) {
        $productClass = 'warning';  // 即將過期
    } elseif ($dateDifference > 0) {
        $productClass = 'safe';     // 尚未過期
    } else {
        $productClass = 'expired';  // 已過期
    }

    // 顯示產品卡片
    echo "
    <div class='product-card $productClass'>
        <div class='product-image'>
            <img src='$kindImage' alt='" . $product['kind'] . "'>
        </div>
        <div class='product-info'>
            <p>品名：<span class='Arial'>" . $product['name'] . "</span></p>
            <p>有效日期：<span class='Arial'>" . $product['date'] . "</span></p>
            <span class='button-c'>
                <button class='action-btn' onclick='Rewrite(\"" . $product['id'] . "\",\"" . $product['name'] . "\",\"" . $product['date'] . "\")'>修改</button>
                <button class='action-btn' onclick=\"location.href='Ldelete.php?id=" . $product['id'] . "'\" type='button'>刪除</button>
            </span>
        </div>
    </div>";
}

echo "<p style='#fff8dc;font-size: 36px'><br/><br/><br/></p>";

mysqli_stmt_close($stmt);
mysqli_close($link);
?>
