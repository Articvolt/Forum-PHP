<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/style-register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>S'enregistrer</title>
</head>
<body>
    <header>
        <nav>
            <a href="/exercices/Forum-PHP/"><i class="fa-solid fa-house"></i>Accueil</a>
        </nav>
     </header>
    <main>
        <h1>S'inscrire</h1>
    
        <form action="\exercices/forum-PHP/index.php?ctrl=security&action=addUser" onsubmit="validation()" method="post">
            <p>
                <label >
                    pseudonyme : <br>
                </label>
                <input type="text" name="pseudonyme" required>
            </p>
            <p>
                <label >
                    email : <br>
                    <input type="email" name="email" required>
                </label>
            </p>
            <p>
                <label >
                    Mot de passe : <br>
                    <input type="text" name="password" required>
                </label>
            </p>
            <p>
                <label >
                    confirmer le mot de passe : <br>
                    <input type="text" name="password2" required>
                </label>
            </p>
            <p>
                <input id="button" type="submit" value="S'inscrire">
            </p>
        </form>
    </main>

    <!-- message de validation -->
    <script>
        function validation() {
            alert("votre enregistrement a bien été validé !")
        }
    </script>
</body>
</html>
