<?php 

function getBooks(PDO $pdo) {
    $query = $pdo->prepare('SELECT * FROM livre ORDER BY date_publication DESC'); 
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC); 
}

    function getBookById(Pdo $pdo, int $id) {
        $query = $pdo->prepare('SELECT * FROM livre WHERE livre_id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function getBooksByGenreId(PDO $pdo, int $id) {
        $query = $pdo->prepare('SELECT * FROM livre WHERE id_genre = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    
    }


    function addBook($pdo, $titre, $auteur, $id_genre, $format, $editeur, $description, $stock, $prix, $pages, $date_publication, $image) {

        $query = $pdo->prepare("INSERT INTO livre (titre, auteur, id_genre, format, editeur, description, stock, prix, pages, date_publication, image) VALUES (:titre, :auteur, :id_genre, :format, :editeur, :description, :stock, :prix, :pages, :date_publication, :image)");

        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':auteur', $auteur, PDO::PARAM_STR);
        $query->bindValue(':id_genre', $id_genre, PDO::PARAM_INT);
        $query->bindValue(':format', $format, PDO::PARAM_STR);
        $query->bindValue(':editeur', $editeur, PDO::PARAM_STR);
        $query->bindValue(':description', $description, PDO::PARAM_STR);
        $query->bindValue(':stock', $stock, PDO::PARAM_STR);
        $query->bindValue(':prix', $prix, PDO::PARAM_INT);
        $query->bindValue(':pages', $pages, PDO::PARAM_INT);
        $query->bindValue(':date_publication', $date_publication, PDO::PARAM_STR);
        $query->bindValue(':image', $image, PDO::PARAM_LOB);

        try {
            $res = $query->execute();
            return $res ? "Livre Ajouté" : "Erreur lors de l'ajout d'un livre.";
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }