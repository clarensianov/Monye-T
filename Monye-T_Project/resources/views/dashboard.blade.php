<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <h1>Hehe</h1>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="btn btn-secondary">Logout</button>
    </form>
</body>
</html>