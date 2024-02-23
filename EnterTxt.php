<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>手動輸入</title>
        </head>
        <body>
           <?php
            require_once 'db_con.php';
           session_start();
            $id = 1;
           if (!isset($_SESSION['AllData'])) {
            $_SESSION['AllData'] = array();
        }
        
        if (isset($_POST['productName']) && isset($_POST['expiryDate'])) {
             $id++;
            $productName = $_POST['productName'];
            $expiryDate = $_POST['expiryDate'];
            $master = "INSERT INTO myfood VALUES ('$id','$productName', '$expiryDate')";
            $result = mysqli_query($link, $master);
           
            // 將新的資料加入陣列
            $_SESSION['AllData'][] = array('productName' => $productName, 'expiryDate' => $expiryDate);
        }

        if (!empty($_SESSION['AllData'])) {
            $latestData = end($_SESSION['AllData']);
            echo "品名：" . $latestData['productName'] . "<br/>有效日期：" . $latestData['expiryDate'];
            print_r ($_SESSION['AllData'][0]);
            // print "<br/>"
            // print_r ($_SESSION['AllData'][]);
        }
        //session_unset();
            // $productName = $_POST['productName'];
            // $expiryDate = $_POST['expiryDate'];

        //     $_SESSION['productName']= $productName;
        //     $_SESSION['expiryDate'] = $expiryDate;



        // echo "品名：".$_SESSION['productName']."<br/>有效日期：".$_SESSION['expiryDate'];
        //print "hi"
        mysqli_close($link);
        header("Location:EnterTxt.html");
?> 
            </body>
            </html>
