<?php
/*
 * send_contact.php
 *
 *  Created on: 2025-04-24
 *  Edited on: 2025-04-24
 *      Author: Andwardo
 *      Version: 1.0
 */

header('Content-Type: application/json');

$secretKey = "6LcKyiMrAAAAAAJbZwxNnnC1ec_5QGTEHRE0M7oS";
$recaptcha = $_POST['g-recaptcha-response'];

if (!$recaptcha) {
  echo json_encode(['success' => false, 'message' => 'reCAPTCHA verification missing.']);
  exit;
}

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptcha");
$responseKeys = json_decode($response, true);

if (!$responseKeys['success']) {
  echo json_encode(['success' => false, 'message' => 'reCAPTCHA failed.']);
  exit;
}

$name = htmlspecialchars($_POST['name'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$phone = htmlspecialchars($_POST['phone'] ?? '');
$message = htmlspecialchars($_POST['message'] ?? '');

if (!$name || !$email || !$message) {
  echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
  exit;
}

// Send email
$to = "andy@andyballardpianoservice.com";  // ← replace with your real inbox
$subject = "New Contact Message from ABPS Website";
$body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: $email";

$mailSent = mail($to, $subject, $body, $headers);

if ($mailSent) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false, 'message' => 'Mail send failed.']);
}
?>