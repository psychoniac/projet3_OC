<?php session_start();
 include( 'connexion_bdd.php' );
 if (!empty($_SESSION)) {
        echo $_SESSION['nom'];
        echo $_SESSION['prenom']; 
        echo "vous êtes bien connecté."; 
} else {
            header('Location: login.php');
         }  
//on se place dans le formulaire 
if (isset($_POST['envoyer'])) {
    //on verifie que $_GET['id] n'est pas vide 
    if (!empty($_GET['id'])) {
        $id_user = htmlspecialchars($_SESSION['id']);
        $id_acteur = htmlspecialchars($_GET['id']);
            
        //on verifie que le commentaire n'est pas vide 
            if (!empty($_POST['commentaire'])) {
            //on renomme les variables 
            $commentaire = htmlspecialchars($_POST['commentaire']);
            //on effectue la requete qui va inserer le commentaire
            $requete = $db->prepare('INSERT INTO post(id_user,id_acteur,post) VALUES (:id_user,:id_acteur,:post)');
            $requete->execute(array(
                'id_user' => $id_user,
                'id_acteur' => $id_acteur,
                'post' => $commentaire));
                if (isset($requete)) {
                    echo "votre commentaire est bien enregistré";
                }
            } else {
                echo "tous les champs doivent etre rempli";}
    } else {
        header('Location: home.php');
    }            
              
}    
?>
