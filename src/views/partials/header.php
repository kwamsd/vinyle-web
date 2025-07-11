<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/style/styles.css">
    <link rel="stylesheet" href="/assets/style/catalogue.css">
    <link rel="stylesheet" href="/assets/style/panier.css">
    <title>SUvinyleUB - Accueil</title>
</head>

<body>
    <header>
        <nav class="navbar">

            <div class="logo">
                <a href="/">
                    <img src="/assets/image/Yeezus_album_cover.png" alt="Logo SUvinyleUB" width="150">
                </a>
            </div>

            <ul class="nav-list">
                <li><a href="/catalogue">Nos produits</a></li>
                <li><a href="#">Nos boutiques</a></li>
                <li><a href="#">À propos de nous</a></li>
            </ul>

            <div class="nav-icons">
                <button aria-label="Panier" onclick="location.href='/panier'">
                    <i class="fa-solid fa-basket-shopping"></i>
                </button>
                <button aria-label="Compte" onclick="location.href='/inscription'">
                    <i class="fa-solid fa-user"></i>
                </button>
            </div>

        </nav>
    </header>