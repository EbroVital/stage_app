# Gestion des avis et des délibérations

Application web de gestion de documents administratifs. Elle permet de centraliser les avis et les délibérations, leurs articles, les références juridiques associées et les signataires, puis de produire les documents au format PDF.

## Fonctionnalités

- Créer, consulter, modifier et supprimer des avis et des délibérations.
- Numéroter les avis et les délibérations selon l’année budgétaire.
- Gérer les articles liés aux avis et aux délibérations.
- Gérer les références juridiques et les associer aux documents.
- Gérer les élus et les signataires.
- Générer et télécharger les avis et délibérations en PDF.
- Accéder au tableau de bord et au profil utilisateur après authentification.

Les fonctionnalités de gestion sont accessibles aux utilisateurs connectés.

## Technologies

- PHP 8.2 ou supérieur et Laravel 10
- MySQL
- Vite, Tailwind CSS
- Dompdf pour la génération des PDF

## Prérequis

- PHP 8.2 ou supérieur, avec les extensions requises par Laravel, notamment `bcmath` et `intl`.
- Composer
- Node.js et npm
- Un serveur MySQL (Laragon convient pour un environnement local sous Windows).

## Installation

Depuis le répertoire du projet :

1. Installer les dépendances PHP :

	```bash
	composer install
	```

2. Créer le fichier d’environnement. Sous Windows :

	```powershell
	Copy-Item .env.example .env
	```

	Sous macOS ou Linux :

	```bash
	cp .env.example .env
	```

3. Dans `.env`, renseigner `APP_URL` et les paramètres de connexion MySQL (`DB_DATABASE`, `DB_USERNAME` et `DB_PASSWORD`). Créer au préalable la base de données indiquée.

4. Générer la clé de l’application et créer les tables :

	```bash
	php artisan key:generate
	php artisan migrate
	```

5. Installer les dépendances front-end et compiler les ressources :

	```bash
	npm install
	npm run build
	```

6. Démarrer le serveur de développement Laravel :

	```bash
	php artisan serve
	```

	Ouvrir ensuite l’adresse affichée par Artisan, généralement `http://127.0.0.1:8000`.

Pour développer les ressources front-end avec rechargement automatique, lancer `npm run dev` dans un terminal séparé.

## Tests

Lancer la suite de tests Laravel avec :

```bash
php artisan test
```

## Structure du projet

- `app/Models` : modèles de l’application (avis, délibérations, articles, références juridiques, signataires et autres).
- `app/Http/Controllers` : logique des pages et des opérations de gestion.
- `database/migrations` : structure de la base de données.
- `resources/views` : vues Blade.
- `routes/web.php` : routes de l’application web.

----

## Compte pour le test
Email : admin@test.com
Password : password

## Capture d'écran
<img width="1366" height="768" alt="CONNEXION" src="https://github.com/user-attachments/assets/9ad0c0b4-919c-4c1d-88d6-6e2f4d17c3f7" />
<img width="1366" height="768" alt="TB" src="https://github.com/user-attachments/assets/d9c5486e-15cd-40ec-9e81-7c255edef24c" />
<img width="1366" height="768" alt="avis" src="https://github.com/user-attachments/assets/a70bfed9-a824-416f-8dff-acbf6c236445" />
<img width="1366" height="768" alt="delib" src="https://github.com/user-attachments/assets/5f7619e4-e57b-4219-a80a-9dfc776fbdfe" />
<img width="1366" height="768" alt="pdf" src="https://github.com/user-attachments/assets/712ba34f-b651-4c85-b6f0-a440d3cca7e4" />



