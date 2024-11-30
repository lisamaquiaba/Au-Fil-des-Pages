<?php

function verifyUserLoginPassword(PDO $pdo, string $email, string $password): bool|array
{
    try {
        $query = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return false;
    }
}

function getAllUsers($pdo)
{
    try {
        $query = $pdo->query('SELECT id, prenom, name, role FROM user ORDER BY prenom, name');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return [];
    }
}

function getUserById(PDO $pdo, int $id)
{
    try {
        $query = $pdo->prepare('SELECT * FROM user WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return null;
    }
}

function updateUser($pdo, $userId, $newRole)
{
    try {
        $updateQuery = $pdo->prepare('UPDATE user SET role = :role WHERE id = :id');
        $updateQuery->bindParam(':role', $newRole);
        $updateQuery->bindParam(':id', $userId);

        if ($updateQuery->execute()) {
            getAllUsers($pdo); 
            return "Le rôle de l'utilisateur a été mis à jour avec succès.";
        } else {
            return "Erreur lors de la mise à jour du rôle.";
        }
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return "Une erreur est survenue lors de la mise à jour.";
    }
}

function deleteUser($pdo, $userId)
{
    try {
        $deleteQuery = $pdo->prepare('DELETE FROM user WHERE id = :id');
        $deleteQuery->bindParam(':id', $userId);

        if ($deleteQuery->execute()) {
            getAllUsers($pdo); 
            return "L'utilisateur a été supprimé avec succès.";
        } else {
            return "Erreur lors de la suppression de l'utilisateur.";
        }
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return "Une erreur est survenue lors de la suppression.";
    }
}

function verifyEmailExists($pdo, $email)
{
    try {
        $checkQuery = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
        $checkQuery->bindValue(':email', $email, PDO::PARAM_STR);
        $checkQuery->execute();
        return $checkQuery->fetchColumn();
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return 0;
    }
}

function addUser(PDO $pdo, $name, $prenom, $email, $password)
{
    $name = trim($name);
    $prenom = trim($prenom);
    $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);

    if (!$email) {
        return "Adresse email invalide.";
    }
    if (strlen($password) < 8) {
        return "Le mot de passe doit comporter au moins 8 caractères.";
    }
    if (strlen($name) > 255 || strlen($prenom) > 255 || strlen($email) > 255) {
        return "Les champs ne doivent pas dépasser 255 caractères.";
    }

    try {
        $emailExists = verifyEmailExists($pdo, $email);

        if ($emailExists > 0) {
            return "Cet email est déjà utilisé.";
        }

        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Préparation de la requête d'insertion
        $query = $pdo->prepare("INSERT INTO user (name, prenom, email, password) VALUES (:name, :prenom, :email, :password)");
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':password', $hashedPassword, PDO::PARAM_STR);

        $res = $query->execute();

        if ($res) {
            return "Compte créé avec succès.";
        } else {
            return "Erreur lors de la création du compte.";
        }
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return "Une erreur est survenue lors de la création du compte. Veuillez réessayer.";
    }
}
