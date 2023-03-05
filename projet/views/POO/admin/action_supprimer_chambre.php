<?php  
 
 require 'bdd/database.php';
 global $connect;

 if(isset($_POST['valider'])){
    extract($_POST);

    if(!empty($id) && !empty($numero_chambre) && !empty($batiment)){

        //on verifie si l idnetifiant existe
        $idExist=$connect->prepare('SELECT id_etudiant FROM chambre WHERE id_etudiant=?');
        $idExist->execute([$id]);
        $resultat1=$idExist->rowCount();
        if($resultat1!=0){
            //on supprime L etudiant de la chambre
            $supp_chambre=$connect->prepare('DELETE FROM chambre where id_etudiant=?');
            $supp_chambre->execute([$id]);

           header('Location: ./supp_reussie.php');


        }else{
            echo 'cet identifiant n a pas de chambre';
        }

        

    }else{
        echo 'veuillez renseigner tous les champs';
    }
 }




















?>