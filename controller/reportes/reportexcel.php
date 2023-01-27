<?php
require_once '../../model/conexion.php';
require "../../librerias/vendor/autoload.php";

$conexion = new conexion();
$con = $conexion->conectar();

$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$mes= date('m');
$año= date('Y');

$MesActual = $meses[$mes-1]." de ".$año;

use PhpOffice\PhpSpreadsheet\SpreadSheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

$logoparareporte = "../../view/static/img/logoEmpresa.png";

$columnas=['v.dniAsesor, u.nombre, v.dniCliente, c.nombre, v.estado, v.sec, v.origen, v.registro'];

$tabla='ventas as v INNER JOIN detalleventas as dv INNER JOIN usuarios as u INNER JOIN clientes as c on v.sec=dv.sec and v.dniAsesor=u.dni and v.dniCliente=c.dni';

$fecharequerida= !empty($_POST['busquedareportefechaventa']) ? $_POST['busquedareportefechaventa'] : null;
$dniModeradorMeta= !empty($_POST['busquedareporteasesorventa']) ? $_POST['busquedareporteasesorventa'] : null;
$dniAsesorMeta= !empty($_POST['busquedareporteasesorventa']) ? $_POST['busquedareporteasesorventa'] : null;
$buscarestado= isset($_POST['busquedareporteestadoventa']) ? $_POST['busquedareporteestadoventa'] : null;
$buscar= isset($_POST['busquedareporteventa']) ? $_POST['busquedareporteventa'] : null;

$mesre= date('m', strtotime($fecharequerida));
$añore= date('Y', strtotime($fecharequerida));

$fecharequeridaconver = $meses[$mesre-1]." de ".$añore;

$where='';

if ($fecharequerida != null) 
{
    $name = " - $fecharequeridaconver";
}
elseif ($fecharequerida == null) 
{
    $name = " - $MesActual";
}

if ($dniAsesorMeta != null) {
    $name .= " - ".$dniAsesorMeta;
    if ($buscarestado != null) {
        $name .= " - ".$dniAsesorMeta." - ".$buscarestado;
        if ($buscar!=null) {
            $name .= " - ".$dniAsesorMeta." - ".$buscarestado." - ".$buscar;
        }
    }
    elseif ($buscar!=null) {
        $name .= " - ".$dniAsesorMeta." - ".$buscar;
    }
}
if ($buscarestado != null and $dniAsesorMeta == null) {
    $name .= " - ".$buscarestado;
    if ($buscar!=null) {
        $name .= " - ".$buscarestado." - ".$buscar;
    }
}
elseif ($buscar!=null and $dniAsesorMeta == null and $buscarestado == null) {
    $name .= " - ".$buscar;
}

// consulta para crear el reporte
if ($fecharequerida != null) 
{
    $where.="where (month(v.registro)=month('$fecharequerida') and year(v.registro)=year('$fecharequerida')) ";
}
elseif ($fecharequerida == null) 
{
    $where.="where (month(v.registro)=month(CURRENT_TIMESTAMP) and year(v.registro)=year(CURRENT_TIMESTAMP)) ";
}

if ($dniAsesorMeta != null) {
    $where.="and dniAsesor='".$dniAsesorMeta."' ";
    if ($buscarestado != null) {
        $where.="and estado='".$buscarestado."' ";
        if ($buscar!=null) {
            $where.=" and (";
            $cont= count($columnasBus);
            for ($i=0; $i < $cont; $i++) { 
                $where.=$columnasBus[$i]." like '%".$buscar."%' or ";
            }
            $where=substr_replace($where, "", -3);
            $where.=")";
        }
    }
    elseif ($buscar!=null) {
        $where.=" and (";
        $cont= count($columnasBus);
        for ($i=0; $i < $cont; $i++) { 
            $where.=$columnasBus[$i]." like '%".$buscar."%' or ";
        }
        $where=substr_replace($where, "", -3);
        $where.=")";
    }
}
if ($buscarestado != null and $dniAsesorMeta == null) {
    $where.="and estado='".$buscarestado."' ";
    if ($buscar!=null) {
        $where.=" and (";
        $cont= count($columnasBus);
        for ($i=0; $i < $cont; $i++) { 
            $where.=$columnasBus[$i]." like '%".$buscar."%' or ";
        }
        $where=substr_replace($where, "", -3);
        $where.=")";
    }
}
elseif ($buscar!=null and $dniAsesorMeta == null and $buscarestado == null) {
    $where.="and (";
    $cont= count($columnasBus);
    for ($i=0; $i < $cont; $i++) { 
        $where.=$columnasBus[$i]." like '%".$buscar."%' or ";
    }
    $where=substr_replace($where, "", -3);
    $where.=")";
}

