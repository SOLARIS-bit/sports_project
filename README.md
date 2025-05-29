# 🎯 Projet Web : Application de Gestion Sportive (2-Tier Architecture)
![PHP](https://img.shields.io/badge/php-8.2-blue?logo=php)
![MariaDB](https://img.shields.io/badge/mariadb-10.11-lightblue?logo=mariadb)
![License](https://img.shields.io/badge/license-MIT-green)
![Status](https://img.shields.io/badge/status-complete-success)
## 🧾 Description
Ce projet consiste à développer une application web simple de gestion de compétitions sportives, basée sur une architecture à deux niveaux (2-tier) :  
- **Frontend / logique métier** en PHP  
- **Backend / base de données** en MariaDB

L’application permet de gérer des joueurs, des équipes, des matchs, des buts, des cartons, et de consulter des statistiques comme les buteurs ou les classements.

---

## ⚙️ Fonctionnalités

- 🔹 Ajouter / afficher des joueurs
- 🔹 Ajouter / afficher des matchs
- 🔹 Ajouter des buts et des cartons
- 🔹 Voir les classements des groupes
- 🔹 Voir les meilleurs buteurs
- 🔹 Rechercher un joueur

---

## 🗄️ Structure du projet

### Fichiers inclus :

| Fichier PHP              | Rôle                                  |
|--------------------------|----------------------------------------|
| `index.php`              | Tableau de bord                        |
| `insert_player.php`      | Formulaire d’ajout de joueur           |
| `view_players.php`       | Liste des joueurs                      |
| `insert_match.php`       | Ajout de match                         |
| `view_matches.php`       | Liste des matchs                       |
| `insert_goal_card.php`   | Ajout de but / carton                  |
| `match_summary.php`      | Résumé de match                        |
| `top_scorers.php`        | Classement des buteurs                 |
| `group_standings.php`    | Classement par groupe                  |
| `search_player.php`      | Recherche de joueur                    |

| Autres fichiers         | Description                           |
|--------------------------|----------------------------------------|
| `database.sql`           | Script de création de la base de données avec données exemple |
| `MCD.png`                | Schéma entité-relation (Modèle Conceptuel de Données) |
| `README.md`              | Ce fichier d'explication              |

---

## 🧠 Modèle Conceptuel de Données (MCD)

Le fichier `MCD.png` représente le **modèle conceptuel de données** de l’application, basé sur les entités suivantes :

- **Competition**
- **Group**
- **Team**
- **Player**
- **Match**
- **Goal**
- **Card**
- **Referee**
- **Team_Group**

Les relations sont modélisées via des clés étrangères (ex : un joueur appartient à une équipe, une équipe joue plusieurs matchs, etc.)

👉 Ce schéma est généré à partir de la structure réelle de la base et visible dans le fichier `MCD.png`.

---

## 💻 Installation (local)

1. Importer la base de données :
   ```bash
   mysql -u root -p < database.sql
   
2. Copier les fichiers dans /var/www/html :
   ```bash
   sudo cp *.php /var/www/html/

3. Accéder au projet dans le navigateur :
   http://localhost
ou http://[adresse IP Linux Crostini]

## Database Setup (phpMyAdmin or CLI)
1. Option A: Importer via phpMyAdmin
- Aller à http://localhost/phpmyadmin
- Se connecter avec ses crédits MySQL/MariaDB
- Créer un nouveau database: sports_management
- Cliquer Import → Select database.sql → Click Go

2. Option B: Importer via Terminal
   ```bash
   mysql -u root -p
   CREATE DATABASE sports_management;
   USE sports_management;
   SOURCE database.sql;


## 🖼️ Entity Relationship Diagram
The full database model is included as a visual MCD:

## Auteur
Solaris-bit
