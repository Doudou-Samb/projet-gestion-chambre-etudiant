<?php
    //ajout de la base de donnees
    require('bdd/database.php');
    global $connect;
    //verifier si l utilisateur a appuye sur s inscrire
    if(isset($_POST['valider'])){
        extract($_POST);
        if(!empty($id) && !empty($nom) && !empty($prenom) && !empty($mdp) && !empty($email)){
                 //  verifie si l identidfiant existe dans la base de données
                 $idExist = $connect->prepare('SELECT id_etudiant FROM etudiant where id_etudiant = ? ');
                 $idExist -> execute([$id]);
                 if ($idExist->rowCount() == 0) {
                    //  verifie si l'utilisateur n'a pas entré l'email d'un admin
                    $adminExist = $connect->prepare('SELECT email FROM administrateur where email = ?');
                    $adminExist -> execute([$email]);
                    if($adminExist ->rowCount() == 0){
                        //  verife si l'email existe dans la base de données
                        $emailExist = $connect->prepare('SELECT email FROM etudiant where email = ?');
                        $emailExist -> execute([$email]);
                        if($emailExist ->rowCount() == 0){
                              //  ajoute l'etudiant dans la base
                            $q = $connect->prepare('INSERT INTO etudiant(id_etudiant,nom,prenom,mdp,email)VALUES(:id_etudiant,:nom,:prenom,:mdp,:email)');
                            $q->execute([
                                'id_etudiant' => $id,
                                'nom' => $nom,
                                'prenom' => $prenom,
                                'mdp' => $mdp,
                                'email' => $email
        
                            ]); 
                            header('Location: inscription_reussie.php');
                        }else{
                            $e = "Cette adrresse Email existe deja.";
                           echo $e;
                        }
                    }else{
                        $e = "Cette adrresse Email existe deja.";
                        echo $e;
                    }
                }else{
                    $e = "Cet identifiant est déja inscrit dans le site.";   
                    echo $e;
                }
            }else{
            $e = "Veuillez Remplir tous les champs .";
            echo $e;
            }
    }
                        
    


   ?>