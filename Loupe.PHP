<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>即期查詢</title>
        </head>
        <body>
        <table border="1">
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
        $query = "SELECT * FROM myfood";
        $result = mysqli_query($link, $query);
    
        // 將資料存入 session 中
        $_SESSION['AllData'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
        // 取得所有資料
        $allData = $_SESSION['AllData'];
    
        // 關閉資料庫連線
        mysqli_close($link);
    
  // 載入 HTML 檔案
  include 'Loupe_html.php';
?> 
</table>
            </body>
            </html>
