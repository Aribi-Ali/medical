<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Password Reset</title>
    @vite(['resources/css/app.css'])
    <style>
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            padding: 20px;
            text-align: center;
        }
        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            padding: 30px;
            background-color: #f9fafb;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            background-color: #f3f4f6;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header flex justify-center">
        <a href="/" class="flex items-center">
            <div class="relative w-10 h-10 mr-2">
                <div class="flex items-center justify-center w-10 h-10 bg-teal-500 rounded-full">
                    <span class="font-bold text-white">H</span>
                </div>
            </div>
            <span class="text-xl font-bold text-gray-900">HealthHub</span>
        </a>
    </div>

    <div class="content space-y-6">
        <h1 style="margin-top: 0;">Password Reset Request</h1>
        <p>You are receiving this email because we received a password reset request for your account.</p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $url }}" class="button bg-teal-500 hover:bg-teal-600">Reset Password</a>
        </div>

        <p>This password reset link will expire in {{ $expiration_minutes }} minutes.</p>

        <p>If you did not request a password reset, no further action is required.</p>
        <p>Regards,</p>
        <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
            <a href="{{ $url }}" class="underline text-blue-500">{{ $url }}</a>
        </p>
    </div>

    <div class="footer">
        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        <div style="margin-top: 10px;">
            <a href="{{ url('/') }}" style="color: #4f46e5; text-decoration: none;">Visit our website</a>
        </div>
    </div>
</div>
</body>
</html>
