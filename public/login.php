<?php
  require_once __DIR__ . "/includes/header.php";
  require_once __DIR__ . "/src/db/pdo.php";  
  require_once __DIR__ . "/src/functions/user.php";

  $errors = [];

  if (isset($_POST['loginUser'])) {
    $user = verifyUserLoginPassword($pdo, $_POST['email'], $_POST['password']);


    if ($user) {
      $_SESSION['user'] = $user;
      header('location: profile.php?id=' . $_SESSION["user"]["id"]);
    } else {
      $errors[] = "Email ou mot de passe incorrecte";
    }

  }
?>


    <section class="conatiner-user">
      <div class="wrapper-form-user">
        <div class="connexion">
          <h1>Se Connecter</h1>
          <form class="form-connexion" method="post" action="">
            <div>
              <label for="email">Email *</label>
              <div class="large-input">
                <input
                  type="text"
                  name="email"
                  id="email"
                  placeholder="email@exemple.com"
                  required
                />
              </div>
            </div>
            <div>
              <label for="password">Mot de passe *</label>
              <div class="large-input">
                <input type="password" name="password" id="password" required />
              </div>
            </div>
            <div class="middle">
              <button type="submit" name="loginUser" class="button-form">Se connecter</button>
            </div>
          </form>
        </div>

        <?php
          foreach ($errors as $errors) { ?>
          <div class="error">
            <?=$errors; ?>
          </div>  
          <?php }
        ?>
      </div>
    </section>
   
    <?php 
      require_once __DIR__ . "/includes/footer.php";
    ?>