<?php
// 啟動 session
session_start();

// 清除所有 session 變量
session_unset();

// 重定向到登錄頁面
header('Location: Login.html');
exit();
?>