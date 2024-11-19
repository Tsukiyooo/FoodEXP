<?php
require_once 'db_con.php';
session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>
            alert('請先登入');
            window.location.href = 'Login.html';
          </script>";
    exit();
} else {
    $user = $_SESSION['user'];
}

if (isset($_POST['ListName']) && isset($_POST['quantity']) && isset($_POST['remark'])) {
    $ListName = $_POST['ListName'];
    $quantity = $_POST['quantity'];
    $remark = $_POST['remark'];

    $check_query_myfood = "SELECT * FROM myfood WHERE user = '$user' AND name = '$ListName'";
    $check_result_myfood = mysqli_query($link, $check_query_myfood);

    $check_query_tobuy = "SELECT * FROM tobuy WHERE user = '$user' AND name = '$ListName'";
    $check_result_tobuy = mysqli_query($link, $check_query_tobuy);

    if (mysqli_num_rows($check_result_myfood) > 0) {
        echo "<script type='text/javascript'>
                if (confirm('家中尚有相同商品，是否要新增？')) {
                    // 使用者選擇確定後，直接在 AJAX 中處理資料庫插入
                    var listName = '$ListName';
                    var quantity = '$quantity';
                    var remark = '$remark';
                    var user = '$user';

                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open('POST', 'ToBuyINSERTAJAX.php', true);  // 修改為新的文件名稱
                    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            alert('成功新增至購物清單');
                            window.location.href = 'ToBuyList_html.php'; // 重定向到購物清單頁
                        }
                    };
                    xmlhttp.send('ListName=' + listName + '&quantity=' + quantity + '&remark=' + remark + '&user=' + user);
                } else {
                    alert('您已取消確認');
                    window.location.href = 'ToBuyINSERT.html';
                }
              </script>";
    } elseif (mysqli_num_rows($check_result_tobuy) > 0) {
        echo "<script type='text/javascript'>
                alert('購物清單內已存在此商品');
                window.location.href = 'ToBuyINSERT.html';
              </script>";
    } else {
        // 如果都不存在，則直接插入資料庫
        $listmaster = "INSERT INTO tobuy (name, quantity, remark, user) VALUES ('$ListName', '$quantity', '$remark', '$user')";
        $result = mysqli_query($link, $listmaster);

        if ($result) {
            echo "<script>alert('成功新增至購物清單');</script>";
            header("Location: ToBuyList_html.php");
        } else {
            echo "<script>alert('新增至購物清單失敗：" . mysqli_error($link) . "');</script>";
        }

        mysqli_close($link);
    }
}
?>
