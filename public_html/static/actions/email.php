<?php

if (isset($_POST['send'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $to = 'Franton Lin <franton.lin@students.olin.edu>'; 
    
    $body = "Email from $name: $email\r\n\r\n$message";
    $headers = "From: Frantonlin.com <contact@frantonlin.com>\r\n"; 
    $headers .= "Reply-To: $email"; 

    $ccbody = "This is a copy of your message to Franton Lin.\r\n\r\n$message";
    $ccheaders = "From: Frantonlin.com <contact@frantonlin.com>\r\n"; 
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
    } elseif (preg_match('/[\r\n]|Content-Type:|Bcc:|Cc:/i', $subject)) {
        // Check if subject is trying to inject headers
        $err .= "spamsubject ";
    }
    
    // Check if message has been entered
    if (!$message) {
        $err .= "nomessage ";
    } elseif (preg_match('/[\r\n]|Content-Type:|Bcc:|Cc:/i', $message)) {
        // Check if message is trying to inject headers
        $err .= "spammessage ";
    }
    if (preg_match('/:\/\//', $message)) {
        $err .= "spamurlmessage";
    }
 
    // If there are no errors, send the email
    if (!$err) {
        if (TRUE) { //mail($to, $subject, $body, $headers)) {
            // mail($email,"Copy: $subject", $ccbody, $ccheaders);
            // echo json_encode(array("success" => TRUE));
        } else {
            echo json_encode(array("success" => FALSE,"error" => "mail() error")); 
        }
    } elseif (strstr($err, "spam")) {
        $spamentry = date('M d, Y   H:i:s')."   errors: $err\r\n
                    Email from $name: $email with subject $subject\r\n
                    $message\r\n
                    ----------------------------------------------------------------------------------------------------\r\n\r\n";
        $spamlog = fopen("../../spam.log", "a");
        fwrite($spamlog, $spamentry);
        fclose($spamlog);
        echo json_encode(array("success" => TRUE,"error" => $err)); 
    } else {
        echo json_encode(array("success" => FALSE,"error" => $err));
    }
}
?>