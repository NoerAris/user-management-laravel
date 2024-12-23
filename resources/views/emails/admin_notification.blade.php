<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Registered</title>
</head>
<body>
<h1>New User Registration</h1>
<p>A new user has registered on the system.</p>
<p>Name: {{ $user->name }}</p>
<p>Email: {{ $user->email }}</p>
<p>Account Created At: {{ $user->created_at }}</p>
</body>
</html>
