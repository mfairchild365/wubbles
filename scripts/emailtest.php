<?
include('Mail.php');
include('Mail/mime.php');
// Constructing the email
$sender = "no-reply@wubblesmemories.com";
$recipient = "mfairchild365@gmail.com";
$subject = "Test Email";
$text = 'This is a text message.';
$html = '<html><body><p>This is a html message</p></body></html>';
$crlf = "\n";
$headers = array(
'From'          => $sender,
'Return-Path'   => $sender,
'Subject'       => $subject
);
// Creating the Mime message
$mime = new Mail_mime($crlf);
// Setting the body of the email
$mime->setTXTBody($text);
$mime->setHTMLBody($html);
 // Set body and headers ready for base mail class
$body = $mime->get();
$headers = $mime->headers($headers);
// SMTP params
$smtp_params["host"] = "localhost"; // SMTP host
$smtp_params["port"] = "25";               // SMTP Port (usually 25)
// Sending the email using smtp
$mail = Mail::factory("smtp", $smtp_params);
$result = $mail->send($recipient, $headers, $body);
if($result == 1)
{
echo("Your message has been sent!");
}
else
{
echo("Your message was not sent: " . $result);
}
?>