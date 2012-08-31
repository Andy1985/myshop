<?php
    require_once "class.phpmailer.php";

    $mail = new PHPMailer();

    $mail->CharSet = "UTF-8";
    $mail->IsSMTP();
    $mail->Host = "smtp.126.com";
    $mail->SMTPAuth = true;
    $mail->Username = "lixueming666@126.com";
    $mail->Password = "1985o624A";
    $mail->Port = 25;
    $mail->From = "lixueming666@126.com";
    $mail->FromName = "lixueming666";
    $address = "lixm666@gmail.com";
    $mail->AddAddress("$address","lixm666");

    $mail->Subject = "PHPMailer 李雪明";
    $mail->AddAttachment("/var/www/mail/test.php");
    $mail->IsHTML(true);

    $mail->Body = "<h1>请点击此连接激活</h1><a href='#'>点击确认</a>";
    //用户激活,checkcode存到memcached，降低db压力
    //$url = "http://myshop.com/confirm/index?id=100&code=12345&checkcode=xx";
    //$mail->Body = "<h1>请点击此连接激活</h1><a href='$url'>点击确认</a>";

    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    if (!$mail->Send())
    {
        echo "邮件发送失败.<p>";
        echo "错误原因：" . $mail->ErrorInfo;
        exit();
    }

    echo "邮件发送成功!";
?>
