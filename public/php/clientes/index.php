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
    $sqlClientes = mysqli_query($conexionBD,"SELECT * FROM clientes WHERE id=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlClientes) > 0){
        $cliente = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
        echo json_encode($cliente);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sqlClientes = mysqli_query($conexionBD,"DELETE FROM clientes WHERE id=".$_GET["borrar"]);
    if($sqlClientes){
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
    $telefono=$data->telefono;
    $provincia=$data->provincia;
    $municipio=$data->municipio;
    $cp=$data->cp;
    $tipo=$data->tipo;
        if(($nombre!="")&&($apellidos!="")&&($nombre!="")&&($correo!="")&&($telefono!="")&&($provincia!="")&&($municipio!="")&&($cp!="")&&($tipo!="")){
            
    $sqlClientes = mysqli_query($conexionBD,"INSERT INTO clientes(nombre,apellidos,correo,telefono,localidad,cp,provincia,tipo) VALUES('$nombre','$apellidos','$correo','$telefono','$municipio','$cp','$provincia','$tipo') ");
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
    
    $sqlClientes = mysqli_query($conexionBD,"UPDATE clientes SET nombre='$nombre',correo='$correo' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["provincias"])){
    // Consulta todos los registros de la tabla clientes
    $sqlProvincias = mysqli_query($conexionBD,"SELECT * FROM provincias ");
    if(mysqli_num_rows($sqlProvincias) > 0){
        $provincias = mysqli_fetch_all($sqlProvincias,MYSQLI_ASSOC);
        echo json_encode($provincias);
        exit();
    }
    else{ echo json_encode([["success"=>0]]); }
}

if (isset($_GET["provinciaId"])){
    $idProvincia = $_GET["provinciaId"];
    $idProvincia = intval($idProvincia);
    // Consulta todos los registros de la tabla clientes
    $sqlProvincias = mysqli_query($conexionBD,"SELECT nombre FROM provincias WHERE cod=$idProvincia");
    if(mysqli_num_rows($sqlProvincias) > 0){
        $provincia = mysqli_fetch_all($sqlProvincias,MYSQLI_ASSOC);
        echo json_encode($provincia);
        exit();
    }
    else{ echo json_encode([["success"=>0]]); }
}
// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["municipios"])){
    // Consulta todos los registros de la tabla clientes
    $provincia = $_GET["municipios"];
    $sqlmunicipios = mysqli_query($conexionBD,"SELECT * FROM municipios WHERE provincia=$provincia");
    if(mysqli_num_rows($sqlmunicipios) > 0){
        $municipios = mysqli_fetch_all($sqlmunicipios,MYSQLI_ASSOC);
        echo json_encode($municipios);
        exit();
    }
    else{ echo json_encode([["success"=>0]]); }
}

if (isset($_GET["municipioId"])){
    $idMunicipio = $_GET["municipioId"];
    $idMunicipio = intval($idMunicipio);
    // Consulta todos los registros de la tabla clientes
    $sqlProvincias = mysqli_query($conexionBD,"SELECT municipio FROM municipios WHERE id=$idMunicipio");
    if(mysqli_num_rows($sqlProvincias) > 0){
        $provincia = mysqli_fetch_all($sqlProvincias,MYSQLI_ASSOC);
        echo json_encode($provincia);
        exit();
    }
    else{ echo json_encode([["success"=>0]]); }
}

// POR DEFECTO
// Consulta todos los registros de la tabla clientes
$sqlClientes = mysqli_query($conexionBD,"SELECT * FROM clientes ");
if(mysqli_num_rows($sqlClientes) > 0){
    $empleaados = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
    echo json_encode($empleaados);
}
else{ echo json_encode([["success"=>0]]); }
