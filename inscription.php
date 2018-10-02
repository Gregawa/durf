
<!doctype html>
<html lang="fr">
    

<head>
   <link rel="icon" type="image/gif" href="img/favicon.png" >
   <link rel="stylesheet" type="text/css" href="css.css">
   <style>
		@import url('https://fonts.googleapis.com/css?family=Roboto');
	</style>
   <title>Inscription</title>
   <meta charset="UTF-8">
</head>
<body>

<?php 

/*$bdd = new PDO('mysql:host=localhost;dbname=cv', '', '');*/
    
/* Charge le fichier config en fonction de si on charge fichier en local ou pas */
   
    /*if (file_exists('config-local.php')){
        
    include 'config-local.php';
}   
        
else{
    
    include('config.php'); 
    
    
    
}*/
    //Ancienne BDD
       /* 
       
       $bdd = new PDO('mysql:host=localhost;dbname=durf', 'root', ''); 
       
       */
    $bdd = new PDO('mysql:host=localhost;dbname=durf', 'root', ''); 
    

if(isset($_POST['submit']))
{
 
 /*   
$fichier = basename($_FILES['image']['name']);
    
$taille_maxi = 5900000;
$taille = filesize($_FILES['image']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
$extension = strrchr($_FILES['image']['name'], '.'); 
*/





        $nom=htmlspecialchars(addslashes($_POST['nom']));
        $prenom=htmlspecialchars(addslashes($_POST['prenom']));
		$mdp=sha1($_POST['mdp']); //floutte le mdp
		$mdp2=sha1($_POST['mdp2']); //floutte le mdp2
		$email=htmlspecialchars(addslashes($_POST['email']));
		
        //$image=$_FILES['image'];
            
        /*$image = implode(', ', $_FILES['image']);*/

      
/*header("Location: connexion.php?msg");*/



	if(
        !empty($_POST['nom'])AND 
        !empty($_POST['prenom'])AND
       !empty($_POST['mdp'])AND!empty($_POST['mdp2'])AND
        !empty($_POST['email']))
	{

		$nomlength= strlen($nom);
		if ($nomlength <= 30)	//Plus de 30 caracteres ?
		{
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) //Email validée ?
			{
				
				$reqnom=$bdd->prepare("SELECT * FROM user WHERE nom=?");
				$reqnom->execute(array($nom));
				$nomExist=$reqnom->rowCount();
				if($nomExist == 0)	//Nom deja utilisée ?
					{
							$reqmail=$bdd->prepare("SELECT * FROM user WHERE mail=?");
							$reqmail->execute(array($email));
							$emailExist=$reqmail->rowCount();
							if($emailExist == 0)	//Email deja utilisée ?
								{


									if($mdp == $mdp2) //Les mots de passe correspondent ?
									{
                                        
                                        
                                        
   /*                                     
                                        
                                        



//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
   
}
if($taille>$taille_maxi)
{
     $erreur = 'Le fichier est trop gros...';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
     if(move_uploaded_file($_FILES['image']['tmp_name'], $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          /*echo 'Upload effectué avec succès !';
          echo "<src img='-7A1F27D4A2F5CB1A5DB407AB1475F24BB47165BEBA48152077-pimgpsh-thumbnail-win-distr.jpg'>";
          echo '<br><br><br><img src='.$fichier.'>';*/
         
         
         
                $insertMembre=$bdd->prepare ("INSERT INTO user(nom,prenom,mdp,mail) VALUES(?,?,?,?)");
                                        
            
                $insertMembre->execute(array($nom,$prenom,$mdp,$email));
         
                //var_dump($image);
            
                            //header("Location: connexion.php?msg");
                $pasErreur="Votre compte a bien été crée !<br> <a href=\"connexion.php\" class='retourAccueil'>Me connecter</a>";
                                        
                                        
         //echo $fichier;
         
                                        
                                        /*
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}
else
{
     echo $erreur;
}


      */                                  
                                        
                                        
                                        
                                        
                                       }
									else
									{
										$erreur="Les mots de passe ne correspondent pas !";
									}
							}
							else
							{
								$erreur="Adresse mail déjà utilisée !";
							}
					}
				else
				{
					$erreur="Ce Nom est déjà utilisée !";
				}
			}
			else
			{
				$erreur="Votre adresse mail n'est pas valide !";
			}
		}
		
		else
		{
			$erreur= "Votre Nom ne doit pas dépasser 30 caractères !";
		}
	}
	else
	{
		$erreur="Tout les champs doivent etre complétés !";
	}


}
?>
	
	

    
<header>
    <div class="wrapper">
        <a href=index.php><img class="image" src="Images/C'EST%20VOUS.png" alt=""></a>
        
    </div>
