<?php
  require_once __DIR__ . "/lib/session.php";
    // PREVIENT LES ATTAQUES DE FIXATION DE SESSION
  session_regenerate_id(true);

//  SUPPRIME LES DONNEES DU SERVEUR
  session_destroy();

//   SUPPRIME LES DONNEES DU TABLEAU $_SESSION
  unset($_SESSION);

  header('location: login.php');
