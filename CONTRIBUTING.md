# Conventions du projet

## Commits — Conventional Commits

Format : `type(scope): description` (impératif, en anglais).

| Type | Usage |
|---|---|
| `feat` | Nouvelle fonctionnalité |
| `fix` | Correction de bug |
| `refactor` | Refactoring sans changement de comportement |
| `perf` | Performance |
| `docs` | Documentation |
| `test` | Tests |
| `chore` | Outillage, config, maintenance |

Exemples : `feat(api): project CRUD endpoints`, `fix(experience): map role to position column`.

## Branches

| Branche | Rôle |
|---|---|
| `main` | Production / releases (taggées SemVer) |
| `develop` | Intégration continue |
| `feature/<nom>` | Une fonctionnalité = une branche, partant de `develop` |

Flux : `feature/*` → `develop` → release taggée sur `main`.

## Versionnement — SemVer

`vMAJOR.MINOR.PATCH`, tag annoté par release + entrée dans le [CHANGELOG](./CHANGELOG.md).

## Règles de code

- PSR-12. Pas de logique métier dans les controllers (mince : Request → Service → Resource).
- Validation dans les Form Requests, mise en forme dans les API Resources.
- Modèles Eloquent : `$fillable` explicite.
- Migrations non destructives en production.
- Commentaires en français, code en anglais.
