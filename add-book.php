<?php
  require_once __DIR__ . "/lib/pdo.php";
  require_once __DIR__ . "/lib/session.php";
  require_once __DIR__ . "/lib/book.php";
  require_once __DIR__ . "/lib/image.php";

    if(isset($_POST['addBook'])) {
//   var_dump("ok");

  $image = handleImageUpload($_FILES['image']);
  // var_dump($_FILES['image']);

  $titre = $_POST['titre'] ?? ''; 
  $auteur = $_POST['auteur'] ?? ''; 
  $genre = $_POST['genre'] ?? ''; 
  $format = $_POST['format'] ?? ''; 
  $editeur = $_POST['editeur'] ?? ''; 
  $description = $_POST['description'] ?? ''; 
  $pages = ($_POST['pages']); 
  $prix = ($_POST['prix']); 
  $stock = ($_POST['stock']); 
  $date_publication = ($_POST['publication']);

  if(!empty($titre) && !empty($auteur) && !empty($genre) && !empty($format) && !empty($editeur) && !empty($description)  && !empty($stock) && !empty($prix) && !empty($pages)) {
    $message = addBook($pdo, $titre, $auteur, $genre, $format, $editeur, $description, $stock, $prix, $pages, $date_publication, $image);
  } else {
      $message = "Veuillez remplir tous les champs, y compris la photo.";
  }
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
          <a href="login.html" class="button1">Connexion</a>
          <a href="sign-up.html" class="button1">S'inscrire</a>
          <!-- <button href="login.html" class="button1">Connexion</button>
          <button class="button2">S'inscrire</button> -->
        </div>
      </nav>
    </header>
    <section class="wrapper-add-book">
      <div>
        <h1>Ajouter un livre</h1>
      </div>
      <div class="form-add-book">
        <form method="post" class="" enctype="multipart/form-data">
          <div class="form-example">
            <label for="titre">Titre du livre</label>
            <input type="text" name="titre" id="titre" required />
          </div>
          <div class="form-example">
            <label for="auteur">Auteur</label>
            <input type="text" name="auteur" id="auteur" required />
          </div>
          <div class="form-example">
            <label for="description">Synopsis</label>
             <div>
             <textarea class="message" name="description" id="description" required></textarea>
             </div>
          </div>
          <div class="form-example">
            <label for="format">Format</label>
            <input type="text" name="format" id="format" required />
          </div>
          <div class="menu-genre">
            <select name="genre" id="select-genre">
              <option value="default-value">
                --- Sélectionnez un Genre ---
              </option>
              <option value="1">Romance</option>
              <option value="2">New-Romance</option>
              <option value="3">Fantasy</option>
              <option value="4">Polar</option>
            </select>
          </div>
          <div class="form-example">
            <label for="editeur">Editeur</label>
            <input type="text" name="editeur" id="editeur" required />
          </div>
          <div class="form-example">
            <label for="pages">Nombre de pages</label>
            <input type="number" name="pages" id="pages" required />
          </div>
          <div class="form-example">
            <label for="prix">Prix</label>
            <input type="number" name="prix" id="prix" required />
          </div>
          <div class="form-example">
            <label for="stock">Stock</label>
            <input type="text" name="stock" id="stock" required />
          </div>
          <div class="form-example">
            <label for="publication">Date de publication</label>
            <input
              type="date"
              name="publication"
              id="publication"
              required
            />
          </div>
          <div class="form-example">
            <label for="image">Couverture</label>
            <input type="file" name="image" accept="image/*">
          </div>
          <div class="middle">
            <button type="submit" name="addBook" class="button-form">
              Ajouter un livre
            </button>
          </div>
          <?php if (isset($message)): ?>
              <p class="error"><?= htmlspecialchars($message); ?></p>
              <?php endif; ?>
        </form>
      </div>
    </section>
 
    <?php require_once __DIR__. "/templates/footer.php" ?>