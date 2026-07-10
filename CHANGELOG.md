# Changelog

Format inspiré de [Keep a Changelog](https://keepachangelog.com/fr/1.1.0/), versionnement [SemVer](https://semver.org/lang/fr/).

## [1.0.0] — API complète
### Ajouté
- API admin (Sanctum) : CRUD Projets (+ images Cloudinary), Compétences & catégories, Expérience, Services, Témoignages, Réseaux sociaux, À propos, SEO.
### Corrigé
- Expérience : mapping du champ API `role` vers la colonne `position`.
- SEO : lecture des réglages sans écrasement des valeurs enregistrées.

## [0.4.0] — Données de démonstration
### Ajouté
- Seeders réalistes (projets GeTime, FormCam, WhatsMark, Estuaire Emplois, compétences, etc.).

## [0.3.0] — API publique & admin
### Ajouté
- Controllers publics et admin, Form Requests, API Resources, services et repositories, routes `/api`.

## [0.2.0] — Modèles & schéma
### Ajouté
- Modèles Eloquent et migrations (projets, compétences, expériences, services, témoignages, socials, about, SEO, workflow).

## [0.1.0] — Structure initiale
### Ajouté
- Initialisation Laravel 13, Sanctum, configuration Cloudinary.
