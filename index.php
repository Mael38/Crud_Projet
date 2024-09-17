<?php
session_start();

// Vérifier si l'utilisateur est connecté et s'il est administrateur
if (!isset($_SESSION['loggedin']) || $_SESSION['user_name'] !== 'mael') {
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
        }
        .welcome-header {
            color: #343a40;
        }
        .admin-button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="welcome-header">Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?> !</h1>
        <p>Ceci est la page d'accueil.</p>

        <?php if ($_SESSION['user_name'] === 'mael'): ?>
            <!-- Bouton Admin visible uniquement pour l'administrateur -->
            <a href="admin_panel.php" class="btn btn-primary admin-button">Panel Admin</a>
        <?php endif; ?>

        <a href="logout.php" class="btn btn-secondary mt-3">Se déconnecter</a>
    </div>

    <!-- Inclure Bootstrap JS et dépendances -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
