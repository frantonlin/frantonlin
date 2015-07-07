<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");
echo "hello?";

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

    $ccbody = "This is a copy of your message to Franton Lin.\n\n$message";
    $ccheaders = "From: $email\r\n"; 
    $ccheaders .= "Reply-To: $to"; 

    // Check if name has been entered
    if (!$_POST['name']) {
        echo "<p>name</p>";
    }
    
    // Check if email has been entered and is valid
    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "<p>email</p>";
    }

    // Check if subject has been entered
    if (!$_POST['subject']) {
        echo "<p>subject</p>";
    }
    
    // Check if message has been entered
    if (!$_POST['message']) {
        echo "<p>message</p>";
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