<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();

if(isset($_POST['mailform'])) {
   $msg   = htmlspecialchars($_POST['msg']);
   $to    = 


$header="MIME-Version: 1.0\r\n";
$header.='Content-Type:text/html; charset="uft-8"'."\n";
$header.='Content-Transfer-Encoding: 8bit';

$message='
<html>
  <body>
    <div align="center">
      Contenu du message : ' . $msg . '
    </div>
  </body>
</html>

';

mail($to, "Site internet", $message, $header);

}


?>

<?php  

$host="localhost";
$user="root";
$pass="";
$base="espace_membre";

mysql_connect($host,$user,$pass);
mysql_select_db($base);

$reponse = mysql_query('SELECT * FROM membres');

?>

<!DOCTYPE html>
<html>

   <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style6.css" />
        <title>Poisson & Cie</title>
        <link rel="icon" sizes="144x144" href="images/logo.png">
   </head>

   <body>


            <header>
                <nav>
                    <ul>
                        <li><a href="accueilsuperviseur.php">Accueil</a></li>
                        <li><a href="accueilsuperviseur.php#contact">Contact</a></li>
                        <li><a href="#">Mon compte</a></li>
                    </ul>
                </nav>
            </header>

         <?php
         if(isset($_SESSION['ID']) AND $userinfo['ID'] == $_SESSION['ID']) {
         ?>
         <h1>Sélectionnez votre client : </h1>

         <div id="selection">
         <?php 
             echo '<select name="name">';

             while ($donnees = mysql_fetch_array($reponse))
            {
             echo '<option value="'.$donnees['NOM'].'">'.$donnees['NOM'].'</option>';
            }

            $mail = $_POST['name'];

             echo '</select>'; 

         ?>
         </div>

         <a href="#" id="infos">Informations</a>
         <a href="#" id="alerter">Alerter</a>
         
         <?php 
          echo $mail;
         ?>

          <p id="cadre"></p>
         
          <form method="POST" action="">
              <textarea id="message" type="text" name="msg" placeholder="Ajoutez votre message ici ..."></textarea>
              <input type="submit" id="envoyer" name="mailform" value="Envoyer">
          </form>
          <br /><br /><br /><br /><br /><br />

         <?php 
         }
         ?>
   </body>
</html>
<?php   
}
?>