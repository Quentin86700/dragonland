<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>

<!DOCTYPE html>
<html>

   <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style5.css" />
        <title>Poisson & Cie</title>
        <link rel="icon" sizes="144x144" href="images/logo.png">
   </head>

   <body>


            <header>
                <nav>
                    <ul>
                        <li><a href="accueilco.php">Accueil</a></li>
                        <li><a href="accueilco.php#contact">Contact</a></li>
                        <li><a href="#">Mon compte</a></li>
                    </ul>
                </nav>
            </header>


         <?php
         if(isset($_SESSION['ID']) AND $userinfo['ID'] == $_SESSION['ID']) {
         ?>

         <br /><br />
         <div id="identification"><h1><?php echo $userinfo['PRENOM']?> <?php echo $userinfo['NOM'] ?></h1></div>
         <a href="deconnexion.php" id="deconnexion"><img src="images/logout2.png" align="right" height="40" title="Déconnexion"></a>
         <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />


         <footer>
           <h5>Vous pouvez également télécharger l'application mobile pour avoir accès plus facilement aux informations de votre aquarium.</h5>
           <a href="#" id="download">TÉLÉCHARGER</a>
           <br /><br /><br />
         </footer>


         <?php
         }
         ?>
   </body>
</html>
<?php   
}
?>