$sql = "select ".implode(", ", $columnas)." from $tabla $where";
$reporteventas=mysqli_query($con,$sql);


// if (isset($_POST['btngenerarreporteventas'])) 
// {

    $imagenesinsert = new Drawing();
    $spreadsheet = new SpreadSheet();
    $spreadsheet->getProperties()->setCreator("Argosal")->setTitle("Reporte de Ventas Argosal");

    $spreadsheet->setActiveSheetIndex(0);
    $hojaActiva = $spreadsheet->getActiveSheet();

    $hojaActiva->mergeCells('A1:B1');
    $hojaActiva->mergeCells('C1:V1');
    
    $imagenesinsert->setName('Logo de Empresa');
    $imagenesinsert->setDescription('Logo de Empresa');
    $imagenesinsert->setPath($logoparareporte);
    $imagenesinsert->setCoordinates('A1');
    $imagenesinsert->setWidth('80');
    $imagenesinsert->setHeight('50');
    $imagenesinsert->setWorksheet($spreadsheet->getActiveSheet());
    // $hojaActiva->setCellValue('A1', 'Logo de la empresa');
    $hojaActiva->setCellValue('C1', "Reporte de Ventas de Linea Movil$name - Argosal");

    // ESTRUCTURA DE VENTA 
    $hojaActiva->setCellValue('A2', 'DNI / Nombre Asesor');
    $hojaActiva->setCellValue('B2', 'DNI / Nombre Cliente');
    $hojaActiva->setCellValue('C2', 'Estado de Venta');
    $hojaActiva->setCellValue('D2', 'SEC');
    $hojaActiva->setCellValue('E2', 'Origen de Venta');

    // ESTRUCTURA DEL DETALLE DE VENTA
    $hojaActiva->setCellValue('F2', 'Telefono Referente');
    $hojaActiva->setCellValue('G2', 'Estado del Producto');
    $hojaActiva->setCellValue('H2', 'Promoción');
    $hojaActiva->setCellValue('I2', 'Producto Requerido');
    $hojaActiva->setCellValue('J2', 'Tipo de Linea');
    $hojaActiva->setCellValue('K2', 'Telefono de Operación');
    $hojaActiva->setCellValue('L2', 'Linea Procedente');
    $hojaActiva->setCellValue('M2', 'Operador Cedente');
    $hojaActiva->setCellValue('N2', 'Modalidad');
    $hojaActiva->setCellValue('O2', 'Modo de Renovación');
    $hojaActiva->setCellValue('P2', 'Plan Requerido');
    $hojaActiva->setCellValue('Q2', 'Equipo Requerido');
    $hojaActiva->setCellValue('R2', 'Forma de Pago');
    $hojaActiva->setCellValue('S2', 'Observaciones');
    $hojaActiva->setCellValue('T2', 'Distrito');
    $hojaActiva->setCellValue('U2', 'Ubicación');
    $hojaActiva->setCellValue('V2', 'Fecha de Registro');

    // CONTENIDO DE VENTA
    $hojaActiva->setCellValue('A3', '76845986 / Manuel Vasquez');
    $hojaActiva->setCellValue('B3', '87956895 / Uriarte');
    $hojaActiva->setCellValue('C3', 'Cerrada');
    $hojaActiva->setCellValue('D3', '5459685978');
    $hojaActiva->setCellValue('E3', 'Whatsapp');
    
    // CONTENIDO DEL DETALLE DE VENTA
    $hojaActiva->setCellValue('F3', '956875487');
    $hojaActiva->setCellValue('G3', 'Pendiente');
    $hojaActiva->setCellValue('H3', '---');
    $hojaActiva->setCellValue('I3', 'Movil');
    $hojaActiva->setCellValue('J3', 'Portabilidad');
    $hojaActiva->setCellValue('K3', '956487548');
    $hojaActiva->setCellValue('L3', 'Postpago');
    $hojaActiva->setCellValue('M3', 'Movistar');
    $hojaActiva->setCellValue('N3', 'Postpago');
    $hojaActiva->setCellValue('O3', '---');
    $hojaActiva->setCellValue('P3', '55.90');
    $hojaActiva->setCellValue('Q3', 'Chip');
    $hojaActiva->setCellValue('R3', 'Cuotas');
    $hojaActiva->setCellValue('S3', 'venta sin problemas');
    $hojaActiva->setCellValue('T3', 'pomalca');
    $hojaActiva->setCellValue('U3', 'miraflores');
    $hojaActiva->setCellValue('V3', '11/01/2023 12:30:15');









    // // para la hoja 2 con lineas fijas
    // $spreadsheet->createSheet();
    // $spreadsheet->setActiveSheetIndex(1);
    // $hojaActiva2 = $spreadsheet->getActiveSheet();

    // $hojaActiva2->mergeCells('A1:B1');
    // $hojaActiva2->mergeCells('C1:H1');
    
    // // $imagenesinsert->setName('Logo de Empresa');
    // // $imagenesinsert->setDescription('Logo de Empresa');
    // // $imagenesinsert->setPath($logoparareporte);
    // // $imagenesinsert->setCoordinates('A1');
    // // $imagenesinsert->setWidth('80');
    // // $imagenesinsert->setHeight('50');
    // $hojaActiva2->setCellValue('A1', 'Logo de la empresa');
    // $hojaActiva2->setCellValue('C1', "Reporte de Ventas de Linea Fija$name - Argosal");

    // // ESTRUCTURA DE VENTA 
    // $hojaActiva2->setCellValue('A2', 'DNI / Nombre Asesor');
    // $hojaActiva2->setCellValue('B2', 'DNI / Nombre Cliente');
    // $hojaActiva2->setCellValue('C2', 'Estado de Venta');
    // $hojaActiva2->setCellValue('D2', 'SEC');
    // $hojaActiva2->setCellValue('E2', 'Origen de Venta');

    // // ESTRUCTURA DEL DETALLE DE VENTA
    // $hojaActiva2->setCellValue('F2', 'Telefono Referente');
    // $hojaActiva2->setCellValue('G2', 'Estado del Producto');
    // $hojaActiva2->setCellValue('H2', 'Promoción');
    // $hojaActiva2->setCellValue('I2', 'Producto Requerido');
    
    // $hojaActiva2->setCellValue('K2', 'Forma de Pago');
    // $hojaActiva2->setCellValue('L2', 'Observaciones');
    // $hojaActiva2->setCellValue('M2', 'Distrito');
    // $hojaActiva2->setCellValue('N2', 'Ubicación');
    // $hojaActiva2->setCellValue('O2', 'Fecha de Registro');

    // // CONTENIDO DE VENTA
    // $hojaActiva2->setCellValue('A3', '76845986 / Manuel Vasquez');
    // $hojaActiva2->setCellValue('B3', '87956895 / Uriarte');
    // $hojaActiva2->setCellValue('C3', 'Cerrada');
    // $hojaActiva2->setCellValue('D3', '5459685978');
    // $hojaActiva2->setCellValue('E3', 'Whatsapp');
    
    // // CONTENIDO DEL DETALLE DE VENTA
    // $hojaActiva2->setCellValue('F3', '956875487');
    // $hojaActiva2->setCellValue('G3', 'Pendiente');
    // $hojaActiva2->setCellValue('H3', '---');
    // $hojaActiva2->setCellValue('I3', 'Movil');
    
    // $hojaActiva2->setCellValue('K3', 'Cuotas');
    // $hojaActiva2->setCellValue('L3', 'venta sin problemas');
    // $hojaActiva2->setCellValue('M3', 'pomalca');
    // $hojaActiva2->setCellValue('N3', 'miraflores');
    // $hojaActiva2->setCellValue('O3', '11/01/2023 12:30:15');






    // nombre del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Reporte de Ventas'.$name.'.xlsx"');
    header('Cache-Control: max-age=0');

    // salida de archivo
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    


    // encabezados

    
                    // while($row=mysqli_fetch_array($reporteventas))
                    // {
                    //     $fechar = date('d/m/y', strtotime($row['fechaRegistro']));
                    //     $fechaa = date('d/m/y', strtotime($row['fechaActualizacion']));
                        
                    //     if ($row['estado'] == "0") 
                    //     {
                    //         $estadorepor = "No Requiere";
                    //     }
                    //     elseif ($row['estado'] == "1") 
                    //     {
                    //         $estadorepor = "Concretado";
                    //     }
                    //     elseif ($row['estado'] == "2") 
                    //     {
                    //         $estadorepor = "Pendiente";
                    //     }

                    //     if ($row['modalidad'] == "0") 
                    //     {
                    //         $modalidadrepor = "Prepago";
                    //     }
                    //     elseif ($row['modalidad'] == "1") 
                    //     {
                    //         $modalidadrepor = "Postpago";
                    //     }
                    //     elseif ($row['modalidad'] == "-") 
                    //     {
                    //         $modalidadrepor = "---";
                    //     }

                    //     if ($row['producto'] == "0") 
                    //     {
                    //         $productorepor = "Fija";
                    //     }
                    //     elseif ($row['producto'] == "1") 
                    //     {
                    //         $productorepor = "Movil";
                    //     }

                    //     if ($row['tipo'] == "0") 
                    //     {
                    //         $tiporepor = "Linea Nueva";
                    //     }
                    //     elseif ($row['tipo'] == "1") 
                    //     {
                    //         $tiporepor = "Portabilidad";
                    //     }
                    //     elseif ($row['tipo'] == "2") 
                    //     {
                    //         $tiporepor = "Renovacion";
                    //     }
                    //     elseif ($row['tipo'] == "-") 
                    //     {
                    //         $tiporepor = "---";
                    //     }

                    //     if ($row['tipoFija'] == "0") 
                    //     {
                    //         $tipofijarepor = "Alta";
                    //     }
                    //     elseif ($row['tipoFija'] == "1") 
                    //     {
                    //         $tipofijarepor = "Portabilidad";
                    //     }
                    //     elseif ($row['tipoFija'] == "-") 
                    //     {
                    //         $tipofijarepor = "---";
                    //     }

                    //     fputcsv($salida, array($row['codigo'],
                    //                             $row['dniAsesor'],
                    //                             $row['nombre'],
                    //                             $row['dni'],
                    //                             $row['telefono'],
                    //                             $productorepor,
                    //                             $row['lineaProcedente'],
                    //                             $row['operadorCedente'],
                    //                             $modalidadrepor,
                    //                             $tiporepor,
                    //                             $row['planR'],
                    //                             $row['equipo'],
                    //                             $row['formaDePago'],
                    //                             $row['numeroReferencia'],
                    //                             $row['sec'],
                    //                             $tipofijarepor,
                    //                             $row['planFija'],
                    //                             $row['modoFija'],
                    //                             $estadorepor,
                    //                             $row['observaciones'],
                    //                             $row['promocion'],
                    //                             $row['ubicacion'],
                    //                             $row['distrito'],
                    //                             $fechar,
                    //                             $fechaa));
                    // }
// }
?>