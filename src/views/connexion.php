<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/partials/header.php'; ?>

    <main>
        <h2 class="form-title">Connexion</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form class="form" method="POST" action="/connexion">
            <label for="email" class="form-label">Email :</label>
            <input type="email" id="email" name="email" class="form-input" required>

            <label for="password" class="form-label">Mot de passe :</label>
            <input type="password" id="password" name="password" class="form-input" required>

            <button type="submit" class="form-button">Se connecter</button>
        </form>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>