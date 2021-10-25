<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con user, contraseña y nombre de la BD
$server = "localhost"; $user = "root"; $password = "mysql"; $database = "empleados";
$connectDB = new mysqli($server, $user, $password, $database);


// If the user do a searchString query
if (isset($_GET["description"]) || isset($_GET["comact"])){
    $sqlProducts = mysqli_query($connectDB,"SELECT CODIGO,DESCRIPCION,COMACT,IVA,USD,COP,EXIST FROM tab_productos WHERE descripcion LIKE '%".$_GET["description"]."%' OR COMACT LIKE '%".$_GET["comact"]."%'");
    if(mysqli_num_rows($sqlProducts) > 0){
        $products = mysqli_fetch_all($sqlProducts,MYSQLI_ASSOC);
        echo json_encode($products);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}else{
    $sqlProducts = mysqli_query($connectDB,"SELECT * FROM tab_productos");
    if(mysqli_num_rows($sqlProducts) > 0){
        $products = mysqli_fetch_all($sqlProducts,MYSQLI_ASSOC);
        echo json_encode($products);
    }
    else{ echo json_encode([["success"=>0]]); }
}
?>