<?php
session_start();
include 'config.php';

// Vérifier si l'utilisateur est connecté et s'il a le rôle d'administrateur
if (!isset($_SESSION['loggedin']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Ajouter l'utilisateur
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
    $stmt->bind_param("sss", $name, $email, $password);
    if ($stmt->execute()) {
        header("Location: admin_panel.php");
        exit;
    } else {
        // Optionnel : Gérer l'erreur si l'ajout échoue
        echo "Erreur lors de l'ajout de l'utilisateur.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
        }
        .btn-custom {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Ajouter un utilisateur</h1>

        <form action="add_user.php" method="POST">
            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-custom">Ajouter</button>
        </form>

        <a href="admin_panel.php" class="btn btn-secondary btn-block mt-3">Retour à la gestion des utilisateurs</a>
    </div>

    <!-- Inclure Bootstrap JS et dépendances ici -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
