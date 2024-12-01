<?php
function addClub(PDO $pdo, string $name, string $prenom, string $email, string $naissance): string
{
    $name = trim($name);
    $prenom = trim($prenom);
    $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    $naissance = trim($naissance);

    if (!$email) {
        return "Adresse email invalide.";
    }
    if (strlen($name) > 255 || strlen($prenom) > 255 || strlen($email) > 255) {
        return "Les champs ne doivent pas dépasser 255 caractères.";
    }

    try {
        $query = $pdo->prepare("INSERT INTO club (name, prenom, email, naissance) VALUES (:name, :prenom, :email, :naissance)");
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':naissance', $naissance, PDO::PARAM_STR);

        $res = $query->execute();
        return $res ? "Informations reçues avec succès !" : "Échec de l'enregistrement.";
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return "Une erreur est survenue lors de l'enregistrement. Veuillez réessayer.";
    }
}
?>
