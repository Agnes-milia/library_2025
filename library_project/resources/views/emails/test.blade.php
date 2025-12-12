<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szülinapi köszöntő</title>
    <style>
        div{
            margin: auto;
            width: 60%;
            border-radius: 20px;
            border: 2px solid black;
        }
        img{
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <div >
        <img src="{{ $mailData['body'] }}" alt="foka">
    </div>
</body>
</html>