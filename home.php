<?php session_start();
include( 'connexion_bdd.php' );
if (!empty($_SESSION)) {
    echo $_SESSION['nom'];
    echo $_SESSION['prenom']; 
    
    echo "vous êtes bien connecté.";   
} else {
    header('Location: login.php');
}
?>
