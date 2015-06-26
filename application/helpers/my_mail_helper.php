<?php

function mymail($email,$subject = FALSE,$message = FALSE,$headers = FALSE,$from = FALSE) {
    $mail = new PHPMailer();

//    $mail->IsSMTP(); // we are going to use SMTP
    $mail->SMTPAuth = true; // enabled SMTP authentication
    $mail->SMTPSecure = "tls";  // prefix for secure protocol to connect to the server
    $mail->Host = "";      // setting GMail as our SMTP server
    $mail->Port = 587;                   // SMTP port to connect to GMail
    $mail->Username = "";  // user email address
    $mail->Password = "";            // password in GMail
    if($from != FALSE)
    $mail->SetFrom($from, 'Shop Admin');  //Who is sending the email
    // $mail->AddReplyTo("ign@ignisitsolutions.com","Firstname Lastname");  //email address that receives the response
    if($subject != FALSE)
    {
        $mail->Subject = $subject;
    }
    if($message != FALSE)
    {
        $mail->Body = $message;
        $mail->AltBody = $message;
    }
    
    
    $destino = $email; // Who is addressed the email to
    
    $mail->AddAddress($destino,$destino);

    //    $mail->AddAttachment("images/phpmailer.gif");      // some attached files
    //    $mail->AddAttachment("images/phpmailer_mini.gif"); // as many as you want
    if (!$mail->Send()) {
        return FALSE;
    } else {
        return TRUE;
    }
}
