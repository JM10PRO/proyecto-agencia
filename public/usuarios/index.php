<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "josemariagil"; $contrasenia = "I9@02hrq"; $nombreBaseDatos = "josemariagil";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);

// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sqlUsuarios = mysqli_query($conexionBD,"SELECT * FROM usuarios WHERE id=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlUsuarios) > 0){
        $empleaados = mysqli_fetch_all($sqlUsuarios,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sqlUsuarios = mysqli_query($conexionBD,"DELETE FROM usuarios WHERE id=".$_GET["borrar"]);
    if($sqlUsuarios){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $nombre=$data->nombre;
    $apellidos=$data->apellidos;
    $correo=$data->correo;
    $passwd=$data->passwd;
        if(($correo!="")&&($nombre!="")&&($apellidos!="")&&($passwd!="")){
            
    $sqlClientes = mysqli_query($conexionBD,"INSERT INTO usuarios(nombre,apellidos,correo,passwd) VALUES('$nombre','$apellidos','$correo','$passwd') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    $nombre=$data->nombre;
    $correo=$data->correo;
    
    $sqlUsuarios = mysqli_query($conexionBD,"UPDATE usuarios SET nombre='$nombre',correo='$correo' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

// POR DEFECTO
// Consulta todos los registros de la tabla usuarios
$sqlUsuarios = mysqli_query($conexionBD,"SELECT * FROM usuarios ");
if(mysqli_num_rows($sqlUsuarios) > 0){
    $empleaados = mysqli_fetch_all($sqlUsuarios,MYSQLI_ASSOC);
    echo json_encode($empleaados);
}
else{ echo json_encode([["success"=>0]]); }
