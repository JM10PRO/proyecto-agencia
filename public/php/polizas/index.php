<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y numero de la BD
$servidor = "localhost"; $usuario = "josemariagil"; $contrasenia = "I9@02hrq"; $nombreBaseDatos = "josemariagil";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);

// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave

if (isset($_GET["buscar"])) {
    $data = json_decode(file_get_contents("php://input"));
    $codigo_cliente_1 = $data->cod1;
    $codigo_cliente_2 = $data->cod2;
    $fecha_inicio = $data->fecha1;
    $fecha_fin = $data->fecha2;
    $estado = $data->estado;

    if($codigo_cliente_1 == null || $codigo_cliente_2 == null || $fecha_inicio == null || $fecha_fin == null){
        echo json_encode(["Hay campos nulos"]);
        exit();
    }

    $filtrar_estado = "";
    $estado != null ? $filtrar_estado = "AND estado = '$estado'" : $filtrar_estado = "";   

    $sqlListado = mysqli_query($conexionBD, "SELECT * FROM polizas WHERE cliente_id BETWEEN $codigo_cliente_1 AND $codigo_cliente_2
    AND fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'". $filtrar_estado ."");

    if($sqlListado == false){
        echo json_encode($filtrar_estado);
        // echo json_encode(["Error"]);
        exit();   
    }

    if (mysqli_num_rows($sqlListado) > 0) {
        $resultado = mysqli_fetch_all($sqlListado, MYSQLI_ASSOC);
        echo json_encode($resultado);
        exit();
    } else {
        echo json_encode(["success" => 0]);
    }
}

if (isset($_GET["consultarpolizascliente"])) {
    $sqlPolizas = mysqli_query($conexionBD, "SELECT * FROM polizas WHERE cliente_id=" . $_GET["consultarpolizascliente"]);
    if (mysqli_num_rows($sqlPolizas) > 0) {
        $polizas = mysqli_fetch_all($sqlPolizas, MYSQLI_ASSOC);
        echo json_encode($polizas);
        exit();
    } else {
        echo json_encode(["success" => 0]);
    }
}

if (isset($_GET["consultardatospoliza"])) {
    $sqlPolizas = mysqli_query($conexionBD, "SELECT * FROM polizas WHERE numero=" . $_GET["consultardatospoliza"]);
    if (mysqli_num_rows($sqlPolizas) > 0) {
        $polizas = mysqli_fetch_all($sqlPolizas, MYSQLI_ASSOC);
        echo json_encode($polizas);
        exit();
    } else {
        echo json_encode(["success" => 0]);
    }
}

//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])) {
    $sqlPolizas = mysqli_query($conexionBD, "DELETE FROM polizas WHERE numero=" . $_GET["borrar"]);
    if ($sqlPolizas) {
        echo json_encode(["success" => 1]);
        exit();
    } else {
        echo json_encode(["success" => 0]);
    }
}
//Inserta un nuevo registro y recepciona en método post los datos de numero y fecha
if (isset($_GET["insertar"])) {
    $data = json_decode(file_get_contents("php://input"));
    $importe = $data->importe;
    $fecha = date('Y-m-d');
    $estado = $data->estado;
    $observaciones = $data->observaciones;
    $cliente_id = $data->cliente_id;
    if (($importe != "") && ($estado != "") && ($observaciones != "") && ($cliente_id != "")) {

        $sqlPolizas = mysqli_query($conexionBD, "INSERT INTO polizas(importe,fecha,estado,observaciones,cliente_id) VALUES('$importe','$fecha','$estado','$observaciones','$cliente_id') ");
        if($sqlPolizas){
            echo json_encode(["success" => 1]);
        }else{
            echo json_encode(["success" => "error al insertar"]);
        }
        exit();
    }
}
// Actualiza datos pero recepciona datos de numero, fecha y una clave para realizar la actualización
if (isset($_GET["actualizar"])) {

    $data = json_decode(file_get_contents("php://input"));

    $id = (isset($data->id)) ? $data->id : $_GET["actualizar"]; //número de la póliza
    $importe = $data->importe;
    $estado = $data->estado;
    $observaciones = $data->observaciones;

    $sqlPolizas = mysqli_query($conexionBD, "UPDATE polizas SET importe='$importe',estado='$estado',observaciones='$observaciones' WHERE numero='$id'");
    echo json_encode(["success" => 1]);
    exit();
}

// POR DEFECTO
// Consulta todos los registros de la tabla polizas
$sqlPolizas = mysqli_query($conexionBD, "SELECT * FROM polizas ORDER BY fecha DESC");
if (mysqli_num_rows($sqlPolizas) > 0) {
    $polizas = mysqli_fetch_all($sqlPolizas, MYSQLI_ASSOC);
    echo json_encode($polizas);
} else {
    echo json_encode([["success" => 0]]);
}
