<?php
require 'phpmailer/PHPMailerAutoload.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
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
			$message_config['to'] = "thanhnp2610@gmail.com";
			$message_config['toname'] = "Thanh Nguyen";
			$message_config['subject'] = "Request for demo";
			$message_config['body'] = $body;
			$result = send_mail($sender_config, $message_config);
		break;
	}

	print json_encode($result);
}

function send_mail($sender, $message){
	$mail = new PHPMailer;
	//$mail->SMTPDebug = 2;
	$mail->isSMTP();
$mail->Debugoutput = 'html';
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
	if (!$mail->send()) {
	    return array("ms " => "Mailer Error: " . $mail->ErrorInfo, "err" => 1);
	} else {
		return array("msg" => "Message sent!", "err" => 0);
	}
}
