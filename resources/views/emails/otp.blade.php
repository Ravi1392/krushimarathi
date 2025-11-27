<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border: 1px solid #e6e6e6;
            border-radius: 8px;
            overflow: hidden;
        }

        .email-header {
            background-color: #f5fff7;
            padding: 20px;
            text-align: center;
        }

        .email-header img {
            max-height: 50px;
        }

        .email-body {
            padding: 30px 20px;
            color: #333;
            line-height: 1.6;
        }

        .otp-wrapper {
            text-align: center;
            margin: 30px 0;
        }

        .otp-code {
            font-size: 28px;
            font-weight: bold;
            color: #0e7c34;
            background-color: #f0f9f4;
            padding: 15px 30px;
            border-radius: 6px;
            display: inline-block;
        }

        .highlight-name {
            color: #0e7c34;
            font-weight: bold;
        }

        .email-footer {
            background-color: #f0f0f0;
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #777;
        }

        .email-footer a {
            color: #0e7c34;
            text-decoration: none;
            margin: 0 10px;
        }

        @media (max-width: 600px) {
            .email-body {
                padding: 20px 10px;
            }

            .otp-code {
                font-size: 24px;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        {{-- Header --}}
        <div class="email-header">
            <img src="https://krushimarathi.in/public/logo.png" alt="Krushi Marathi">
        </div>

        {{-- Body --}}
        <div class="email-body">
            <p>Hello <span class="highlight-name">{{ $full_name }}</span>,</p>

            <p>Your One-Time Password (OTP) for verification is:</p>

            <div class="otp-wrapper">
                <div class="otp-code">{{ $otp }}</div>
            </div>

            <p>This OTP is valid for 5 minutes. Please do not share it with anyone.</p>

            <p>Once verified, you can access all features of our website.</p>

            <p>Thank you,<br><strong>Team KrushiMarathi.in</strong></p>
        </div>

        {{-- Footer --}}
        <div class="email-footer">
            <a href="{{ url('/ads') }}">Visit Website</a> |
            <a href="{{ url('/contact-us') }}">Contact Support</a> |
            <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
        </div>
    </div>
</body>
</html>
