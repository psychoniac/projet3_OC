<?php session_start(); ?>
<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
?>
<?php include('connexion_bdd.php'); ?>

<!DOCTYPE html>
<html>

<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css">
		<title>Acteur</title>
</head>

<body>
	<?php include('en_tete.php'); ?>
	
	<h2>Les partenaires</h2>
	<?php 
		if (isset($_GET['id'])) {	
			$requeteSQL = "SELECT * FROM acteur WHERE id_acteur = :id";
			$requete = $db->prepare($requeteSQL);
			$acteurselect = $requete->execute(['id' => $_GET['id']]);
			$acteur = $requete->fetch();
		
			if (empty($acteur)); ?>
				<img class="logo_acteur" src="img/<?php echo $acteur['logo']; ?>"></br>
			
				<div class='nom_acteur2'>
				<?php			
				echo $acteur['acteur'];?></br>
				</div>

				<div class='description'>
				<?php
				echo $acteur['description'];
		}
	?></div>

	<section class="commentaire">
		<h4>Poster un commentaire</h4>
	<?php 
		if (isset ($_SESSION['username'])){
			echo $_SESSION['username'];
			echo "  ";
			echo "poster un commentaire pour";
			echo "   ";
			echo $_GET['nom'];
		}
		?>
	</br>
	<?php echo date('l \l\e jS'); ?>
		<form method="post" action="acteur.php">
			<textarea name="commentaire" id="commentaire" rows="5" cols="250"></textarea>
			<input type="submit" name="envoyer">
		</form>
	</section>
	        

			<?php    //on verifie que l'utilisateur est bien connecté via $_SESSION['id']
 
				if (isset($_SESSION['username'])){
					$commentaire = ($_POST['commentaire']);
					
				
					if (isset($_POST['envoyer']) && !empty($_POST['commentaire'])){
					//on insere le commentaire
					$requeteSQL = $db->prepare("INSERT INTO post(post) VALUES (:post)");
					$requeteSQL->execute();
	
					}
		
					}	
					 
	?>
	<?php include('footer.php'); ?>
	



</body>

</html>


