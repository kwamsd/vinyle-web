<!DOCTYPE html>
<html lang="fr">
<head><title>Inscription</title>
</head>
<body>
    <?php include __DIR__ . '/partials/header.php'; ?>

    <main>
        <h2 class="form-title">Inscription</h2>
        <form class="form" method="POST" action="/inscription">
            <label for="username" class="form-label">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" class="form-input" required>

            <label for="email" class="form-label">Email :</label>
            <input type="email" id="email" name="email" class="form-input" required>

            <label for="password" class="form-label">Mot de passe :</label>
            <input type="password" id="password" name="password" class="form-input" required>

            <button type="submit" class="form-button">S'inscrire</button>
        </form>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>