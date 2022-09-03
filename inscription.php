<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_POST['forminscription'])) {
   $prenom = htmlspecialchars($_POST['prenom']);
   $nom = htmlspecialchars($_POST['nom']);
   $mail = htmlspecialchars($_POST['mail']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp3']);
   if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp3']))
        {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                     $insertmbr = $bdd->prepare("INSERT INTO membres(prenom, nom, mail, motdepasse) VALUES(?, ?, ?, ?)");
                     $insertmbr->execute(array($prenom, $nom, $mail, $mdp));
                     $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }   
      } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>

<!DOCTYPE html>
<html>

	<head> 
		<meta charset="utf-8">
		<link rel="stylesheet" href="style3.css" />
		<title>Poisson & Cie</title>
    <link rel="icon" sizes="144x144" href="images/logo.png">
	</head>

	<body>        

            <header>
                <nav>
                    <ul>
                        <li><a href="accueil.php">Accueil</a></li>
                        <li><a href="accueil.php#contact">Contact</a></li>                     
                        <li><a href="connexion.php">Se connecter</a></li>
                    </ul>
                </nav>
            </header>

            <div id="co"><h2>Inscription</h2>
            </div>


        <form method="POST" action="" >
       
          <p id="prenom2">Prénom<br /></p><input id="prenom" type="text" name="prenom" placeholder="Prénom" value="<?php if(isset($prenom)) { echo $prenom; } ?>">

          <p id="nom2">Nom<br /></p><input id="nom" type="text" name="nom" placeholder="Nom" value="<?php if(isset($nom)) { echo $nom; } ?>">

          <p id="email2">Adresse email<br /></p><input id="mail" type="email" name="mail" placeholder="votreemail@gmail.com" value="<?php if(isset($mail)) { echo $mail; } ?>">

          <p id="mdp2">Mot de passe<br /></p><input id="mdp" name="mdp" type="password" placeholder="••••••••">

          <p id="mdp4">Confirmer le mot de passe<br /></p><input id="mdp3" name="mdp3" type="password" placeholder="••••••••">

          <input type="submit" id="inscription" name="forminscription" value="S'INSCRIRE" > 

        </form>
        <p2>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
        </p2>
  </body>
</html>