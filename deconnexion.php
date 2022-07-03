<?php session_start();
 if (isset($_SESSION['username'])) {
    echo $_SESSION['username'];}
else {
    header(Location: "login.php");
}
?>

<?php    if (isset($_POST['deconnexion'])) {
        session_destroy();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>projet3</title>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
</head>
<body>
   
    <button name="deconnexion">Deconnexion</button>
    
</body>
</html>