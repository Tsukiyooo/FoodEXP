<?php
require_once 'db_con.php';
session_start();

if (isset($_POST['ListName']) && isset($_POST['quantity']) && isset($_POST['remark']) && isset($_POST['user'])) {
    $ListName = $_POST['ListName'];
    $quantity = $_POST['quantity'];
    $remark = $_POST['remark'];
    $user = $_POST['user'];

    // 插入資料庫操作
    $listmaster = "INSERT INTO tobuy (name, quantity, remark, user) VALUES ('$ListName', '$quantity', '$remark', '$user')";
    $result = mysqli_query($link, $listmaster);

    if ($result) {
        echo "成功新增至購物清單";
    } else {
        echo "新增至購物清單失敗：" . mysqli_error($link);
    }

    mysqli_close($link);
}
?>
