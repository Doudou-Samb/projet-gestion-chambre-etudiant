<?php
include 'bdd/database.php';
global $connect;
 if(isset($_POST['connexion'])){
    extract($_POST);
    if(!empty($id) && !empty($mdp)){
        $idExist = $connect->prepare('SELECT id FROM administrateur WHERE id=:id');
        $idExist->execute(['id'=>$id]);
        $resultat= $idExist->fetch();
        if($resultat==true){
            $mdpExist = $connect->prepare('SELECT * FROM administrateur WHERE mdp=:mdp');
            $mdpExist->execute(['mdp'=>$mdp]);
            $resultat2= $mdpExist->fetch();
            if($resultat2==true){
               header("Location:admin.php");
            }else{
                echo "l identifiant ou le mot de passe n'existe pas";
            }
        }else{
            echo "l identifiant ou le mot de passe n'existe pas";
        }
    }else{
        echo 'veuillez remplir tous les champs';
    }
 }