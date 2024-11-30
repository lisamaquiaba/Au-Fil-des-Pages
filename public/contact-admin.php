<?php 
  require_once __DIR__ . "/includes/header.php";
  require_once __DIR__ . "/src/db/pdo.php";
  require_once __DIR__ . "/src/functions/contact.php";

  if($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'employe') {
    header('location: index.php');
    exit;
  }

 $contacts = contactAll($pdo);
 
?>

<section class="wrapper-contact-admin">
  <h2>Messages des utilisateurs</h2>
<?php foreach ($contacts as $contact): ?>
  <div class="message-contact">
    <div class="userinfo-for-contact">
      <p><?= htmlspecialchars($contact['name']); ?></p>
      <p><?= htmlspecialchars($contact['prenom']); ?></p>
    </div>
      <div>
        <p>Email : <?= htmlspecialchars($contact['email']); ?></p>
      </div>
        <div>
          <p>Raison du message : <?= htmlspecialchars($contact['reason']); ?></p>
        </div>
          <div>
            <p>Message : <?= htmlspecialchars($contact['message']); ?></p>
          </div>
  </div>
      
        <?php endforeach; ?> 
</section>


<?php 
  require_once __DIR__ . "/includes/footer.php";
?>