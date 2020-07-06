<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Created Participant</title>

</head>
<body>
<div>
    <h1>Created Participant</h1>
    <ul>
        <li>{{ $name }}</li>
        <li>{{ $email }}</li>
        <li>{{ $eventTitle }}</li>
        <li>{{ $eventDate }}</li>
        <li>{{ $eventCity }}</li>
    </ul>
</div>
</body>
</html>
