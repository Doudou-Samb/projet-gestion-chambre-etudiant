<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/list_etudiant.css">
    <title>Document</title>
</head>
<body>
    
<div class="elipse"></div>
    <a href="admin.php">
    <div class="retour"></div>
    <p class="text_retour"> Retour</p>
    <div class="elipse2"></div>
    <img src="asset/img/fleche-arriere.png" class="retour2">
    </a>
<div class="fond_gris">


  
  
 
    <h1>Liste des etudiants</h1>
	<?php
		 require 'bdd/database.php';
		$requete = "SELECT nom,prenom,id_etudiant FROM etudiant";
		$resultat = $connect->query($requete)->fetchAll();
        $resultat2=$connect->query('SELECT * FROM chambre ')
        
        ?>

        <table class="tab1">
        
                    <tr>
                        <td>Nom</td>
                        <td>prenom</td>
                        <td>Identifiant</td>
                    
                    </tr>
               
              
                <?php foreach ($resultat as $value){ ?>
          <tr>
          
            <td><?php echo $value['nom'];?> </td> 
           <td> <?php echo $value['prenom'];?></td> 
            <td><?php echo $value['id_etudiant'];?></td> <br>
          
                </tr>
               
         

            <?php }  ?>
        
            </table > 
                   
            <table class="tab2">

            <tr>
                    <td>Identifiant</td>
                    <td>Numero chambre</td>
                    <td>Nom batiment</td>


                    </tr>
                    <?php foreach ($resultat2 as $value2){ ?>
                    <tr>
                        <td><?php echo $value2['id_etudiant']  ?></td>
                        <td><?php echo$value2['numero_chambre'] ?></td>
                        <td><?php  echo $value2['nom_batiment']?></td>
                    </tr>
                    <?php } ?>




            </table>

   
</div>
</body>
</html>