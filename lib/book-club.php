<?php 
    function VerifyClub($pdo, $nom, $prenom, $email, $naissance) {
        if (empty($nom) || empty($prenom) || empty($email) || empty($naissance)) {
            return "Veuillez remplir tous les champs, y compris la photo.";
        }
    
        // Préparation de la requête
        $query = $pdo->prepare("INSERT INTO club (nom, prenom, email, naissance) VALUES (:nom, :prenom, :email, :naissance)");
        
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':naissance', $naissance, PDO::PARAM_STR);

    }
?>