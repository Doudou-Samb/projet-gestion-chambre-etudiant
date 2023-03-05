<?php
    //ajout de la base de donnees
    require('bdd/database.php');
    global $connect;
    //verifier si l utilisateur a appuye sur s inscrire
    if(isset($_POST['valider'])){
        extract($_POST);
        if(!empty($id) && !empty($nom) && !empty($prenom) && !empty($mdp) && !empty($email)){
                 //  verifie si l identidfiant existe dans la base de données
                 $idExist = $connect->prepare('SELECT id FROM administrateur where id = ? ');
                 $idExist -> execute([$id]);
                 if ($idExist->rowCount() == 0) {
                    //  verifie si l'utilisateur n'a pas entré l'email d'un admin
                    $adminExist = $connect->prepare('SELECT email FROM administrateur where email = ?');
                    $adminExist -> execute([$email]);
                    if($adminExist ->rowCount() == 0){
                              //  ajoute l'admin dans la base
                            $q = $connect->prepare('INSERT INTO administrateur(id,nom,prenom,mdp,email)VALUES(:id,:nom,:prenom,:mdp,:email)');
                            $q->execute([
                                'id' => $id,
                                'nom' => $nom,
                                'prenom' => $prenom,
                                'mdp' => $mdp,
                                'email' => $email
        
                            ]); 
                            header('Location: ./enregistrer_reussie.php');
                       
                    }else{
                            $e = "Cette adrresse Email existe deja.";
                           echo $e; 
                    }
                }else{
                    $e = "Cet identifiant existe déja .";   
                    echo $e;
                }
            }else{
            $e = "Veuillez Remplir tous les champs .";
            echo $e;
            }
    }
                        
    


   ?>