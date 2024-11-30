<?php
    require_once __DIR__ . "/includes/header.php";
    require_once __DIR__ . "/src/db/pdo.php";
    require_once __DIR__ . "/src/functions/book.php";


    // Vérifiez que l'ID est valide
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    // Si aucun ID valide n'est fourni, redirigez
    header('Location: index.php');
    exit;
}

$book = getBookById($pdo,$id);
   
?>
    <section class="container-detail">
      <div class="livre">
        <div class="cover">
        <?php if (!empty($book['image'])): ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($book['image']); ?>" alt="Photo de <?= htmlspecialchars($book['titre']); ?>" />
                <?php else: ?>
                    <img src="./assets/images/la_femme_de_menage.png" alt="Image par défaut" />
                <?php endif; ?>
        </div>        </div>
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
            <p>Genre : <?= htmlspecialchars($book['genre_nom'] ?? 'Inconnu'); ?></p> <!-- Affichage du genre -->
            <p>Format : <?= htmlspecialchars($book['format']); ?></p>
              <p>Editeur : <?= htmlspecialchars($book['editeur']); ?></p>
              <p>Parution : <?= htmlspecialchars($book['date_publication']); ?></p>
              <p>Pages : <?= htmlspecialchars($book['pages']); ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="purchase">
        <p><?= htmlspecialchars($book['prix']); ?>€</p>
        <button class="button-form">
              <img src="./assets/images/cart.png" alt="Panier" />
            </button>
      </div>
    </section>
    <?php 
            require_once __DIR__ . "/includes/footer.php";
        ?>