<?php

// Récupérer tous les genres
function getAllGenres($pdo) {
    try {
        $query = $pdo->prepare('SELECT * FROM genre');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur SQL lors de la récupération des genres : " . $e->getMessage());
        return "Erreur lors de la récupération des genres.";
    }
}

// Supprimer un genre
function deleteGenre($pdo, $genreId) {
    try {
        $deleteQuery = $pdo->prepare('DELETE FROM genre WHERE id = :id');
        $deleteQuery->bindParam(':id', $genreId, PDO::PARAM_INT);

        if ($deleteQuery->execute()) {
            return "Le genre a été supprimé avec succès.";
        } else {
            return "Erreur lors de la suppression du genre.";
        }
    } catch (PDOException $e) {
        error_log("Erreur SQL lors de la suppression du genre : " . $e->getMessage());
        return "Erreur lors de la suppression du genre.";
    }
}

// Récupérer un genre par son ID
function getGenreById($pdo, $id) {
    try {
        $query = $pdo->prepare('SELECT * FROM genre WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur SQL lors de la récupération du genre par ID : " . $e->getMessage());
        return "Erreur lors de la récupération du genre.";
    }
}

// Mettre à jour un genre
function updateGenre($pdo, $genre, $genreId) {
    try {
        $updateQuery = $pdo->prepare('UPDATE genre SET genre = :genre WHERE id = :id');
        $updateQuery->bindParam(':genre', $genre, PDO::PARAM_STR);
        $updateQuery->bindParam(':id', $genreId, PDO::PARAM_INT);

        if ($updateQuery->execute()) {
            return "Le genre a été mis à jour avec succès.";
        } else {
            return "Erreur lors de la mise à jour du genre.";
        }
    } catch (PDOException $e) {
        error_log("Erreur SQL lors de la mise à jour du genre : " . $e->getMessage());
        return "Erreur lors de la mise à jour du genre.";
    }
}

?>
