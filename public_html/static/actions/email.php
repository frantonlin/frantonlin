<?php
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

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        mail($email,"CC: $subject", $ccbody, $ccheaders);
    } else {
        // error
    }
}
?>