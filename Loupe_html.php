<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rwdd.css">
    <title>即期查詢</title>
    <style>
        .expired { background-color: #FBC3BC; }
        .soonToExpire { background-color: #ffef9f; font-size: 36px;}
        .notExpired { background-color:#C0F7A4;font-size: 36px; }
    </style>
</head>
<body>
    <div class="titArea">
        即期查詢
        <div class="Loubtn">
            <button id="Search" onclick="ToSearch()">找尋商品</button>
            <button id="RewriteDate" onclick="ToDo()">改寫資料</button>
            <button id="allDelete">過期刪除</button>
            <button id="Sort">變更排序</button>
        </div>
    </div>
    <div class="button-container">
      <button class="btn" id="btn1"><img id="myImage" src="pic/camera.png"><br>拍攝照片</button>
      <button class="btn" id="btn2"><img id="myImage" src="pic/edit.png"><br>手動輸入</button>
      <button class="btn" id="btn3"><img id="myImage" src="pic/list.png"><br>購物清單</button>
      <button class="btn" id="btn4"><img id="myImage" src="pic/loupe.png"><br>即期查詢</button>
      <button class="btn" id="btn5"><img id="myImage" src="pic/shop.png"><br>推薦商家</button> 
    </div>

    <?php
// 引入資料庫連線檔案
require_once 'db_con.php';

// 開啟 session
session_start();

// 檢查是否有 'AllData' session 變數，若無，則初始化為空陣列
if (!isset($_SESSION['AllData'])) {
    $_SESSION['AllData'] = array();
}

// 取得所有資料庫中的資料
$query = "SELECT * FROM myfood ORDER BY date ASC";
$result = mysqli_query($link, $query);
// 將資料存入 session 中
$_SESSION['AllData'] = mysqli_fetch_all($result, MYSQLI_ASSOC);

// 取得所有資料
$allData = $_SESSION['AllData'];
        if (isset($_SESSION['AllData'])) {
            // 使用 foreach 遍歷 $_SESSION['AllData'] 陣列
            foreach ($_SESSION['AllData'] as $product) {
                // 取得有效日期（僅考慮日期部分，不包含時分秒）
                $expiryDate = strtotime(date('Y-m-d', strtotime($product['date'])));
                
                // 取得當前日期（僅考慮日期部分，不包含時分秒）
                $currentDate = strtotime(date('Y-m-d'));
        
                // 計算日期差
                $dateDifference = $expiryDate - $currentDate;
        
                // 設定背景顏色樣式
                $backgroundColor = '';
                if ($dateDifference > 0 && $dateDifference <= 3 * 24 * 60 * 60) {
                    // 在有效日期前三天（包括當日），黃色
                    $backgroundColor = 'background-color: #ffef9f; font-size: 36px;';
                } elseif ($dateDifference > 0) {
                    // 未到期，綠色
                    $backgroundColor = 'background-color: #C0F7A4; font-size: 36px;';
                } else {
                    // 過期，紅色
                    $backgroundColor = 'background-color: #FBC3BC; font-size: 36px;';
                }
        
                // 顯示每個商品的品名和有效日期，帶有樣式
                // echo "<p style='$backgroundColor'>品名：" . $product['name'] ."<button onclick='Delete()'>刪除</button>". "<br/> 有效日期：" . $product['date'] . "<br/> </p>";
                echo "<p style='$backgroundColor'>品名：" . $product['name'] ."<br/> 有效日期：" . $product['date'] . "<br/> </p>";

            }                          
    } else {
        echo "";
    }
    
    echo "<p style='#fff8dc;font-size: 36px'>"  . "<br/> <br/>". "<br/> </p>";
    ;
    if (isset($_SESSION['update_completed']) && $_SESSION['update_completed'] == true) {
        // 顯示提示訊息 "變更已完成"
        echo "<script>alert('變更已完成');</script>";
        
        // 刪除 session 中的 update_completed 變數，避免下次加載頁面時再次顯示
        unset($_SESSION['update_completed']);
    }//修改後提示字
// 關閉資料庫連線
mysqli_close($link);
?>
 
<script src="Script.js"></script>
</body>
</html>
