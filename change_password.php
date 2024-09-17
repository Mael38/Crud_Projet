<?php
session_start();
include 'config.php'; // Inclure la connexion à la base de données

// Vérifier si l'utilisateur est connecté et s'il a le rôle d'administrateur
if (!isset($_SESSION['loggedin']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];
    $newPassword = $_POST['password'];

    // Hash le nouveau mot de passe
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Met à jour le mot de passe dans la base de données
    $sql = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $hashedPassword, $userId);

    if ($stmt->execute()) {
        $message = "Mot de passe mis à jour avec succès.";
    } else {
        $message = "Erreur lors de la mise à jour du mot de passe.";
    }
    $stmt->close();
} else {
    $userId = $_GET['id'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer le mot de passe</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Changer le mot de passe</h1>

        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form action="change_password.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($userId); ?>">
            <div class="form-group">
                <label for="password">Nouveau mot de passe :</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Changer le mot de passe</button>
        </form>

        <a href="admin_panel.php" class="btn btn-secondary btn-block mt-3">Retour à la gestion des utilisateurs</a>
    </div>

    <!-- Inclure Bootstrap JS et dépendances -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
