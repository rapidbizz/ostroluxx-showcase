<?php
// Demo example — a small contact form handler in PHP.
// Illustrative example only, not the client website code.

declare(strict_types=1);

function clean(string $value): string
{
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

function isValidEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Only accept form submissions.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

$name = clean($_POST['name'] ?? '');
$email = clean($_POST['email'] ?? '');
$message = clean($_POST['message'] ?? '');

$errors = [];
if ($name === '') {
    $errors[] = 'Name is required.';
}
if (!isValidEmail($email)) {
    $errors[] = 'A valid email is required.';
}
if (strlen($message) < 10) {
    $errors[] = 'Please write a message of at least 10 characters.';
}

if ($errors !== []) {
    http_response_code(422);
    foreach ($errors as $error) {
        echo '<p>' . $error . '</p>';
    }
    exit;
}

$subject = 'New enquiry from ' . $name;
$body = "Name: {$name}\nEmail: {$email}\n\n{$message}";
$headers = "From: website@example.com\r\nReply-To: {$email}";

// In the real site this mails the Ostroluxx team;
// here it just shows the prepared message.
echo '<h1>Thank you, ' . $name . '</h1>';
echo '<p>Your message is ready to send.</p>';
echo '<pre>' . $body . '</pre>';
