<!doctype html>
<html lang="fr">

<head>
    <link rel="icon" type="image/gif" href="img/favicon.png">
    <link rel="stylesheet" type="text/css" href="css.css">
    
    <title>C'est Vous-Connexion</title>
    <meta charset="UTF-8">
</head>

<body>
   <a href="index.php">Accueil</a>
    <header>
    
    <?php
        
        
session_start(); //permet d'utiliser les "$_SESSION"
    
    if (isset($_GET['msg'])){
        echo "Compte crée";
    }

/*$bdd = new PDO('mysql:host=sqletud.u-pem.fr;dbname=gcolombe_db', 'gcolombe', 'philippe');*/
        
    $bdd = new PDO('mysql:host=localhost;dbname=durf', 'root', '');
      
    
/* Charge le fichier config en fonction de si on charge fichier en local ou pas */
   
/*    if (file_exists('config-local.php')){
        
    include 'config-local.php';
}   
        
else{
    
    include('config.php'); 
}*/
        

        


if (isset($_POST['formConnexion']))
{
	$emailConnect = htmlspecialchars(addslashes($_POST['emailConnect']));
	$mdpConnect = sha1($_POST['mdpConnect']);
    
    
    
    $UserEtudiant=0;
    
    
	if (!empty($emailConnect) AND !empty($mdpConnect))
	{
        
       // echo "<br> userExist = ".$userEtudiantExist." !";
        
        
       $reqUser=$bdd->prepare("SELECT * FROM user WHERE mail = ? AND mdp=? ");
		$reqUser->execute(array($emailConnect, $mdpConnect));
		$userEtudiantExist=$reqUser->rowCount();
        
        

            
            
            if($userEtudiantExist == 1){
                
                
                $userInfo = $reqUser->fetch();
			    $_SESSION['id'] = $userInfo['id'];
                $_SESSION['nom'] = $userInfo['nom'];
                $_SESSION['mail'] = $userInfo['mail'];
                
                /*header("Location: profil.php?id=".$_SESSION['id']);//redirige vers le profil de la personne selon l'id*/
                
                
                header("Location: index.php?id=".$_SESSION['id']);
                
            }
		else
		{
			$erreur="Mauvais email ou mot de passe";
		}
        

	}
	else
	{
		$erreur="Tout les champs doivent etre complétés ! ";
	}
}

?>

    


    <div class="wrapper">
       
      
         
        <?php
        echo "<a href='index.php'><img src='Images/imgNeutre.png' width='230px'></a><br><br>";
        ?>
        
        
    </div>
</header>

        <div class="zoneConnexion pageconnexion">
            
            <form method="POST" action="">
                <label>Email</label>
                <input type="email" name="emailConnect" placeholder="Email" />
                <label>Mot de passe</label>
                <input type="password" name="mdpConnect" placeholder="Mot de passe"/>

                <input type="submit" class="button"name="formConnexion" value="Connexion"/>

    
                <p class="message">Vous n'ètes pas enregistré. <a class="lien message" href="inscription.php">Creer un compte</a></p>
            </form>
        </div>



        <?php
		if (isset($erreur))
		{
			echo '<font color="red">'.$erreur.'</font>';
		}

	?>
</body>

</html>
