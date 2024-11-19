<?php
require_once 'db_con.php';
session_start();
if (!isset($_SESSION['Users'])) {
$_SESSION['Users'] = array();
}

if (isset($_POST['user']) && isset($_POST['pass'])) {
$user = $_POST['user'];
$password = $_POST['pass'];
$email=$_POST['email'];
$users = "INSERT INTO users (user,password,email) VALUES ('$user', '$password','$email')";
$result = mysqli_query($link, $users);
echo "<div style='text-align: center; margin-top: 20px;'>";
    if ($result) {
        echo "<script>
                    alert('註冊成功！');
                    window.location.href = 'Login.html';
                  </script>";
    } else {
        echo "註冊失敗：" . mysqli_error($link) . "<br/>";
        echo "<a href='register.html'>回註冊頁</a>";
    }
    echo "</div>";

mysqli_close($link);
}

 $firebaseUrl = "https://foodexp-bc56a-default-rtdb.firebaseio.com/";

 // 需要儲存的資料
 $data = [
  "user" => $user,
  "password" => $password,
  "email" => $email
 ];

 // 將資料轉為 JSON 格式
 $jsonData = json_encode($data);

 // 初始化 curl
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $firebaseUrl . 'users/'.$user.'.json'); // "users" 是資料庫節點名稱
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
 curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json',
 ]);

 // 發送請求並取得回應
//  $response = curl_exec($ch);
//  curl_close($ch);

//  echo "Firebase 回應：" . $response;
?>
