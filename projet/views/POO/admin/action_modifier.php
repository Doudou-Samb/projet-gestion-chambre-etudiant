<?php
require 'bdd/database.php';
global $connect;

if(isset($_POST['valider'])){
    extract($_POST);

    if(!empty($id) && !empty($batiment_act) && !empty($chambre_act) && !empty($batiment_dest) && !empty($chambre_dest)){

        //verifie si l etudiant exist dans la base de donnee

        $idExist=$connect->prepare('SELECT * FROM chambre WHERE id_etudiant=? and numero_chambre=? and nom_batiment=?');
        $idExist->execute([$id,$chambre_act,$batiment_act]);
        $resultat=$idExist->rowCount();
        if($resultat!=0){
             //verifie si la chambre de destination n est pas pleine
             $etudiant_max=$connect->prepare('SELECT * FROM chambre where numero_chambre=? and nom_batiment=? ');
             $etudiant_max->execute([$chambre_dest ,$batiment_dest]);
             $max=$etudiant_max->rowCount();
             if($max<5){
            // si ellle n est pas pleine on modifie 
            $modif=$connect->prepare('UPDATE chambre SET numero_chambre=?,nom_batiment=? WHERE id_etudiant=?');
            $modif->execute([$chambre_dest,$batiment_dest,$id]);


              //verifie s il existe un batiment
              $batimentExist = $connect->prepare('SELECT nom_batiment,nom_batiment FROM batiment WHERE nom_batiment=? and numero_chambre=?');
              $batimentExist->execute([$batiment_dest,$chambre_dest]);
              $result=$batimentExist->rowCount();
              if($result==0){
                  
                  //ajouter un batiment
                  $ajouter_batiment=$connect->prepare('INSERT INTO batiment(nom_batiment,numero_chambre)VALUES(?,?)');
                  $ajouter_batiment->execute([$batiment_dest,$chambre_dest]);
              }
              header('Location: ./modif_reussie.php');
             }else{
                echo 'la chambre de destination est pleine';
             }
        }else{
            echo 'cet identifiant n existe pas';
        }


    }else{
        echo 'veuillez renseigner tous les champs';
    }
}

















?>