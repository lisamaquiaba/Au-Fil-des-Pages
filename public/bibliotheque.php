<?php
    require_once __DIR__ . "/includes/header.php";
    require_once __DIR__ . "/src/db/pdo.php";
    require_once __DIR__ . "/src/functions/book.php";
    require_once __DIR__ . "/src/functions/genre.php";

    $isAdminOnly = false;
    $listBooks = [];


    if (!empty($_GET["search"]) || !empty($_GET["genre"])) {
      $search = !empty($_GET["search"]) ? trim($_GET["search"]) : null;
      $genre = !empty($_GET["genre"]) ? (int) $_GET["genre"] : null;
      $listBooks = getFilterBooks($pdo, $search, $genre);
  
  } else {
      $listBooks = getBooks(pdo: $pdo);
  }

  $genres = getAllGenres($pdo)



?>

    <section class="wrapper-recherche">
      <form method="get">
      <div class="menu-genre">
        <select name="genre" id="select-genre">
          <option class="default-value" value="">
            --- Sélectionnez un Genre ---
          </option>
          <?php foreach ($genres as $genre): ?>
                        <option value="<?= $genre['id'] ?>">
                            <?= htmlspecialchars($genre['genre']) ?>
                        </option>
                    <?php endforeach; ?>
        </select>
      </div>
      <div class="recherche">
        <input type="search" name="search" placeholder="Recherche" />
      </div>
      <div class="middle">
        <button class="button1" type="submit">Rechercher</button>
      </div>
      </form>
    </section>
      <div class="container">
        <section class="wrapper-preview">
    <?php foreach ($listBooks as $book): ?>
      <div class='card-book'>
        <div>
        <?php if (!empty($book['image'])): ?>
          <img class="img-res" src="data:image/jpeg;base64,<?= base64_encode($book['image']); ?>" alt="Photo de <?= htmlspecialchars($book['titre']); ?>" />

<?php else: ?>
    <img class="" src="./assets/images/default_cover.png" alt="Image par défaut" />
<?php endif; ?>
        </div>
        <div>
          <div class="book">
            <h3><?= htmlspecialchars($book['titre']); ?></h3>
            <a class="more" href="product-detail.php?id=<?=$book['livre_id'] ?>">Voir plus</a>
            <div class="description-book">
            <p>Genre : <?= htmlspecialchars($book['genre_nom'] ?? 'Inconnu'); ?></p> <!-- Affichage du genre -->
            <p>Format : <?= htmlspecialchars($book['format']); ?></p>
              <p>Editeur : <?= htmlspecialchars($book['editeur']); ?></p>
              <p>Parution : <?= htmlspecialchars($book['date_publication']); ?></p>
              <p>Pages : <?= htmlspecialchars($book['pages']); ?></p>
            </div>
          </div>
          <div class="purchase">
            <p><?= htmlspecialchars($book['prix']); ?>€</p>
            <button class="button-form">
              <img src="./assets/images/cart.png" alt="Panier" />
            </button>
          </div>
        </div>
        </div>
        <?php endforeach; ?> 
      </section>
        </div>
        
        <?php 
            require_once __DIR__ . "/includes/footer.php";
        ?>