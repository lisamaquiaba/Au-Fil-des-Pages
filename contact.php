<?php 
  require_once __DIR__ . "/lib/pdo.php";
  require_once __DIR__ . "/lib/contact.php";
  require_once __DIR__ . "/lib/session.php";

  if(isset($_POST['btn-contact']))  { //Lorsque que l'on appuie sur le bouton

  $name = $_POST['name'] ?? ''; 
  $prenom = $_POST['prenom'] ?? ''; 
  $email = $_POST['email'] ?? ''; 
  $reason = $_POST['reason'] ?? ''; 
  $message = $_POST['message'] ?? ''; 
  var_dump($name, $prenom, $email, $reason, $message);

  $message = contactUs($pdo, $name, $prenom, $email, $reason, $message);
  }
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
          <a href="club.html" class="nav-link">Club de Lecture</a>
          <a href="contact.html" class="nav-link active">Nous contacter</a>
          <a href="cart.html"><img src="img/cart.png" alt="Panier" class="cart"></a>
          <?php if (isset($_SESSION['user'])) { ?>
            <a href="logout.php" class="button1">Déconnexion</a>
          <?php } else { ?>
            <a href="login.php" class="button1">Connexion</a>
          <?php } ?>
          <a href="sign-up.html" class="button1">S'inscrire</a>
        </div>
      </nav>
    </header>
    <div class="container-contact">
      <section class="contact">
        <div class="explanation">
          <h1>Contactez-nous</h1>
          <p class="test2">
            Une question ? Une suggestion ? Un problème ? Contactez notre
            service client.
          </p>
        </div>
        <div class="container-form-contact">
          <form class="form-contact" action="" method="post">
            <div class="user-infos">
              <div class="form-contact">
                <label for="name">Nom * </label>
                <input
                  type="text"
                  name="name"
                  id="name"
                  required
                  placeholder="Votre Nom"
                />
              </div>
              <div class="form-test-contact">
                <label for="prenom">Prénom * </label>
                <input
                  type="text"
                  name="prenom"
                  id="prenom"
                  required
                  placeholder="Votre Prénom"
                />
              </div>
              <div class="form-test-contact">
                <label for="email">Email * </label>
                <input
                  type="email"
                  name="email"
                  id="email"
                  required
                  placeholder="Votre Email"
                />
              </div>
            </div>
            <section class="checkbox">
              <div class="form-test-contact">
                <input type="radio" name="reason" id="suggestion" value="suggestion" />
                <label for="suggestion">Suggestion</label>
              </div>
              <div class="form-test-contact">
                <input type="radio" name="reason" id="club"  value="club"/>
                <label for="club">Club de lecture</label>
              </div>
              <div class="form-test-contact">
                <input type="radio" name="reason" id="autre"  value="autre"/>
                <label for="autre">Autre</label>
              </div>
            </section>
            <div class="wrapper-message">
              <label for="message">Votre message</label>
              <div>
                <textarea
                  class="message"
                  name="message"
                  id="message"
                ></textarea>
              </div>
            </div>
            <div class="middle">
              <button type="submit" name="btn-contact" class="button-form">
                Envoyer
              </button>
            </div>
          </form>
        </div>
      </section>
    </div>
    
    <?php require_once __DIR__. "/templates/footer.php" ?>