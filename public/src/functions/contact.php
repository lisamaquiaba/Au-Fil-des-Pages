<?php

// envoyer un message de contact
function contactUs($pdo, $name, $prenom, $email, $reason, $message) {
    if (!empty($name) && !empty($prenom) && !empty($email) && !empty($reason) && !empty($message)) {
        $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        
        if (!$email) {
            return "Adresse email invalide.";
        }

        if (strlen($name) > 255 || strlen($prenom) > 255 || strlen($reason) > 255 || strlen($message) > 1000) {
            return "Les champs ne doivent pas dépasser leurs longueurs maximales.";
        }

        try {
            $query = $pdo->prepare("INSERT INTO contact (name, prenom, email, reason, message) 
                                    VALUES (:name, :prenom, :email, :reason, :message)");
            $query->bindValue(':name', $name, PDO::PARAM_STR);
            $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->bindValue(':reason', $reason, PDO::PARAM_STR);
            $query->bindValue(':message', $message, PDO::PARAM_STR);

            // Exécution de la requête
            $res = $query->execute();

            // Vérification du résultat de l'insertion
            if ($res) {
                return $pdo->lastInsertId(); // Retourner l'ID du dernier message ajouté
            } else {
                return "Erreur lors de l'ajout du message.";
            }
        } catch (PDOException $e) {
            error_log("Erreur SQL lors de l'insertion du message : " . $e->getMessage());
            return "Une erreur est survenue. Veuillez réessayer plus tard.";
        }
    } else {
        return "Veuillez remplir tous les champs.";
    }
}

//récupération tous les messages de contact
function contactAll($pdo) {
    try {
        $query = $pdo->prepare('SELECT * FROM contact');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur SQL lors de la récupération des messages de contact : " . $e->getMessage());
        return [];
    }
}

?>
