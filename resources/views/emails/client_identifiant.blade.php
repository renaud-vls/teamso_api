
<!DOCTYPE html>
<html>
<head>
    <title>Votre identifiant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Bonjour {{ $username }},</h1>
    <p>Votre identifiant est : {{ $identifiant }}</p>
</body>
</html>
