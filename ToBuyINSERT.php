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
if (isset($_POST['ListName']) && isset($_POST['quantity']) && isset($_POST['remark'])) {
    $ListName = $_POST['ListName'];
    $quantity = $_POST['quantity'];
    $remark = $_POST['remark'];
    
    $check_query_myfood = "SELECT * FROM myfood WHERE user = '$user'&& name = '$ListName'";
    $check_result_myfood = mysqli_query($link, $check_query_myfood);
    
    $check_query_tobuy = "SELECT * FROM tobuy WHERE user = '$user' && name = '$ListName'";
    $check_result_tobuy = mysqli_query($link, $check_query_tobuy);
    
    if (mysqli_num_rows($check_result_myfood) > 0) {
?>
        <script src="Script.js"></script>
        <script type='text/javascript'>
            showConfirmationDialog();
            window.location.href = 'ToBuyINSERT.html';
        </script>
<?php
    } elseif (mysqli_num_rows($check_result_tobuy) > 0) {
        echo "<script type='text/javascript'>";
        echo "alert('購物清單內已存在此商品');";
        echo "window.location.href = 'ToBuyINSERT.html';";
        echo "</script>";
    } else {
        $listmaster = "INSERT INTO tobuy (name, quantity, remark,user) VALUES ('$ListName','$quantity','$remark','$user')";
        $result = mysqli_query($link, $listmaster);
        
        if ($result) {
            echo "<script>alert('成功新增至購物清單');</script>";
        } else {
            echo "<script>alert('新增至購物清單失敗：" . mysqli_error($link) . "');</script>";
        }
        
        $_SESSION['ListData'][] = array('productName' => $ListName, 'quantity' => $quantity, 'remark' => $remark, 'user' => $user);
        
        mysqli_close($link);
        header("Location: ToBuyList_html.php");
    }
}
?>

<script src="Script.js"></script>
