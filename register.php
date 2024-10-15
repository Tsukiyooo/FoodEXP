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
?>
