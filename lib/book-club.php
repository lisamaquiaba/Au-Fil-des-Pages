<?php 
    function verifyClub($pdo, $name, $prenom, $email, $naissance) {
       // Préparation de la requête
        $query = $pdo->prepare("INSERT INTO club (name, prenom, email, naissance) VALUES (:name, :prenom, :email, :naissance)");
        
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':naissance', $naissance, PDO::PARAM_STR);

        try {
            $res = $query->execute();
            return $res ? "Information reçu avec succès !" : false;
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }

    }
?>