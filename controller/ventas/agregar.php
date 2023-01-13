<?php 

require_once '../../model/ventas.php';

$model = new ventas();

$listadeproductos = isset($_POST['lista']) ? $_POST['lista'] : json_encode([["hola","jsjs","jsjs","jsjs","jsjs","jsjs","jsjs","jsjs","jsjs","jsjs","jsjs","jsjs","jsjs","jsjs","jsjs","jsjs","jsjs","jsjs","jsjs","jsjs"]]);

$lista = json_decode($listadeproductos, true);

$filas = count($lista);

$datos = '';

if ($filas>0) 
{  
    foreach ($lista as $lp) {
        $datos .= " | ".$lp[0]." | ".$lp[1]." | ".$lp[2]." | ".$lp[3]." | ".$lp[4]." | ".$lp[5]." | ".$lp[6]." | ".$lp[7]." | ".$lp[8]." | ".$lp[9]." | ".$lp[10]." | ".$lp[11]." | ".$lp[12]." | ".$lp[13]." | ".$lp[14]." | ".$lp[15]." | ".$lp[16]." | ".$lp[17]."  |  ".$lp[18]."  |  ".$lp[19]." | <br>"; 
    }
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...







// $asesor = $_POST['asesor'];
// $nombre = $_POST['nombre'];
// $dni = $_POST['dni'];

// $telefonoRef = $_POST['telefonoRef'];
// $producto = $_POST['producto'];
// $promocion = $_POST['promocion'];
// $tipo = $_POST['tipo'];
// $tipoFija = $_POST['tipoFija'];
// $telefono = !empty($_POST['telefono']) ? $_POST['telefono'] : "---";
// $lineaProce = $_POST['lineaProce'];
// $operadorCeden = $_POST['operadorCeden'];
// $modalidad = $_POST['modalidad'];
// $plan = $_POST['plan'];
// $equipos = $_POST['equipos'];
// $planFija = $_POST['planFija'];
// $modoFija = $_POST['modoFija'];
// $formaPago = $_POST['formaPago'];
// $sec = !empty($_POST['sec']) ? $_POST['sec'] : "---";
// $estado = $_POST['estado'];
// $observacion = !empty($_POST['observaciones']) ? $_POST['observaciones'] : "---";
// $ubicacion = !empty($_POST['ubicacion']) ? $_POST['ubicacion'] : "---";
// $distrito = !empty($_POST['distrito']) ? $_POST['distrito'] : "---";

// if ($producto === "0") 
// {
//     if ($tipoFija === "0") 
//     {
//         $model->agregarFijaAlta($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipoFija,$planFija,$modoFija,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito);
//     }
//     elseif ($tipoFija === "1") 
//     {
//         $model->agregarFijaPortabilidad($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipoFija,$telefono,$planFija,$modoFija,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito);
//     }
// }
// elseif ($producto === "1") 
// {
//     if ($tipo === "0") 
//     {
//         if ($modalidad === "0") 
//         {
//             $model->agregarMovilNewPre($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$modalidad,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito);
//         }
//         elseif ($modalidad === "1") 
//         {
//             $model->agregarMovilNewPost($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$modalidad,$plan,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito);
//         }
//     }
//     elseif ($tipo === "1") 
//     {
//         if ($modalidad === "0") 
//         {
//             $model->agregarMovilPortaPre($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$telefono,$lineaProce,$operadorCeden,$modalidad,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito);
//         }
//         elseif ($modalidad === "1") 
//         {
//             $model->agregarMovilPortaPost($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$telefono,$lineaProce,$operadorCeden,$modalidad,$plan,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito);
//         }
//     }
//     elseif ($tipo === "2") 
//     {
//         if ($modalidad === "0") 
//         {
//             $model->agregarMovilRenoPre($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$telefono,$lineaProce,$modalidad,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito);
//         }
//         elseif ($modalidad === "1") 
//         {
//             $model->agregarMovilRenoPost($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$telefono,$lineaProce,$modalidad,$plan,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito);
//         }
//     }
// }
?>
<!-- <script>
    window.history.back();
</script> -->
