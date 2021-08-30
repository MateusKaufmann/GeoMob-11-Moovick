<?php 
require_once('PHPMailerAutoload.php');
require_once('phpmailer/get_oauth_token.php');
    $mail = new PHPMailer;
     
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'moovickifrs@gmail.com';
    $mail->Password = 'batista.9234';
    $mail->Port = 587;
     
    $mail->setFrom('email@gmail.com', 'Contato');
    $mail->addAddress('moovickifrs@gmail.com');
     
    $mail->isHTML(true);
     
    $mail->Subject = "Envio admin";
    $mail->Body    = "Mensagem";
    $mail->AltBody = "corpo";
     
    if(!$mail->send()) {
        echo 'Não foi possível enviar a mensagem.<br>';
        echo 'Erro: ' . $mail->ErrorInfo;
   } else {
        header('Location: index.php');
  }

?>