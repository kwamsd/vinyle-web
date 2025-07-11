# Projet E-commerce - Vinyles

## Technologies utilisées

* PHP
* MySQL
* MAMP
* HTML/CSS

## Objectif du projet

Ce projet consiste à développer un site e‑commerce en respectant le modèle MVC. Le thème choisi est la vente de vinyles ; le site est codé en PHP avec une base de données MySQL, en s’appuyant sur **AltoRouter** pour le routage et **vlucas/phpdotenv** pour la gestion des variables d’environnement.

## Pages du site d’e‑commerce

* Page d’accueil
* Page d’inscription/connexion
* Page catalogue
* Page produit détail
* Page panier

## Installation et Utilisation

### À faire dans votre terminal :

```bash
# Cloner le dépôt
git clone https://github.com/kwamsd/vinyle-web.git

# Se déplacer dans le dossier du projet
cd vinyle-web

# Installer les dépendances
composer install

# Copier le fichier d’exemple et configurer l’environnement
cp .env.example .env
# Éditez .env pour renseigner DB_HOST, DB_NAME, DB_USER, DB_PASS

# Importer la base de données MySQL
mysql -u root -p < public/assets/script/bdd.sql
```

Une fois ces étapes terminées, démarrez **MAMP** (Apache & MySQL) et accédez au projet via :

```
http://localhost:8888/
```

## Bonnes pratiques

* Ne pas commiter le fichier `.env`
* Gérer les secrets (identifiants) via le `.env`
* Créer un utilisateur MySQL avec des privilèges restreints

## Licence

Ce projet est libre, à usage pédagogique.
