<?php
  require_once __DIR__ . "/includes/header.php";
  require_once __DIR__ . "/src/db/pdo.php";
  require_once __DIR__ . "/src/functions/user.php";

  if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$users = getAllUsers($pdo);
$selectedUser = null;
$message = "";

if (isset($_POST['selectUser']) && is_numeric($_POST['id_user'])) {
    $selectedUser = getUserById($pdo, intval($_POST['id_user']));
}

if (isset($_POST['updateUser'])) {
    $userId = intval($_POST['id_user']);
    $newRole = htmlspecialchars($_POST['role']);

   $message = updateUser($pdo, $userId, $newRole);
}

if (isset($_POST['deleteUser'])) {
    $userId = intval($_POST['id_user']);
    $message = deleteUser($pdo, $userId);
}

?>
<section class="wrapper-edit">
    <div>
        <h2>Gérer les Comptes Utilisateurs</h2>
    </div>

    <?php if ($message): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <div class="form-edit">
        <form method="post" class="form-example">
            <div class="menu-genre">
                <select name="id_user" id="select-user">
                    <option value="">--- Sélectionnez un Utilisateur ---</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id'] ?>" <?= isset($selectedUser) && $selectedUser['id'] == $user['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($user['prenom'] . " " . $user['name'] . " (" . $user['role'] . ")") ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="middle">
                <button type="submit" name="selectUser" class="button-form modify-button">Modifier</button>
            </div>
        </form>

        <?php if ($selectedUser): ?>
            <h2>Modifier le Compte de : <?= htmlspecialchars($selectedUser['prenom'] . " " . $selectedUser['name']) ?></h2>
            <form method="post" class="form-editUser">
                <input type="hidden" name="id_user" value="<?= $selectedUser['id'] ?>">

                <label for="role">Rôle de l'utilisateur</label>
                <select name="role" id="role" required>
                    <option value="client" <?= $selectedUser['role'] === 'client' ? 'selected' : '' ?>>Client</option>
                    <option value="employe" <?= $selectedUser['role'] === 'employe' ? 'selected' : '' ?>>Employé</option>
                    <option value="admin" <?= $selectedUser['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>

                <div class="middle edit-buttons">
                    <button type="submit" name="updateUser" class="button-form">Mettre à jour</button>
                    <button type="submit" name="deleteUser" class="button-form" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</section>
<?php 
      require_once __DIR__ . "/includes/footer.php";
    ?>