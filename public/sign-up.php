<?php
 require_once __DIR__ . "/includes/header.php";
  require_once __DIR__ . "/src/db/pdo.php";  
  require_once __DIR__ . "/src/functions/user.php";


 if(isset($_POST['addUser']))  {

  $name = $_POST['name'] ?? ''; 
  $prenom = $_POST['prenom'] ?? ''; 
  $email = $_POST['email'] ?? ''; 
  $password = $_POST['password'] ?? '';

  

 $message = addUser($pdo, $name, $prenom, $email, $password);
}
?>

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
          <div class="middle">
            <button class="button-form" type="submit" name="addUser">Créer un compte</button>
          </div>
          <?php if (isset($message)): ?>
              <p class="error"><?= htmlspecialchars($message); ?></p>
              <?php endif; ?>
        </form>
        
      </div>
    </section>
   
    <?php 
      require_once __DIR__ . "/includes/footer.php";

    ?>
