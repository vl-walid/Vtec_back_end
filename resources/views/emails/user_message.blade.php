<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Message</title>
</head>
<body>
    <h1>New Message from {{ $messageData['name'] }}</h1>
    <p><strong>Email:</strong> {{ $messageData['email'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $messageData['message'] }}</p>
</body>
</html>
