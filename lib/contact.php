<?php 
    function contactUs($pdo, $name, $prenom, $email, $reason, $message) {
        if (!empty($name) && !empty($prenom) && !empty($email) && !empty($reason) && !empty($message)) {
            $query = $pdo->prepare("INSERT INTO contact (name, prenom, email, reason, message) VALUES (:name, :prenom, :email, :reason, :message)");
            $query->bindValue(':name', $name, PDO::PARAM_STR);
            $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->bindValue(':reason', $reason, PDO::PARAM_STR);
            $query->bindValue(':message', $message, PDO::PARAM_STR);
    
            try {
                $res = $query->execute();
                if ($res) {
                    return $pdo->lastInsertId();
                } else {
                    return "Erreur lors de l'ajout du message.";
                }
            } catch (PDOException $e) {
                return "Erreur SQL : " . $e->getMessage();
            }
        } else {
            return "Veuillez remplir tous les champs.";
        }
    }
?>