<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rwdd.css">
    <title>即期查詢</title>
    <style>
        .expired { background-color: #FBC3BC; }
        .soonToExpire { background-color: #ffef9f; font-size: 36px; }
        .notExpired { background-color:#C0F7A4; font-size: 36px; }
    </style>
</head>
<body>
<nav class="nav-box">
  <input type="checkbox" id="menu">
  <label for="menu" class="line">
    <div class="menu"></div>
  </label>

  <div class="menu-list">
    <ul>
      <li id="bt0">首頁</li>
      <li id="bt1">歷史紀錄</li>
      <li id="bt2">食品紀錄</li>
      <li id="bt3">購物清單</li>
      <li id="bt4">即期查詢</li>
      <li id="bt5">推薦商家</li>
      <li id="bt6">登出</li>
    </ul>
  </div>
</nav>
    <div class="titArea">
        即期查詢
        <div class="Loubtn">
            <button id="Search" onclick="ToSearch()">找尋商品</button>
            <button id="RewriteDate" onclick="ToDo()">改寫資料</button>
        </div>
        
    </div>
    <div class="expbtn">
            <select class="selectkind" name="kind" id="kind" required style="font-size: large;">
                <option value="" selected>分類</option>
                <option value="meat">肉品類</option>
                <option value="seafood">海鮮類</option>
                <option value="vegetable">蔬菜類</option>
                <option value="fruit">水果類</option>
                <option value="drinks">飲品類</option>
                <option value="sauce">調味料</option>
                <option value="other">其他</option>
            </select>
            <select class="selectkind" name="sort" id="sort" required style="font-size: large;">
                <option value="" selected disabled>排序</option>
                <option value="asc">有效日期由近到遠</option>
                <option value="desc">有效日期由遠到近</option>
            </select>
        </div>
    <div class="button-container">
        <button class="btn" id="btn0">首頁</button>
        <button class="btn" id="btn1"><span>歷史</span><span>紀錄</span></button>
        <button class="btn" id="btn2"><span>食品</span><span>紀錄</span></button>
        <button class="btn" id="btn3"><span>購物</span><span>清單</span></button>
        <button class="btn" id="btn4"><span>即期</span><span>查詢</span></button>
        <button class="btn" id="btn5">登出</button> 
        <!-- <button class="btn" id="btn6"><span>推薦</span><span>商家</span></button>  -->
    </div>
    <div id="product-list">
        <!-- 產品列表將在這裡顯示 -->
        <?php
        require_once 'db_con.php';

        session_start();
        if (!isset($_SESSION['user'])) {
            echo "<script>
                    alert('請先登入');
                    window.location.href = 'Login.html';
                  </script>";
            exit();
        }else{
         $user=$_SESSION['user'];
        }
        if (!isset($_SESSION['AllData'])) {
            $_SESSION['AllData'] = array();
        }

        $query = "SELECT * FROM myfood WHERE user = '$user' ORDER BY date ASC";  //默認由遠到近
        $mail="SELECT email FROM users WHERE user = '$user'";
        $usermail = mysqli_query($link, $mail);

    if ($usermail) {
    $row = mysqli_fetch_assoc($usermail);
    if ($row) {
        $email = $row['email'];
    }
}
        $result = mysqli_query($link, $query);
        $_SESSION['AllData'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $allData = $_SESSION['AllData'];
        if (isset($_SESSION['AllData'])) {
            foreach ($_SESSION['AllData'] as $product) {
                $expiryDate = strtotime(date('Y-m-d', strtotime($product['date'])));
                $currentDate = strtotime(date('Y-m-d'));
                $dateDifference = $expiryDate - $currentDate;
                $kindImage =  "pic/" . $product['kind'] . ".png"; // 替換為實際的圖片路徑
                $class = '';
        
                if ($dateDifference > 0 && $dateDifference <= 3 * 24 * 60 * 60) {
                    $class = 'warning';
                    $firebaseUrl = "https://foodexp-bc56a-default-rtdb.firebaseio.com/";

 // 需要儲存的資料

 $data = [
    "id" => $product['id'],
  "name" => $product['name'],
  "date" => $product['date'],
  "kind" => $product['kind'],
  "user" => $product['user'],
  "email"=>$email
 ];

 // 將資料轉為 JSON 格式
 $jsonData = json_encode($data);

 // 初始化 curl
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $firebaseUrl . 'remind/'.$product['id'].'.json'); // "users" 是資料庫節點名稱
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
 curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json',
 ]);

 
                    
                } elseif ($dateDifference > 0) {
                    $class = 'safe';
                } else {
                    $class = 'expired';

                     // 移除 expired 的資料
    $firebaseUrl = "https://foodexp-bc56a-default-rtdb.firebaseio.com/";
    
    // 初始化 curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $firebaseUrl . 'remind/' . $product['id'] . '.json');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_exec($ch);
    curl_close($ch);
                }
        
                echo "
                <div class='product-card $class'>
                    <div class='product-image'>
                        <img src='$kindImage' alt='". $product['kind']. "'>
                    </div>
                    <div class='product-info'>
                        <p>品名： <span class='Arial'>".$product['name']."</span></br>有效日期：<span class='Arial'>".$product['date'] ."</span></p>
                    </div>
                </div>
                ";
            }
        } else {
            echo "";
        }

        echo "<p style='#fff8dc;font-size: 36px'>"  . "<br/> <br/>". "<br/> </p>";

        if (isset($_SESSION['update_completed']) && $_SESSION['update_completed'] == true) {
            echo "<script>alert('變更已完成');</script>";
            unset($_SESSION['update_completed']);
        }

        mysqli_close($link);
        ?>
    </div>
    <div class="top-button" onclick="scrollToTop()">TOP</div>
    <script src="Script.js"></script>
</body>
</html>
