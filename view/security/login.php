<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/style-connect.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Se connecter</title>
</head>
<body class="body-connect">
    <header>
        <a href="/exercices/Forum-PHP/"><i class="fa-solid fa-house"></i>Accueil</a>
    </header>
    <main>
        <h1>Se connecter</h1>
        <!-- FORMULAIRE -->
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
    </main>

</body>
</html>