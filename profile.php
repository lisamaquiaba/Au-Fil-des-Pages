<?php 
  require_once __DIR__ . "/lib/pdo.php";
  require_once __DIR__ . "/lib/user.php";
  require_once __DIR__ . "/lib/session.php";

//  session_start();

  $isAdminOnly = false;
  $isEmploye = false;
  $isClient = false;

  if(isset($_GET['id'])) { 
    $id = intval($_GET['id']);
  }

  $user = getUserById($pdo, $id);

  if($_SESSION['user']['id'] !== $id) {
    header('location: index.php');
    exit;
  }

  // var_dump($_SESSION);
   if($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'employe' && $_SESSION['user']['role'] !== 'client') {
       header('location: index.php');
       exit;
   }

  if (isset($user['role']) && $user['role'] === 'admin' ) {
      $isAdminOnly = true;
  }

  if (isset($user['role']) && $user['role'] === 'client') {
      $isClient = true;
  }

  if (isset($user['role']) && $user['role'] === 'employe') {
      $isEmploye = true;
  }
?>

<!DOCTYPE html>
<html lang="fr">
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
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header class="topbar">
      <nav class="navbar">
        <div class="logo">
          <a href="index.html">
            <img
              src="img/logo.png"
              alt="Logo de Au Fil des Pages"
              width="80px"
              height="64px"
            />
          </a>
        </div>
        <div class="wrapper-link">
          <a href="index.html" class="nav-link">Accueil</a>
          <a href="bibliotheque.html" class="nav-link">Bibliothèque</a>
          <a href="club.html" class="nav-link">Club de Lecture</a>
          <a href="contact.html" class="nav-link">Nous contacter</a>
          <?php if (isset($_SESSION['user'])) { ?>
            <a href="logout.php" class="button1">Déconnexion</a>
          <?php } else { ?>
            <a href="login.php" class="button1">Connexion</a>
          <?php } ?>
          <a href="sign-up.html" class="button1">S'inscrire</a>
          <!-- <button href="login.html" class="button1">Connexion</button>
          <button class="button2">S'inscrire</button> -->
        </div>
      </nav>
    </header>
    <div class="wrapper-user-connected">
    <?php if ($isClient): ?>
      <h2>Bienvenue <?= htmlspecialchars($user['prenom']) ?> !</h2>
      <div class="user-link">
        <a href="commande.html">Mes Commandes</a>
        <a href="cart.html">Mon Panier</a>
        <a href="info.html">Mes Informations</a>
        <?php endif; ?>

        <?php if ($isAdminOnly): ?>
          <h1>Bonjour <?= htmlspecialchars($user['prenom']) ?> !</h1>
          <div class="user-link">
          <a href="add-book.php">Ajouter un livre</a>
          <a href="edit-book.html">Modifier / Supprimer un livre</a>
          <a href="addUser.php">Créer un compte</a>
        <?php endif; ?>

        <?php if ($isEmploye): ?>
          <h2>Bonjour <?= htmlspecialchars($user['prenom']) ?> !</h2>
          <div class="user-link">
          <a href="add-book.php">Ajouter un livre</a>
          <a href="edit-book.html">Modifier / Supprimer un livre</a>

        <?php endif; ?>

      </div>
    </div>
    <div class="footer">
      <div class="logo-footer">
        <img
          src="img/logo.png"
          alt="Logo de Au Fil des Pages"
          width="100"
          height="100"
        />
      </div>
      <div class="horaires">
        <h2>Nos Horaires</h2>
        <p>Du Lundi au vendredi : de 9h30 à 19h</p>
        <p>Samedi : de 10h à 18h</p>
      </div>
      <div class="link">
        <h3>Liens rapides</h3>
        <a href="index.html"><p>Accueil</p></a>
        <a href="bibliotheque.html"><p>Bibliothèque</p></a>
        <a href="club.html"><p>Club de Lecture</p></a>
        <a href="contact.html"><p>Nous Contacter</p></a>
      </div>
      <div class="social">
        <h3>Rejoignez-nous sur :</h3>
        <a href="https://www.tiktok.com/"
          ><img src="img/tiktok.png" alt="Logo TikTok"
        /></a>
        <a href="https://www.instagram.com/"
          ><img src="img/instagram.png" alt="Logo Instagram"
        /></a>
        <a href="https://www.youtube.com/"
          ><img src="img/youtube.png" alt="Logo Youtube"
        /></a>
      </div>
      <div class="copyright">
        <img src="img/copyright.png" alt="" width="15" height="15" />
        <p>Au fil des Pages - Tous droits réservés</p>
      </div>
    </div>
  </body>
</html>
