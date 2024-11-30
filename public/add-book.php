<?php
  require_once __DIR__ . "/includes/header.php";
  require_once __DIR__ . "/src/db/pdo.php";
  require_once __DIR__ . "/src/functions/book.php";
  require_once __DIR__ . "/src/functions/genre.php";
  require_once __DIR__ . "/src/functions/uploadImage.php";

  if($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'employe') {
    header('location: index.php');
    exit;
  }

    if(isset($_POST['addBook'])) {

  $image = handleImageUpload($_FILES['image']);

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

  if(!empty($titre) && !empty($auteur) && !empty($genre) && !empty($format) && !empty($editeur) && !empty($description)  && !empty($stock) && !empty($prix) && !empty($pages) && $image !== null) {
    $message = addBook($pdo, $titre, $auteur, $genre, $format, $editeur, $description, $stock, $prix, $pages, $date_publication, $image);
  } else {
      $message = "Veuillez remplir tous les champs, y compris la photo.";
  }
}

$genres = getAllGenres($pdo);
?>


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
            <label for="description">Description</label>
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
              <?php foreach ($genres as $genre): ?>
                        <option value="<?= $genre['id'] ?>">
                            <?= htmlspecialchars($genre['genre']) ?>
                        </option>
                    <?php endforeach; ?>
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
 
    <?php 
      require_once __DIR__ . "/includes/footer.php";
    ?>