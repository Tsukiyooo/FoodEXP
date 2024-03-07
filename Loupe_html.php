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
            <button id="Search">找尋商品</button>
            <button id="Rewrite">改寫資料</button>
        </div>
    </div>
    <div class="button-container">
      <button class="btn" id="btn1"><img id="myImage" src="pic/camera.png"><br>拍攝照片</button>
      <button class="btn" id="btn2"><img id="myImage" src="pic/edit.png"><br>手動輸入</button>
      <button class="btn" id="btn3"><img id="myImage" src="pic/list.png"><br>購物清單</button>
      <button class="btn" id="btn4"><img id="myImage" src="pic/loupe.png"><br>即期查詢</button>
      <button class="btn" id="btn5"><img id="myImage" src="pic/shop.png"><br>推薦商家</button> 
    </div>
        <div id="dataContainer"></div>
    </div>
    <!-- <div id="content">
    <div id="displayData"></div>
    <script>
        // 顯示Loupe.php內容
        var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // 當請求完成且成功時，將返回的資料插入到displayData元素中
            document.getElementById("displayData").innerHTML = this.responseText;
        }
    };

    // 添加隨機參數，以防止瀏覽器緩存
    var randomParam = new Date().getTime();
    xhttp.open("GET", "Loupe.php?random=" + randomParam, true);
    xhttp.send();

    var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4) {
        if (this.status == 200) {
            console.log("成功：", this.responseText);
            document.getElementById("displayData").innerHTML = this.responseText;
        } else {
            console.error("錯誤狀態碼：", this.status);
        }
    }
};

    </script> --> 



    <?php
     session_start();

     


    // 如果 $allData 不是数组，则初始化为一个空数组
    if (!isset($_SESSION['AllData'])) {
        $_SESSION['AllData'] = array();
    }
     // 取得所有資料
    $allData = $_SESSION['AllData'];
    // // 使用 PHP 生成動態 HTML
    // foreach ($allData as $data) {
    //     $productName = $data['name'];
    //     $expiryDate = $data['date'];

    //     // 將日期轉換為時間戳記
    //     $expiryTimestamp = strtotime($expiryDate);
    //     $currentTimestamp = time();
    //     //echo "<p style='$backgroundColor'>品名：" . $product['productName'] ."<button onclick='yourFunction()'>刪除</button>". "<br/> 有效日期：" . $product['expiryDate'] . "<br/> </p>";               
    //     //echo "<div class='" . getColorClass($expiryTimestamp, $currentTimestamp) . "'>";
    //     echo "<p>品名：" . $productName . "</p>";
    //     echo "<p>有效日期：" . $expiryDate . "</p>";
    //     echo "<hr>";
    //     echo "</div>";
    // }

    // Helper function to determine color class


        if (isset($_SESSION['AllData'])) {
            // 使用 foreach 遍歷 $_SESSION['AllData'] 陣列
            foreach ($_SESSION['AllData'] as $product) {
                // 取得有效日期（僅考慮日期部分，不包含時分秒）
                $expiryDate = strtotime(date('Y-m-d', strtotime($product['expiryDate'])));
                
                // 取得當前日期（僅考慮日期部分，不包含時分秒）
                $currentDate = strtotime(date('Y-m-d'));
        
                // 計算日期差
                $dateDifference = $expiryDate - $currentDate;
        
                // 設定背景顏色樣式
                $backgroundColor = '';
                if ($dateDifference >= 0 && $dateDifference <= 3 * 24 * 60 * 60) {
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
                echo "<p style='$backgroundColor'>品名：" . $product['productName'] ."<button onclick='yourFunction()'>刪除</button>". "<br/> 有效日期：" . $product['expiryDate'] . "<br/> </p>";

            }                          
    } else {
        echo "";
    }
    
    echo "<p style='#fff8dc;font-size: 36px'>"  . "<br/> <br/>". "<br/> </p>";
    ;
    ?>
<script src="Script.js"></script>
</body>
</html>