</header>	
	
<div class="inscription">
<div class="formE">

<form  class="login-form" method="POST" action="" enctype="multipart/form-data" >
    
<!--<p class="message">Vous ètes <a>ÉTUDIANT</a></p>-->

<label>Nom</label>
<input type="text" placeholder="Votre nom" name="nom" id="nom" value="<?php if(isset($nom))
					{
echo $nom; //laisser ce que l'utilisateur a ecrit
					}?>" />

<label>Prénom</label>		
<input type="text" placeholder="Votre prenom" name="prenom" id="prenom" value="<?php if(isset($prenom))
					{
echo $prenom; //laisser ce que l'utilisateur a ecrit
					}?>" />

<!--<label for="dateNaissance">Date de naissance</label>-->



		
<!--<input type="hidden" name="MAX_FILE_SIZE" value="90000000">-->

<label>Email</label>
<input type="Email" placeholder="Votre Email" name="email" id="email" value="<?php if(isset($email))
					{
echo $email; //laisser ce que l'utilisateur a ecrit
					}?>"/>
		    
<!--<label for="image">Photo de profil</label>
<input type="file" name="image" id="image"/>-->

 <label>Mot de passe</label>
<input type="password" placeholder="Votre mot de passe" name="mdp" id="mdp"/>

<label>Confirmation mot de passe</label>
<input type="password" placeholder="Comfirmer votre mot de passe" name="mdp2" id="mdp2"/>
	



	
<input class="button" type="submit" name="submit" value="Inscription">
    
</form>
</div>












    <!-- RECRUTEURS : -->


<!-- Inscription recruteur-->



</div>





<br><br>


<div align="center">
	<?php
		if (isset($erreur))
		{
			echo '<div class="formERREUR ">
     
    <form class="login-formERREUR ">
      <p class="message"><a>ERREUR</a></p>
      <p class="message1">'.$erreur.'</p>
      
    </form>
  </div>';
		}



		if (isset($pasErreur))
		{
			echo '<div class="formVALIDATION">
     
    <form class="login-formVALIDATION">
      <p class="message"><a>VALIDATION</a></p>
      <p class="message1">'.$pasErreur.'</p>
      
    </form>
  </div>';
		}

	?>
