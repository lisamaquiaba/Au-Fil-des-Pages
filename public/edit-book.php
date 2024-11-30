<?php
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/src/db/pdo.php";
require_once __DIR__ . "/src/functions/book.php";
require_once __DIR__ . "/src/functions/genre.php";
require_once __DIR__ . "/src/functions/uploadImage.php";


// Vérifiez que l'utilisateur est admin ou employé
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'employe')) {
    header('Location: login.php');
    exit;
}


// Initialisation des variables
$books = getBooks($pdo);
$selectedBook = null;
$message = "";

// Si un livre est sélectionné
if (isset($_POST['selectBook']) && is_numeric($_POST['book_id'])) {
    $selectedBook = getBookById($pdo, intval($_POST['book_id']));
}

// Si un livre est modifié
if (isset($_POST['updateBook'])) {
    $bookId = intval($_POST['book_id']);
    $titre = htmlspecialchars($_POST['titre']);
    $auteur = htmlspecialchars($_POST['auteur']);
    $id_genre = intval($_POST['id_genre']);
    $format = htmlspecialchars($_POST['format']);
    $editeur = htmlspecialchars($_POST['editeur']);
    $description = htmlspecialchars($_POST['description']);
    $stock = intval($_POST['stock']);
    $prix = floatval($_POST['prix']);
    $pages = intval($_POST['pages']);
    $date_publication = $_POST['date_publication'];
    $image = $_FILES['image']['name'];

    // Gestion de l'image
    if (!empty($image)) {
        $imagePath = handleImageUpload( $_FILES['image']);
    } else {
        $imagePath = $selectedBook['image']; // Si l'image n'est pas changée, garder l'ancienne
    }

    $message = updateBook($pdo,$titre, $auteur, $id_genre, $format, $editeur, $description, $stock, $prix, $pages, $date_publication, $imagePath, $bookId);
}

// Si un livre est supprimé
if (isset($_POST['deleteBook'])) {
    $bookId = intval($_POST['book_id']);
    $deleteQuery = $pdo->prepare('DELETE FROM livre WHERE livre_id = :id');
    $deleteQuery->bindParam(':id', $bookId);

    if ($deleteQuery->execute()) {
        $message = "Le livre a été supprimé avec succès.";
        $books = getBooks($pdo); // Rafraîchir la liste des livres
    } else {
        $message = "Erreur lors de la suppression du livre.";
    }
}
?>


<section class="wrapper-add-book">
    <h1>Gérer les livres</h1>

    <?php if ($message): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <div></div>

    <form method="post" class="form-select-book">
        <div class="option-book">
            <label for="book_id">Sélectionnez un livre :</label>
            <select name="book_id" id="book_id" required>
            <option value="">-- Choisissez un livre --</option>
            <?php foreach ($books as $book): ?>
                <option value="<?= $book['livre_id'] ?>" <?= isset($selectedBook) && $selectedBook['livre_id'] == $book['livre_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($book['titre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="middle">
            <button type="submit" name="selectBook" class='button-form'>Modifier</button>
        </div>
    </form>

    <div class="form-edit">
    <?php if ($selectedBook): ?>
        <h2>Modifier le livre : <?= htmlspecialchars($selectedBook['titre']) ?></h2>
        <form method="post" enctype="multipart/form-data" class="form-example">
            <input type="hidden" name="book_id" value="<?= $selectedBook['livre_id'] ?>">
            <div class="form-example">
                <label for="titre">Titre :</label>
                <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($selectedBook['titre']) ?>" required>
            </div>

            <div class="form-example">
                <label for="auteur">Auteur :</label>
                <input type="text" name="auteur" id="auteur" value="<?= htmlspecialchars($selectedBook['auteur']) ?>" required>
            </div>

            <div class="form-example">
                <label for="id_genre">Genre :</label>
                <select name="id_genre" id="id_genre" required>
                <?php
                $genres = getAllGenres($pdo);
                foreach ($genres as $genre):
                    ?>
                    <option value="<?= $genre['id'] ?>" >
                        <?= htmlspecialchars($genre['genre']) ?>
                    </option>
                <?php endforeach; ?>
                </select>
            </div>

            <div class="form-example">
                <label for="format">Format :</label>
                <input type="text" name="format" id="format" value="<?= htmlspecialchars($selectedBook['format']) ?>" required>
            </div>

            <div class="form-example">
             <label for="editeur">Éditeur :</label>
             <input type="text" name="editeur" id="editeur" value="<?= htmlspecialchars($selectedBook['editeur']) ?>" required>
            </div>

            <div class="form-example">
                <label for="description">Description :</label>
                <div>
                    <textarea class="description" name="description" id="description" rows="5" required><?= htmlspecialchars($selectedBook['description']) ?></textarea>
                </div>
            </div>

            <div class="form-example">
                <label for="stock">Stock :</label>
                <input type="number" name="stock" id="stock" value="<?= htmlspecialchars($selectedBook['stock']) ?>" required>
            </div>
            
            <div class="form-example">
                <label for="prix">Prix :</label>
                <input type="number" step="0.01" name="prix" id="prix" value="<?= htmlspecialchars($selectedBook['prix']) ?>" required>
            </div>

            <div class="form-example">
                <label for="pages">Pages :</label>
                <input type="number" name="pages" id="pages" value="<?= htmlspecialchars($selectedBook['pages']) ?>" required>
            </div>

            <div class="form-example">
                <label for="date_publication">Date de publication :</label>
                <input type="date" name="date_publication" id="date_publication" value="<?= $selectedBook['date_publication'] ?>" required>
            </div>

            <div class="form-example">
                <label for="image">Image :</label>
                <input type="file" name="image" id="image">
            </div>

            <div class="edit-buttons">
                <button type="submit" name="updateBook" class="button-form">Mettre à jour</button>
                <button type="submit" name="deleteBook" class="button-form" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">Supprimer</button>
            </div>

        </form>
    <?php endif; ?>
    </div>
</section>

<?php 
    require_once __DIR__ . "/includes/footer.php"
?>
