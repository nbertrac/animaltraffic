<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once('test_session.php');
require_once('Database.php');
$cnn = new Database;
if ($_POST['type']==='Ajouter'){
    if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['race']) && !empty($_POST['race']) && isset($_POST['age']) && !empty($_POST['age']) && isset($_POST['sexe']) && !empty($_POST['sexe']) && isset($_POST['sterile'])){
        $sql = "SELECT id FROM animal";
        $query= $cnn->getData($sql);
        $id=1;
        foreach($query as $key => $value) {
            if($value->id == $id) $id++;
        }
        
        $p='photo/'.htmlspecialchars($_FILES['photo']['name']);
        $allowed = 'jpg';
        $filename = $_FILES['photo']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if ($ext!=$allowed) {
            header('location:admin.php');
        }
        date_default_timezone_set("Europe/Paris");
        $date=date("Y-m-d");
        $fichier = basename($_FILES['photo']['name']);
        $dossier='photo/';
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier.$fichier)){
            echo "did it!";
        }
        else echo 'Shit';
        $values=array(
            "id"=>$id,
            "r"=>$_POST['race'],
            "n"=>$_POST['name'],
            "a"=>$_POST['age'],
            "s"=>$_POST['sexe'],
            "p"=>$p,
            "st"=>$_POST['sterile'],
            "dates"=>$date
            );
        $sql="INSERT INTO animal (id, race, nom, age, sexe, photo, sterile, created) VALUE (:id, :r, :n, :a, :s, :p, :st, :dates)";
        $cnn->saveData($sql, $values);
        //$qry= $cnn->prepare($sql);
        //$qry->execute();
        echo '<a href="admin.php">C\'est fait, cliquez ici pour retourner</a>';
    }else echo '<a href="admin.php">Les champ sont mal rempli</a>';
}
if ($_POST['type']==='Supprimer'){
    if(isset($_POST['animal']) && !empty($_POST['animal'])){
    $id=htmlspecialchars($_POST['animal']);
        $sql="DELETE FROM animal WHERE id='$id'";
        $cnn->deleteData($sql);
        echo '<a href="admin.php">C\'est fait, cliquez ici pour retourner</a>';
    }else echo '<a href="admin.php">Les champ sont mal rempli</a>';
}
if ($_POST['type']==='Modifier'){
    if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['animal']) && !empty($_POST['animal']) && isset($_POST['race']) && !empty($_POST['race']) && isset($_POST['age']) && !empty($_POST['age']) && isset($_POST['sexe']) && !empty($_POST['sexe']) && isset($_POST['sterile'])){
        $p='photo/'.htmlspecialchars($_FILES['photo']['name']);
        $allowed = 'jpg';
        $filename = $_FILES['photo']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if ($ext!=$allowed) {
            header('location:admin.php');
        }
        $fichier = basename($_FILES['photo']['name']);
        $dossier='photo/';
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier.$fichier)){
            echo "did it!";
        }
        else echo 'Shit';
        $values=array(
            "r"=>$_POST['race'],
            "n"=>$_POST['name'],
            "a"=>$_POST['age'],
            "s"=>$_POST['sexe'],
            "p"=>$p,
            "st"=>$_POST['sterile'],
            "id"=>$_POST['animal'],
            );
        $sql="UPDATE animal SET race=:r, nom=:n, age=:a, sexe=:s, photo=:p, sterile=:st WHERE id=:id";
        $cnn->saveData($sql, $values);
        echo '<a href="admin.php">C\'est fait, cliquez ici pour retourner</a>';
    }else echo '<a href="admin.php">Les champ sont mal rempli</a>';
}