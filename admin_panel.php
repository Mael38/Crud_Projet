<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include 'config.php';

// Récupérer tous les utilisateurs de la base de données
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .table th, .table td {
            text-align: center;
        }
        .btn-custom {
            margin-top: 10px;
        }
        .btn-custom:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Gestion des utilisateurs</h1>

        <!-- Table des utilisateurs -->
        <form action="update_roles.php" method="POST">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td>
                            <input type="checkbox" name="admin_users[]" value="<?php echo htmlspecialchars($row['id']); ?>" <?php echo $row['role'] === 'admin' ? 'checked' : ''; ?>>
                        </td>
                        <td>
                            <a href="edit_user.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="delete_user.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                            <a href="change_password.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-info btn-sm">Changer le mot de passe</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- Lien vers la page d'ajout d'utilisateur -->
            <a href="add_user.php" class="btn btn-primary btn-custom">Ajouter un utilisateur</a>

            <a href="index.php" class="btn btn-secondary btn-custom">Retour à l'accueil</a>

            <button type="submit" class="btn btn-success btn-custom">Mettre à jour les rôles</button>
        </form>
    </div>

    <!-- Inclure Bootstrap JS et dépendances -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
