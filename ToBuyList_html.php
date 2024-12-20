<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rwdd.css">
    <title>購物清單</title>

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
        <button class="btn" id="btn0">首頁</button>
        <button class="btn" id="btn1"><span>歷史</span><span>紀錄</span></button>
        <button class="btn" id="btn2"><span>食品</span><span>紀錄</span></button>
        <button class="btn" id="btn3"><span>購物</span><span>清單</span></button>
        <button class="btn" id="btn4"><span>即期</span><span>查詢</span></button>
        <button class="btn" id="btn5"><span>推薦</span><span>商家</span></button> 
        <button class="btn" id="btn6">登出</button> 
    </div>
    <table border="0">
        <?php
        require_once 'db_con.php';
        echo "<tr align='center'>
        <td class='checkbox-cell'>檢核</td>
        <td class='table-cell name'>品名</td>
        <td class='table-cell quantity'>數量</td>
        <td class='table-cell remark'>備註</td>
        <td class='action'></td>
      </tr>";
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
      
        if (!isset($_SESSION['ListData'])) {
            $_SESSION['ListData'] = array();
        }
        $listmaster = "SELECT * FROM tobuy WHERE user='$user'";
        $result = mysqli_query($link, $listmaster);
        $_SESSION['ListData'] = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $listData = $_SESSION['ListData'];
        if (isset($_SESSION['ListData'])) {
            foreach ($_SESSION['ListData'] as $buy) {
                echo "
<tr align=center>
  <td><input type='checkbox' class='myCheckbox' data-id='" . $buy['id'] . "' onchange='changeRowColor(this)'></td>
  <td class='table-cell name'>" . $buy['name'] . "</td>
  <td class='table-cell quantity'>" . $buy['quantity'] . "</td>
  <td class='table-cell remark'>" . $buy['remark'] . "</td>
  <td>
    <div class='action-menu'>
      <button class='action-listbtn' onclick='toggleMenu(this)'>
        <img src='pic/more.png' alt='更多'>
      </button>
      <div class='menu-options' style='display: none;'>
        <button class='edit-option' onclick='TBRewrite(\"" . $buy['id'] . "\",\"" . $buy['name'] . "\",\"" . $buy['quantity'] . "\",\"" . $buy['remark'] . "\")'>修改</button>
        <button class='delete-option' onclick=\"location.href='TBdelete.php?id=" . $buy['id'] . "'\">刪除</button>
      </div>
    </div>
  </td>
</tr>";
    //   <td><button class='action-listbtn' onclick='TBRewrite(\"" . $buy['id'] . "\",\"" . $buy['name'] . "\",\"" . $buy['quantity'] . "\",\"" . $buy['remark'] . "\")'>修改</button></td>

    //   <td><button class='action-listbtn' onclick=\"location.href='TBdelete.php?id=" . $buy['id'] . "'\">刪除</button></td>

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
    <div class="top-button" onclick="scrollToTop()">TOP</div>
    <script src="Script.js"></script> <!-- 移动到页面底部 -->
</body>
</html>