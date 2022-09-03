<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_POST['formconnexion'])) {
   $email = htmlspecialchars($_POST['email']);
   $mdp = sha1($_POST['mdp']);
   if(!empty($email) AND !empty($mdp)) {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
      $requser->execute(array($email, $mdp));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['ID'] = $userinfo['ID'];
         $_SESSION['prenom'] = $userinfo['prenom'];
         $_SESSION['mail'] = $userinfo['mail'];
       
         if($_SESSION['ID'] == 999){
            header("Location: superviseur.php?id=".$_SESSION['ID']);
          }
         else{
            header("Location: profil.php?id=".$_SESSION['ID']);
         }
       
      } else {
         $erreur = "Mot de passe ou mail incorrecte.";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés.";
   }
}
?>
<!DOCTYPE html>
<html>

	<head> 
		<meta charset="utf-8">
		<link rel="stylesheet" href="style2.css" />
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

            <div id="co"><h2>Connexion</h2>
            </div>

       <div id="inscription"> 
        <form method="post" action="" >
       
          <p id="email2">Adresse email<br /></p><input id="email" type="email" name="email" placeholder="votreemail@gmail.com" >
          <p id="mdp2">Mot de passe<br /></p><input id="mdp" type="password" name="mdp" placeholder="••••••••" >
          <input type="submit" id="connexion" name="formconnexion" value="SE CONNECTER" >         

         <p3>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
        </p3>

        </form>
        <p2 id="pascompte"> Pas de compte ?  <a href="inscription.php">Créer un compte </p2>


       </div>



  </body>
</html>