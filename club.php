<?php 
      require_once __DIR__ . "/lib/pdo.php";
      require_once __DIR__ . "/lib/session.php";
      require_once __DIR__ . "/lib/book-club.php";


      if(isset($_POST['verifyClub'])) {
    
        $name = $_POST['name'] ?? ''; 
        $prenom = $_POST['prenom'] ?? ''; 
        $email = $_POST['email'] ?? ''; 
        $naissance = $_POST['naissance'] ?? ''; 

        var_dump($name, $prenom, $email, $naissance);
    
        if(!empty($name) && !empty($prenom) && !empty($email) && !empty($naissance) !== null) {
            $club = verifyClub($pdo, $name, $prenom, $email, $naissance);
            if($club){
              header('location: index.html');
              
            } else {
              $message = "Erreur.";
            }  

        } else {
            $message = "Veuillez remplir tous les champs.";
        }
    }
    
    //SI CHAMPS REMPLIS : RENVOYER A LA PAGE D'ACCUEUIL
    //SI CHAMPS NON REMPLIS OU INCORRECT : AFFICHER ERREUR

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Au Fil des Pages</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Lora:ital,wght@0,400..700;1,400..700&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header class="topbar">
      <nav class="navbar">
        <div class="logo">
          <a href="index.html">
            <img
              src="img/logo.png"
              alt="Logo de Au Fil des Pages"
              width="80px"
              height="64px"
            />
          </a>
        </div>
        <div class="wrapper-link">
          <a href="index.html" class="nav-link">Accueil</a>
          <a href="bibliotheque.html" class="nav-link">Bibliothèque</a>
          <a href="club.html" class=" active nav-link">Club de Lecture</a>
          <a href="contact.html" class="nav-link">Nous contacter</a>
          <a href="login.html" class="button1">Connexion</a>
          <a href="sign-up.html" class="button1">S'inscrire</a>
          <!-- <button href="login.html" class="button1">Connexion</button>
          <button class="button2">S'inscrire</button> -->
        </div>
      </nav>
    </header>
    <span class="wrapper">
      <div class="text">
        <h1>Le club de lecture</h1>
        <p class="test2">
          Au fil des Pages vous donne la possibilité de rejoindre son Club de
          lecture. Une activité parfaite pour partager votre passion des livres,
          discuter de vos expériences littéraires et rencontrer de nouvelles
          personnes autour de cette même passion. Chaque début de mois, les
          membres de notre club se réunissent afin de choisir tous ensemble un
          livre à découvrir pour les semaines à venir. Evidemment, chacun a la
          possibilité de proposer ses idées pour la lecture du mois et de
          contribuer à la décision finale. A la fin du mois, nous nous
          retrouvons pour notre session "debriefing", autour d’une bonne boisson
          pour discuter, échanger nos ressentis, nos impressions et débattre sur
          notre lecture. En bref, c’est le moment parfait pour découvrir de
          nouveaux auteurs et genres littéraires dans la joie et la bonne
          humeur!
        </p>
      </div>
      <div class="illu">
        <img
          src="img/book_club.png"
          alt="Illustration du club de lecture Au fil des Pages"
          width="250"
        />
      </div>
    </span>
    <div class="tittle">
      <h3>
        Tu aimerais rejoindre notre club de lecture ? Rien de plus simple !
        Rempli notre formulaire
      </h3>
    </div>
    <div class="container-club">
      <section class="club">
        <h4>Formulaire d’inscription au Club de lecture</h4>
        <p>* Champ obligatoire</p>
        <div class="form-club">
          <form action="" method="post">
            <div class="form-example">
              <label for="name">Nom * </label>
              <input type="text" name="name" id="name" required placeholder="Votre Nom"/>
            </div>
            <div class="form-example">
              <label for="firstname">Prénom * </label>
              <input type="text" name="prenom" id="prenom" required placeholder="Votre Prénom"/>
            </div>
            <div class="form-example">
              <label for="email">Email * </label>
              <input type="email" name="email" id="email" required placeholder="Votre Email"/>
            </div>
            <div>
              <label for="dob">Date de naissance *</label>
              <input type="date" id="dob" name="naissance" min="1900" max="2006" required />
            </div>
              <div class="middle">
                <button type="submit" name='verifyClub'class="button-form">Soumettre le formulaire</button></div>
            </div>
          </form>
        </div>
      </section>
      <div class="rules">
        <p>- Le club de lecture n’est ouvert que pour les personnes de plus de 18 ans</p>
        <p>- Par mois, le club propose seulement dix places.</p>
        <p>- Les boissons sont à vos frais.</p>
      </div>
    </div>
   
    <?php require_once __DIR__. "/templates/footer.php" ?>
