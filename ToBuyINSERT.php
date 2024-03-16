<?php
        require_once 'db_con.php';
          session_start();
          if (!isset($_SESSION['ListData'])) {
           $_SESSION['ListData'] = array();
       }
       
       if (isset($_POST['ListName']) && isset($_POST['quantity'])&& isset($_POST['remark'])) {
           $ListName = $_POST['ListName'];
           $quantity = $_POST['quantity'];
           $remark = $_POST['remark'];
           $listmaster = "INSERT INTO Tobuy (name,quantity,remark) VALUES ('$ListName','$quantity','$remark')";
           $result = mysqli_query($link, $listmaster);
          
           // 將新的資料加入陣列
           $_SESSION['ListData'][] = array('productName' => $ListName, 'quantity' => $quantity,'remark' => $remark);
       }

       mysqli_close($link);
       header("Location:ToBuyList_html.php");
?>