<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");
echo "<p>hello?</p>";

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

    $errName = False;
    $errEmail = False;
    $errSubject = False;
    $errMessage = False;

    // Check if name has been entered
    if (!$_POST['name']) {
        echo "<p>name</p>";
        $errName = True;
    }
    
    // Check if email has been entered and is valid
    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "<p>email</p>";
        $errEmail = True;
    }

    // Check if subject has been entered
    if (!$_POST['subject']) {
        echo "<p>subject</p>";
        $errSubject = True;
    }
    
    // Check if message has been entered
    if (!$_POST['message']) {
        echo "<p>message</p>";
        $errMessage = True;
    }

    echo "<p>$errName</p>"
 
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