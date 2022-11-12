<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css/style-register.css">
    <title>S'enregistrer</title>
</head>
<body>
    <h1>S'inscrire</h1>

    <form action="\exercices/forum-PHP/index.php?ctrl=security&action=addUser" onsubmit="validation()" method="post">
        <label >
            pseudonyme : <br>
            <input type="text" name="pseudonyme" required>
        </label>
        <br>
        <label >
            email : <br>
            <input type="email" name="email" required>
        </label>
        <br>
        <label >
            Mot de passe : <br>
            <input type="text" name="password" required>
        </label>
        <br>
        <label >
            confirmer le mot de passe : <br>
            <input type="text" name="password2" required>
        </label>
        <br>
        <input type="submit" value="S'inscrire">
    </form>

    <!-- message de validation -->
    <script>
        function validation() {
            alert("votre enregistrement a bien été validé !")
        }
    </script>
</body>
</html>
