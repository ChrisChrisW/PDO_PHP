# PDO_PHP - Projet PDO en PHP pour Licence Professionnelle MDN

## Introduction

Bienvenue dans le projet PDO_PHP, une base de données contenant les informations d'un Pokédex. Ce projet est destiné à l'exercice de PDO en PHP pour la Licence Professionnelle Mention Développement Web (LP MDN).

## Fonctionnalités

Le projet PDO_PHP offre les fonctionnalités CRUD (Create, Read, Update, Delete) pour interagir avec les données du Pokédex.

## Prérequis

Avant de commencer, assurez-vous d'avoir [Composer](https://getcomposer.org/) installé sur votre machine. Ensuite, exécutez les commandes suivantes pour installer les dépendances nécessaires :

```bash
composer install
composer require twig/twig
```

Ces commandes installeront les packages requis pour le bon fonctionnement du projet, y compris le moteur de template Twig.

## Configuration de la Base de Données

1. Assurez-vous que vous avez un serveur MySQL installé et en cours d'exécution sur votre machine.
2. Configurez les paramètres de la base de données dans le fichier `config/config.php`. Vous devrez renseigner les informations telles que le nom d'utilisateur, le mot de passe, le nom de la base de données, etc.

## Lancement du Projet

Une fois les dépendances installées et la configuration effectuée, vous pouvez lancer le projet en utilisant un serveur local. Par exemple, avec PHP, vous pouvez utiliser la commande suivante :

```bash
php -S localhost:8000 -t public
```

Accédez ensuite à [http://localhost:8000](http://localhost:8000) dans votre navigateur pour voir le projet en action.
