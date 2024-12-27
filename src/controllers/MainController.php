<?php

namespace Src\Controllers;

use Src\Utils\Database;

class MainController
{
    public function accueil()
    {
        require_once __DIR__ . '/../views/accueil.php';
    }

    public function panier()
    {
        session_start();


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $productId = (int) $_POST['product_id'];


            $db = Database::getConnection();
            $query = $db->prepare('SELECT id, title, price FROM album WHERE id = :id');
            $query->execute(['id' => $productId]);
            $product = $query->fetch(\PDO::FETCH_ASSOC);

            if ($product) {
                // initialise le panier si nécessaire
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                // ajoute le produit au panier
                if (isset($_SESSION['cart'][$productId])) {
                    $_SESSION['cart'][$productId]['quantity']++;
                } else {
                    $_SESSION['cart'][$productId] = [
                        'title' => $product['title'],
                        'price' => $product['price'],
                        'quantity' => 1,
                    ];
                }
            }
            header('Location: /panier');
            exit;
        }

        require __DIR__ . '/../views/panier.php';
    }

    public function catalogue()
    {
        require_once __DIR__ . '/../views/catalogue.php';
    }

    public function connexion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (!empty($email) && !empty($password)) {
                $userModel = new \Src\Models\UserModel();
                $user = $userModel->getUserByEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user'] = $user['id']; 
                    header('Location: /'); 
                    exit;
                } else {
                    $error = "Email ou mot de passe incorrect.";
                }
            }
        }

        require __DIR__ . '/../views/connexion.php';
    }

    public function inscription()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (!empty($username) && !empty($email) && !empty($password)) {
                try {
                    $userModel = new \Src\Models\UserModel();
                    $userModel->createUser($username, $email, $password);
                    header('Location: /connexion'); 
                    exit;
                } catch (\Exception $e) {
                    $error = $e->getMessage();
                }
            }
        }

        require __DIR__ . '/../views/inscription.php';
    }
}
