<?php
session_start();
include 'config.php';

// Initialiser les variables pour les messages d'erreur
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);

    // Requête préparée pour récupérer les informations de l'utilisateur
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR name = ?");
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Vérifier si le compte est verrouillé
        if ($user['lock_until'] && new DateTime() < new DateTime($user['lock_until'])) {
            $error = "Compte verrouillé. Réessayez plus tard.";
        } else {
            // Vérifier si le mot de passe est correct
            if (password_verify($password, $user['password'])) {
                // Réinitialiser les tentatives échouées et le verrouillage
                $stmt = $conn->prepare("UPDATE users SET failed_attempts = 0, lock_until = NULL WHERE email = ? OR name = ?");
                $stmt->bind_param("ss", $login, $login);
                $stmt->execute();

                // Création de la session utilisateur
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role']; // Ajouter le rôle dans la session

                // Redirection selon le rôle de l'utilisateur
                if ($user['role'] === 'admin') {
                    header("Location: index.php");
                } else {
                    header("Location: user_dashboard.php");
                }
                exit;
            } else {
                // Augmenter le nombre de tentatives échouées
                $failedAttempts = $user['failed_attempts'] + 1;
                $lockUntil = null;
                if ($failedAttempts >= 5) {
                    $lockUntil = (new DateTime())->modify('+10 minutes')->format('Y-m-d H:i:s');
                }
                $stmt = $conn->prepare("UPDATE users SET failed_attempts = ?, last_attempt = NOW(), lock_until = ? WHERE email = ? OR name = ?");
                $stmt->bind_param("isss", $failedAttempts, $lockUntil, $login, $login);
                $stmt->execute();

                $error = "Email ou mot de passe incorrect.";
            }
        }
    } else {
        $error = "Email ou mot de passe incorrect.";
    }

    // Fermer la requête préparée
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion utilisateur</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1 class="text-center">Connexion</h1>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="login">Nom ou Email :</label>
                <input type="text" class="form-control" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
        </form>
        <p class="text-center mt-3">Vous n'avez pas de compte ? <a href="register.php">Créer un compte</a></p>
    </div>
    <!-- Inclure Bootstrap JS et dépendances -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
