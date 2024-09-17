<?php
session_start();
include 'config.php';

// Vérifier si l'utilisateur est administrateur
if (!isset($_SESSION['loggedin']) || $_SESSION['user_name'] !== 'mael') {
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
}
$stmt->close();
?>
