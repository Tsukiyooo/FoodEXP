<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rwdd.css">
    <title>購物清單</title>

</head>
<body>
    <div class="titArea">
        購物清單
        <div class="Loubtn">
            <button id="SearchBuy" onclick="searchBuy()">找尋商品</button>
            <button id="Add" onclick="addBuy()">新增商品</button>
        </div>
    </div>
    <div class="button-container">
        <!-- 按钮代码 -->
    </div>
    </div>
    <div class="button-container">
      <button class="btn" id="btn1"><img id="myImage" src="pic/time.png"><br>歷史紀錄</button>
      <button class="btn" id="btn2"><img id="myImage" src="pic/edit.png"><br>食品紀錄</button>
      <button class="btn" id="btn3"><img id="myImage" src="pic/list.png"><br>購物清單</button>
      <button class="btn" id="btn4"><img id="myImage" src="pic/loupe.png"><br>即期查詢</button>
      <button class="btn" id="btn5"><img id="myImage" src="pic/shop.png"><br>推薦商家</button> 
    </div>
    <table border="1">
        <?php
        require_once 'db_con.php';
        echo "<tr align=center><td> 檢核 </td><td colspan='5'>品名</td><td colspan='3'>數量</td><td colspan='5'>備註</td><td>修改</td><td>刪除</td></tr>";

        session_start();
        if (!isset($_SESSION['ListData'])) {
            $_SESSION['ListData'] = array();
        }
        $listmaster = "SELECT * FROM tobuy";
        $result = mysqli_query($link, $listmaster);
        $_SESSION['ListData'] = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $listData = $_SESSION['ListData'];
        if (isset($_SESSION['ListData'])) {
            foreach ($_SESSION['ListData'] as $buy) {
                echo "<tr align=center><td><input type='checkbox' class='myCheckbox' data-id='" . $buy['id'] . "' onchange='changeRowColor(this)'></td>";
                echo "<td colspan='5' style='font-size: 30px;'>" . $buy['name'] . "</td>";
                echo "<td colspan='3' style='font-size: 30px;'>" . $buy['quantity'] . "</td>";
                echo "<td colspan='5' style='font-size: 30px;'>" . $buy['remark'] . "</td>";
                echo "<td><button style='font-size: 20px;background-color: #fff8dc;box-shadow: 2px 2px 3px #888888; border: 1px solid #ffffff;' onclick='TBRewrite(\"" . $buy['id'] . "\",\"" . $buy['name'] . "\",\"" . $buy['quantity'] . "\",\"" . $buy['remark'] . "\")'>修改</button></td>";
                echo "<td><button style='font-size: 20px;background-color: #fff8dc;box-shadow: 2px 2px 3px #888888; border: 1px solid #ffffff;' onclick=\"location.href='TBdelete.php?id=" . $buy['id'] . "'\">刪除</button></td></tr>";
            }
        } else {
            echo "";
        }
        if (isset($_SESSION['TBupdate_completed']) && $_SESSION['TBupdate_completed'] == true) {
            echo "<script>alert('變更已完成');</script>";
            unset($_SESSION['update_completed']);
        }
        mysqli_close($link);
        ?>
    </table>
    <p style='#fff8dc;font-size: 36px'><br/> <br/><br/> </p>
    <script src="Script.js"></script> <!-- 移动到页面底部 -->
</body>
</html>