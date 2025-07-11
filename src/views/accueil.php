<?php include __DIR__ . '/partials/header.php'; ?>

<?php
require_once __DIR__ . '/../utils/Database.php';

use Src\Utils\Database;

$db = Database::getConnection();
try {
    $stmt = $db->prepare(
        'SELECT album.id, album.title, album.price, album.cover, artist.name AS artist_name
         FROM album
         JOIN artist ON album.artist_id = artist.id
         ORDER BY album.id DESC
         LIMIT 4'
    );
    $stmt->execute();
    $featured = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Erreur BDD : ' . $e->getMessage());
}
?>

<main>
    <section class="hero">
        <video class="hero-video" autoplay muted loop playsinline>
            <source src="/assets/vidéo/2984380-hd_1920_1080_24fps.mp4" type="video/mp4">
            Votre navigateur ne supporte pas la vidéo HTML5.
        </video>

        <div class="hero-text">
            <h1>Découvrez le charme des vinyles</h1>
            <p>Un voyage musical intemporel pour les amateurs de son authentique.</p>
            <a href="/catalogue" class="hero-button">Explorer le catalogue</a>
        </div>
    </section>

    <section class="featured-products">
        <h2>Nos coups de cœur</h2>
        <div class="products">
            <?php foreach ($featured as $album): ?>
                <section>
                    <article class="product-card">
                        <img
                            src="<?= htmlspecialchars($album['cover']) ?>"
                            alt="<?= htmlspecialchars($album['title']) ?>">
                    </article>
                    <div class="product-text">
                        <h3><?= htmlspecialchars($album['title']) ?></h3>
                        <p><?= number_format($album['price'], 2, ',', ' ') ?> €</p>
                        <button onclick="location.href='/produit.php?id=<?= $album['id'] ?>'">
                            Voir le produit
                        </button>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="about">
        <h2>À propos de SUvinyleUB</h2>
        <p>Chez SUvinyleUB, nous partageons votre passion pour le vinyle. Plongez dans notre collection et découvrez
            des albums rares et incontournables.</p>
    </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>