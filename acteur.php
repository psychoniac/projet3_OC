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
		if (isset($_GET['id'])) 
		{	
			$requeteSQL = "SELECT * FROM acteur WHERE id_acteur = :id";
			$requete = $db->prepare($requeteSQL);
			$acteurselect = $requete->execute(['id' => $_GET['id']]);
			$acteur = $requete->fetch();
		
			if (empty($acteur)); ?>
				<img class="logo_acteur" src="img/<?php echo $acteur['logo']; ?>"></br>
			
				<div class='nom_acteur2'>
				<?php	echo $acteur['acteur'];?></br>
				</div>
				<div class='description'>
				<?php echo $acteur['description'];?>

				<?php //on verifie que l'utilisateur est bien connecté via $_SESSION['id'],et que $_post envoyer et commentaire sont bien défini
				if (isset($_SESSION['username']) && !empty($_POST['envoyer']) && !empty($_POST['commentaire']) && !empty($_GET['id_acteur'])) {
		 			$commentaire = htmlspecialchars($_POST['commentaire']);
		 			$userLog = htmlspecialchars($_SESSION['username']);
		 			$acteurid = htmlspecialchars($_GET['id_acteur']);

		 			$requete = $db->prepare("INSERT INTO post(id_post,id_user,id_acteur,date_add,post) VALUES(NULL,$userLog,$acteurid,$commentaire)");
							$db->execute($requete);
				}?>
			</div>
				</br>
				<a href= 'like_dislike.php?vote=1 & id=<?php echo $_GET['id']; ?> & user=<?php echo $_SESSION['username']; ?>' >Like</a>	
				<a href= 'like_dislike.php?vote=0 & id=<?php echo $_GET['id']; ?> & user=<?php echo $_SESSION['username']; ?>' >Dislike</a>	

			</br>

	<?php echo date_add();
		echo $_SESSION['username']; ?>
	</br>
	<?php echo "peut poster un commentaire"; ?>

		<form method="post" action="acteur.php">
			<textarea name="commentaire" name="commentaire" rows="5" cols="250"></textarea>
			<input type="submit" name="envoyer">
		</form>
	</section>
<?php };	?>
				
	        

		
</body>

</html>