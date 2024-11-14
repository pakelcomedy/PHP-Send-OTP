# PHP-Send-OTP

PHP-Send-OTP is a simple PHP application that allows you to send OTP (One Time Password) via email to users. It uses PHPMailer for email delivery and includes an HTML form for users to input their email address to receive the OTP.

## Features

- **Generate OTP**: Generates a 6-digit OTP.
- **Email Delivery**: Sends the OTP to the specified email address using PHPMailer.
- **Responsive Interface**: Simple and clean front-end using HTML and CSS for OTP submission.

## Requirements

- PHP >= 7.2
- Composer (for managing dependencies)
- PHPMailer (via Composer)

## Installation

Follow these steps to set up the project:

1. **Clone the repository**:
    ```bash
    git clone https://github.com/pakelcomedy/PHP-Send-OTP.git
    cd PHP-Send-OTP
    ```

2. **Install dependencies**:
    Use Composer to install PHPMailer and other dependencies.
    ```bash
    composer install
    ```

3. **Configure SMTP**:
    Edit the `config/smtp_config.php` file to include your email credentials (SMTP server, email, password, etc.) for sending OTP emails.

    ```php
    // config/smtp_config.php
    return [
        'host' => 'smtp.gmail.com',
        'username' => 'your_email@gmail.com',
        'password' => 'your_app_specific_password',
        'encryption' => 'tls',
        'port' => 587,
    ];
    ```

4. **Set up the web server**:
    Ensure you have a PHP-compatible web server (like Apache or Nginx) running. You can also use PHP's built-in server for testing purposes:
    ```bash
    php -S localhost:8000
    ```

5. **Access the application**:
    Open your browser and navigate to `http://localhost:8000/public/index.html` to start using the OTP sending functionality.

## Usage

1. Enter the recipient's email address in the input form.
2. Click "Send OTP" to send the OTP to the provided email.
3. The response message will indicate whether the OTP was sent successfully or if there was an error.

## Screenshot

Here is a screenshot of the application:

![image](https://github.com/user-attachments/assets/d583afa8-54b7-4dec-84ab-f21ac292a05c)


## Troubleshooting

- **Invalid Email**: Ensure the email address is valid.
- **SMTP Authentication Errors**: Double-check your email configuration and ensure the SMTP server settings are correct.
- **Firewall/Port Issues**: Make sure that port 587 (TLS) is open on your server.

## License

This project is open-source and available under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Acknowledgements

- [PHPMailer](https://github.com/PHPMailer/PHPMailer) for email sending functionality.
- [Composer](https://getcomposer.org/) for managing PHP dependencies.
