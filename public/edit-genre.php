<?php
  require_once __DIR__ . "/includes/header.php";
  require_once __DIR__ . "/src/db/pdo.php";
  require_once __DIR__ . "/src/functions/genre.php";

  // Vérification de l'utilisateur admin ou employé
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'employe')) {
    header('Location: login.php');
    exit;
}

// Initialisation des variables
$genres = getAllGenres($pdo);
$selectedGenre = null;
$message = "";

// Si un genre est sélectionné
if (isset($_POST['selectGenre']) && is_numeric($_POST['id'])) {
    $selectedGenre = getGenreById($pdo, intval($_POST['id']));
}

// Si un genre est modifié
if (isset($_POST['updateGenre'])) {
    $genreId = intval($_POST['id']);
    $genre = htmlspecialchars($_POST['genre']);
    $message = updateGenre($pdo, $genre, $genreId);
}

// Si un genre est supprimé
if (isset($_POST['deleteGenre'])) {
    $genreId = intval($_POST['id']);
    $message = deleteGenre($pdo, $genreId);
}
?>


<section class="wrapper-add-book">
    <div>
        <h1>Gérer les Genres</h1>
    </div>
    <?php if ($message): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <div class="form-edit">
        <form method="post" class="form-example">
            <div class="menu-genre">
                <select name="id" id="select-genre">
                    <option value="">--- Sélectionnez un Genre ---</option>
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?= $genre['id'] ?>" <?= isset($selectedGenre) && $selectedGenre['id'] == $genre['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($genre['genre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="middle">
                <button type="submit" name="selectGenre" class="button-form modify-button">Modifier</button>
            </div>
        </form>

        <?php if ($selectedGenre): ?>
            <h2>Modifier le Genre : <?= htmlspecialchars($selectedGenre['genre']) ?></h2>
            <form method="post" class="form-example">
                <input type="hidden" name="id" value="<?= $selectedGenre['id'] ?>">

                <label for="genre">Genre</label>
                <input type="text" name="genre" id="genre" value="<?= htmlspecialchars($selectedGenre['genre']) ?>" required />

                <div class="middle edit-buttons">
                    <button type="submit" name="updateGenre" class="button-form">Mettre à jour</button>
                    <button type="submit" name="deleteGenre" class="button-form" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce genre ?');">Supprimer</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</section>
 
    <?php 
      require_once __DIR__ . "/includes/footer.php";
    ?>