# Guide de déploiement — Portfolio OS

Procédure **complète et réutilisable** pour déployer :
- **Backend** (Laravel 13) → **Render** (Docker + PostgreSQL)
- **Frontend** (React/Vite) → **Vercel**
- **Médias** → **Cloudinary**

> Ce document contient aussi **tous les problèmes rencontrés et leurs solutions** (section 6). En cas de nouveau déploiement, lis d'abord la **checklist rapide** (section 7).

---

## 1. Vue d'ensemble

```
Navigateur
   │
   ├──►  Frontend (Vercel)      https://sylvinhio-portfolio.vercel.app
   │        │  VITE_API_URL
   │        ▼
   └──►  Backend (Render)       https://portfolio-backend-v8qa.onrender.com/api
            │
            ├──►  PostgreSQL (Render, managé)
            └──►  Cloudinary (images / PDF)
```

Les deux services **se pointent l'un vers l'autre** :
| Service | Variable | = URL de… |
|---|---|---|
| Render (back) | `FRONTEND_URL` | le **front** Vercel |
| Vercel (front) | `VITE_API_URL` | le **back** Render **+ `/api`** |

---

## 2. Prérequis
- Code sur GitHub : `portfolio-backend` et `portfolio-frontend` (dépôts séparés).
- Comptes : **Render**, **Vercel**, **Cloudinary** (tous gratuits).
- En local : `php artisan key:generate --show` pour générer `APP_KEY`.

---

## 3. Backend sur Render (Docker + PostgreSQL)

> ⚠️ Render **n'offre pas de MySQL** managé (seulement **PostgreSQL**) et **pas de PHP natif** → on déploie en **Docker**.

### 3.1 Fichiers nécessaires (déjà dans le repo)
- **`Dockerfile`** — image `php:8.3-apache`, extensions `pdo_pgsql`/`pdo_mysql`, docroot `public/`, `composer install --no-dev`.
- **`docker/start.sh`** — applique le port `$PORT` imposé par Render, lance les migrations, seed conditionnel (`RUN_SEED`), démarre Apache.
- **`.dockerignore`** — exclut `vendor`, `node_modules`, `.git`, `.env`.
- **`render.yaml`** — Blueprint : crée la base PostgreSQL + le service web, injecte les `DB_*` automatiquement.

