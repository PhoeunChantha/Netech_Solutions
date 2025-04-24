{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $template['title'] }}</title>
</head>
<body>
    <p>{!! strip_tags($template['message'], '<p><a><b><i><u>') !!}</p>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $template['title'] }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
            line-height: 1.6;
            color: #333333;
            max-width: 650px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .email-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            border-bottom: 2px solid #eaeaea;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .logo {
            max-height: 60px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #eaeaea;
            font-size: 12px;
            color: #777777;
            text-align: center;
        }
        h1, h2, h3 {
            color: #2c3e50;
        }
        a {
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .button {
            display: inline-block;
            background-color: #3498db;
            color: white !important;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin: 15px 0;
        }
        .button:hover {
            background-color: #2980b9;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="/api/placeholder/200/60" alt="Company Logo" class="logo">
        </div>
        <div class="content">
            <div class="message">
                <p>Dear {{ $template['email'] }},</p>
                <p>{!! strip_tags($template['message'], '<p><a><b><i><u>') !!}</p>
            </div>
            
        </div>
        <div class="footer">
            <p>© 2025 Netech Solutions. All rights reserved.</p>
        </div>
    </div>
</body>
</html>