<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $template['title'] ?? __('Default Title') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        p {
            margin: 10px 0;
        }

        .otp-code {
            font-size: 18px;
            font-weight: bold;
            color: #2c7be5;
        }

        a {
            color: #2c7be5;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <p>{!! strip_tags($template['message'] ?? __('No message provided'), '<p><a><b><i><u>') !!}</p>
    <p>Your OTP code is: <span class="otp-code">{{ $otp }}</span></p>
</body>

</html>

