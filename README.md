# 📌 Gestion automatisée des Avis et Délibérations

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![Chart.js](https://img.shields.io/badge/Charts-Chart.js-FF6384?style=for-the-badge&logo=chartdotjs&logoColor=white)
![PDF](https://img.shields.io/badge/PDF-DomPDF-CC0000?style=for-the-badge&logo=adobeacrobatreader&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

---

## 📖 Description
Ce projet est une application web développée avec **Laravel** permettant de gérer automatiquement les **Avis** et **Délibérations**.  
Elle offre une interface simple et intuitive pour la **création**, la **modification**, la **suppression** et l’**archivage** de documents administratifs, avec génération automatique de **rapports PDF**.

---

## 🚀 Fonctionnalités principales
- Gestion des **Avis** (CRUD complet)
- Gestion des **Délibérations**
- Gestion des **Articles** associés
- Gestion des **Références juridiques**
- Gestion des **Signataires**
- Association avec une **année budgétaire**
- **Tableau de bord dynamique** avec statistiques
- **Export PDF** des documents
- **Authentification sécurisée** avec Laravel Breeze
- Design responsive avec **Bootstrap 5**
- Notifications modernes avec **SweetAlert2**

---

## 🛠️ Technologies utilisées
- [Laravel 10](https://laravel.com/) (Framework PHP)
- [PHP 8.2](https://www.php.net/)
- [MySQL](https://www.mysql.com/) (Base de données relationnelle)
- [Bootstrap 5](https://getbootstrap.com/) (Interface utilisateur)
- [SweetAlert2](https://sweetalert2.github.io/) (Notifications)
- [Chart.js](https://www.chartjs.org/) (Graphiques et statistiques)
- [DomPDF](https://github.com/dompdf/dompdf) (Export PDF)

---

## 📂 Installation et configuration

1️⃣ Cloner le projet
```bash
git clone https://github.com/EbroVital/stage_app.git
cd stage_app

2️⃣ Installer les dépendances
composer install
npm install && npm run build

3️⃣ Configurer l’environnement
cp .env.example .env

Puis modifier les paramètres :

APP_NAME="StageApp"
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stageapp
DB_USERNAME=root
DB_PASSWORD=

4️⃣ Générer la clé et migrer la base
php artisan key:generate
php artisan migrate --seed

5️⃣ Lancer le serveur
php artisan serve

Accéder à l’application : 👉 http://localhost:8000






