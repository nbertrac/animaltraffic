<?php
require_once('Database.php');
$cnn = new Database;
if(isset($_GET['id']) && !empty($_GET['id']));
$id=htmlspecialchars($_GET['id']);
$sql = "SELECT * FROM animal WHERE id=$id";
$query= $cnn->getData($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Details</title>
</head>
<nav>
    <ul>
        <li> <a href="index.php">Accueil</a> </li>
        <li> <a href="animals.php">Animaux</a> </li>
        <li> <a href="adminConnect.html">Administration</a></li>
    </ul>
    <form action="https://www.paypal.com/donate" method="post" target="_blank">
          <input type="hidden" name="hosted_button_id" value="CSVQM9UD3PV78" />
          <input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_donate_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Bouton Faites un don avec PayPal" />
          <img alt="" border="0" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1" />
    </form>
</nav>

<body>
    <div class="animal">
        <div class="animal-left">
            <img class="detail-img" src="<?php echo $query[0]->photo ?>" alt="animal">
            <h2>Nom: <?php  echo $query[0]->nom ?><h2>
            <h3>Race : <?php echo $query[0]->race ?><h3>    
            <h3>Age : <?php echo $query[0]->age ?><h3>
            <h3>Sexe : <?php echo $query[0]->sexe ?><h3>
            <h3>Sterile : <?php 
            if($query[0]->sterile) echo 'Oui';
            else echo 'Non'
             ?><h3>
        </div>
        <div class="animal-right">
            <form action="dc.php" method="post" class="form-adoption" enctype=multipart/form-data>
                <h2>Formulaire d'adoption:</h2>
                <input type="hidden" name="id" value="<?php  echo $query[0]->id ?>">
                <input type="text" name="nom" placeholder="Nom" required>
                <input type="text" name="prenom" placeholder="Prenom" required>
                <input type="text" name="adresse" placeholder="Adresse d'habitation" required>
                <input type="text" name="telephone" placeholder="Numéro de Telephone" required>
                <input type="text" name="mail" placeholder="Adresse mail" required>
                <label for="">Carte d'identité (pdf) :</label>
                <input type="file" name="cin" accept="application/pdf" required>
                <button type="submit">Valider</button>
            </form>
        </div>
    </div>
</body>

</html>