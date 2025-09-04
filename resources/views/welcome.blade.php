<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Gestion des Avis & Délibérations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Lien CDN Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(135deg, #4b6cb7, #6777EF);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
            backdrop-filter: blur(5px);
        }
        .btn-outline-light:hover {
            color: #182848;
            background-color: #fff;
            border-color: #fff;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="card p-5 rounded-4 shadow-lg">
            <h1 class="mb-4 fw-bold">Bienvenu(e)</h1>
            <p class="mb-4 fs-5">Application de gestion automatisée des <strong>avis</strong> et <strong>délibérations</strong></p>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4">Se connecter</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">S'inscrire</a>
            </div>
        </div>
    </div>

    <!-- JS Bootstrap (facultatif ici) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


{{-- @if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
    </div>
@endif --}}
