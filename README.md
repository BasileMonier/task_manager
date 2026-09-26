# Task.

Un gestionnaire de tâches minimaliste en noir et blanc, construit en PHP, MySQL et JavaScript natifs — sans framework. Projet réalisé pour pratiquer les bases du backend (PHP, SQL, PDO) et découvrir JavaScript de zéro (manipulation du DOM, `fetch`, requêtes asynchrones).

## Fonctionnalités

- Authentification (inscription / connexion / déconnexion) avec mots de passe hashés (`password_hash` / `password_verify`) et sessions PHP
- CRUD complet sur les tâches : création, lecture, mise à jour (cocher/décocher), suppression
- Toutes les actions passent par `fetch()` — aucun rechargement de page
- Chaque utilisateur ne voit et ne peut modifier que ses propres tâches (vérifié au niveau des requêtes en base)
- Interface minimaliste en noir avec un léger fond quadrillé

## Stack technique

- PHP (sans framework), PDO pour tous les accès en base (requêtes préparées partout)
- MySQL
- JavaScript natif (`fetch`, API du DOM — aucune librairie)
- CSS pur

## Structure du projet

```
task-manager/
├── db.php              # Connexion PDO
├── register.php        # Page + logique d'inscription
├── login.php            # Page + logique de connexion
├── logout.php           # Détruit la session
├── tasks.php            # Page protégée, liste les tâches de l'utilisateur connecté
├── create-task.php      # Endpoint AJAX — création d'une tâche
├── update-task.php      # Endpoint AJAX — bascule le statut d'une tâche
├── delete-task.php      # Endpoint AJAX — suppression d'une tâche
├── CSS/
│   └── style.css
├── JS/
│   ├── script.js         # Validation du formulaire de register.php
│   ├── login.js          # Validation du formulaire de login.php
│   └── tasks.js           # Interactions de la liste de tâches (coche/création/suppression)
└── schema.sql             # Schéma de la base de données
```

## Schéma de la base de données

```sql
CREATE TABLE Users (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE Tasks (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_id INT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    statut ENUM ('To do', 'In progress', 'Done') NOT NULL,
    date_creation DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
);
```

## Installation (en local, avec MAMP)

1. Clone le repo dans le dossier `htdocs` de MAMP.
2. Démarre MAMP (Apache + MySQL).
3. Dans phpMyAdmin, crée une base nommée `task_manager` et importe `schema.sql`.
4. Mets à jour les identifiants dans `db.php` si besoin (host, port, nom de la base, user, password).
5. Rends-toi sur `http://localhost:8888/task-manager/register.php` (adapte le port à ta config MAMP) pour créer un compte.

## Sécurité

- Les mots de passe sont hashés avec `password_hash()` (bcrypt), jamais stockés en clair.
- Toutes les requêtes SQL passent par des requêtes préparées (PDO) pour éviter les injections SQL.
- Chaque requête/modification sur les tâches est filtrée par le `user_id` de l'utilisateur connecté — impossible pour un utilisateur de lire ou modifier les tâches d'un autre, même en devinant/manipulant un id de tâche.
- L'affichage passe par `htmlspecialchars()` pour éviter les failles XSS.

## Pistes d'amélioration futures

- Mode dessin/tableau blanc sur la page des tâches (notes libres via `<canvas>`)
- Animation de gribouillis au lieu d'un simple check
- Modification du contenu d'une tâche (actuellement : création / coche / suppression uniquement)
- Dates d'échéance, tri/filtre par statut

---

Réalisé par Basile Monier.