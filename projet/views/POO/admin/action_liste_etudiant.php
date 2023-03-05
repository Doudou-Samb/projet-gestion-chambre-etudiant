<?php 
require '../../bdd/database.php';
global $connect;
$sql=('SELECT *FROM etudiant');
$result=mysqli_query($connect,$sql) or die ('erreur');

while($liste=mysqli_fetch_all($result)){
    echo "{$liste['prenom']} {$liste['nom']} {$liste['Identifiant']} ";
}





?>