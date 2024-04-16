<?php 
try{
    $pdo=new PDO('mysql:host=localhost;dbname=todo','root','');
}catch(PDOException $e){
    die("erreur connexion: ".$e->getMessage());
}

?>