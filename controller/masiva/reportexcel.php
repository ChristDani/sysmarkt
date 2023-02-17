<?php
require_once '../../model/conexion.php';
require_once '../../model/empresa.php';
require "../../librerias/vendor/autoload.php";

$conexion = new conexion();
$con = $conexion->conectar();

$modelempresa = new empresa();

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

$columnas=['documento', 'nombre', 'tel_Fijo', 'celular', 'fechaActivacion', 'operador', 'tipo_plan', 'direccion', 'distrito', 'provincia', 'departamento', 'fechaRegistro'];

$tabla='masiva';

$busquedaconsultareportedepamasiva = !empty($_POST['busquedareportedepartamentomasiva']) ? $_POST['busquedareportedepartamentomasiva'] : null;
$busquedaconsultareporteprovimasiva = !empty($_POST['busquedareporteprovinciamasiva']) ? $_POST['busquedareporteprovinciamasiva'] : null;
$bustelodni = !empty($_POST['busquedareportedistritomasiva']) ? $_POST['busquedareportedistritomasiva'] : null;

$where='';
$name = '';

if ($busquedaconsultareportedepamasiva != null) 
{
    $name .= " - Departamento: $busquedaconsultareportedepamasiva";
    if ($busquedaconsultareporteprovimasiva != null) 
    {
        $name .= " - Provincia: $busquedaconsultareporteprovimasiva";        
        if ($bustelodni != null) 
        {
            $name .= " - Telefono/DNI: $bustelodni";        
        }
    }
    elseif ($bustelodni != null) 
    {
        $name .= " - Telefono/DNI: $bustelodni"; 
    }
}
elseif ($busquedaconsultareporteprovimasiva != null and $busquedaconsultareportedepamasiva == null) 
{
    $name .= " - Provincia: $busquedaconsultareporteprovimasiva";   
    if ($bustelodni != null) 
    {
        $name .= " - Telefono/DNI: $bustelodni"; 
    }
}
elseif ($bustelodni !=null and $busquedaconsultareportedepamasiva == null and $busquedaconsultareporteprovimasiva == null) 
{
    $name .= " - Telefono/DNI: $bustelodni"; 
}

// consulta para crear el reporte
if ($busquedaconsultareportedepamasiva != null) 
{
    $where .= "where departamento like '%".$busquedaconsultareportedepamasiva."%'";
    if ($busquedaconsultareporteprovimasiva != null) 
    {
        $where .= " and provincia like '%".$busquedaconsultareporteprovimasiva."%'";
        if ($bustelodni != null) 
        {
            $where .= " and (documento like '%".$bustelodni."%' or celular like '%".$bustelodni."%')";
        }
    }
    elseif ($bustelodni != null) 
    {
        $where .= " and (documento like '%".$bustelodni."%' or celular like '%".$bustelodni."%')";
    }
}
elseif ($busquedaconsultareporteprovimasiva != null and $busquedaconsultareportedepamasiva == null) 
{
    $where .= "where provincia like '%".$busquedaconsultareporteprovimasiva."%'";
    if ($bustelodni != null) 
    {
        $where .= " and (documento like '%".$bustelodni."%' or celular like '%".$bustelodni."%')";
    }
}
elseif ($bustelodni !=null and $busquedaconsultareportedepamasiva == null and $busquedaconsultareporteprovimasiva == null) 
{
    $where .= "where (documento like '%".$bustelodni."%' or celular like '%".$bustelodni."%')";
}

$sql = "select ".implode(", ", $columnas)." from $tabla $where order by documento desc";
$reportecsv = mysqli_query($con,$sql);

