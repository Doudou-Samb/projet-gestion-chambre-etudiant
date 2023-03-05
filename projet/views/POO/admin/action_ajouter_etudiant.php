<?php
        require 'bdd/database.php';
        global $connect;
        if(isset($_POST['valider'])){
            extract($_POST);
               
                if(!empty($nom) && !empty($prenom) && !empty($id) && !empty($numero_chambre) && !empty($batiment)){
                    //verifie  si le nom de l etudiant se trouve dans la base de donnees
                    $nomExist = $connect->prepare("SELECT nom FROM etudiant WHERE nom=?");
                    $nomExist->execute([$nom]);
                    $resultat =$nomExist->rowCount();
                    if($resultat==0){
                            echo 'ce nom n existe pas';
                    }


                    //verifie si le prenom de l etudiant se trouve dans la base de donnees
                        $prenomExist = $connect->prepare('SELECT prenom FROM etudiant WHERE prenom=?');
                        $prenomExist->execute(array($prenom));
                        $resultat2 =$prenomExist->rowCount();
                        if($resultat2==0){
                            echo 'ce prenom n existe pas';
                        }
                        
                    //verifie si l'identifiant se trouve dans la base de donnees
                            $idExist = $connect->prepare("SELECT id_etudiant FROM etudiant WHERE id_etudiant=?");
                            $idExist->execute([$id]);
                            $resultat3 =$idExist->rowCount();
                            if($resultat3!=0){
                                
                                //verifie s il existe un batiment
                                $batimentExist = $connect->prepare('SELECT nom_batiment,nom_batiment FROM batiment WHERE nom_batiment=? and numero_chambre=?');
                                $batimentExist->execute([$batiment,$numero_chambre]);
                                $result=$batimentExist->rowCount();
                                if($result==0){
                                    
                                    //ajouter un batiment
                                    $ajouter_batiment=$connect->prepare('INSERT INTO batiment(nom_batiment,numero_chambre)VALUES(?,?)');
                                    $ajouter_batiment->execute([$batiment,$numero_chambre]);
                                }
                                
                    //verifie si une chambre existe
                                $chambreExist = $connect->prepare('SELECT numero_chambre FROM chambre WHERE numero_chambre=?');
                                $chambreExist->execute([$numero_chambre]);
                                $resultat4 =$chambreExist->rowCount();
                                $resultat5 =$chambreExist->fetch();
                                
                                if($resultat4==0 || $resultat4!=0){
                                
                                    //verifie si la chambre n est pas pleine
                                    $etudiant_max=$connect->prepare('SELECT * FROM chambre where numero_chambre=? and nom_batiment=? ');
                                    $etudiant_max->execute([$numero_chambre ,$batiment]);
                                    $max=$etudiant_max->rowCount();
                                    if($max<5){
                                         // si elle n est pas pleine on cree une chambre
                                    $ajouter_chambre =$connect->prepare("INSERT INTO chambre(numero_chambre,id_etudiant,nom_batiment)VALUES(?,?,?)");
                                    $ajouter_chambre->execute([$numero_chambre,$id,$batiment]);

                                    header('Location:./ajout_reussie.php');
                                    }else{
                                        echo 'la chambre est pleine';
                                    }
                                    
                                    
                                   

                                    }
                                  
                                }else{
                                    echo 'cet identifiant n existe pas';
                                    }    
                                
                    

                 
                    
                    }else{
                        echo 'veuillez renseigner tous les champs';
                }
               
                }
            
        
    ?>