<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   Index 
   <br>
   <!--
   
   <a href="inscription.php">S'inscrire</a>
   <a href="connexion.php">Connexion</a>
   
   -->
   <a href="boutique.php">Boutique</a>
   
   
   <br><br>
   
   <form action="" method="GET">
       
        <input id="search" name="keywords" type="text" placeholder="Nom du produit">
        <input id="submit" type="submit" value="Rechercher">
        
   </form>
    
   <?php
    //$bdd = new PDO('mysql:host=localhost;dbname=durf', 'root', '');
  
     
    ?>
    
    <?php 
    
    //Connection à la bdd 
    
    $connection = mysql_connect("localhost","root","");
    mysql_select_db("durf")or die(mysql_error());
    
   //Fin de la Connection     

    $keywords = isset($_GET['keywords']) ? '%'.$_GET['keywords'].'%' : '';

    $result = mysql_query("SELECT name FROM products where name like '$keywords'");
    
    
    while ($row = mysql_fetch_assoc($result)) 
        
    {
        echo "<div id='link' onClick='addText(\"".$row['name']."\");'>" . $row['name'] . "</div>";  
    }

?>
    
   
       
      
       
       
  
       
       
        
    <?php    
    session_start();
    
    if (isset($_SESSION['id'])){
        
    
   
        
        
    echo "<a href='profil.php?&id=".$_SESSION["id"]."'>Profil</a>";
        
        
    echo '
   <a href="deconnexion.php">Déconnexion</a>
   ';
        
        
        }
    
    else{
       
        echo '
   <a href="inscription.php">Inscription</a>
   ';
        
    echo '
   <a href="connexion.php">Connexion</a>
   ';
        
    }
    
    
    
    ?>
    
    <br><br>
    
    
</body>
</html>