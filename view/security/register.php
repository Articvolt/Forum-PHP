<body>
    <header>
        <nav>
            <a href="/exercices/Forum-PHP/"><i class="fa-solid fa-house"></i> Accueil</a>
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
                <input id="button" type="submit" name="register" value="S'inscrire">
            </p>
        </form>
    </main>

    <!-- message de validation -->
    <!-- <script>
        function validation() {
            alert("votre enregistrement a bien été validé !")
        }
    </script> -->
</body>
</html>
