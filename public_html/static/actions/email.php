<?php
header("Content-Type: text/json; charset=utf8");
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
    
    $body = "From $name: $email\r\n$message";
    $headers = "From: contact@frantonlin.com\r\n"; 
    $headers .= "Reply-To: $email"; 

    $ccbody = "This is a copy of your message to Franton Lin.\r\n\r\n$message";
    $ccheaders = "From: $email\r\n"; 
    $ccheaders .= "Reply-To: $to"; 

    $err = "";

    // Check if name has been entered
    if (!$_POST['name']) {
        echo "<p>name</p>";
        $err .= "name ";
    }
    
    // Check if email has been entered and is valid
    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "<p>email</p>";
        $err .= "email ";
    }

    // Check if subject has been entered
    if (!$_POST['subject']) {
        echo "<p>subject</p>";
        $err .= "subject ";
    }
    
    // Check if message has been entered
    if (!$_POST['message']) {
        echo "<p>message</p>";
        $err .= "message ";
    }

    echo "<p>Error: $err</p>";
    echo "<p>Body:\r\n$body</p>";
 
    // If there are no errors, send the email
    if (!$err) {
        echo "<p>If it gets here, it should send the email!</p>";
        if (mail($to, $subject, $body, $headers)) {
            mail($email,"CC: $subject", $ccbody, $ccheaders);
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false,"error" => "mail() error")); 
        }
    } else {
        echo json_encode(array("success" => false,"error" => $err));
    }
}
?>