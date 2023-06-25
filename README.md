# **projet-housing-platform-hetic**

--- 

APARIS - Platforme de location de logement haut de gamme sur Paris.

---

## **Description** : 
Ce projet à été réalisé dans le cadre d'un projet scolaire de fin de première année du Bachelor Développeur Web à HETIC.

## **Fonctionnalités** :
- **Authentification sécurisée** : Permet aux utilisateurs de créer des comptes et de se connecter en toute sécurité.
- **Recherche avancée de logements** : Permet aux utilisateurs de trouver des logements en fonction de critères spécifiques.
- **Réservation de logements** : Permet aux utilisateurs de réserver des logements disponibles en effectuant le paiement.
- **Gestion des logements** : Permet aux propriétaires/gestionnaires de gérer leurs annonces et les informations des logements.
- **Gestion des réservations** : Offre un suivi des réservations, y compris les paiements et les remboursements.
- **Gestion des employés et des tâches** : Permet aux administrateurs d'attribuer des tâches aux employés.
- **Avis clients** : Permet aux utilisateurs de laisser des avis et aux propriétaires de les gérer.


## **Technologies utilisées** :
- PHP
- HTML
- CSS
- JavaScript

## **Dépendances** :
- [PHPMailer](https://github.com/PHPMailer/PHPMailer)

## **Installation** :
- Cloner le projet ```git clone https://github.com/heitzjulien/projet-housing-platform-hetic.git```
- Installer les dépendances ```composer require phpmailer/phpmailer```
- Mettre à jour l'auto-chargement de composer ```php composer.phar dump-autoload```
- Créer une base de données et importer le fichier SQL ```aparis.sql```
- Modifier le fichier ```const.php``` avec vos informations de connexion à la base de données
- Lancer le serveur et profiter du projet ! 

## **Email** : 
Pour pouvoir utiliser la fonction qui vérifie le compte d'un utilisateur par email, il faut passer par [mailhog](https://github.com/mailhog/MailHog).
Je vous invite à suivre le lien pour l'installer sur votre machine. Depuis le panel de MailHog vous pourrez catch les mails envoyés depuis le projet. 

## **Contributeurs** : 
- [Benjamin SCHINKEL](https://github.com/LeBenjos)
- [Alessandro GARAU](https://github.com/AlessGarau)
- [Louisan TCHITOULA](https://github.com/LTOssian)
- [Marie RENE](https://github.com/TainaMarieRene)
- [Marie-Gwenaelle FAHEM](https://github.com/Marie-GwenaelleFahem)
- [Sabrina ATTOS](https://github.com/anirbas2)
- [Julien HEITZ](https://github.com/heitzjulien)
