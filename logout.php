<?php
session_start();
session_destroy();  // Détruire toutes les données de session
header("Location: login.php");
exit;
?>
