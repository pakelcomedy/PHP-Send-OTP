<?php
// public/send_otp.php

require_once __DIR__ . '/../src/OTPMailer.php';

// Generate OTP (misalnya, 6 digit angka)
$otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

// Periksa apakah metode request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil email penerima dari data POST
    $recipientEmail = $_POST['email'] ?? '';

    // Validasi email
    if (filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
        $mailer = new OTPMailer();
        $resultMessage = $mailer->sendOtp($recipientEmail, $otp);

        // Periksa hasil pengiriman
        if (strpos($resultMessage, 'OTP sent successfully!') !== false) {
            echo json_encode(['status' => 'success', 'message' => $resultMessage]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send OTP.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email address']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
