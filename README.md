# Blog : Osez Dire Non  

## 🎯 Introduction

**"Osez Dire Non"** est un blog participatif, éducatif et engagé, conçu pour offrir un espace d’expression libre à celles et ceux qui souhaitent témoigner, sensibiliser ou conseiller sur des sujets souvent passés sous silence : pression sociale, abus de pouvoir, inégalités, discriminations, etc.

Le site inclut un **système de rôles** (éditeur/admin), un **espace publicitaire payant**, et une **modération des contenus**.  
Chaque contribution est modérée avec soin avant publication afin de garantir un cadre respectueux, constructif et bienveillant.

---

## 📁 Guide d’installation – Local (WAMP / SQLite)

1. **Installer [WAMP](https://www.wampserver.com/)**  
2. **Installer [Composer](https://getcomposer.org/)**  
3. **Créer projet Laravel avec Breeze et Vite**
```bash
composer create-project laravel/laravel osezdirenon
cd osezdirenon
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run dev
```

4. **Configurer SQLite dans `.env`**
```
DB_CONNECTION=sqlite
DB_DATABASE=./database/database.sqlite
```

5. **Créer la base et lancer le site**
```bash
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

---

## 🧱 Conception technique

- Modèle conceptuel (MCD), logique (MLD) et physique (MPD)
- Diagramme UML des entités et des cas d’usage
- Base de données SQLite avec Seeders et Migrations Laravel

---

## 🏗️ Architecture Laravel

- MVC clair :
  - **Models** : Article, Comment, User, Publicite, Paiement, Category, ContactMessage
  - **Controllers** : séparés par rôle (admin, éditeur, public, Stripe)
  - **Views** :
    - `resources/views/admin/...`
    - `resources/views/editeur/...`
    - `resources/views/auth/...`
    - `resources/views/contact.blade.php`, `home.blade.php`...

- Routes protégées par middleware :
  - `role:admin`, `role:editeur`, `auth`
  - Groupées dans `routes/web.php`

---

## 🔐 Authentification et redirection par rôle

Utilisation de **Laravel Breeze** pour tous les utilisateurs via le formulaire `/login`.

Redirection personnalisée selon le rôle dans `AuthenticatedSessionController` :
```php
public function redirectTo($user)
{
    if ($user->role->name === 'admin') {
        return route('admin.dashboard');
    } elseif ($user->role->name === 'editeur') {
        return route('editeur.dashboard');
    }
    return '/';
}
```

- L’éditeur peut s’inscrire via `/register` (Breeze)
- L’administrateur est créé en base, pas de formulaire d’inscription

---

## 🧩 Vues Blade et Breeze

- Organisation par rôle :
  - `admin/` : dashboard, validation, statistiques
  - `editeur/` : articles, pubs, commentaires, profil
- Breeze utilisé pour les vues `auth/` : login, register, mot de passe oublié
- Layouts séparés (`layout.blade.php`, `admin.layout.blade.php`, `editeur.layout.blade.php`)

---

## 💡 Intégration Vite.js

Le projet utilise **Vite** comme bundler JavaScript et CSS via Laravel Breeze Blade.
- Compilation CSS/JS avec : `npm run dev`
- Hot Reload via `npm run dev`
- TailwindCSS inclus via Vite

---

## 🎯 RGPD & Bandeau cookies

Le site affiche un **bandeau RGPD** informatif en bas de page à la première visite.
- Fonctionne avec `localStorage`
- Disparaît au clic sur "Accepter"
- Aucune collecte de données personnelles

---

## 📦 Dépendances principales

- Laravel 12
- Laravel Breeze (Blade)
- Tailwind CSS
- Vite.js
- SQLite
- Stripe PHP SDK
- Swiper.js

---

## 📚 Tous les contrôleurs Laravel utilisés

| Contrôleur                     | Rôle principal                                                                 |
|-------------------------------|--------------------------------------------------------------------------------|
| `AdminController`             | Dashboard Admin, validation articles/publicités, statistiques                  |
| `EditeurController`           | Dashboard Éditeur, création articles/publicités, modération, commentaires      |
| `ArticleController`           | Création, modification, upload image, affichage public                         |
| `PubliciteController`         | Validation des pubs, accès publicités actives côté admin                       |
| `CommentController`           | Création, affichage, validation des commentaires                               |
| `ContactController`           | Traitement du formulaire de contact vers Mailtrap                             |
| `CategoryController`          | Filtrage des articles par catégorie                                            |
| `PaiementController`          | Affichage des paiements pour l’éditeur                                         |
| `StripeController`            | Redirection vers Stripe, gestion du paiement d’une pub                         |
| `StripeWebhookController`     | Réception des webhooks Stripe : mise à jour `paiement`                         |
| `ProfileController`           | Modification du profil éditeur avec Breeze                                     |
| `ProfilController` *(admin)*  | Accès au profil admin                                          |
| `HomeController`              | Page d’accueil (articles + publicités défilantes)                             |
| `AuthenticatedSessionController` | Connexion/déconnexion personnalisée avec redirection par rôle           |
| `RegisteredUserController`    | Inscription d’un éditeur via Laravel Breeze                                    |

---

## 🧩 Déploiement du projet via GitHub

### 🔧 Créer un dépôt GitHub

1. Aller sur [GitHub](https://github.com)
2. Créer un dépôt `osezdirenon`
3. Ne pas initialiser avec README

### 🔄 Relier à VS Code :
 C:\Users\Utilisateur\Desktop\blog>
```bash

git init
git remote add origin https://github.com/SylvieProjectLaplateForme/osezdirenon.git
git add .
git commit -m "Initial commit"
git push -u origin main
```

---

## 🧩 Clonage du projet Laravel "Osez Dire Non"

```bash
git clone https://github.com/SylvieProjectLaplateForme/osezdirenon.git
cd osezdirenon
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm install && npm run dev
php artisan serve
```

---

👉 Le site est prêt à l’emploi sur `http://127.0.0.1:8000`
