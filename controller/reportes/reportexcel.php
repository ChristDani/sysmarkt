<?php
require_once '../../model/conexion.php';
require_once '../../model/usuarios.php';
require_once '../../model/empresa.php';
require "../../librerias/vendor/autoload.php";

$conexion = new conexion();
$con = $conexion->conectar();

$usuarios = new user();

$modelempresa = new empresa();

$moderadorselect = "";
$asesorselect = "";

$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$mes= date('m');
$año= date('Y');

$MesActual = $meses[$mes-1]." de ".$año;

$nombredeempresa = ' ';
$logodeempresa = ' ';

$empresa=$modelempresa->listar();
if ($empresa != null) 
{
    foreach($empresa as $row)
    {
        $nombredeempresa = $row[0];
        $logodeempresa = $row[1];
    }
}
else 
{
    $nombredeempresa = "SYSMARKT";
    $logodeempresa = "logosysmarkt.png";
}

use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

$columnas=['v.dniAsesor', 'u.nombre', 'v.dniCliente', 'c.nombre', 'v.estado', 'v.sec', 'v.origen', 'v.registro', 'dv.telefonoRefencia', 'dv.producto', 'dv.promocion', 'dv.tipo', 'dv.telefonoOperacion', 'dv.lineaProcedente', 'dv.operadorCendente', 'dv.modalidad', 'dv.modoReno', 'dv.plan', 'dv.equipo', 'dv.tipoFija', 'dv.planFija', 'dv.modoFija', 'dv.formaPago', 'dv.distrito', 'dv.ubicacion', 'dv.observaciones', 'dv.estado'];

$tabla='ventas as v INNER JOIN detalleventas as dv INNER JOIN usuarios as u INNER JOIN clientes as c on v.sec=dv.sec and v.dniAsesor=u.dni and v.dniCliente=c.dni';

$fecharequerida= !empty($_POST['busquedareportefechaventa']) ? $_POST['busquedareportefechaventa'] : null;
$dniModeradorMeta= !empty($_POST['busquedareportemoderadorventa']) ? $_POST['busquedareportemoderadorventa'] : null;
$dniAsesorMeta= !empty($_POST['busquedareporteasesorventa']) ? $_POST['busquedareporteasesorventa'] : null;
$buscarestado= isset($_POST['busquedareporteestadoventa']) ? $_POST['busquedareporteestadoventa'] : null;
$buscar= isset($_POST['busquedareporteventa']) ? $_POST['busquedareporteventa'] : null;

if ($dniModeradorMeta != null) {
    $listamoderador = $usuarios->buscarUser($dniModeradorMeta);
    $moderadorselect = $listamoderador[0][1];
}
if ($dniAsesorMeta != null) {
    $listaasesor = $usuarios->buscarUser($dniAsesorMeta);
    $asesorselect = $listaasesor[0][1];
}

if ($buscarestado == "0") {
    $nameestado = "Ventas en Proceso";
}
if ($buscarestado == "1") {
    $nameestado = "Ventas Cerradas";
}

$mesre= date('m', strtotime($fecharequerida));
$añore= date('Y', strtotime($fecharequerida));

$fecharequeridaconver = $meses[$mesre-1]." de ".$añore;

$where='';
$name='';

// consultas para el nombre del excel
if ($fecharequerida != null) 
{
    $name = " - $fecharequeridaconver";
}
elseif ($fecharequerida == null) 
{
    $name = " - $MesActual";
}

