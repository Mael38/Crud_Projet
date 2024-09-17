<?php
include 'config.php'; // Inclure la connexion à la base de données

session_start();

// Vérifier si l'utilisateur est connecté et s'il est administrateur
if (!isset($_SESSION['loggedin']) || $_SESSION['user_name'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 800px;
        }
        .welcome-header {
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }
        .welcome-message {
            font-size: 1.2rem;
            text-align: center;
            margin-bottom: 40px;
        }
        .btn-custom {
            margin-top: 20px;
        }
        .btn-custom:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="welcome-header">Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?> !</h1>
        <p class="welcome-message">Ceci est la page d'accueil.</p>

        <a href="admin_panel.php" class="btn btn-primary btn-custom btn-block">Accéder au Panel Admin</a>

        <a href="logout.php" class="btn btn-secondary btn-block mt-3">Se déconnecter</a>
    </div>

    <!-- Inclure Bootstrap JS et dépendances -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
