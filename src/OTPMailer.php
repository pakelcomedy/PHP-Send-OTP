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
    
            // Pengaturan konten email dengan HTML yang lebih menarik
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Your OTP Code';
    
            // Template HTML untuk email
            $htmlBody = "
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        padding: 20px;
                    }
                    .email-container {
                        background-color: #ffffff;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        width: 100%;
                        max-width: 500px;
                        margin: 0 auto;
                    }
                    h2 {
                        color: #333;
                        font-size: 24px;
                        text-align: center;
                    }
                    .otp-code {
                        font-size: 36px;
                        font-weight: bold;
                        color: #007BFF;
                        text-align: center;
                        padding: 10px 0;
                    }
                    .button-container {
                        text-align: center;
                        margin-top: 20px;
                    }
                    .copy-btn {
                        background-color: #007BFF;
                        color: white;
                        padding: 10px 20px;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        text-transform: uppercase;
                        font-size: 14px;
                    }
                    .copy-btn:hover {
                        background-color: #0056b3;
                    }
                    .footer {
                        text-align: center;
                        font-size: 14px;
                        color: #888;
                        margin-top: 20px;
                    }
                </style>
            </head>
            <body>
                <div class='email-container'>
                    <h2>Your OTP Code</h2>
                    <p>Thank you for using our service. Below is your One-Time Password (OTP) for verification:</p>
                    <div class='otp-code'>$otp</div>
                    <div class='button-container'>
                        <button class='copy-btn'>Copy OTP Code</button>
                    </div>
                    <p>If you didn't request this OTP, please ignore this email.</p>
                    <div class='footer'>
                        <p>Best regards, <br> OTP Service Team</p>
                    </div>
                </div>
            </body>
            </html>
            ";

            // Ganti placeholder OTP dengan nilai sesungguhnya
            $htmlBody = str_replace('{{OTP}}', $otp, $htmlBody);

            // Set body HTML email
            $this->mail->Body = $htmlBody;
    
            // Kirim email
            $this->mail->send();
            return "OTP sent successfully!";
        } catch (Exception $e) {
            return "Error sending OTP: {$this->mail->ErrorInfo}";
        }
    }
}