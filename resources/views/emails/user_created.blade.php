<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account Has Been Created</title>
</head>
<body>
<h1>Welcome, {{ $user->name }}!</h1>
<p>Your account has been successfully created. You can now log in with your email: {{ $user->email }}.</p>
<p>Thank you for joining us!</p>
</body>
</html>
