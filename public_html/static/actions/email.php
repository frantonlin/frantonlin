<?php

if (isset($_POST['send'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $to = 'franton.lin@students.olin.edu'; 
    
    $body = "From $name: $email\r\n\r\n$message";
    $headers = "From: contact@frantonlin.com\r\n"; 
    $headers .= "Reply-To: $email"; 

    $ccbody = "This is a copy of your message to Franton Lin.\r\n\r\n$message";
    $ccheaders = "From: $email\r\n"; 
    $ccheaders .= "Reply-To: $to"; 

    $err = "";

    // Check if name has been entered
    if (!$_POST['name']) {
        $err .= "name ";
    }
    
    // Check if email has been entered and is valid
    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $err .= "email ";
    }

    // Check if subject has been entered
    if (!$_POST['subject']) {
        $err .= "subject ";
    }
    
    // Check if message has been entered
    if (!$_POST['message']) {
        $err .= "message ";
    }

 
    // If there are no errors, send the email
    if (!$err) {
        if (mail($to, $subject, $body, $headers)) {
            mail($email,"CC: $subject", $ccbody, $ccheaders);
            echo json_encode(array("success" => TRUE));
        } else {
            echo json_encode(array("success" => FALSE,"error" => "mail() error")); 
        }
    } else {
        echo json_encode(array("success" => FALSE,"error" => $err));
    }
}
?>