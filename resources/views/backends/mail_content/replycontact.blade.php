<!DOCTYPE html>
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
</html>
