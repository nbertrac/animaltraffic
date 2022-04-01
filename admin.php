<?php
require_once('test_session.php');
require_once('Database.php');
$cnn = new Database;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administration</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav>
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li> <a href="animals.php">Animaux</a> </li>
          <li> <a href="adminConnect.html">Administration</a></li>
        </ul>
        <form action="https://www.paypal.com/donate" method="post" target="_blank">
          <input type="hidden" name="hosted_button_id" value="CSVQM9UD3PV78" />
          <input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_donate_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Bouton Faites un don avec PayPal" />
          <img alt="" border="0" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1" />
        </form>
      </nav>
<?php
        if (isset($_GET['type']) && $_GET['type'] === 'mdf') {
                $sql = "SELECT * FROM animal";
                $query= $cnn->getData($sql);
                //var_dump($query[0]->nom);
            echo '<a class="cancel_control4" href="admin.php">Annuler</a>
    <form action="mpn.php" method="post" id="form" enctype=multipart/form-data>
    <div>
            <div>
                <select class="select_control3" name="animal" id="animal" required>
                    <option value="">--animal--</option>';
            $html = '';
            foreach($query as $key => $value) {
                $html .= '<option value="' .$value->id. '">('.$value->id .') '.$value->nom.'</option>';
            }
            echo $html;
            echo '</select></div>
               <div>
               <label for="" class="required">Nom</label>
                <input class="input2_control" type="text" name="name" id="name" placeholder=" Nouveau nom">
                </div>
            <div>
                <label for="" class="required">Race</label>
                <input class="input2_control" type="text" name="race" id="race" placeholder="Nouvelle race">
            </div>
            <div>
            <label for="" class="required">Age</label>
            <input type="text" name="age" maxlength="2" size="2" pattern="[0-9]{1,}" placeholder="Age">
            </div>
            <div>
            <label for="" class="required">Photo</label>
            <input type="file" name="photo" class="req" accept=".jpg" required>
            </div>
            <div>
            <label for="" class="required">Sexe</label>
            <select class="select_control4" name="sexe" id="sexe">
                <option value="">--Sexe--</option>
                <option value="Masculin">--Masculin--</option>
                <option value="Feminin">--Feminin--</option>
            </select></div>
            <div>
            <label for="" class="required">Sterile</label>
            <select class="select_control4" name="sterile" id="sterile">
                <option value="">--Sterile--</option>
                <option value="1">--Oui--</option>
                <option value="0">--Non--</option>
            </select></div>
            <div>
        <input type="submit" class="valider2_control" name="type" value="Modifier">
      </div>
      </form>
      </div>';
        } elseif (isset($_GET['type']) && $_GET['type'] === 'spr') {
                $sql = "SELECT * FROM animal";
                $query= $cnn->getData($sql);
            echo '<a href="admin.php" class="cancel_control3">Annuler</a>
    <form action="mpn.php" method="post" id="form">
    <div>
            <div>
                <select class="select2_control" name="animal" id="animal" required>
                    <option value="">--Animal--</option>';
            $html = '';
            foreach($query as $key => $value) {
                $html .= '<option value="' .$value->id. '">('.$value->id .') '.$value->nom.'</option>';
            }
            echo $html;
            echo '</select></div>
        <div>
            <input type="submit" name="type" value="Supprimer" class="suppr_control">
        </div>
      </form>
        </div>';
        } elseif (isset($_GET['type']) && $_GET['type'] === 'ajt') {
            echo '<a href="admin.php" class="cancel_control2">Annuler</a>
    <form action="mpn.php" method="post" id="form" enctype=multipart/form-data>
    <div>
    <div>
    <label for="" class="required">Nom</label>
     <input class="input2_control" type="text" name="name" id="name" placeholder=" Nouveau nom">
     </div>
 <div>
     <label for="" class="required">Race</label>
     <input class="input2_control" type="text" name="race" id="user" placeholder="Nouvelle race">
 </div>
 <div>
 <label for="" class="required">Age</label>
 <input type="text" name="age" maxlength="2" size="2" pattern="[0-9]{1,}" placeholder="Age">
 </div>
 <div>
 <label for="" class="required">Photo</label>
 <input type="file" name="photo" class="req" accept=".jpg" required>
 </div>
 <div>
 <label for="" class="required">Sexe</label>
 <select class="select_control4" name="sexe" id="sexe">
     <option value="">--Sexe--</option>
     <option value="Masculin">--Masculin--</option>
     <option value="Feminin">--Feminin--</option>
 </select></div>
 <div>
 <label for="" class="required">Sterile</label>
 <select class="select_control4" name="sterile" id="sterile">
     <option value="">--Sterile--</option>
     <option value="1">--Oui--</option>
     <option value="0">--Non--</option>
 </select></div>
        <div>
            <input type="submit" name="type" value="Ajouter" class="ajout_control">
        </div>
      </form>
      </div>';
    } elseif (isset($_GET['type']) && $_GET['type'] === 'doss') {
        $sql = "SELECT * FROM reservation";
        $query= $cnn->getData($sql);
        if (!empty($cnn->getData($sql))) {
            foreach ($query as $key => $value) {
              echo "
              <div class='carte-animal'>  
              <h3> $value->id_animal</h3>
              <h4> Nom : $value->nom <h4>
              <h4> Prenom : $value->prenom <h4>
              <h4> adresse : $value->adresse <h4>
              <h4> Telephone : $value->telephone <h4>
              <h4> Mail : $value->mail <h4>
              <h4> Date de creation : $value->dc <h4>
              <a href='$value->ci'>Carte d'identité</a>
              </div>    
              ";
            }
          } else echo "<h3> Il n'y a pas de reservation</h3>";
        $html = '<form action="mpn.php" method="post" id="form">
            <select class="select_control" name="id" id="id" required>
                <option value="">--Valider un dossier--</option>';
            foreach($query as $key => $value) {
                $html .= '<option value="' .$value->id. '">'.$value->id.'</option>';
            }
        $html .= '</select><select class="select_control" name="valide" id="valide" required>
        <option value="">--Valider?--</option>
        <option value="1">--Oui--</option>
        <option value="0">--Non--</option></select>';

  $html.='<div>
    <input class="send_control" type="submit" name=type value="Dossier">
  </div>
  </form>
</div>';
        echo $html;
    } elseif (!isset($_GET['ajt']) && !isset($_GET['mdf']) && !isset($_GET['spr']) && !isset($_GET['doss'])) {
            $html = '<form action="admin.php" method="get" id="form">
                <select class="select_control" name="type" id="type">
                    <option value="">--Actions--</option>
                    <option value="ajt">Ajouter</option>
                    <option value="spr">Supprimer</option>
                    <option value="mdf">Modifier</option>
                    <option value="doss">Dossier</option>
                </select>
      <div>
        <input class="send_control" type="submit" value="Valider">
      </div>
      </form>
    </div>';
            echo $html;
    }
        ?>
</body>