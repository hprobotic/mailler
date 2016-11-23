<?php
require 'phpmailer/PHPMailerAutoload.php';
if ($_POST){
	foreach($_POST as $nombre_campo => $valor){
		$$nombre_campo = $valor;
	}

	switch ($type){
		case 'send-mail':
			$sender_config['smtp'] = "smtp.gmail.com";
			$sender_config['user'] = "lienminhthot@gmail.com";
			$sender_config['password'] = "Babynoob@123";
			$sender_config['smtpsecure'] = "tls";
			$message_config['from'] = "lienminhthot@gmail.com";
			$message_config['fromname'] = "Lien Minh";
			$message_config['to'] = "hprobotic@gmail.com";
			$message_config['toname'] = "Hoi Pham";
			$message_config['subject'] = "Tieu de";
			$message_config['body'] = "Noi dung";
			$result = send_mail($sender_config, $message_config);
			var_dump($result); exit;
		break;
	}

	print json_encode($result);
}

function send_mail($sender, $message){
	$mail = new PHPMailer;
	$mail->SMTPDebug = 2;
	$mail->isSMTP();
	$mail->Host = $sender['smtp'];
	$mail->SMTPAuth = true;
	$mail->Username = $sender['user'];
	$mail->Password = $sender['password'];
	$mail->SMTPSecure = $sender['smtpsecure'];
	$mail->From = $message['from'];
	$mail->Port = 587;
	$mail->FromName = $message['fromname'];
	$mail->addAddress($message['to'], $message['toname']);
	$mail->isHTML(true);
	$mail->Subject = $message['subject'];
	$mail->Body    = $message['body'];
	var_dump($mail->send()); exit;
	if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	    echo "Message sent!";
	}
}
