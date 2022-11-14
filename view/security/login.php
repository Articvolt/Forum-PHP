<body>
    <header>
        <nav>
            <a href="/exercices/Forum-PHP/"><i class="fa-solid fa-house"></i>Accueil</a>
        </nav>
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