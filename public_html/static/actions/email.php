<?php
$err="Well at least it gets here"
if (isset($_POST["submit"])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];

    $message = $_POST['message'];
    $to = 'franton.lin@students.olin.edu'; 
    
    $body = "From $name: $email\n$message";
    $headers = "From: contact@frantonlin.com\r\n"; 
    $headers .= "Reply-To: $email"; 

    $ccbody = "This is a copy of your message to Franton Lin.\n\n$message"
    $ccheaders = "From: $email\r\n"; 
    $ccheaders .= "Reply-To: $to"; 

    // Check if name has been entered
    if (!$_POST['name']) {
        echo "name";
    }
    
    // Check if email has been entered and is valid
    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "email";
    }

    // Check if subject has been entered
    if (!$_POST['subject']) {
        echo "subject";
    }
    
    // Check if message has been entered
    if (!$_POST['message']) {
        echo "message";
    }
 
    // If there are no errors, send the email
    if (!$errName && !$errEmail && !$errSubject && !$errMessage) {
        if (mail($to, $subject, $body, $headers)) {
            mail($email,"CC: $subject", $ccbody, $ccheaders);
        } else {
            // error
        }
    }
}
?>