### 3.2 Créer le service
1. [dashboard.render.com](https://dashboard.render.com) → **New +** → **Blueprint**.
2. Connecte le repo `portfolio-backend`. Champs :
   - **Blueprint Name** : `portfolio-backend` (libellé libre).
   - **Blueprint Path** : `render.yaml` (racine).
3. **Apply** → Render provisionne `portfolio-db` (PostgreSQL) + le web service.

### 3.3 Variables d'environnement
Service → onglet **Environment**. Les `DB_*` sont injectées automatiquement (via `render.yaml`). À renseigner **manuellement** :

| Variable | Valeur | Remarque |
|---|---|---|
| `APP_KEY` | `base64:...` | `php artisan key:generate --show` en local |
| `APP_URL` | `https://portfolio-backend-v8qa.onrender.com` | la vraie URL après le 1er déploiement |
| `APP_ENV` | `production` | |
| `APP_DEBUG` | `false` | |
| `DB_CONNECTION` | `pgsql` | (Postgres) |
| `CLOUDINARY_URL` | `cloudinary://key:secret@cloud` | depuis le dashboard Cloudinary |
| `FRONTEND_URL` | `https://<domaine>.vercel.app` | pour le CORS |
| `SANCTUM_STATEFUL_DOMAINS` | `<domaine>.vercel.app` | sans `https://` |

> ⚠️ **Tape les valeurs à la main** (pas de copier-coller) : un espace/retour à la ligne invisible casse le déploiement (voir 6.4).
> ⚠️ Mets **UNIQUEMENT la valeur** dans le champ *Value* (pas `NOM = valeur`).

> 💡 Sur Render, **chaque « Save Changes » déclenche un redéploiement automatique** → regroupe tes changements.

### 3.4 Migrations & données de démo (seed)
- Les **migrations** tournent à chaque déploiement (dans `docker/start.sh`).
- Le **Shell Render est payant** → on seed via un drapeau :
  1. Ajoute `RUN_SEED = true` → **Save** → le déploiement exécute `php artisan db:seed --force`.
  2. Vérifie dans **Logs** : `>>> RUN_SEED=true → seeding…`.
  3. **Remets `RUN_SEED = false`** (ou supprime-le) → **Save**. ⚠️ Sinon doublons au prochain déploiement.

### 3.5 Vérifier le backend
```
https://<service>.onrender.com/up            → 200 (santé)
https://<service>.onrender.com/api/projects  → tes projets
https://<service>.onrender.com/api/about     → tes infos
```

---

## 4. Frontend sur Vercel

1. [vercel.com](https://vercel.com) → **Add New → Project** → importe `portfolio-frontend`.
2. Framework détecté : **Vite**. Build : `npm run build`, output : `dist`.
3. **Environment Variables** :
   | Key | Value |
   |---|---|
   | `VITE_API_URL` | `https://portfolio-backend-v8qa.onrender.com/api` |

   ⚠️ **Champ Value = uniquement l'URL**, avec `https://` (2 slashes) et **se terminant par `/api`** (voir 6.7 / 6.8).
4. **Deploy**.

> Les variables `VITE_*` sont **figées au build** → après tout changement : **Deployments → ⋯ → Redeploy**.

### 4.1 Domaine propre
Vercel donne un domaine à rallonge si le nom est pris. Pour un domaine court :
Projet → **Settings → Domains** → *Add* → `sylvinhio-portfolio.vercel.app` → *Set as Production*.
Puis **répercute** ce domaine dans `FRONTEND_URL` / `SANCTUM_STATEFUL_DOMAINS` sur Render.

---

## 5. Relier front ↔ back (CORS)
La config `config/cors.php` autorise l'origine via `env('FRONTEND_URL')` — **aucun code à changer**, il suffit de définir la variable.
- `FRONTEND_URL` (Render) doit correspondre **exactement** au domaine Vercel (avec `https://`, sans `/` final).
- Après changement → **Save** (redeploy backend).

---

## 6. ⚠️ Problèmes rencontrés & solutions

### 6.1 Cloudinary — « Overwrite is not a valid boolean »
**Cause** : le service envoyait `overwrite => false` (booléen PHP) en multipart → devient une chaîne vide → refus Cloudinary.
**Solution** : retirer le paramètre `overwrite` (`CloudinaryService::uploadImage/uploadPdf`). Le `public_id` est un UUID unique → inutile.

### 6.2 Cloudinary — « Invalid Signature » à l'upload
**Cause** : `quality` et `fetch_format` étaient inclus dans la **signature**, mais Cloudinary ne les signe pas à l'upload → décalage.
**Solution** : retirer `quality`/`fetch_format` de l'upload. L'optimisation `f_auto/q_auto` est appliquée à l'affichage (`buildCloudinaryUrl`).

### 6.3 Cloudinary — « Invalid Signature » au delete
**Cause** : `generateSignature()` incluait `resource_type`, qui est dans l'URL (pas signé).
**Solution** : signer seulement `public_id` + `timestamp`.

### 6.4 Render — « Invalid URI: A URI cannot contain CR/LF/TAB characters »
**Cause** : une variable URL (`APP_URL`…) contenait un **caractère invisible** (retour à la ligne / tab / espace) collé par erreur. Erreur au démarrage → Apache ne se lance pas → **« no open ports »**.
**Solution** : re-taper les variables URL **à la main** dans Render (Environment), une seule ligne, sans espace.

### 6.5 Render — « no open ports detected »
**Cause** : conséquence de 6.4 — `migrate` plante (`set -e`) → `apache2-foreground` n'est jamais atteint → aucun port.
**Solution** : corriger la cause racine (variable fautive). Le port est géré par `docker/start.sh` via `$PORT`.

### 6.6 Render — Shell indisponible (plan gratuit)
**Cause** : le Web Shell / one-off jobs sont réservés aux plans payants → impossible de lancer `db:seed` manuellement.
**Solution** : seed conditionnel au démarrage via `RUN_SEED=true`, puis remettre à `false` (voir 3.4).

### 6.7 Frontend — toutes les routes en 404, sans `/api`
**Cause** : `VITE_API_URL` défini **sans** `/api` → requêtes vers `/skill-categories` au lieu de `/api/skill-categories`.
**Solution** : `VITE_API_URL = https://<service>.onrender.com/api` (avec `/api`) → Redeploy.

### 6.8 Frontend — URL de type `vercel.app/VITE_API_URL = https:/...`
**Cause** : on a collé **toute la ligne** `VITE_API_URL = https://...` dans le champ **Value** → la variable valait une chaîne invalide, traitée comme chemin relatif.
**Solution** : Champ **Value = uniquement l'URL** (`https://...onrender.com/api`), sans le nom ni le `=`.

### 6.9 CORS — « Access-Control-Allow-Origin manquant »
**Cause** : soit la requête tapait hors `api/*` (voir 6.7), soit `FRONTEND_URL` ne correspondait pas au domaine Vercel.
**Solution** : requêtes sous `/api/*` **et** `FRONTEND_URL` = domaine Vercel exact.

### 6.10 Cold start (plan gratuit Render)
**Cause** : le service s'endort après ~15 min d'inactivité → 1er appel lent, parfois réponse vide.
**Solution** : normal. Réveiller via `/up` avant les tests.

### 6.11 Config cache & `env()`
**Cause** : `CloudinaryService` lit `env('CLOUDINARY_URL')` directement. `php artisan config:cache` ferait renvoyer `null`.
**Solution** : **ne pas** exécuter `config:cache` en prod (ou déplacer la lecture dans un `config/*.php`).

### 6.12 (Dev) Édition projet → 422 « slug already taken »
**Cause** : `UpdateProjectRequest` lisait `route('project')` alors que la route est `/projects/{id}` → l'exception `unique->ignore` ne s'appliquait pas.
**Solution** : `$this->route('id')`.

### 6.13 (Dev) Login admin
- Route réelle : `/api/admin/auth/login` (pas `/api/auth/login`).
- Réponse **enveloppée** (`data.token`) → désenvelopper dans `authService`.
- Email seedé : coquille `sylviniho` → corrigée en `sylvinhio676@gmail.com`.

---

## 7. Checklist de redéploiement (rapide)

**Modif code (front ou back)** → `git push` sur `main` → Render/Vercel redéploient automatiquement.

**Changer une variable Render** → Environment → éditer (à la main) → **Save** (redeploy auto).

**Changer `VITE_API_URL` (Vercel)** → éditer (Value = URL seule + `/api`) → **Redeploy** manuel.

**Re-seed la base (rare)** → `RUN_SEED=true` → Save → vérifier logs → `RUN_SEED=false` → Save.

**Nouvelle URL front** → mettre à jour `FRONTEND_URL` + `SANCTUM_STATEFUL_DOMAINS` (Render) et `VITE_API_URL` reste inchangé.

---

## 8. Sécurité (à faire avant de partager)
- 🔴 **Ne jamais committer `.env`** (déjà dans `.gitignore`). Ne pas mettre de token GitHub dans `.env`.
- 🔴 **Changer le mot de passe admin** de prod (par défaut `password`).
- Garder `APP_DEBUG=false` en production.

---

## 9. Variables d'environnement — récapitulatif

**Backend (Render)** :
`APP_KEY`, `APP_URL`, `APP_ENV=production`, `APP_DEBUG=false`, `DB_CONNECTION=pgsql`, `DB_*` (auto), `CLOUDINARY_URL`, `FRONTEND_URL`, `SANCTUM_STATEFUL_DOMAINS`, (`RUN_SEED` ponctuel), `MAIL_*` (si contact).

**Frontend (Vercel)** :
`VITE_API_URL=https://<service>.onrender.com/api`, `VITE_CLOUDINARY_CLOUD_NAME` (optionnel).
