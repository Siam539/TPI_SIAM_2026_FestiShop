# FestiShop — Guide d'installation

**Projet TPI — CFPT Informatique, Développement d'applications**
Kazi Al Tahsib Siam | IFDAP4B – 4e | 2025–2026

Site e-commerce développé avec Laravel (PHP 8.3+)

---

## Prérequis techniques

| Logiciel          | Version minimale |
|-------------------|-----------------|
| WSL (Ubuntu/Debian) | 2.x           |
| PHP               | 8.3+            |
| Composer          | 2.x             |
| Node.js + npm     | 18+             |
| MySQL / MariaDB   | 8.x             |
| phpMyAdmin        | Toute version récente |

---

## Étapes d'installation

### 1. Récupérer le projet

Ouvrir WSL et se placer dans le dossier de travail, puis cloner ou copier le projet.

### 2. Créer la base de données

Ouvrir phpMyAdmin dans le navigateur (`http://localhost/phpmyadmin`) et créer une nouvelle base de données nommée **festishop**.

### 3. Configurer le fichier `.env`

Ouvrir le projet dans VS Code, copier `.env.example` en `.env`, puis renseigner les informations de connexion à la base de données :

```env
DB_DATABASE=festishop
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

### 4. Générer la clé d'application

```bash
php artisan key:generate
```

### 5. Installer les dépendances PHP

```bash
composer install
```

### 6. Créer les tables et insérer les données de démonstration

```bash
php artisan migrate --seed
```

Cette commande crée toutes les tables et insère les données de test (catégories, produits, utilisateurs).

### 7. Installer les dépendances JavaScript et compiler les assets

```bash
npm install
npm run build
```

### 8. Lancer le serveur de développement

```bash
php artisan serve
```

Le site est ensuite accessible à l'adresse : `http://127.0.0.1:8000`

---

## Comptes de démonstration

| Rôle             | Email               | Mot de passe |
|------------------|---------------------|-------------|
| Administrateur   | admin@gmail.com     | 12345678    |
| Manutentionnaire | manager@gmail.com   | 12345678    |
| Client           | S'inscrire via le site | —        |

---

## Informations du projet

| Champ         | Valeur                              |
|---------------|-------------------------------------|
| Date de début | 20 avril 2026                       |
| Date de fin   | 7 mai 2026                          |
| Maître TPI    | Yves Juillerat                      |
| Expert 1      | M. Yohann Vila                      |
| Expert 2      | M. Frank Villaro-Dixon              |
