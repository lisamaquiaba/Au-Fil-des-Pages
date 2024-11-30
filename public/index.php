
    <?php 
        require_once __DIR__ . "/includes/header.php";
        require_once __DIR__ . "/src/db/pdo.php";
        require_once __DIR__ . "/src/functions/book.php";
        require_once __DIR__ . "/src/functions/genre.php";

        $listBooks = getBestSeller(pdo: $pdo);
        $listGenres = getAllGenres($pdo);

    ?>
    <section class="wrapper">
      <div class="text">
        <h1>Bienvenue chez Au Fil des Pages</h1>
        <p class="test2">
          La propriétaire, Lisa et ses employés vous invite chez Au fil des
          Pages; une librairie pour tout les passionnés de lecture de tout
          horizons. Dans une ambiance calme et cosy, venez découvrir nos
          nouveautés. Que vous vous présentiez à notre librairie ou sur notre
          site internet; romans, bandes dessinés, mangas, essais et bien plus
          encore vous attend! Au fil des Pages vous propose également un "Coin
          Café", une pièce cosy et cocooning, parfaite pour vous détendre devant
          un bon livre et une bonne boisson. Sur le site internet de la
          librairie, vous avez la possibilité de passer commande et vérifié la
          disponibilité de nos produits.
        </p>
      </div>
      <div class="illu">
        <img
          src="./assets/images/library.png"
          alt="Illustration de la librairie Au fil des Pages"
          width="400"
        />
      </div>
    </section>
    <section class="wrapper-bestseller">
      
      <p>Nos Best seller du mois</p>
      <div class="bestseller">
      <?php foreach ($listBooks as $book): ?>
        <a class="more" href="product-detail.php?id=<?=$book['livre_id'] ?>"> 

      <div class="img-bestseller">
        <?php if (!empty($book['image'])): ?>
                    <img class="img-res" src="data:image/jpeg;base64,<?= base64_encode($book['image']); ?>" alt="Photo de <?= htmlspecialchars($book['titre']); ?>" />
                <?php else: ?>
                    <img class="" src="./assets/images/la_femme_de_menage.png" alt="Image par défaut" />
                <?php endif; ?>
        </div>
        </a>
        <?php endforeach; ?> 
      </div>
    </section>
    <section>
      <p>Nos Livres par catégories</p>
      <div class="wrapper-categories">
        <?php foreach ($listGenres as $genre): ?>
          <div class="categories">
          <a href="bibliotheque.php?genre=<?= htmlspecialchars($genre['id']); ?>"><?= htmlspecialchars($genre['genre']); ?></a>
          </div>
          <?php endforeach; ?> 
      </div>
    </section>
    <?php 
        require_once __DIR__ . "/includes/footer.php";
    ?>
  </body>
</html>
