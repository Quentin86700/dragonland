<?php
session_start();

if(isset($_POST['mailform'])) {
   $prenom = htmlspecialchars($_POST['prenom']);
   $nom = htmlspecialchars($_POST['nom']);
   $tel = htmlspecialchars($_POST['tel']);
   $mail = htmlspecialchars($_POST['mail']);
   $msg   = htmlspecialchars($_POST['msg']);

	if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['tel']) AND !empty($_POST['mail']) AND !empty($_POST['msg']))
        {

$header="MIME-Version: 1.0\r\n";
$header.='Content-Type:text/html; charset="uft-8"'."\n";
$header.='Content-Transfer-Encoding: 8bit';

$message='
<html>
	<body>
		<div align="center">
			Prenom du client : ' . $prenom . '
			<br/> 
			Nom du client : ' . $nom . '
			<br />
			Numéro du client : ' . $tel . '
			<br />
			Mail du client : ' . $mail . '
			<br />
			Contenu du message : ' . $msg . '
		</div>
	</body>
</html>

';

mail("projetaquariumsti2d@gmail.com", "Site internet", $message, $header);

$erreur = "Votre mail a bien été envoyé.";

		
		} else {
      $erreur = "Tous les champs doivent être complétés !";
	}
}

?>

<!DOCTYPE html>
<html>

	<head> 
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" />
		<title>Poisson & Cie</title>
		<link rel="icon" sizes="144x144" href="images/logo.png">
	</head>

	<body>
					 
			 <header>
					<nav>
						<ul>
							<li><a href="accueilsuperviseur.php">Accueil</a></li>
							<li><a href="#contact">Contact</a></li>                        
							<li><a href="superviseur.php">Mon Compte</a></li>  
						</ul>
					</nav>
			 </header>

					 <h1>POISSON & Cie</h1>
					 <img id="image_aquarium" src="images/aquarium3.jpg" alt="" />


					 <div class="images_services">
						 <img src="images/waw.jpg" alt="" />
						 <h2>NOS SERVICES<br />___</h2> 
					 	<br /><br />
						

					 	<div id="services">
								<div id="nos_services">
									<h3>INFORMATION</h3>
									<p>Le client, depuis une application sur son smartphone, pourra être informer des différents paramètres de vie des poissons et sera aussi informer en cas d'intervention humaine sur son aquarium lors de disfonctionnement</p>
							 </div>

							 <div id="nos_services">
									<h3>TÉLÉSURVEILLANCE ET TÉLÉGESTION</h3>
									<p>Un superviseur distant sera informer des différents paramètres de vie des poissons et pourra commander certains dispositifs</p>
							 </div>

							 <div id="nos_services">
									<h3>INTERVENTION</h3>
									<p>En cas de disfonctionnement non réglable à distance, un agent sera envoyé immédiatemment afin de résoudre ce disfonctionnement</p>
							 </div>
					 	</div><br /><br /><br /><br /><br />
					 </div>

					 <div id="contact">
						<h4>Nous contacter</h4>

						 <form method="POST" action="">
							<input id="prenom" type="text" name="prenom" placeholder="Prénom">
							<input id="nom" type="text" name="nom" placeholder="Nom de famille">
							<input id="email" type="email" name="mail" placeholder="E-mail">
							<input id="tel" type="text" name="tel" placeholder="Téléphone">
							<textarea id="message" type="text" name="msg" placeholder="Ajoutez votre message ici ..."></textarea>
							<input type="submit" id="envoyer" name="mailform" value="Envoyer">
						 </form>

						 <h5>
						 <?php
        				 if(isset($erreur)) {
       					 echo '<font color="#FFFFFFF">'.$erreur."</font>";
       					 }
        				 ?>
        				 </h5>

						<img id="contact_fond" src="images/aquarium2.jpg" alt="" />
					 </div>

					 <footer>            
					 </footer>

	</body>
</html>