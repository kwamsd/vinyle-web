<?php

use Src\Controllers\MainController;

$router->map('GET', '/', function() {
    $controller = new MainController();
    $controller->accueil();
}, 'home');

$router->map('GET', '/panier', function() {
    $controller = new MainController();
    $controller->panier();
}, 'panier');

$router->map('POST', '/panier', function() {
    $controller = new MainController();
    $controller->panier(); 
}, 'panier_post');


$router->map('GET|POST', '/inscription', function() {
    $controller = new MainController();
    $controller->inscription();
}, 'inscription');

$router->map('GET', '/catalogue', function() {
    $controller = new MainController();
    $controller->catalogue();
}, 'catalogue');

$router->map('GET|POST', '/connexion', function() {
    $controller = new MainController();
    $controller->connexion();
}, 'connexion');
?>