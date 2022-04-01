<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../db/Database.php';
    include_once '../class/animals.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new Animal($db);
    $stmt = $items->getAnimals();
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){
        
        $animalArr = array();
        $animalArr["body"] = array();
        $animalArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "nom" => $nom,
                "photo" => $email,
                "age" => $age,
                "created" => $created
            );
            array_push($animalArr["body"], $e);
        }
        echo json_encode($animalArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
