<?php
session_start();
include 'config.php';

// Vérifier si l'utilisateur est connecté et s'il a le rôle d'administrateur
if (!isset($_SESSION['loggedin']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

// Supprimer l'utilisateur
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    header("Location: admin_panel.php");
    exit;
} else {
    // Optionnel : Gérer l'erreur si la suppression échoue
    echo "Erreur lors de la suppression de l'utilisateur.";
}
$stmt->close();
?>
