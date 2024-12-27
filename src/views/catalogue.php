<?php

require_once __DIR__ . '/../utils/Database.php';

use Src\Utils\Database;

$db = Database::getConnection();

// requête pour écupérer les produits de la base de données
try {
    $query = $db->query('SELECT album.id, album.title, album.price, album.cover, artist.name AS artist_name FROM album
                         JOIN artist ON album.artist_id = artist.id');
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Erreur lors de la récupération des produits : ' . $e->getMessage());
}

?>

<!DOCTYPE html>
    <title>Catalogue de vinyles</title>
</head>
<body>
    <?php include __DIR__ . '/partials/header.php'; ?>

    <main>
        <h2 class="titre-catalogue">Catalogue de vinyles</h2>
        <div class="catalogue">
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <img src="<?= htmlspecialchars($product['cover']) ?>" alt="<?= htmlspecialchars($product['title']) ?>">
                    <h2><?= htmlspecialchars($product['title']) ?></h2>
                    <p>Artiste : <?= htmlspecialchars($product['artist_name']) ?></p>
                    <p>Prix : <?= htmlspecialchars($product['price']) ?> €</p>
                    <form method="POST" action="/panier">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
                        <button type="submit">Ajouter au panier</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>