</div>
</body>
   
   
   
   
   
   <style>
    /*
 
    
    
    .login-formVALIDATION {
  width: 100%;
  padding: 8% 0 0;
  margin: auto;
}    
    
.formVALIDATION {
  display: flex;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 10px;
  padding: 0px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
  margin-top: 155vh;
  z-index: 999;
  margin-bottom: 20vh;
}
    

    
.formVALIDATION button:hover,.formVALIDATION button:active,.formVALIDATION button:foscus {
  background-color: dimgray;
  transition-duration: 0.3s;
  
}
.formVALIDATION .message {
  margin: 15px 0 0;
  margin-top: 0%;
}
.formVALIDATION .message a {
  color: green;
  text-decoration: none;
  font-size:2.5em;
  
}

    
.formVALIDATION .message a:hover{color: grey;
                        transition-duration: 0.3s;}
    
.formVALIDATION .message a: {transition-duration: 0.3s;}

.formVALIDATION .message::selection {
 background-color: grey;
}

.formVALIDATION .message a::selection {
 background-color: grey;
}
    
    .formVALIDATION .retour a{
        color: green;
        text-decoration: none;
        font-size:1em;
        transition-duration: 0.5s;
        }
    
    .formVALIDATION .retour a:hover{
        color: grey;
        cursor: pointer;
        transition-duration: 0.5s;
    }
    
    .formVALIDATION .message1{font-size: 1rem;
                    color: grey;
                    margin-bottom: 30px;}

    
    
    
    
    
    
    
    
    
    
    
.login-formERREUR {
  width: 100%;
  padding: 8% 0 0;
  margin: auto;
}    
    
.formERREUR {
  display: flex;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 10px;
  padding: 0px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
  margin-top: 155vh;
  z-index: 999;
  margin-bottom: 20vh;
}
    

    
.formERREUR button:hover,.formERREUR button:active,.formERREUR button:foscus {
  background-color: dimgray;
  transition-duration: 0.3s;
  
}
.formERREUR .message {
  margin: 15px 0 0;
  margin-top: 0%;
}
.formERREUR .message a {
  color: red;
  text-decoration: none;
  font-size:2.5em;
  
}

    
.formERREUR .message a:hover{color: grey;
                        transition-duration: 0.3s;}
    
.formERREUR .message a: {transition-duration: 0.3s;}

.formERREUR .message::selection {
 background-color: red;
}

.formERREUR .message a::selection {
 background-color: grey;
}
    
    .formERREUR .retour a{
        color: red;
        text-decoration: none;
        font-size:1em;
        transition-duration: 0.5s;
        }
    
    .formERREUR .retour a:hover{
        color: grey;
        cursor: pointer;
        transition-duration: 0.5s;
    }
    
    .formERREUR .message1{font-size: 1rem;
                    color: grey;
                    margin-bottom: 30px;}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
@import url(https://fonts.googleapis.com/css?family=Roboto:300);

@import "compass/css3";


    
.login-form {
  width: 100%;
  padding: 8% 0 0;
  margin: auto;
}

  
.formE {
  display: flex;
  z-index: 1;
  background: white;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
  float: left; 
  margin-left: 15%;
  margin-top: 10vh;
}

.formE input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
  transition-duration: 0.3s;
}
    
.formE input:hover{color: #28c19b;
                   transition-duration: 0.3s;}
.formE input:active{color: #28c19b;
                    transition-duration: 0.3s;}
    
.formE input::selection {
 background-color: grey;
 color: #28c19b;
}
    

.formE select {
        
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
  color:dimgray;
  height: 6%;
    }
.formE .button {
  margin-top:2vh;
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #28c19b;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
  transition-duration: 0.3s;
}
.formE .button:hover,.formE .button:active,.formE .button:focus {
  background-color: dimgray;
  transition-duration: 0.3s;
  
}
    
.formE .imput:active{border: 1px solid #2d3e50;}
    
.formE .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
  margin-bottom: 10%;
  margin-top: 0%;

}
.formE .message a {
  color: #28c19b;
  text-decoration: none;
  font-size:3em;
  
}
    
.formE .button a {text-decoration: none;
                  color: white;
                   }
    
    
.formE .message a:hover{color: grey;
                        transition-duration: 0.3s;}
    
.formE .message a:{transition-duration: 0.3s;}
    
.formE .message::selection {
 background-color: grey;
 color: #28c19b;
}

.formE .message a::selection {
 background-color: grey;
 color: #28c19b;
}    
    

    
    
    
    

.formR {
  display: flex;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
  float:right;
  margin-right: 15%;
  margin-top: 10vh;
}
.formR input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
  transition-duration: 0.3s;
    
}

.formR input:hover{color: #f59782;
                   transition-duration: 0.3s;}
.formR input:active{color: #f59782;
                    transition-duration: 0.3s;}
    
.formR input::selection {
 background-color: grey;
 color: #f59782;
}
    
.formR .button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #f59782;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
  transition-duration: 0.3s;
}
.formR .button:hover,.formR .button:active,.formR .button:focus {
  background-color: dimgray;
  transition-duration: 0.3s;
  
}
.formR .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
  margin-bottom: 10%;
  margin-top: 0%;
}
.formR .message a {
  color: #f59782;
  text-decoration: none;
  font-size:3em;
  
}

.formR button a {text-decoration: none;
                  color: white;}
    
.formR .message a:hover{color: grey;
                        transition-duration: 0.3s;}
    
.formR .message a: {transition-duration: 0.3s;}

.formR .message::selection {
 background-color: grey;
 color: #f59782;
}

.formR .message a::selection {
 background-color: grey;
 color: #f59782;
}

body {
  background:white; 
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale; font-family: "Roboto", sans-serif;
     
}
    
label{color: black;
      float: left;
      margin-bottom: 1vh;}
    
header {

        left: 0px;
        right: 0px;
        top: 0px;
        height: 20%vh;
        }   
    
 .wrapper{display: flex;
              margin-left: 5%;}
    
    
.wrapper h1 a{position: relative;
            text-decoration: none;
              color: dimgrey;
                margin-top: 10vh;}    
    
.wrapper h1 a:hover{text-decoration: none;
              color: black;}
    
    .image{width: 50%;}
    
    .titrepage{font-size: 4em;
                color: dimgray;
                margin-left: 30%;
                margin-top: 4vh;}
       
*/

</style> 
    
</html
    

    
    


