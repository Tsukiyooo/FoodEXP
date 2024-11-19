<?php
$user="test";
$productName="楊桃";
$expiryDate="2024/11/20";
$email="test911030@gmail.com";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // 如果是用 Composer 安裝

try {
    // 建立 PHPMailer 實例
    $mail = new PHPMailer(true);

    // 設定 SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // 使用 Gmail SMTP 伺服器
    $mail->SMTPAuth = true;
    $mail->Username = 'penny911030@gmail.com'; // 你的 Gmail 地址
    $mail->Password = 'tsxe smmb rvbb cqwq'; // 應用程式密碼
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // 設定發信人與收信人
    $mail->setFrom('penny911030@gmail.com', '食品管理系統'); // 發信人
    $mail->addAddress($email); // 收信人

    // 設定郵件內容
    $mail->isHTML(true);
        $mail->Subject = '商品即期提醒通知';
        $mail->Body = $user."您好，您家中的 <strong>$productName</strong> 將於 <strong>$expiryDate</strong> 到期，請儘快食用！";

    // 發送郵件
    $mail->send();
    echo "提醒郵件已成功發送！";
} catch (Exception $e) {
    echo "郵件發送失敗：{$mail->ErrorInfo}";
}
?>
