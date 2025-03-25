# 🧮 Calculatrice Laravel + Vue.js

Ce projet est une **calculatrice moderne en ligne**, développée dans le cadre d’un test technique. Il utilise **Laravel** pour le traitement backend et **Vue.js** en frontend (intégré via CDN), sans outils de compilation, pour une installation simple et rapide.

---

## 🎯 Objectifs du projet

- Concevoir une interface utilisateur propre et responsive
- Gérer les opérations de calcul côté serveur via une API JSON
- Utiliser Vue.js pour une expérience fluide sans rechargement
- Fournir une structure claire et extensible
- Préparer l'application à une installation en PWA (Progressive Web App)

---

## 🚀 Fonctionnalités

- 4 opérations de base : addition, soustraction, multiplication, division
- Design inspiré de la calculatrice Windows 11
- Animation visuelle sur l'affichage du résultat
- Installation possible comme application bureau (PWA-ready)
- Structure de code claire avec séparation frontend/backend

---

## 🛠️ Stack technique

| Frontend        | Backend        | Autres                        |
|-----------------|----------------|-------------------------------|
| Vue.js (CDN)    | Laravel 10.x    | HTML/CSS (Poppins, Flexbox)  |
| Axios (fetch)   | API JSON        | Manifest PWA, Git, artisan   |

---

## 📦 Installation locale

```bash
git clone https://github.com/YoDevMoaad/calculatrice.git
cd calculator
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
