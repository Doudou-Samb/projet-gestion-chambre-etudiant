<?php

require 'bdd/database.php';
global $connect;

 if(isset($_POST['connexion'])){
    extract($_POST);

    if(!empty($id) && !empty($mdp)){

        $idExist = $connect->prepare('SELECT id_etudiant,mdp FROM etudiant WHERE id_etudiant=? and mdp=?');
        $idExist->execute([$id,$mdp]);
        $resultat= $idExist->rowCount();
            if($resultat!=0){

               
                header('Location: log_etudiant.php');
               
            }else{
                echo 'l identifiant ou le mot de passe n existe pas';
            }


      
    }else{
        echo 'veuillez remplir tous les champs';
    }
}
 
?>