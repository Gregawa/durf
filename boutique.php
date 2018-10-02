<?php 
    require 'db.class.php';

    $DB = new DB();
?>
   
<?php

//var_dump();


//$DB->query('SELECT * FROM products')

?>
    
    
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   La boutique <br><br>
   
   
   
 <!-- Search Box -->
<body>
   
   
    <form action="" method="GET">
        <input id="search" name="keywords" type="text" placeholder="Nom du produit">
        <input id="submit" type="submit" value="Rechercher">
    </form>
    
    
</body>


<?php 

$connection = mysql_connect("localhost","root","");

mysql_select_db("durf")or die(mysql_error());

$keywords = isset($_GET['keywords']) ? '%'.$_GET['keywords'].'%' : '';

$result = mysql_query("SELECT name FROM products WHERE name like '$keywords'");
while ($row = mysql_fetch_assoc($result)) {
    
    
    
    echo "<div id='link' onClick='addText(\"".$row['name']."\");'>" . $row['name'] . "</div><div>
    <img src='img/test.jpg' alt='' height='150' width='150'></div>";
    
    
    echo "ttt";
     echo $row['img'];
    
    
    //$resultImg = mysql_query("SELECT img FROM products ");
        //while ($row = mysql_fetch_assoc($resultImg)) {
    
   // echo '<img src="img/'.$resultImg.'" alt="" >';
    
    
    
    
    //$img=mysql_query("SELECT img FROM products where name like '$keywords'");
    
     //var_dump(img);
   
    
}
?>
<!-- Fin de la Search Box -->


<?php
    //Ajout au panier
    
    
    
    
    
    //Fin Ajout au panier
    
?>
</body>
</html>