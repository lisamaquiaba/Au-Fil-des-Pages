<?php 
  require_once __DIR__ . "/lib/pdo.php";
  require_once __DIR__ . "/lib/user.php";
  require_once __DIR__ . "/lib/session.php";

  if($_SESSION['user']['role'] !== 'admin') {
    header('location: index.html');
    exit;
  }

  if(isset($_POST['addUser']))  {

      $name = $_POST['name'] ?? ''; 
      $prenom = $_POST['prenom'] ?? ''; 
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';
      $role = $_POST['role'] ?? '';
      // var_dump()

     $message = addUser($pdo, $name, $prenom, $email, $password, $role);
    }
    // var_dump($prenom, $name, $prenom, $email, $password, $role);
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
          <a href="contact.html" class="nav-link">Nous contacter</a>
          <a href="cart.html"
            ><img src="img/cart.png" alt="Panier" class="cart"
          /></a>
          <?php if (isset($_SESSION['user'])) { ?>
          <a href="logout.php" class="button1">Déconnexion</a>
          <?php } else { ?>
          <a href="login.php" class="button1">Connexion</a>
          <?php } ?>
          <a href="sign-up.html" class="button1">S'inscrire</a>
        </div>
      </nav>
    </header>
    <section class="container-new-user">
      <div>
        <h1>Créer un nouveau compte employé</h1>
      </div>
      <form class="form-new-user" action="" method="post">
        <div class="large-input">
          <div>
            <label for="name">Nom *</label>
          </div>
          <input type="text" name="name" id="name" required placeholder="Nom" />
        </div>
        <div class="large-input">
          <div>
            <label for="prenom">Prénom * </label>
          </div>
          <input
            type="text"
            name="prenom"
            id="prenom"
            required
            placeholder="Votre Prénom"
          />
        </div>
        <div class="large-input">
          <div>
            <label for="email">Email * </label>
          </div>
          <input
            type="email"
            name="email"
            id="email"
            required
            placeholder="Email"
          />
        </div>
        <div class="large-input">
          <div>
            <label for="password">Mot de passe *</label>
          </div>
          <input type="password" name="password" id="password" />
        </div>
        <div>
          <select name="role" id="role">
            <option class="default-value" value="">--- Sélectionnez un rôle ---</option>
            <option value="employe">Employé</option>

          </select>
        </div>
        <div class="middle">
          <button type="submit" name="addUser" class="button-form">
            Créer un compte
          </button>
        </div>
        <?php if (isset($message)): ?>
    <p class="error"><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>
      </div>
      </form>
    </section>

    <?php require_once __DIR__. "/templates/footer.php" ?>