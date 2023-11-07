<?php
   require 'config/ConfigEmail.php';
   use PHPMailer\PHPMailer\PHPMailer;
   require 'PHPMailer/Exception.php';
   require 'PHPMailer/PHPMailer.php';
   require 'PHPMailer/SMTP.php';
   
   function sendEmail($receiver_email, $email_subject, $email_content) {
      $mail = new PHPMailer;
      
      // basic configuration
      $mail -> isSMTP();
      $mail -> Host = email_host;
      $mail -> SMTPAuth = true;
      $mail -> Username = email_name;
      $mail -> Password = email_pass;
      $mail -> SMTPSecure = 'tls';
      $mail -> Port = 25;
      $mail -> SMTPAutoTLS = false;
      $mail->SMTPSecure = 'none';
      $mail -> setFrom('no-reply@gmail.com', 'Vi Dien Tu');
      $mail -> addAddress($receiver_email);
      $mail -> isHTML(true);

      $mail -> Subject = $email_subject;
      $mail -> Body = $email_content;

      return $mail -> send();
   }
?>
