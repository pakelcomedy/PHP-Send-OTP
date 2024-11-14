<?php
// src/OTPMailer.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

class OTPMailer {
    private $mail;

    public function __construct() {
        $config = include(__DIR__ . '/../config/smtp_config.php');
        $this->mail = new PHPMailer(true);

        // Konfigurasi SMTP
        $this->mail->isSMTP();
        $this->mail->Host = $config['host'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $config['username'];
        $this->mail->Password = $config['password'];
        $this->mail->SMTPSecure = $config['encryption'];
        $this->mail->Port = $config['port'];

        // Pengaturan email pengirim
        $this->mail->setFrom($config['username'], 'OTP Service');
    }

    public function sendOtp($recipientEmail, $otp) {
        try {
            // Pengaturan email penerima
            $this->mail->addAddress($recipientEmail);

            // Pengaturan konten email
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Your OTP Code';
            $this->mail->Body = "Your OTP code is: <b>$otp</b>";

            // Kirim email
            $this->mail->send();
            return "OTP sent successfully!";
        } catch (Exception $e) {
            return "Error sending OTP: {$this->mail->ErrorInfo}";
        }
    }
}