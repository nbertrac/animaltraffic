<?php
if (isset($_POST['user']) && !empty($_POST['user']) & isset($_POST['pass']) && !empty($_POST['pass'])){
    $u=htmlspecialchars($_POST['user']);
    $p=htmlspecialchars($_POST['pass']);
    $p=hash('sha512', sha1($p).'trybitch', false);
    try{
        
        $cnn=new PDO('mysql:host=localhost;dbname=animaltraffic;charset=utf8', 'new', 'ok');
        $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //SELECT SHA2(CONCAT(SHA1('test'), 'trybitch'), 512);
        $req='SELECT * FROM utilisateur WHERE pseudo = ? AND pass = ?';
        $qry=$cnn->prepare($req);
        $vals=array($u, $p);
        $qry->execute($vals);
        if($qry->rowCount()===1){
            // Démarage session et stockage variable de session
            session_start();
            $row=$qry->fetch(PDO::FETCH_ASSOC);
            $_SESSION['connected']=true;
            $_SESSION['session_id']= session_id();
            $_SESSION['user']= $u;
            $_SESSION['pass']=$p;
            unset($cnn);
            header('location:admin.php');
        }else {
            unset($cnn);
            header('location:adminConnect.html');
        }
    }catch (PDOException $err) {
        echo '<p class="alert alert-danger">'.$err->getMessage().'</p>';
    }
}else{
    header('location:adminConnect.html');
}	