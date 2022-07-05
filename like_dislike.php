<?php session_start();  
	//on se connecte a la BDD 
	include('connexion_bdd.php');
	//on check qu_un utilisateur est connecte et que les variable existe et ne sont pas null
	if (!empty($_GET['vote']) && (!empty($_SESSION['id'])) && (!empty($_GET['acteurId']))) {
		//on protege nos variables
		$id_acteur = htmlspecialchars($_GET['acteurId']);
		$userConnect = htmlspecialchars($_SESSION['id']);
		$likeDislike = htmlspecialchars($_GET['vote']);
	
		//on verifie si lid acteur et lid user on deja un vote
		$req1 = $db->prepare('SELECT * FROM vote WHERE id_acteur = ? AND id_user = ?');
		$req1->execute(array($id_acteur, $userConnect));
		$voteExist = $req1->rowCount();
		//si le vote n'existe pas
		if ($voteExist == 0){
			if ($likeDislike == 1 || $likeDislike == 0)  {
				$like = $db->prepare('INSERT INTO vote(id_user,id_acteur,vote) VALUES (:iduser, :id_acteur, :likeDislike)');
				$like->execute(array('iduser' => $userConnect,'id_acteur' => $id_acteur,'likeDislike' => $likeDislike));
				header('Location: acteur.php');
			}
		} else {
			//on recupere la valeur du vote existant
			$req2 = $db->prepare('SELECT vote FROM vote WHERE id_acteur = ? AND id_user = ?');
			$req2->execute(array($id_acteur,$userConnect));
			$vote = $req2->fetch();
			//on met la valeur du vote dans une variable
			$valeurvote = $vote['vote'];
			//si la valeur du vote est differente du vote du formulaire on met à jour la valeur de la BDD
			if ($valeurvote != $likeDislike) {
				$update = $db->prepare("UPDATE vote SET vote = :vote WHERE id_user = :iduser AND id_acteur = :id");
				$update->execute(array($likeDislike,$id_acteur));
			} else {
				echo "vous avez deja voter de cette facon pour cette acteur";
			}
			
		}
		
	}?>
	 
	
	
	 
