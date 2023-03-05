<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/log_etudian.css">
    <title>Document</title>
   

</head>
<body>
 
    <form method="post">
    <input type="text" name="id" class="id" placeholder="votre identifiant">
    <input type="text" name="mdp" class="mdp" placeholder="votre mot de passe">
    <input type="submit" name="valider" class="valider">
    <p class="text_id">Id et mot de passe:</p>
  <a href="etudiant.php">
   <div class="elipse"><img src="asset/img/chevron-fleche-vers-le-bas.png" class="img"> </div>
   </a>
    </form>

     
        <?php 
    
    require 'bdd/database.php';
    global $connect;


    if(isset($_POST['valider'])){
        extract($_POST);
        $exist=$connect->prepare('SELECT id_etudiant,mdp FROM etudiant where id_etudiant=? and mdp=?');
        $exist->execute([$id,$mdp]);
        if($exist->rowCount()!=0){
            $chambre=$connect->prepare('SELECT numero_chambre FROM chambre where id_etudiant=?');
            $chambre->execute([$id]);
            $res=$chambre->fetch();

            $batiment=$connect->prepare('SELECT nom_batiment FROM chambre where id_etudiant=?');
            $batiment->execute([$id]);
            $res2=$batiment->fetch();
        }else{
            echo 'Identifiant ou mot de passe incorrect';
        }
       ?>
          
          <div class="chambre"></div>
        <p class="text_chambre">Votre Chambre:</p>
        <p class="message1"><?php echo $res['numero_chambre']  ?></p>
    
        <div class="batiment"></div>
        <p class="text_batiment">Votre batiment:</p>
        <p class="message2"><?php  echo $res2['nom_batiment']?></p>
   
       

        <?php }?>

    


</body>
</html>