if (isset($_POST['btngenerarreportemasiva'])) 
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
    $spreadsheet->getProperties()->setCreator($nombredeempresa)->setTitle("Data Masiva - $nombredeempresa")->setCategory('Data')->setLastModifiedBy($nombredeempresa);

    // encabezados
    $spreadsheet->setActiveSheetIndex(0);
    $hojaActiva = $spreadsheet->getActiveSheet();
    $spreadsheet->getActiveSheet()->setTitle('Data Masiva');
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

    $hojaActiva->mergeCells('B1:L1');
    $hojaActiva->getRowDimension('1')->setRowHeight(70);
    $hojaActiva->getRowDimension('2')->setRowHeight(25);
    $hojaActiva->getStyle('B1:L1')->getFont()->setName('arial')->setSize(15);
    $hojaActiva->getStyle('B1:L1')->getAlignment()->setHorizontal('center');
    $hojaActiva->getStyle('B1:L1')->getAlignment()->setVertical('center');
    $hojaActiva->getStyle('A2:L2')->getAlignment()->setHorizontal('center');
    $hojaActiva->getStyle('A2:L2')->getAlignment()->setVertical('center');
    $hojaActiva->getStyle('A1:L1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E0F9E3');
    $hojaActiva->getStyle('A2:L2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('C6E3EF');
    $hojaActiva->getStyle('A1:L1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $hojaActiva->getStyle('A2:L2')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    
    addImage($logodeempresa,'A1',$spreadsheet->getActiveSheet());
    $hojaActiva->setCellValue('B1', "Data Masiva$name - $nombredeempresa");
    $hojaActiva->getColumnDimension('A')->setWidth(5);

    // ESTRUCTURA DE ENCABEZADO 
    $hojaActiva->setCellValue('A2', 'DNI');
    $hojaActiva->setCellValue('B2', 'Nombre');
    $hojaActiva->setCellValue('C2', 'Telf. Fijo');
    $hojaActiva->setCellValue('D2', 'Telf. Movil');
    $hojaActiva->setCellValue('E2', 'Fecha de Activación');
    $hojaActiva->setCellValue('F2', 'Operador');
    $hojaActiva->setCellValue('G2', 'Tipo de Plan');
    $hojaActiva->setCellValue('H2', 'Dirección');
    $hojaActiva->setCellValue('I2', 'Distrito');
    $hojaActiva->setCellValue('J2', 'Provincia');
    $hojaActiva->setCellValue('K2', 'Departamento');
    $hojaActiva->setCellValue('L2', 'Fecha de Registro');
    
    $linea = 3;
    while($row=mysqli_fetch_array($reportecsv))
    {
        $fechaac = date('d/m/y', strtotime($row['fechaActivacion']));
        $fecha = date('d/m/y h:i:s A', strtotime($row['fechaRegistro']));

        $hojaActiva->getStyle("A$linea:V$linea")->getAlignment()->setHorizontal('center');
        $hojaActiva->getStyle("A$linea:V$linea")->getAlignment()->setVertical('center');

        // CONTENIDO
        $hojaActiva->setCellValue("A$linea", $row['documento']);
        $hojaActiva->setCellValue("B$linea", $row['nombre']);
        $hojaActiva->setCellValue("C$linea", $row['tel_Fijo']);
        $hojaActiva->setCellValue("D$linea", $row['celular']);
        $hojaActiva->setCellValue("E$linea", $fechaac);
        $hojaActiva->setCellValue("F$linea", $row['operador']);
        $hojaActiva->setCellValue("G$linea", $row['tipo_plan']);
        $hojaActiva->setCellValue("H$linea", $row['direccion']);
        $hojaActiva->setCellValue("I$linea", $row['distrito']);
        $hojaActiva->setCellValue("J$linea", $row['provincia']);
        $hojaActiva->setCellValue("K$linea", $row['departamento']);
        $hojaActiva->setCellValue("L$linea", $fecha);

        $linea = $linea + 1;
    }
    
    // nombre del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Data Masiva'.$name.' - '.$nombredeempresa.'.xlsx"');
    header('Cache-Control: max-age=0');

    // salida de archivo
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
}
?>