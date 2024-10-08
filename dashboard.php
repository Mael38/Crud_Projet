<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>
    <h1>Bienvenue, <?php echo $_SESSION['user_name']; ?> !</h1>
    <p>Ceci est une page sécurisée.</p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
