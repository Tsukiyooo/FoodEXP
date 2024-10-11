<?php
require_once 'db_con.php';
session_start();

if (isset($_POST['user']) && isset($_POST['pass'])) {
    $User = $_POST['user'];
    $UserPWD = $_POST['pass'];
    
    $_SESSION['user'] = $User;
    $_SESSION['pass'] = $UserPWD;

    $sql = "SELECT * FROM users WHERE user = '$User'";
    $result = mysqli_query($link, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($UserPWD == $row["password"]) {
                echo "<script>
                        alert('登入成功！')
                        window.location.href = 'main.php';
                    </script>";
            } else {
                echo "<script>
                        alert('密碼錯誤')
                        window.location.href = 'Login.html';
                    </script>";
            }
        } else {
            echo "<script>
                        alert('帳號不存在')
                        window.location.href = 'Login.html';
                    </script>";
        }
        mysqli_free_result($result); 
    } else {
        echo "<script>
        alert('登入失敗: " . mysqli_error($link) . "');
        window.location.href = 'Login.html';
      </script>";
    }

    mysqli_close($link);
} else {
    echo "<script>
            alert('請填寫帳號和密碼')
            window.location.href = 'Login.html';
        </script>";
}
?>
<script src="Script.js"></script>
