<?php
require_once 'db_con.php';
    session_start();
    $findpassword_email=$_POST['findpassword_email'];
    $findpassword_user=$_POST['findpassword_user'];
    $newpassword=$_POST['newpassword'];
    $_SESSION['findpassword_email']=$findpassword_email;
    $_SESSION['findpassword_user']=$findpassword_user;


    $sql = "SELECT * FROM users WHERE email = '$findpassword_email' AND user ='$findpassword_user'";
    $result = mysqli_query($link, $sql);
    if(mysqli_num_rows($result) > 0) {
    // 如果找到匹配的電子郵件，則進行密碼更新
    $update_sql = "UPDATE users SET password = '$newpassword' WHERE email = '$findpassword_email' AND user ='$findpassword_user'";
    
    if(mysqli_query($link, $update_sql)) {
        echo "<script>
                    alert('密碼更新成功！');
                    window.location.href = 'Login.html';
                  </script>";
    } else {
        echo "更新密碼時出現錯誤：" . mysqli_error($link);
    }
} else {
    // 如果沒有找到該電子郵件
    echo "<script>
                    alert('該使用者或電子郵件不存在於資料庫中！');
                    window.location.href = 'Login.html';
                  </script>";
}
?>