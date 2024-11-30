<?php
// Assurez-vous que la session est démarrée
session_start();

// Supprimer toutes les variables de session
$_SESSION = [];

// Détruire la session sur le serveur
session_destroy();

// Rediriger vers la page de connexion
header("Location: login.php");
exit;