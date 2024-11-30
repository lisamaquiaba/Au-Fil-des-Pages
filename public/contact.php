<?php 
  require_once __DIR__ . "/includes/header.php";
  require_once __DIR__ . "/src/db/pdo.php";  
  require_once __DIR__ . "/src/functions/contact.php";

  if(isset($_POST['btn-contact']))  { //Lorsque que l'on appuie sur le bouton

  $name = $_POST['name'] ?? ''; 
  $prenom = $_POST['prenom'] ?? ''; 
  $email = $_POST['email'] ?? ''; 
  $reason = $_POST['reason'] ?? ''; 
  $message = $_POST['message'] ?? ''; 

  $message = contactUs($pdo, $name, $prenom, $email, $reason, $message);
  }
?>


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
    
    <?php 
      require_once __DIR__ . "/includes/footer.php";
      ?>