<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>食品紀錄</title>
        </head>
        <body>
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
        if (isset($_POST['productName']) && isset($_POST['expiryDate'])) {
            
            $productName = $_POST['productName'];
            $expiryDate = $_POST['expiryDate'];
            $kind=$_POST['kind'];
            $master = "INSERT INTO myfood (name,kind,date,user) VALUES ('$productName', '$kind','$expiryDate','$user')";
            $mas = "INSERT INTO history (name,kind,date,user) VALUES ('$productName', '$kind', '$expiryDate','$user')";
            $result = mysqli_query($link, $master);
            $res = mysqli_query($link, $mas);
           
            // 將新的資料加入陣列
            $_SESSION['AllData'][] = array('productName' => $productName, 'kind' => $kind,'expiryDate' => $expiryDate);
        }

        if (!empty($_SESSION['AllData'])) {
            $latestData = end($_SESSION['AllData']);
            echo "品名：" . $latestData['productName'] . "<br/>有效日期：" . $latestData['expiryDate'];
            print_r ($_SESSION['AllData'][0]);
        }
        $query = "SELECT id FROM myfood WHERE user = '$user' AND kind ='$kind' AND name ='$productName' AND date ='$expiryDate'";
$result = mysqli_query($link, $query);

// 检查查询是否成功，并获取结果
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
} else {
    echo '无法找到对应的 ID';
    exit(); // 如果未找到 ID，则终止脚本
}
        mysqli_close($link);
       
      

        header("Location:EnterTxt.html");
?> 
            </body>
            </html>
