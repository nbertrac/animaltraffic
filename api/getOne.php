<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../db/Database.php';
include_once '../class/Animals.php';
$database = new Database();
$db = $database->getConnection();
$item = new Animal($db);
$item->id = isset($_GET['id']) ? $_GET['id'] : die();

$item->getSingleAnimal();
if ($item->nom != null) {
  // create array
  $animal_arr = array(
    "id" =>  $item->id,
    "nom" => $item->nom,
    "photo" => $item->photo,
    "age" => $item->age
  );

  http_response_code(200);
  echo json_encode($animal_arr);
} else {
  http_response_code(404);
  echo json_encode("not found.");
}
