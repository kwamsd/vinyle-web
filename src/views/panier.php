<?php

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];

require_once __DIR__ . '/../utils/Database.php';

use Src\Utils\Database;

$db = Database::getConnection();

// ajoute un produit au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = (int) $_POST['product_id'];

    $query = $db->prepare('SELECT id, title, price FROM album WHERE id = :id');
    $query->execute(['id' => $productId]);
    $product = $query->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'title' => $product['title'],
                'price' => $product['price'],
                'quantity' => 1,
            ];
        }
    }

    $_SESSION['cart'] = $cart;

    // redirection pour eviter un doublon
    header('Location: /panier');
    exit;
}

// pour supprimer un produit du panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_id'])) {
    $removeId = (int) $_POST['remove_id'];

    // vérifie si le produit est dans le panier
    if (isset($cart[$removeId])) {
        unset($cart[$removeId]);
    }

    // met à jour la session avec le panier modifié
    $_SESSION['cart'] = $cart;


    header('Location: /panier');
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Votre Panier</title>
</head>

<body>
    <?php include __DIR__ . '/partials/header.php'; ?>

    <main>
        <h2 class="titre-panier">Votre Panier</h2>

        <?php if (empty($cart)): ?>
            <p>Votre panier est vide.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix Unitaire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($cart as $productId => $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['title']) ?></td>
                            <td><?= htmlspecialchars(number_format($item['price'], 2)) ?> €</td>
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td><?= htmlspecialchars(number_format($item['price'] * $item['quantity'], 2)) ?> €</td>
                            <td>
                                <form method="POST" action="/panier">
                                    <input type="hidden" name="remove_id" value="<?= htmlspecialchars($productId) ?>">
                                    <button type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        <?php $total += $item['price'] * $item['quantity']; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td><?= htmlspecialchars(number_format($total, 2)) ?> €</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>

        <a href="/catalogue" class="btn">Retour au catalogue</a>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>