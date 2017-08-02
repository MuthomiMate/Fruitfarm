<?php
$to       = 'muthomimate254@gmail.com';
$subject  = 'Testing sendmail.exe';
$message  = 'Hi, your order has been received. Thanks for shopping with us';
$headers  = 'From: muthomimate@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';
if(mail('muthomimate254@gmail.com', $subject, $message, $headers))
    echo "Email sent";
else
    echo "Email sending failed";
?>
