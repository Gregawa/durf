<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/gif" href="img/favicon.png">
    <link rel="stylesheet" type="text/css" href="css.css">
    <title>C'est Vous-Profil</title>
    
    
   
        
</head>

<body>
   
    <?php
    
session_start(); //permet d'utiliser les "$_SESSION" (la on les recupere)
    
    
    $bdd = new PDO('mysql:host=localhost;dbname=durf', 'root', '');
    
    

/* Charge le fichier config en fonction de si on charge fichier en local ou pas */
   
/*    if (file_exists('config-local.php')){
        
    include 'config-local.php';
}   
        
else{
    
    include('config.php'); 
}*/
           /*$bdd = new PDO('mysql:host=sqletud.u-pem.fr;dbname=gcolombe_db', 'gcolombe', 'philippe');*/
    ?>

        




        <?php


    
    
    
if(isset($_SESSION['id'])){
    
 // si etudiant afficher le profil d'un étudiant
    
    /*echo "<a href='accueilEtudiant.php?type=".$_GET["type"]."&id=".$_SESSION["id"]."'><img src='Images/imgEtudiant.png' width='230px'></a><br><br>"; */

	$getId = intval($_GET['id']); //convertit en nombre
	$reqUser = $bdd->prepare('SELECT * FROM user WHERE id = ?');
	$reqUser->execute(array($getId));
	$userInfo = $reqUser->fetch();
    
    


    
    
    
    
        if(isset($_GET['id']) AND $_GET['id'] > 0 ) 
{
    
?>

Votre nom :<br><br>
<?php echo $userInfo['nom']; ?><br><br>
        
        
Votre E-mail :<br><br>
 <?php echo $userInfo['mail']; ?><br>            
               

                 
             
           
            <?php
  
    }
    ?>




                <?php
	if (isset($_SESSION['id']) AND $userInfo['id'] == $_SESSION['id'])
	{	
        echo "<br><br><br>";
        
        
		}
	?>


                    <?php

    
    ?>

   
    
    <?php

    
}
    
else{
    header("Location: connexion.php");
}
  
    ?>



</body>



</html>
