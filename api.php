<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con user, contraseña y nombre de la BD
$server = "localhost"; $user = "root"; $password = "mysql"; $database = "empleados";
$connectDB = new mysqli($server, $user, $password, $database);


if (isset($_GET["item1"]) || isset($_GET["item2"])){
    $sqlProducts = mysqli_query($connectDB,"SELECT some_fields FROM products WHERE item1 LIKE '%".$_GET["item1"]."%' OR item2 LIKE '%".$_GET["item2"]."%'");
    if(mysqli_num_rows($sqlProducts) > 0){
        $products = mysqli_fetch_all($sqlProducts,MYSQLI_ASSOC);
        echo json_encode($products);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}else{
    $sqlProducts = mysqli_query($connectDB,"SELECT * FROM products");
    if(mysqli_num_rows($sqlProducts) > 0){
        $products = mysqli_fetch_all($sqlProducts,MYSQLI_ASSOC);
        echo json_encode($products);
    }
    else{ echo json_encode([["success"=>0]]); }
}

?>