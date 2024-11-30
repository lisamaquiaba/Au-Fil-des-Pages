<?php
  require_once __DIR__ . "/includes/header.php";
  require_once __DIR__ . "/src/db/pdo.php";
  require_once __DIR__ . "/src/functions/user.php";

  if($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'employe') {
    header('location: index.php');
    exit;
  }

  if(isset($_POST['addUser']))  {

      $name = $_POST['name'] ?? ''; 
      $prenom = $_POST['prenom'] ?? ''; 
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';
      $role = $_POST['role'] ?? '';

     $message = addUser($pdo, $name, $prenom, $email, $password);
    }
?>


    <section class="container-new-user">
      <div>
        <h1>Créer un nouveau compte employé ou admin</h1>
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
            <option value="client">Client</option>
            <option value="admin ">Admin</option>

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

    <?php 
      require_once __DIR__ . "/includes/footer.php";
    ?>