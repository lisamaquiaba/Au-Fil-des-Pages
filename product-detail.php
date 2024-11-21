<?php
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/user.php";
require_once __DIR__ . "/lib/session.php";
require_once __DIR__ . "/lib/book.php";

if(isset($_GET['id'])) { 
  $id = intval($_GET['id']);
}

$book = getBookById($pdo, $id);
// var_dump($book)
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
          <a href="bibliotheque.html" class="active nav-link">Bibliothèque</a>
          <a href="club.html" class="nav-link">Club de Lecture</a>
          <a href="contact.html" class="nav-link">Nous contacter</a>
          <a href="login.html" class="button1">Connexion</a>
          <a href="sign-up.html" class="button1">S'inscrire</a>
          <!-- <button href="html" class="button1">Connexion</button>
          <button class="button2">S'inscrire</button> -->
        </div>
      </nav>
    </header>
    <section class="container-detail">
      <div class="livre">
        <div class="cover">
        <?php if (!empty($book['picture'])): ?>
                    <!-- Affichage de l'image en base64 -->
                    <img class="img-res" src="data:image/jpeg;base64,<?= base64_encode($book['picture']); ?>" alt="Photo de <?= htmlspecialchars($book['titre']); ?>" />
                <?php else: ?>
                    <!-- Image par défaut si aucune image n'est disponible dans la base de données -->
                    <img class="" src="img/la_femme_de_menage.png" alt="Image par défaut" />
                <?php endif; ?>
        </div>
        <div class="wrapper-product">
          <div class="author">
            <h4><?= htmlspecialchars($book['auteur']); ?></h4>
            <h2><?= htmlspecialchars($book['titre']); ?></h2>
          </div>
          <div class="aside">
            <div class="synopsis">
            <?= htmlspecialchars($book['description']); ?>
            </div>
            <div class="caracteristic">
              <p>Genre : </p>
              <p>Format : <?= htmlspecialchars($book['format']); ?></p>
              <p>Editeur : <?= htmlspecialchars($book['editeur']); ?></p>
              <p>Paru : <?= htmlspecialchars($book['date_publication']); ?></p>
              <p>Pages : <?= htmlspecialchars($book['pages']); ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="purchase">
        <p><?= htmlspecialchars($book['prix']); ?></p>
        <button class="button-form">
          <img src="img/cart.png" alt="Panier" />
        </button>
      </div>
    </section>
    
    <?php require_once __DIR__. "/templates/footer.php" ?>