if ($dniModeradorMeta != null) 
{
    $name .= " - Moderador: $moderadorselect";
    if ($dniAsesorMeta != null) 
    {
        $name .= " - Asesor: $asesorselect";
        if ($buscarestado != null) 
        {
            $name .= " - $nameestado";
            if ($buscar!=null) 
            {
                $name .= " - SEC: $buscar";
            }
        }
        elseif ($buscar!=null) 
        {
            $name .= " - SEC: $buscar";
        }
    }
    elseif ($buscarestado != null && $dniAsesorMeta == null) 
    {
        $name .= " - $nameestado";
        if ($buscar!=null) 
        {
            $name .= " - SEC: $buscar";
        }
    }
    elseif ($buscar!=null && $buscarestado == null && $dniAsesorMeta == null) 
    {
        $name .= " - SEC: $buscar";
    }
}
elseif ($dniAsesorMeta != null && $dniModeradorMeta == null) 
{
    $name .= " - Asesor: $asesorselect";
    if ($buscarestado != null) 
    {
        $name .= " - $nameestado";
        if ($buscar!=null) 
        {
            $name .= " - SEC: $buscar";
        }
    }
    elseif ($buscar!=null) 
    {
        $name .= " - SEC: $buscar";
    }
}
elseif ($buscarestado != null && $dniAsesorMeta == null && $dniModeradorMeta == null) 
{
    $name .= " - $nameestado";
    if ($buscar!=null) 
    {
        $name .= " - SEC: $buscar";
    }
}
elseif ($buscar!=null && $buscarestado == null && $dniAsesorMeta == null && $dniModeradorMeta == null) {
    $name .= " - SEC: $buscar";
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

if ($dniModeradorMeta != null) {
    $where.="and u.dniModerador='".$dniModeradorMeta."' ";
    if ($dniAsesorMeta != null) {
        $where.="and v.dniAsesor='".$dniAsesorMeta."' ";
        if ($buscarestado != null) {
            $where.="and v.estado='".$buscarestado."' ";
            if ($buscar != null) {
                $where.="and v.sec like '%".$buscar."%' ";
            }
        }
        elseif ($buscar != null) {
            $where.="and v.sec like '%".$buscar."%' ";
        }
    }
    elseif ($buscarestado != null) {
        $where.="and v.estado='".$buscarestado."' ";
        if ($buscar != null) {
            $where.="and v.sec like '%".$buscar."%' ";
        }
    }
    elseif ($buscar != null) {
        $where.="and v.sec like '%".$buscar."%' ";
    }
}
elseif ($dniAsesorMeta != null and $dniModeradorMeta == null) {
    $where.="and v.dniAsesor='".$dniAsesorMeta."' ";
    if ($buscarestado != null) {
        $where.="and v.estado='".$buscarestado."' ";
        if ($buscar != null) {
            $where.="and v.sec like '%".$buscar."%' ";
        }
    }
    elseif ($buscar != null) {
        $where.="and v.sec like '%".$buscar."%' ";
    }
}
elseif ($buscarestado != null and $dniAsesorMeta == null and $dniModeradorMeta == null) {
    $where.="and v.estado='".$buscarestado."' ";
    if ($buscar != null) {
        $where.="and v.sec like '%".$buscar."%' ";
    }
}
elseif ($buscar!=null and $dniAsesorMeta == null and $buscarestado == null and $dniModeradorMeta == null) {
    $where.="and v.sec like '%".$buscar."%' ";
}

$sql = "select ".implode(", ", $columnas)." from $tabla $where";
$reporteventas=mysqli_query($con,$sql);


if (isset($_POST['btngenerarreporteventas'])) 
{
    $spreadsheet = new SpreadSheet();
    function addImage($path,$coordinates,$sheet)
    {
        $logoparareporte = "../../view/static/empresa/$path";
        $imagenesinsert = new Drawing();
        $imagenesinsert->setName('Logo de Empresa');
        $imagenesinsert->setDescription('Logo de Empresa');
        $imagenesinsert->setPath($logoparareporte);
        $imagenesinsert->setCoordinates($coordinates);
        $imagenesinsert->setWidth('100');
        $imagenesinsert->setHeight('70');
        $imagenesinsert->setOffsetX(25);
        $imagenesinsert->setOffsetY(10);
        $imagenesinsert->setResizeProportional(true);
        $imagenesinsert->setWorksheet($sheet);
    }
    $spreadsheet->getProperties()->setCreator($nombredeempresa)->setTitle("Reporte de Ventas - $nombredeempresa")->setCategory('Ventas')->setLastModifiedBy($nombredeempresa);

    // encabezados de la hoja de lineas moviles
    $spreadsheet->setActiveSheetIndex(0);
    $hojaActiva = $spreadsheet->getActiveSheet();
    $spreadsheet->getActiveSheet()->setTitle('Linea Movil');
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);

    $hojaActiva->mergeCells('B1:V1');
    $hojaActiva->getRowDimension('1')->setRowHeight(70);
    $hojaActiva->getRowDimension('2')->setRowHeight(25);
    $hojaActiva->getStyle('B1:V1')->getFont()->setName('arial')->setSize(15);
    $hojaActiva->getStyle('B1:V1')->getAlignment()->setHorizontal('center');
    $hojaActiva->getStyle('B1:V1')->getAlignment()->setVertical('center');
    $hojaActiva->getStyle('A2:V2')->getAlignment()->setHorizontal('center');
    $hojaActiva->getStyle('A2:V2')->getAlignment()->setVertical('center');
    $hojaActiva->getStyle('A1:V1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E0F9E3');
    $hojaActiva->getStyle('A2:V2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('C6E3EF');
    $hojaActiva->getStyle('A1:V1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $hojaActiva->getStyle('A2:V2')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    
    addImage($logodeempresa,'A1',$spreadsheet->getActiveSheet());
    $hojaActiva->setCellValue('B1', "Reporte de Ventas - Linea Movil$name - $nombredeempresa");
    $hojaActiva->getColumnDimension('A')->setWidth(5);

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

    // encabezados de la hoja de lineas fijas
    $spreadsheet->createSheet();
    $spreadsheet->setActiveSheetIndex(1);
    $hojaActiva2 = $spreadsheet->getActiveSheet();
    $spreadsheet->getActiveSheet()->setTitle('Linea Fija');
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);

    $hojaActiva2->mergeCells('B1:R1');
    $hojaActiva2->getRowDimension('1')->setRowHeight(70);
    $hojaActiva2->getRowDimension('2')->setRowHeight(25);
    $hojaActiva2->getStyle('B1:R1')->getFont()->setName('arial')->setSize(15);
    $hojaActiva2->getStyle('B1:R1')->getAlignment()->setHorizontal('center');
    $hojaActiva2->getStyle('B1:R1')->getAlignment()->setVertical('center');
    $hojaActiva2->getStyle('A2:R2')->getAlignment()->setHorizontal('center');
    $hojaActiva2->getStyle('A2:R2')->getAlignment()->setVertical('center');
    $hojaActiva2->getStyle('A1:R1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E0F9E3');
    $hojaActiva2->getStyle('A2:R2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('C6E3EF');
    $hojaActiva2->getStyle('A1:R1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $hojaActiva2->getStyle('A2:R2')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    
    addImage($logodeempresa,'A1',$spreadsheet->getActiveSheet());
    $hojaActiva2->setCellValue('B1', "Reporte de Ventas - Linea Fija$name - $nombredeempresa");

    // ESTRUCTURA DE VENTA 
    $hojaActiva2->setCellValue('A2', 'DNI / Nombre Asesor');
    $hojaActiva2->setCellValue('B2', 'DNI / Nombre Cliente');
    $hojaActiva2->setCellValue('C2', 'Estado de Venta');
    $hojaActiva2->setCellValue('D2', 'SEC');
    $hojaActiva2->setCellValue('E2', 'Origen de Venta');

    // ESTRUCTURA DEL DETALLE DE VENTA
    $hojaActiva2->setCellValue('F2', 'Telefono Referente');
    $hojaActiva2->setCellValue('G2', 'Estado del Producto');
    $hojaActiva2->setCellValue('H2', 'Promoción');
    $hojaActiva2->setCellValue('I2', 'Producto Requerido');
    $hojaActiva2->setCellValue('J2', 'Tipo de Linea');
    $hojaActiva2->setCellValue('K2', 'Telefono de Operación');
    $hojaActiva2->setCellValue('L2', 'Modo de Fija');
    $hojaActiva2->setCellValue('M2', 'Plan Requerido');
    $hojaActiva2->setCellValue('N2', 'Forma de Pago');
    $hojaActiva2->setCellValue('O2', 'Observaciones');
    $hojaActiva2->setCellValue('P2', 'Distrito');
    $hojaActiva2->setCellValue('Q2', 'Ubicación');
    $hojaActiva2->setCellValue('R2', 'Fecha de Registro');

    $lineaMovil = 3;
    $lineaFija = 3;
    while($row=mysqli_fetch_array($reporteventas))
    {
        $fechar = date('d/m/y h:i:s A', strtotime($row[7]));
        $dniAsesorlis = $row[0];
        $nombreAsesorlis = $row[1];
        $dniClientelis = $row[2];
        $nombreClientelis = $row[3];
        
        // origen de venta
        if ($row[6] == "0") 
        {
            $origenvenrepor = "Whatsapp";
        }
        elseif ($row[6] == "1") 
        {
            $origenvenrepor = "Landing";
        }
        
        // estado de venta
        if ($row[4] == "0") 
        {
            $estadorepor = "Venta en Proceso";
        }
        elseif ($row[4] == "1") 
        {
            $estadorepor = "Venta Cerrada";
        }
        
        // estado de producto
        if ($row[26] == "0") 
        {
            $estadoproducrepor = "Producto no Requerido";
        }
        elseif ($row[26] == "1") 
        {
            $estadoproducrepor = "Producto Vendido";
        }
        elseif ($row[26] == "2") 
        {
            $estadoproducrepor = "Producto Pendiente";
        }
    
        // forma de pago
        if ($row[22] == "0") 
        {
            $formapagorepor = "Contado";
        }
        elseif ($row[22] == "1") 
        {
            $formapagorepor = "Cuotas";
        }
        elseif ($row[22] == "-") 
        {
            $formapagorepor = "---";
        }

        // generacion de las hojas de excel
        if ($row[9] == "0") 
        {
            if ($row[19] == "0") 
            {
                $tipofijarepor = "Alta";
            }
            elseif ($row[19] == "1") 
            {
                $tipofijarepor = "Portabilidad";
            }
            elseif ($row[19] == "-") 
            {
                $tipofijarepor = "---";
            }

            $hojaActiva2->getStyle("A$lineaFija:R$lineaFija")->getAlignment()->setHorizontal('center');
            $hojaActiva2->getStyle("A$lineaFija:R$lineaFija")->getAlignment()->setVertical('center');

            // CONTENIDO DE VENTA
            $hojaActiva2->setCellValue("A$lineaFija", "$dniAsesorlis / $nombreAsesorlis");
            $hojaActiva2->setCellValue("B$lineaFija", "$dniClientelis / $nombreClientelis");
            $hojaActiva2->setCellValue("C$lineaFija", $estadorepor);
            $hojaActiva2->setCellValue("D$lineaFija", $row[5]);
            $hojaActiva2->setCellValue("E$lineaFija", $origenvenrepor);

            // CONTENIDO DEL DETALLE DE VENTA
            $hojaActiva2->setCellValue("F$lineaFija", $row[8]);
            $hojaActiva2->setCellValue("G$lineaFija", $estadoproducrepor);
            $hojaActiva2->setCellValue("H$lineaFija", $row[10]);
            $hojaActiva2->setCellValue("I$lineaFija", 'Fija');
            $hojaActiva2->setCellValue("J$lineaFija", $tipofijarepor);
            $hojaActiva2->setCellValue("K$lineaFija", $row[12]);
            $hojaActiva2->setCellValue("L$lineaFija", $row[21]);
            $hojaActiva2->setCellValue("M$lineaFija", $row[20]);
            $hojaActiva2->setCellValue("N$lineaFija", $formapagorepor);
            $hojaActiva2->setCellValue("O$lineaFija", $row[25]);
            $hojaActiva2->setCellValue("P$lineaFija", $row[23]);
            $hojaActiva2->setCellValue("Q$lineaFija", $row[24]);
            $hojaActiva2->setCellValue("R$lineaFija", $fechar);

            $lineaFija = $lineaFija + 1;
        }

        if ($row[9] == "1") 
        {
            // modalidad
            if ($row[15] == "0") 
            {
                $modalidadrepor = "Prepago";
            }
            elseif ($row[15] == "1") 
            {
                $modalidadrepor = "Postpago";
            }
            elseif ($row[15] == "-") 
            {
                $modalidadrepor = "---";
            }
    
            // modo de renovacion
            if ($row[22] == "0") 
            {
                $modorenovarepor = "Descendente";
            }
            elseif ($row[22] == "1") 
            {
                $modorenovarepor = "Ascendente";
            }
            elseif ($row[22] == "-") 
            {
                $modorenovarepor = "---";
            }
    
            // tipo de linea
            if ($row[11] == "0") 
            {
                $tiporepor = "Linea Nueva";
            }
            elseif ($row[11] == "1") 
            {
                $tiporepor = "Portabilidad";
            }
            elseif ($row[11] == "2") 
            {
                $tiporepor = "Renovación";
            }
            elseif ($row[11] == "-") 
            {
                $tiporepor = "---";
            }

            $hojaActiva->getStyle("A$lineaMovil:V$lineaMovil")->getAlignment()->setHorizontal('center');
            $hojaActiva->getStyle("A$lineaMovil:V$lineaMovil")->getAlignment()->setVertical('center');
    
            // CONTENIDO DE VENTA
            $hojaActiva->setCellValue("A$lineaMovil", "$dniAsesorlis / $nombreAsesorlis");
            $hojaActiva->setCellValue("B$lineaMovil", "$dniClientelis / $nombreClientelis");
            $hojaActiva->setCellValue("C$lineaMovil", $estadorepor);
            $hojaActiva->setCellValue("D$lineaMovil", $row[5]);
            $hojaActiva->setCellValue("E$lineaMovil", $origenvenrepor);
            
            // CONTENIDO DEL DETALLE DE VENTA
            $hojaActiva->setCellValue("F$lineaMovil", $row[8]);
            $hojaActiva->setCellValue("G$lineaMovil", $estadoproducrepor);
            $hojaActiva->setCellValue("H$lineaMovil", $row[10]);
            $hojaActiva->setCellValue("I$lineaMovil", 'Movil');
            $hojaActiva->setCellValue("J$lineaMovil", $tiporepor);
            $hojaActiva->setCellValue("K$lineaMovil", $row[12]);
            $hojaActiva->setCellValue("L$lineaMovil", $row[13]);
            $hojaActiva->setCellValue("M$lineaMovil", $row[14]);
            $hojaActiva->setCellValue("N$lineaMovil", $modalidadrepor);
            $hojaActiva->setCellValue("O$lineaMovil", $modorenovarepor);
            $hojaActiva->setCellValue("P$lineaMovil", $row[17]);
            $hojaActiva->setCellValue("Q$lineaMovil", $row[18]);
            $hojaActiva->setCellValue("R$lineaMovil", $formapagorepor);
            $hojaActiva->setCellValue("S$lineaMovil", $row[25]);
            $hojaActiva->setCellValue("T$lineaMovil", $row[23]);
            $hojaActiva->setCellValue("U$lineaMovil", $row[24]);
            $hojaActiva->setCellValue("V$lineaMovil", $fechar);//'11/01/2023 12:30:15'
            
            $lineaMovil = $lineaMovil + 1;
        }
    }
    
    // nombre del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Reporte de Ventas'.$name.' - '.$nombredeempresa.'.xlsx"');
    header('Cache-Control: max-age=0');

    // salida de archivo
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
}
?>