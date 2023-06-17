<!DOCTYPE html>
<html>
<head>
    <title>Email Form</title>
</head>
<body>
    <h2>Email Form</h2>
    <form action="send_email.php" method="POST">
        <label for="sender_email">Sender Email:</label>
        <input type="email" id="sender_email" name="sender_email" required><br>

        <label for="recipient_email">Recipient Email:</label>
        <input type="email" id="recipient_email" name="recipient_email" required><br>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required><br>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea><br>

        <input type="submit" value="Send Email">
    </form>
</body>
</html>
