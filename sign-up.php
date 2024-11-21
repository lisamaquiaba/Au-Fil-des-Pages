<?php
 require_once __DIR__ . "/lib/session.php";
 require_once __DIR__ . "/lib/pdo.php";
 require_once __DIR__ . "/lib/user.php";


 if(isset($_POST['addUser']))  {

  $name = $_POST['name'] ?? ''; 
  $prenom = $_POST['prenom'] ?? ''; 
  $email = $_POST['email'] ?? ''; 
  $password = $_POST['password'] ?? '';

  // var_dump($name);
  // var_dump($prenom);
  // var_dump($email);
  // var_dump($password);

 $message = addUser($pdo, $name, $prenom, $email, $password);
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
          <a href="club.html" class="active nav-link">Club de Lecture</a>
          <a href="contact.html" class="nav-link">Nous contacter</a>
          <a href="login.html" class="button1">Connexion</a>
          <a href="sign-up.html" class="button1">S'inscrire</a>
          <!-- <button href="login.html" class="button1">Connexion</button>
          <button class="button2">S'inscrire</button> -->
        </div>
      </nav>
    </header>
    <section class="wrapper-form-signup">
      <div class="sign-up">
        <h1>Créer un compte</h1>
        <form class="form-signup" method="post" action="">
          <div class="user-signup">
            <div class="mid-size-input">
              <label for="name">Nom *</label>
              <input
                type="text"
                name="name"
                id="name"
                placeholder="Votre nom"
                required
              />
            </div>
            <div class="mid-size-input">
              <label for="prenom">Prénom *</label>
              <input
                type="text"
                name="prenom"
                id="prenom"
                placeholder="Votre prénom"
                required
              />
            </div>
          </div>
          <div class="user-signup">
            <div class="mid-size-input">
              <label for="email">Email *</label>
              <input
                type="text"
                name="email"
                id="email"
                placeholder="email@example.com"
                required
              />
            </div>
            <div class="mid-size-input">
              <label for="password">Mot de passe *</label>
              <input type="password" name="password" id="password" required />
            </div>
          </div>
          <!-- <div class="mid-size-input">
            <label for="password">Confirmer le mot de passe *</label>
            <input type="password" name="password" id="password" required />
          </div> -->
          <div class="middle">
            <button class="button-form" type="submit" name="addUser">Créer un compte</button>
          </div>
        </form>
      </div>
    </section>
   
    <?php require_once __DIR__. "/templates/footer.php" ?>
