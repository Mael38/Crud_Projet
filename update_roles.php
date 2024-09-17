<?php
session_start();
include 'config.php';

// Vérifier si l'utilisateur est connecté et s'il est administrateur
if (!isset($_SESSION['loggedin']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Récupérer les IDs des utilisateurs qui doivent être administrateurs
$adminUserIds = isset($_POST['admin_users']) ? $_POST['admin_users'] : [];

// Mettre à jour le rôle de tous les utilisateurs
// Assigner 'admin' aux utilisateurs sélectionnés et 'user' aux autres
$sql = "UPDATE users SET role = 'user'";
$conn->query($sql); // Réinitialiser tous les rôles à 'user'

if (!empty($adminUserIds)) {
    $sql = "UPDATE users SET role = 'admin' WHERE id IN (" . implode(',', array_map('intval', $adminUserIds)) . ")";
    $conn->query($sql);
}

header("Location: admin_panel.php");
exit;
?>
