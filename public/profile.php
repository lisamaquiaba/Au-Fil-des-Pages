<?php 
  require_once __DIR__ . "/includes/header.php";
  require_once __DIR__ . "/src/db/pdo.php";
  require_once __DIR__ . "/src/functions/user.php";

  // Vérifiez si l'utilisateur est connecté
  if (!isset($_SESSION['user'])) {
      header('Location: login.php');
      exit;
  }

  // Vérifiez que l'ID est valide
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
      $id = intval($_GET['id']);
  } else {
      // Si aucun ID valide n'est fourni, redirigez
      header('Location: index.php');
      exit;
  }

  // Récupérez l'utilisateur à afficher
  $user = getUserById($pdo, $id);

  // Si l'utilisateur à afficher n'existe pas
  if (!$user) {
      header('Location: index.php');
      exit;
  }

  


  // Déterminez si l'utilisateur affiché est admin ou employé
  $isAdminOnly = ($user['role'] === 'admin');
  $isEmploye = ($user['role'] === 'employe');
  $isClient = ($user['role'] === 'client')
?>



    <div class="wrapper-user-connected">
    <?php if ($isClient): ?>
      <h2>Bienvenue <?= htmlspecialchars($user['prenom']) ?> !</h2>
      <div class="user-link">
        <?php endif; ?>

        <?php if ($isAdminOnly): ?>
          <h1>Bonjour <?= htmlspecialchars($user['prenom']) ?> !</h1>
          <div class="user-link">
          <a href="add-book.php">Ajouter un livre</a>
          <a href="edit-book.php">Modifier / Supprimer un livre</a>
          <a href="edit-genre.php">Modifier / Supprimer un genre</a>
          <a href="addUser.php">Créer un compte</a>
          <a href="editUser.php">Modifier un compte</a>
          <a href="contact-Admin.php">Messages</a>
        <?php endif; ?>

        <?php if ($isEmploye): ?>
          <h2>Bonjour <?= htmlspecialchars($user['prenom']) ?> !</h2>
          <div class="user-link">
          <a href="add-book.php">Ajouter un livre</a>
          <a href="edit-book.php">Modifier / Supprimer un livre</a>
          <a href="edit-genre.php">Modifier / Supprimer un genre</a>
          <a href="contact-Admin.php">Messages</a>
        <?php endif; ?>

      </div>
    </div>
    
<?php 
  require_once __DIR__ . "/includes/footer.php";
?>