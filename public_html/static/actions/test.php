<?php
echo "<p>This should show up.</p>";
$headers = 'From: test@frantonlin.com';
if(mail('franton.lin@students.olin.edu', 'Test email using PHP', 'This is a test email message', $headers)) {
    echo "<h1>IT WORKS</h1>";
} else {
    echo "<h1>Something's broken...</h1>";
}
?>