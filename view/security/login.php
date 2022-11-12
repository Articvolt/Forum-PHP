<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css/style-connect.css">
    <title>Se connecter</title>
</head>
<body class="body-connect">
    <h1>Se connecter</h1>

    <form action="\exercices/forum-PHP/index.php?ctrl=security&action=login" method="post">
    <label >
            email : <br>
            <input type="text" name="email" required>
        </label>
        <br>
        <label >
            password : <br>
            <input type="password" name="password" required>
        </label>
        <br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>