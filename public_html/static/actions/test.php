<?php
echo "<p>Is this supposed to show up?</p>";
$headers = 'From: test@frantonlin.com';
mail('franton.lin@gmail.com', 'Test email using PHP', 'This is a test email message', $headers);
?>