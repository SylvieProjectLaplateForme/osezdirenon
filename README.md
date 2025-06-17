# Osez Dire Non  README Complet

##  Introduction

"Osez Dire Non" est un blog participatif qui permet aux utilisateurs dexprimer leurs experiences sur des sujets du quotidien comme le travail, la famille ou lecole.  
Le site inclut un systeme de roles (editeur/admin), un espace publicitaire payant, et une moderation des contenus.

---

##  Conception technique

- Modele conceptuel (MCD), logique (MLD) et physique (MPD)
- Diagramme UML des entites et des cas dusage
- Base de donnees SQLite avec Seeders et Migrations Laravel

---

##  Architecture Laravel

- MVC clair :
  - **Models** : Article, Comment, User, Publicite, Paiement, Category
  - **Controllers** : separes par role (admin, editeur, public, Stripe)
  - **Views** :
    - `resources/views/admin/...`
    - `resources/views/editeur/...`
    - `resources/views/auth/...`
    - `resources/views/contact.blade.php`, `home.blade.php`...

- Routes protegees par middleware :
  - `role:admin`, `role:editeur`, `auth`
  - Groupees dans `routes/web.php`

---

##  Authentification et redirection par role

Utilisation de **Laravel Breeze** pour tous les utilisateurs via le formulaire `/login`.

Redirection personnalisee selon le role dans `AuthenticatedSessionController` :

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

-  Lediteur peut sinscrire via `/register` (Breeze)
-  Ladministrateur est cree en base, pas de formulaire dinscription

---

##  Vues Blade et Breeze

- Organisation par role :
  - `admin/` : dashboard, validation, statistiques
  - `editeur/` : articles, pubs, commentaires, profil
- Breeze utilise pour les vues `auth/` : login, register, mot de passe oublie
- Layouts separes (`layout.blade.php`, `admin.layout.blade.php`, `editeur.layout.blade.php`)

---

##  Erreur rencontree et corrigee

Vue de creation d'article mal placee :

-  `resources/views/editeur/articleCreate.blade.php`
-  Corrige : `resources/views/editeur/articles/create.blade.php`
-  Mise a jour du controleur :
```php
return view('editeur.articles.create');
```

---

##  Bonnes pratiques Laravel respectees

- Auth unique avec redirection selon role
- Routes organisees par middleware
- Vues et controleurs separes par responsabilite
- Composants Blade reutilisables
- Admin sans inscription publique
- Validation et upload proteges

---

##  Tous les controleurs Laravel utilises

| Controleur                     | Role principal                                                                 |
|-------------------------------|--------------------------------------------------------------------------------|
| `AdminController`             | Dashboard Admin, validation articles/publicites, statistiques                  |
| `EditeurController`           | Dashboard Editeur, creation articles/publicites, moderation, commentaires      |
| `ArticleController`           | Creation, modification, upload image, affichage public                         |
| `PubliciteController`         | Validation des pubs, acces publicites actives cote admin                       |
| `CommentController`           | Creation, affichage, validation des commentaires                               |
| `ContactController`           | Traitement du formulaire de contact vers Mailtrap                             |
| `CategoryController`          | Filtrage des articles par categorie                                            |
| `PaiementController`          | Affichage des paiements pour lediteur                                         |
| `StripeController`            | Redirection vers Stripe, gestion du paiement dune pub                         |
| `StripeWebhookController`     | Reception des webhooks Stripe (paiement reussi ou echoue)                      |
| `ProfileController`           | Modification du profil editeur avec Breeze (nom, email)                        |
| `ProfilController` *(admin)*  | Acces au profil admin (non via Breeze)                                         |
| `HomeController`              | Page daccueil (articles + publicites defilantes)                              |
| `AuthenticatedSessionController` | Connexion/deconnexion personnalisee avec redirection par role           |
| `RegisteredUserController`    | Inscription dun editeur via Laravel Breeze                                    |




---



# 🔧 Guide d’installation – Environnement de développement

Ce projet Laravel a été développé et testé localement sous Windows avec les outils suivants :

---

## 🧰 Outils nécessaires

| Outil                | Version recommandée       | Description                            |
|---------------------|---------------------------|----------------------------------------|
| WAMP Server          | PHP 8.x, Apache 2.4       | Serveur local (Apache + PHP + MySQL)   |
| PHP                  | 8.1 ou supérieur           | Requis pour Laravel                    |
| Composer             | 2.x                        | Gestionnaire de dépendances PHP        |
| Laravel              | 10.x                       | Framework principal du projet          |
| Laravel Breeze       | 1.x                        | Système d’authentification              |
| SQLite               | (fourni avec Laravel)      | Base de données locale                 |
| Visual Studio Code   | Dernière version           | Éditeur de code                        |
| Git                  | Dernière version           | (optionnel) gestion de version         |

---

## ⚙️ Étapes d'installation

1. **Installer WAMP Server**  
   [https://www.wampserver.com/](https://www.wampserver.com/)  
   - Lancer le serveur Apache uniquement (MySQL non utilisé ici)

2. **Installer Composer**  
   [https://getcomposer.org/](https://getcomposer.org/)  
   Vérifier dans le terminal :
   ```bash
   composer --version
   ```

3. **Créer le projet Laravel**
   ```bash
   composer create-project laravel/laravel osezdirenon
   ```

4. **Se placer dans le dossier du projet**
   ```bash
   cd osezdirenon
   ```

5. **Installer Laravel Breeze**
   ```bash
   composer require laravel/breeze --dev
   php artisan breeze:install blade
   npm install && npm run dev
   php artisan migrate
   ```

6. **Configurer la base SQLite**
   - Créer le fichier : `database/database.sqlite`
   - Dans `.env` :
     ```
     DB_CONNECTION=sqlite
     DB_DATABASE=/chemin/vers/database.sqlite
     ```

7. **Lancer le serveur local**
   ```bash
   php artisan serve
   ```

---

## 📁 Structure du projet

- `/app` → contrôleurs, modèles
- `/resources/views` → vues Blade
- `/routes/web.php` → routes Laravel
- `/database/` → migrations, seeders, base SQLite
- `/public` → fichiers accessibles publiquement (images, JS compilé)

---

## 📦 Dépendances principales

- `laravel/framework`
- `laravel/breeze`
- `tailwindcss`
- `swiper` (carrousel de publicités)
- `stripe/stripe-php`

---

## 📝 Astuce

Pensez à exécuter régulièrement :
```bash
php artisan migrate:fresh --seed
npm run dev
```

---

Ce guide est compatible avec l’environnement de développement utilisé pour "Osez Dire Non".
