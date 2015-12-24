<?php

if (isset($_POST['send'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $to = 'Franton Lin <flin@frantonlin.com>'; 
    
    $body = "Email from $name: $email\r\n\r\n$message";
    $headers = "From: Frantonlin.com <flin@frantonlin.com>\r\n"; 
    $headers .= "Reply-To: $email"; 

    $ccbody = "This is a copy of your message to Franton Lin.\r\n\r\n$message";
    $ccheaders = "From: Frantonlin.com <flin@frantonlin.com>\r\n"; 
    $ccheaders .= "Reply-To: $to"; 

    $err = "";

    // Check if name has been entered
    if (!$name) {
        $err .= "noname ";
    }
    
    // Check if email has been entered and is valid
    if (!$email) {
        $err .= "noemail ";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if email is trying to inject headers
        $err .= "spamemail ";
    }

    // Check if subject has been entered
    if (!$subject) {
        $err .= "nosubject ";
    } elseif (preg_match('/[\r\n]|href|content-type:|bcc:|cc:/i', $subject)) {
        // Check if subject is trying to inject headers
        $err .= "spamsubject ";
    }
    
    // Check if message has been entered
    if (!$message) {
        $err .= "nomessage ";
    } elseif (preg_match('/href|content-type:|bcc:|cc:/i', $message)) {
        // Check if message is trying to inject headers
        $err .= "spammessage ";
    }
    if (preg_match('/:\/\//', $message)) {
        // Check if message includes links
        $err .= "spamurlmessage";
    }
 
    // If there are no errors, send the email
    if (!$err) {
        if (mail($to, $subject, $body, $headers, "-f flin@frantonlin.com")) {
            mail($email,"Copy: $subject", $ccbody, $ccheaders, "-f flin@frantonlin.com");
            echo json_encode(array("success" => TRUE));
        } else {
            echo json_encode(array("success" => FALSE,"error" => "mail() error")); 
        }
        $entry = date('M d, Y   H:i:s')."   errors: $err\nEmail from $name: $email with subject $subject\n$message\n------------------------------------------------------------------------------------------------------------------------------------------------------\n\n";
        $log = fopen("/var/www/frantonlin.com/contact.log", "a");
        fwrite($log, $entry);
        fclose($log);
    } elseif (strstr($err, "spam")) {
        $spamentry = date('M d, Y   H:i:s')."   errors: $err\nEmail from $name: $email with subject $subject\n$message\n------------------------------------------------------------------------------------------------------------------------------------------------------\n\n";
        $spamlog = fopen("/var/www/frantonlin.com/contact.spam.log", "a");
        fwrite($spamlog, $spamentry);
        fclose($spamlog);
        echo json_encode(array("success" => TRUE,"error" => $err)); 
    } else {
        echo json_encode(array("success" => FALSE,"error" => $err));
    }
}
?>