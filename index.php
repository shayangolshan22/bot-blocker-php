<?php
session_start();

// Honeypot: hidden field to detect bots
$honeypot = isset($_POST['email']) ? $_POST['email'] : '';

// Time delay method to detect bots (if form is submitted too quickly)
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
}

// If email field is filled or the form was submitted too quickly, it's likely a bot
if ($honeypot || (time() - $_SESSION['start_time']) < 2) {
    die("Bot detected! Access denied.");
}

// Handle normal form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Form submitted successfully.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bot Blocker Form</title>
    <style>
        /* Style the form */
        body {
            font-family: Arial, sans-serif;
        }
        .form-container {
            margin: 0 auto;
            width: 300px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        label {
            margin: 10px 0;
            display: block;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <!-- Honeypot: Hidden field to trap bots -->
            <div style="display:none;">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email">
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>
