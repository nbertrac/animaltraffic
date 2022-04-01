<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once('Database.php');
$cnn = new Database;
if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['adresse']) && !empty($_POST['adresse']) && isset($_POST['telephone']) && !empty($_POST['telephone']) && isset($_POST['mail']) && !empty($_POST['mail'])){
    $sql = "SELECT id FROM reservation";
    $query= $cnn->getData($sql);
    $id=1;
    foreach($query as $key => $value) {
        if($value->id == $id) $id++;
    }
    $cin='cin/'.htmlspecialchars($_FILES['cin']['name']);
    $allowed = 'pdf';
    $filename = $_FILES['cin']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext!=$allowed) {
        header('location:index.php');
    }
    date_default_timezone_set("Europe/Paris");
    $date=date("Y-m-d");
    $fichier = basename($_FILES['cin']['name']);
    $dossier='cin/';
    if(move_uploaded_file($_FILES['cin']['tmp_name'], $dossier.$fichier)){
        echo "did it!";
    }
    else echo 'Shit';
    $values=array(
        "id"=>$id,
        "idan"=>$_POST['id'],
        "n"=>$_POST['nom'],
        "p"=>$_POST['prenom'],
        "a"=>$_POST['adresse'],
        "t"=>$_POST['telephone'],
        "mail"=>$_POST['mail'],
        "cin"=>$cin,
        "dates"=>$date
        );
    $sql="INSERT INTO reservation (id, id_animal, nom, prenom, adresse, telephone, mail, ci, dc) VALUE (:id, :idan, :n, :p, :a, :t, :mail, :cin, :dates)";
    $cnn->saveData($sql, $values);
    echo '<a href="index.php">C\'est fait, cliquez ici pour retourner</a>';
}else echo '<a href="admin.php">Les champ sont mal rempli</a>';