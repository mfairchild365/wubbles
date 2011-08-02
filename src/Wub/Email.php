<?php 
class Wub_Email
{
    public static function sendEmail($to, $subject, $body)
    {
        $html = " <html>
                    <head>
                      <title>Wubbles Notification</title>
                    </head>
                    <body>
                      " . $body . "
                    </body>
                    </html>";
        
        include('Mail.php');
        include('Mail/mime.php');
        
        // Constructing the email
        $sender = Wub_Controller::$emailAddress;
        $headers = array(
            'From'          => $sender,
            'Return-Path'   => $sender,
            'Subject'       => $subject
        );
        
        // Creating the Mime message
        $mime = new Mail_mime("\n");
        
        $mime->setHTMLBody($html);
        
         // Set body and headers ready for base mail class
        $body    = $mime->get();
        $headers = $mime->headers($headers);
        
        // SMTP params
        $smtp_params["host"] = "localhost"; // SMTP host
        $smtp_params["port"] = "25";               // SMTP Port (usually 25)
        
        // Sending the email using smtp
        $mail = Mail::factory("smtp", $smtp_params);
        
        return $mail->send($to, $headers, $body);
    }
}