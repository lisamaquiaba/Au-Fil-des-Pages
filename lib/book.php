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

    function addBook($pdo, $titre, $auteur, $id_genre, $format, $description, $prix, $stock, $date_publication, $imgContent) {
        if (empty($prenom) || empty($etat) || empty($imgContent)) {
            return "Veuillez remplir tous les champs, y compris la photo.";
        }

    $query = $pdo->prepare("INSERT INTO livre (titre, auteur, id_genre, format, description, prix, stock, date_publication, picture) VALUES (:titre, :auteur, :id_genre, :format, :description, :prix, :stock, :date_publication, :picture)");
    
    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':auteur', $auteur, PDO::PARAM_STR);
    $query->bindValue(':id_genre', $id_genre, PDO::PARAM_INT);
    $query->bindValue(':format', $format, PDO::PARAM_STR);
    $query->bindValue(':description', $descrpiption, PDO::PARAM_STR);
    $query->bindValue(':prix', $prix, PDO::PARAM_STR);
    $query->bindValue(':stock', $stock, PDO::PARAM_INT);
    $query->bindValue(':date_publication', $date_publication, PDO::PARAM_STR);
    $query->bindValue(':picture', $imgContent, PDO::PARAM_LOB);

    }