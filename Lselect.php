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
            <button id="Search" onclick="Back()">找尋商品</button>
            <button id="RewriteDate" onclick="ToDoSel()">改寫資料</button>
        </div>
    </div>
    <div class="button-container">
      <button class="btn" id="btn1"><img id="myImage" src="pic/time.png"><br>歷史紀錄</button>
      <button class="btn" id="btn2"><img id="myImage" src="pic/edit.png"><br>食品紀錄</button>
      <button class="btn" id="btn3"><img id="myImage" src="pic/list.png"><br>購物清單</button>
      <button class="btn" id="btn4"><img id="myImage" src="pic/loupe.png"><br>即期查詢</button>
      <button class="btn" id="btn5"><img id="myImage" src="pic/shop.png"><br>推薦商家</button> 
    </div>
<?php
    require_once 'db_con.php';
    session_start();
    if (!isset($_SESSION['Data'])) {
        $_SESSION['Data'] = array();
    }
    
    //  echo $_GET['productName'];
    $productName=$_GET['productName'];
    $_SESSION['SelproductName']=$_GET['productName'];
    $query = "SELECT id,name, date FROM myfood WHERE name LIKE '%$productName%'ORDER BY date ASC";
    
    $result = mysqli_query($link, $query);
    $_SESSION['Data'] = mysqli_fetch_all($result, MYSQLI_ASSOC);

// 取得所有資料
$Data = $_SESSION['Data'];
        if (isset($_SESSION['Data'])) {
            // 使用 foreach 遍歷 $_SESSION['AllData'] 陣列
            foreach ($_SESSION['Data'] as $product) {
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
    mysqli_close($link);
?>
 
 <script src="Script.js"></script>
</body>
</html>