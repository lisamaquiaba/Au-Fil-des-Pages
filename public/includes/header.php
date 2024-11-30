<?php 
    require_once __DIR__ . "/../src/session.php";

?>
<!DOCTYPE html>
<html lang="fr">w
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Au Fil des Pages</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Lora:ital,wght@0,400..700;1,400..700&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./assets/css/style.css" />
  </head>
  <body>
    <header class="topbar">
      <nav class="navbar">
        <div class="logo">
          <a href="index.php">
            <img
              src="./assets/images/logo.png"
              alt="Logo de Au Fil des Pages"
              width="80px"
              height="64px"
            />
          </a>
        </div>
        <div class="wrapper-link">
          <a href="index.php" class="nav-link">Accueil</a>
          <a href="bibliotheque.php" class="nav-link">Bibliothèque</a>
          <a href="club.php" class="nav-link">Club de Lecture</a>
          <a href="contact.php" class="nav-link">Nous contacter</a>
          <?php if (isset($_SESSION['user'])) { ?>
            <a class="nav-link" href="profile.php?id=<?= htmlspecialchars($_SESSION['user']['id']); ?>"><?= htmlspecialchars(string: $_SESSION['user']['prenom']) ?></a>

            <a href="logout.php" class="button1">Déconnexion</a>
          <?php } else { ?>
            <a href="login.php" class="button1">Connexion</a>
            <a href="sign-up.php" class="button1">S'inscrire</a>
          <?php } ?>
        </div>

        <div class="nav-mobile">
        <a href="index.php" class="nav-link">Accueil</a>
          <a href="bibliotheque.php" class="nav-link">Bibliothèque</a>
          <a href="club.php" class="nav-link">Club de Lecture</a>
          <a href="contact.php" class="nav-link">Nous contacter</a>
          <?php if (isset($_SESSION['user'])) { ?>
            <a class="nav-link" href="profile.php?id=<?= htmlspecialchars($_SESSION['user']['id']); ?>"><?= htmlspecialchars(string: $_SESSION['user']['prenom']) ?></a>

            <a href="logout.php" class="button1">Déconnexion</a>
          <?php } else { ?>
            <a href="login.php" class="button1">Connexion</a>
            <a href="sign-up.php" class="button1">S'inscrire</a>
          <?php } ?>

        </div>

        <span class="nav-toggle"><img src="./assets/images/list.png" alt="" /></span>
      </nav>
    </header> 