<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>即期查詢</title>
        </head>
        <body>
        <table border="1">
           <?php
        session_start();

if (isset($_SESSION['AllData'])) {
        // 使用 foreach 遍歷 $_SESSION['AllData'] 陣列
        foreach ($_SESSION['AllData'] as $product) {
            // 取得有效日期
            $expiryDate = strtotime($product['expiryDate']);
            
            // 取得當前日期
            $currentDate = time();
    
            // 計算日期差
            $dateDifference = $expiryDate - $currentDate;
    
            // 設定背景顏色樣式
            $backgroundColor = '';
            if ($dateDifference > 0) {
                // 未到期，綠色
                $backgroundColor = 'background-color: #C0F7A4;font-size: 36px;';
            } elseif ($dateDifference > -3 * 24 * 60 * 60) {
                // 到期前三天，黃色
                $backgroundColor = 'background-color: #ffef9f;font-size: 36px;';
            } else {
                // 過期，紅色
                $backgroundColor = 'background-color: #FBC3BC;font-size: 36px';
            }
    
            // 顯示每個商品的品名和有效日期，帶有樣式
            echo "<p style='$backgroundColor'>品名：" . $product['productName'] . "<br/> 有效日期：" . $product['expiryDate'] . "<br/> </p>";
            ;

        }
    } else {
        echo "";
    }
    
    echo "<p style='#fff8dc;font-size: 36px'>"  . "<br/> <br/>". "<br/> </p>";
    ;
?> 
</table>
            </body>
            </html>
