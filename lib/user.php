<?php

function verifyUserLoginPassword(PDO $pdo, string $email, string $password):bool|array
{
    $query = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    //fetch() nous permet de récupérer une seule ligne
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {

        return $user;
    } else {
        return false;
    }
}

function getUserById(PDO $pdo, int $id) {
    $query = $pdo->prepare('SELECT * FROM user WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);
}


function addUser(PDO $pdo, $name, $prenom, $email, $password) {
    if(!empty($name) && !empty($prenom) && !empty($email) && !empty($password)) {
        try {
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
                return "Compte créé avec succès. ";
            } else {
                return  "Erreur lors de la création du compte.";
            }
        } catch (PDOException $e) {
            return  "Erreur SQL : " . $e->getMessage();
        }
    } else {
        return "Veuillez remplir tous les champs.";
    }
}