<?php
  $name = $_POST['name'];
  $guest_email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

$email_from = 'ektransport.no@gmail.com';

$email_subject = 'New Form Submission';

$email_body = "User Name: $name.\n".
                "User Email: $guest_email.\n".
                "Subject: $subject.\n".
                "User Message: $message.\n";

$to = 'kireilisk@gmail.com';

$headers = "From: $email_from \r\n";

$headers .= "Reply-To: $guest_email \r\n";

mail($to,$email_subject,$email_body,$headers);

header ("Location: kontaktai.html");

?>
