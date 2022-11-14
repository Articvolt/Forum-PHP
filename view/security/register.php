<body>
    <main>
        <h1>S'inscrire</h1>
    
        <form action="\exercices/forum-PHP/index.php?ctrl=security&action=addUser" method="post">
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

</body>
</html>
