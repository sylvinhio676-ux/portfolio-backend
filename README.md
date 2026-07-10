# Portfolio OS — Backend (API)

API REST du portfolio de **Negoue Tamo Sylvinhio**. Elle expose le contenu public du portfolio et alimente le dashboard d'administration (CMS) : projets, compétences, expériences, services, témoignages, réseaux sociaux, à propos, SEO.

> Frontend associé : [portfolio-frontend](https://github.com/sylvinhio676-ux/portfolio-frontend) (React + Vite).

## ✨ Stack technique

| Domaine | Technologie |
|---|---|
| Framework | Laravel 13 (PHP 8.3) |
| Base de données | MySQL 8 (Eloquent ORM) |
| Authentification | Laravel Sanctum (tokens) |
| Médias | Cloudinary |
| Format API | JSON (API Resources) |

## 🏗️ Architecture

Couches strictes : **route → controller (mince) → Form Request (validation) → Service (métier) / Repository → Model → API Resource (sortie)**.

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Public/     # endpoints publics (lecture)
│   │   └── Admin/      # endpoints protégés (CRUD)
│   ├── Requests/       # validation (Form Requests)
│   └── Resources/      # mise en forme JSON
├── Models/             # modèles Eloquent
├── Services/           # logique métier (CloudinaryService, …)
├── Repositories/       # accès données
└── Helpers/            # ApiResponse (enveloppe standard)
database/
├── migrations/         # schéma
└── seeders/            # données de démonstration
routes/
└── api.php             # routes /api (public + /admin protégé)
```

Toutes les réponses suivent l'enveloppe `{ status, message, data }`.

## 🚀 Démarrage

Prérequis : **PHP 8.3**, **Composer**, **MySQL 8**.

```bash
# 1. Dépendances
composer install

# 2. Environnement
cp .env.example .env
php artisan key:generate
#   -> renseigner DB_*, CLOUDINARY_URL, MAIL_*

# 3. Base de données
php artisan migrate --seed

# 4. Serveur
php artisan serve
```

## 📜 Commandes utiles

| Commande | Rôle |
|---|---|
| `php artisan serve` | Serveur de développement |
| `php artisan migrate --seed` | Migrations + données de démo |
| `php artisan db:seed --class=XxxSeeder` | Seeder ciblé |
| `php artisan test` | Tests |

## 🔐 Variables d'environnement

`DB_*`, `CLOUDINARY_URL`, `SANCTUM_STATEFUL_DOMAINS`, `FRONTEND_URL`, `MAIL_*`.

## 🧩 Fonctionnalités

- **API publique** : about, projets (+ détail), compétences & catégories, services, expériences, témoignages, réseaux sociaux, SEO par page, workflow (méthode de travail), contact (envoi d'email).
- **API admin** (Sanctum) : CRUD complet de toutes les ressources + upload d'images (Cloudinary).

## 🗺️ Roadmap

- [x] API publique + admin (CRUD complet)
- [ ] Endpoint Médias (bibliothèque Cloudinary)
- [ ] Tests de fonctionnalité (endpoints critiques)
- [ ] Déploiement (serveur PHP + HTTPS)

## 🌿 Workflow Git

Voir [CONTRIBUTING.md](./CONTRIBUTING.md) : Conventional Commits, branches `main` / `develop` / `feature/*`, versionnement SemVer.

## 👤 Auteur

**Negoue Tamo Sylvinhio** — sylvinhio676@gmail.com
