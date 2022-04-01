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
  <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
</head>
<body>
<a href="menu.php" class="menu_control">Retour a l'acceuil</a>
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
            <input type="text" name="age" maxlength="2" size="2" pattern="[0-9]" placeholder="Age">
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
 <input type="text" name="age" maxlength="2" size="2" pattern="[0-9]" placeholder="Age">
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
        } elseif (!isset($_GET['ajt']) && !isset($_GET['mdf']) && !isset($_GET['spr'])) {
            $html = '<form action="admin.php" method="get" id="form">
                <select class="select_control" name="type" id="type">
                    <option value="">--Type de modification--</option>
                    <option value="ajt">Ajouter</option>
                    <option value="spr">Supprimer</option>
                    <option value="mdf">Modifier</option>
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