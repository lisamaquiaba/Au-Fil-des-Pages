<?php
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/session.php";
    require_once __DIR__ . "/lib/book.php";

    $isAdminOnly = false;

    if(!empty($_GET["search"])) {
      $search = $_GET["search"];
      $query = $pdo->prepare('SELECT * FROM livre WHERE titre LIKE :search'); 
      $query->execute(["search" => '%' . $search . '%']);
      $listBooks = $query->fetchAll(PDO::FETCH_ASSOC);   

      // $genre = $_GET["genre"];
      // $query = $pdo->prepare('SELECT * FROM livre WHERE id_genre = :genre'); 
      // $query->execute(["genre" => $genre]);
      // $listBooks = $query->fetchAll(PDO::FETCH_ASSOC);   
      } else {
        $listBooks = getBooks($pdo);
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
          <a href="bibliotheque.html" class="active nav-link">Bibliothèque</a>
          <a href="club.html" class="nav-link">Club de Lecture</a>
          <a href="contact.html" class="nav-link">Nous contacter</a>
          <a href="login.html" class="button1">Connexion</a>
          <a href="sign-up.html" class="button1">S'inscrire</a>
          <!-- <button href="login.html" class="button1">Connexion</button>
          <button class="button2">S'inscrire</button> -->
        </div>
      </nav>
    </header>
    <section class="wrapper-recherche">
      <form method="get">
      <div class="menu-genre">
        <select name="genre" id="select-genre">
          <option class="default-value" value="">
            --- Sélectionnez un Genre ---
          </option>
          <option value="1">Romance</option>
          <option value="2">New-Romance</option>
          <option value="3">Fantasy</option>
          <option value="4">Polar</option>
        </select>
      </div>
      <div class="recherche">
        <input type="search" name="search" placeholder="Recherche" />
      </div>
      <button class="button1" type="submit">Rechercher</button>
      </form>
    </section>
      <div class="container">
    <?php foreach ($listBooks as $book): ?>
      <section class="wrapper-preview">
        <div>
        <?php if (!empty($book['picture'])): ?>
                    <!-- Affichage de l'image en base64 -->
                    <img class="img-res" src="data:image/jpeg;base64,<?= base64_encode($book['picture']); ?>" alt="Photo de <?= htmlspecialchars($book['titre']); ?>" />
                <?php else: ?>
                    <!-- Image par défaut si aucune image n'est disponible dans la base de données -->
                    <img class="" src="img/la_femme_de_menage.png" alt="Image par défaut" />
                <?php endif; ?>
        </div>
        <div>
          <div class="book">
            <h3><?= htmlspecialchars($book['titre']); ?></h3>
            <a class="more" href="product-detail.php?id=<?=$book['livre_id'] ?>">Voir plus</a>
            <!-- <a href="animal.php?id=<?=$animal['animal_id'] ?>" class="btn btn-primary"> -->
            <div class="description-book">
              <p>Genre : </p>
              <p>Format : <?= htmlspecialchars($book['format']); ?></p>
              <p>Editeur : <?= htmlspecialchars($book['editeur']); ?></p>
              <p>Parution : <?= htmlspecialchars($book['date_publication']); ?></p>
              <p>Pages : <?= htmlspecialchars($book['pages']); ?></p>
            </div>
          </div>
          <div class="purchase">
            <p><?= htmlspecialchars($book['prix']); ?>€</p>
            <button class="button-form">
              <img src="img/cart.png" alt="Panier" />
            </button>
          </div>
        </div>
      </section>

        <?php endforeach; ?> 
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
