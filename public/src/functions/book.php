<?php 

function getBooks(PDO $pdo) {
    $query = $pdo->prepare('
        SELECT 
            livre.*, 
            genre.genre AS genre_nom  
        FROM 
            livre
        LEFT JOIN 
            genre ON livre.id_genre = genre.id 
        ORDER BY 
            livre.date_publication DESC
    ');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC); 
}

function getBestSeller(PDO $pdo) {
    $query = $pdo->prepare('
        SELECT 
            * 
        FROM 
            livre
        LIMIT 3
    ');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC); 
}

    function getBookById(Pdo $pdo, int $id) {
        $query = $pdo->prepare('SELECT livre.*, genre.genre AS genre_nom FROM livre LEFT JOIN genre ON livre.id_genre = genre.id WHERE livre_id = :id');
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

    function getFilterBooks(PDO $pdo, $search, $genre) {
        $sql = "SELECT livre.*, genre.genre AS genre_nom FROM livre 
                LEFT JOIN genre ON livre.id_genre = genre.id WHERE 1=1"; 
        
        $params = [];
      
        // Filtrage par titre
        if ($search) {
            $sql .= " AND titre LIKE :search"; 
            $params['search'] = '%' . $search . '%';
        }
      
        // Filtrage par genre
        if ($genre) {
            $sql .= " AND livre.id_genre = :genre"; 
            $params['genre'] = $genre;
        }
      
        $query = $pdo->prepare($sql);
        $query->execute($params);
      
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

    function updateBook($pdo, $titre, $auteur, $id_genre, $format, $editeur, $description, $stock, $prix, $pages, $date_publication, $imagePath, $bookId) {
        $updateQuery = $pdo->prepare('UPDATE livre SET 
        titre = :titre, auteur = :auteur, id_genre = :id_genre, format = :format, 
        editeur = :editeur, description = :description, stock = :stock, prix = :prix, 
        pages = :pages, date_publication = :date_publication, image = :image WHERE livre_id = :id');
    $updateQuery->bindParam(':titre', $titre);
    $updateQuery->bindParam(':auteur', $auteur);
    $updateQuery->bindParam(':id_genre', $id_genre);
    $updateQuery->bindParam(':format', $format);
    $updateQuery->bindParam(':editeur', $editeur);
    $updateQuery->bindParam(':description', $description);
    $updateQuery->bindParam(':stock', $stock);
    $updateQuery->bindParam(':prix', $prix);
    $updateQuery->bindParam(':pages', $pages);
    $updateQuery->bindParam(':date_publication', $date_publication);
    $updateQuery->bindParam(':image', $imagePath, PDO::PARAM_LOB);
    $updateQuery->bindParam(':id', $bookId);

    if ($updateQuery->execute()) {
        $books = getBooks($pdo); // Rafraîchir la liste des livres
        return "Le livre a été mis à jour avec succès.";
    } else {
        return "Erreur lors de la mise à jour du livre.";
    }

    }