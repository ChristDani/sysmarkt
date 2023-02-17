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

$columnas=['c.dni', 'c.nombre', 'c.ubicacion', 'c.distrito', 'c.registro', 't.telefono', 't.tipo', 't.operador', 't.tipoLinea'];
$columnasabuscar=['dni', 'nombre', 'ubicacion', 'distrito'];

$tabla='clientes as c inner join telefonos as t on c.dni = t.dniCliente';

$busqueda = !empty($_POST['busquedaclientereportes']) ? $_POST['busquedaclientereportes'] : null;

$where='';
$name = '';

if ($busqueda != null) 
{
    $name .= " - filtrado por: '$busqueda'";
}

// consulta para crear el reporte
if ($busqueda != null) 
{
    // $where .= "where departamento like '%".$busqueda."%'";
    $where.=" where (";
    $cont= count($columnasabuscar);
        for ($i=0; $i < $cont; $i++) 
        { 
            $where.=$columnasabuscar[$i]." like '%".$busqueda."%' or ";
        }
    $where=substr_replace($where, "", -3);
    $where.=")";
}

$sql = "select ".implode(", ", $columnas)." from $tabla $where order by c.nombre";
$reportecsv = mysqli_query($con,$sql);

if (isset($_POST['btngenerarreporteclientes'])) 
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
        $imagenesinsert->setOffsetX(10);
        $imagenesinsert->setOffsetY(10);
        $imagenesinsert->setResizeProportional(true);
        $imagenesinsert->setWorksheet($sheet);
    }
    $spreadsheet->getProperties()->setCreator($nombredeempresa)->setTitle("Reporte de Clientes - $nombredeempresa")->setCategory('Data')->setLastModifiedBy($nombredeempresa);

    // encabezados
    $spreadsheet->setActiveSheetIndex(0);
    $hojaActiva = $spreadsheet->getActiveSheet();
    $spreadsheet->getActiveSheet()->setTitle('Reporte de Clientes');
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

    $hojaActiva->mergeCells('B1:I1');
    $hojaActiva->getRowDimension('1')->setRowHeight(70);
    $hojaActiva->getRowDimension('2')->setRowHeight(25);
    $hojaActiva->getStyle('B1:I1')->getFont()->setName('arial')->setSize(15);
    $hojaActiva->getStyle('B1:I1')->getAlignment()->setHorizontal('center');
    $hojaActiva->getStyle('B1:I1')->getAlignment()->setVertical('center');
    $hojaActiva->getStyle('A2:I2')->getAlignment()->setHorizontal('center');
    $hojaActiva->getStyle('A2:I2')->getAlignment()->setVertical('center');
    $hojaActiva->getStyle('A1:I1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E0F9E3');
    $hojaActiva->getStyle('A2:I2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('C6E3EF');
    $hojaActiva->getStyle('A1:I1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $hojaActiva->getStyle('A2:I2')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    
    addImage($logodeempresa,'A1',$spreadsheet->getActiveSheet());
    $hojaActiva->setCellValue('B1', "Reporte de Clientes$name - $nombredeempresa");
    $hojaActiva->getColumnDimension('A')->setWidth(5);

    // ESTRUCTURA DE ENCABEZADO 
    $hojaActiva->setCellValue('A2', 'DNI');
    $hojaActiva->setCellValue('B2', 'Nombre');
    $hojaActiva->setCellValue('C2', 'Ubicacion');
    $hojaActiva->setCellValue('D2', 'Distrito');
    $hojaActiva->setCellValue('E2', 'Fecha de Registro');
    $hojaActiva->setCellValue('F2', 'Telefono');
    $hojaActiva->setCellValue('G2', 'Tipo de Linea');
    $hojaActiva->setCellValue('H2', 'Operador');
    $hojaActiva->setCellValue('I2', 'Modalidad');
    
    $linea = 3;
    while($row=mysqli_fetch_array($reportecsv))
    {
        if ($row[6] == "0") 
        {
            $tipodelinearc = "Linea Fija";
        }
        elseif ($row[6] == "1") 
        {
            $tipodelinearc = "Linea Movil";
        }
        elseif ($row[6] == "-") 
        {
            $tipodelinearc = "---";
        }

        if ($row[8] == "0") 
        {
            $modalidadderep = "Prepago";
        }
        elseif ($row[8] == "1") 
        {
            $modalidadderep = "Postpago";
        }
        elseif ($row[8] == "-") 
        {
            $modalidadderep = "---";
        }

        $fecha = date('d/m/y h:i:s A', strtotime($row[4]));

        $hojaActiva->getStyle("A$linea:I$linea")->getAlignment()->setHorizontal('center');
        $hojaActiva->getStyle("A$linea:I$linea")->getAlignment()->setVertical('center');

        // CONTENIDO
        $hojaActiva->setCellValue("A$linea", $row[0]);
        $hojaActiva->setCellValue("B$linea", $row[1]);
        $hojaActiva->setCellValue("C$linea", $row[2]);
        $hojaActiva->setCellValue("D$linea", $row[3]);
        $hojaActiva->setCellValue("E$linea", $fecha);
        $hojaActiva->setCellValue("F$linea", $row[5]);
        $hojaActiva->setCellValue("G$linea", $tipodelinearc);
        $hojaActiva->setCellValue("H$linea", $row[7]);
        $hojaActiva->setCellValue("I$linea", $modalidadderep);

        $linea = $linea + 1;
    }
    
    // nombre del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Reporte de Clientes'.$name.' - '.$nombredeempresa.'.xlsx"');
    header('Cache-Control: max-age=0');

    // salida de archivo
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
}
?>