<?php
require "../../librerias/PHPExcel/Classes/PHPExcel.php";
require_once "../../model/conexion.php";

$model = new conexion();
$con = $model -> conectar();

require_once "../../model/archivos.php";
$procearchivos = new archivos();

if ($_FILES['masiva']['name']) 
{
    // subiendo el archivo al sistema
    $masiva = $_FILES['masiva']['name'];
        $dirtMasiva = "../../view/static/archivos/masiva/".$masiva;
        copy($_FILES['masiva']['tmp_name'],$dirtMasiva);
        
    // detenemos el codigo un momento para que procesen los datos
    sleep(0.8);

    // especificando la ubicacion del archivo
    $archivoMasiva = $dirtMasiva;

    // cargando el archivo con la libreria
    $excelMasiva = PHPExcel_IOFactory::load($archivoMasiva);

    // cargar la hoja escefica que queremos
    $excelMasiva -> setActiveSheetIndex(0);

    // obtener el numero de filas del archivo
    $numerofila = $excelMasiva -> setActiveSheetIndex(0) -> getHighestRow();
    // echo $numerofila;

    for ($i=2; $i <= $numerofila ; $i++) 
    {
        // se especifican las variables
        $documento = $excelMasiva -> getActiveSheet() -> getCell('A'.$i) -> getCalculatedValue();
        $nombre = $excelMasiva -> getActiveSheet() -> getCell('B'.$i) -> getCalculatedValue();
        $tel_Fijo = $excelMasiva -> getActiveSheet() -> getCell('C'.$i) -> getCalculatedValue();
        $celular = $excelMasiva -> getActiveSheet() -> getCell('D'.$i) -> getCalculatedValue();
        $fechaActivacion = $excelMasiva -> getActiveSheet() -> getCell('E'.$i) -> getCalculatedValue();
        $operador = $excelMasiva -> getActiveSheet() -> getCell('F'.$i) -> getCalculatedValue();
        $tipo_plan = $excelMasiva -> getActiveSheet() -> getCell('G'.$i) -> getCalculatedValue();
        $direccion = $excelMasiva -> getActiveSheet() -> getCell('H'.$i) -> getCalculatedValue();
        $distrito = $excelMasiva -> getActiveSheet() -> getCell('I'.$i) -> getCalculatedValue();
        $provincia = $excelMasiva -> getActiveSheet() -> getCell('J'.$i) -> getCalculatedValue();
        $departamento = $excelMasiva -> getActiveSheet() -> getCell('K'.$i) -> getCalculatedValue();

        // se ejecuta la insercion
        $procearchivos->insertarMasiva($documento,$nombre,$tel_Fijo,$celular,$fechaActivacion,$operador,$tipo_plan,$direccion,$distrito,$provincia,$departamento);
    }
}

if ($_FILES['productos']['name']) 
{
    // subiendo el archivo al sistema
    $producto = $_FILES['productos']['name'];
        $dirtProductos = "../../view/static/archivos/productos/".$producto;
        copy($_FILES['productos']['tmp_name'],$dirtProductos);
        
    // detenemos el codigo un momento para que procesen los datos
    sleep(0.8);

    // especificando la ubicacion del archivo
    $archivoProductos = $dirtProductos;

    // cargando el archivo con la libreria
    $excelProductos = PHPExcel_IOFactory::load($archivoProductos);

    // cargar la hoja escefica que queremos
    $excelProductos -> setActiveSheetIndex(1);

    // obtener el numero de filas del archivo
    $numerofila = $excelProductos -> setActiveSheetIndex(1) -> getHighestRow();
    // echo $numerofila;

    // eliminamos la tabla antigua para reemplazar los datos
    $sqlprod = "delete from productos";
    $rsd=sqlsrv_query($con,$sqlprod);

    for ($i=2; $i <= $numerofila ; $i++) 
    {
        // se especifican las variables
        $region = $excelProductos -> getActiveSheet() -> getCell('A'.$i) -> getCalculatedValue();
        $nombre = $excelProductos -> getActiveSheet() -> getCell('B'.$i) -> getCalculatedValue();
        $centro = $excelProductos -> getActiveSheet() -> getCell('C'.$i) -> getCalculatedValue();
        $almacen = $excelProductos -> getActiveSheet() -> getCell('D'.$i) -> getCalculatedValue();
        $nombreAlmacen = $excelProductos -> getActiveSheet() -> getCell('E'.$i) -> getCalculatedValue();
        $material = $excelProductos -> getActiveSheet() -> getCell('F'.$i) -> getCalculatedValue();
        $descripcion = $excelProductos -> getActiveSheet() -> getCell('G'.$i) -> getCalculatedValue();
        $libres = $excelProductos -> getActiveSheet() -> getCell('H'.$i) -> getCalculatedValue();
        $bloqueados = $excelProductos -> getActiveSheet() -> getCell('I'.$i) -> getCalculatedValue();

        // se ejecuta la insercion
        $procearchivos->insertarProductos($region,$nombre,$centro,$almacen,$nombreAlmacen,$material,$descripcion,$libres,$bloqueados);
    }
}

if ($_FILES['cac']['name']) 
{
    // subiendo el archivo al sistema
    $cac = $_FILES['cac']['name'];
        $dirtCac = "../../view/static/archivos/ubicaciones/cac/".$cac;
        copy($_FILES['cac']['tmp_name'],$dirtCac);
        
    // detenemos el codigo un momento para que procesen los datos
    sleep(0.8);

    // especificando la ubicacion del archivo
    $archivoCac = $dirtCac;

    // cargando el archivo con la libreria
    $excelCac = PHPExcel_IOFactory::load($archivoCac);

    // cargar la hoja escefica que queremos
    $excelCac -> setActiveSheetIndex(0);

    // obtener el numero de filas del archivo
    $numerofila = $excelCac -> setActiveSheetIndex(0) -> getHighestRow();
    // echo $numerofila;

    // eliminamos la tabla antigua para reemplazar los datos
    $sqlcac = "delete from cac";
    $rsd=sqlsrv_query($con,$sqlcac);

    for ($i=2; $i <= $numerofila ; $i++) 
    {
        // se especifican las variables
        $region = $excelCac -> getActiveSheet() -> getCell('A'.$i) -> getCalculatedValue();
        $pdv = $excelCac -> getActiveSheet() -> getCell('B'.$i) -> getCalculatedValue();
        $nombre = $excelCac -> getActiveSheet() -> getCell('C'.$i) -> getCalculatedValue();
        $entrega = $excelCac -> getActiveSheet() -> getCell('D'.$i) -> getCalculatedValue();
        $direccion = $excelCac -> getActiveSheet() -> getCell('E'.$i) -> getCalculatedValue();
        $distrito = $excelCac -> getActiveSheet() -> getCell('F'.$i) -> getCalculatedValue();
        $provincia = $excelCac -> getActiveSheet() -> getCell('G'.$i) -> getCalculatedValue();
        $departamento = $excelCac -> getActiveSheet() -> getCell('H'.$i) -> getCalculatedValue();
        $horario = $excelCac -> getActiveSheet() -> getCell('I'.$i) -> getCalculatedValue();

        // se ejecuta la insercion
        $procearchivos->insertarCac($region,$pdv,$nombre,$entrega,$direccion,$distrito,$provincia,$departamento,$horario);
    }
}

if ($_FILES['dac']['name']) 
{
    // subiendo el archivo al sistema
    $dac = $_FILES['dac']['name'];
        $dirtDac = "../../view/static/archivos/ubicaciones/dac/".$dac;
        copy($_FILES['dac']['tmp_name'],$dirtDac);
        
    // detenemos el codigo un momento para que procesen los datos
    sleep(0.8);

    // especificando la ubicacion del archivo
    $archivoDac = $dirtDac;

    // cargando el archivo con la libreria
    $excelDac = PHPExcel_IOFactory::load($archivoDac);

    // cargar la hoja escefica que queremos
    $excelDac -> setActiveSheetIndex(0);

    // obtener el numero de filas del archivo
    $numerofila = $excelDac -> setActiveSheetIndex(0) -> getHighestRow();
    // echo $numerofila;

    // eliminamos la tabla antigua para reemplazar los datos
    $sqldac = "delete from dac";
    $rsd=sqlsrv_query($con,$sqldac);

    for ($i=2; $i <= $numerofila ; $i++) 
    {
        // se especifican las variables
        $nombre = $excelDac -> getActiveSheet() -> getCell('A'.$i) -> getCalculatedValue();
        $distrito = $excelDac -> getActiveSheet() -> getCell('B'.$i) -> getCalculatedValue();
        $provincia = $excelDac -> getActiveSheet() -> getCell('C'.$i) -> getCalculatedValue();
        $departamento = $excelDac -> getActiveSheet() -> getCell('D'.$i) -> getCalculatedValue();
        $region = $excelDac -> getActiveSheet() -> getCell('E'.$i) -> getCalculatedValue();
        $direccion = $excelDac -> getActiveSheet() -> getCell('F'.$i) -> getCalculatedValue();
        $descripcion = $excelDac -> getActiveSheet() -> getCell('G'.$i) -> getCalculatedValue();

        // se ejecuta la insercion
        $procearchivos->insertarDac($nombre,$distrito,$provincia,$departamento,$region,$direccion,$descripcion);
    }
}

if ($_FILES['acd']['name']) 
{
    // subiendo el archivo al sistema
    $acd = $_FILES['acd']['name'];
        $dirtAcd = "../../view/static/archivos/ubicaciones/acd/".$acd;
        copy($_FILES['acd']['tmp_name'],$dirtAcd);
        
    // detenemos el codigo un momento para que procesen los datos
    sleep(0.8);

    // especificando la ubicacion del archivo
    $archivoAcd = $dirtAcd;

    // cargando el archivo con la libreria
    $excelAcd = PHPExcel_IOFactory::load($archivoAcd);

    // cargar la hoja escefica que queremos
    $excelAcd -> setActiveSheetIndex(1);

    // obtener el numero de filas del archivo
    $numerofila = $excelAcd -> setActiveSheetIndex(1) -> getHighestRow();
    // echo $numerofila;

    // eliminamos la tabla antigua para reemplazar los datos
    $sqlacd = "delete from acd";
    $rsd=sqlsrv_query($con,$sqlacd);

    for ($i=2; $i <= $numerofila ; $i++) 
    {
        // se especifican las variables
        $region = $excelAcd -> getActiveSheet() -> getCell('A'.$i) -> getCalculatedValue();
        $pdv = $excelAcd -> getActiveSheet() -> getCell('B'.$i) -> getCalculatedValue();
        $nombre = $excelAcd -> getActiveSheet() -> getCell('C'.$i) -> getCalculatedValue();
        $entrega = $excelAcd -> getActiveSheet() -> getCell('D'.$i) -> getCalculatedValue();
        $pdvsisact = $excelAcd -> getActiveSheet() -> getCell('E'.$i) -> getCalculatedValue();
        $codpdv = $excelAcd -> getActiveSheet() -> getCell('F'.$i) -> getCalculatedValue();
        $descripcion = $excelAcd -> getActiveSheet() -> getCell('G'.$i) -> getCalculatedValue();
        $direccion = $excelAcd -> getActiveSheet() -> getCell('H'.$i) -> getCalculatedValue();
        $distrito = $excelAcd -> getActiveSheet() -> getCell('I'.$i) -> getCalculatedValue();
        $provincia = $excelAcd -> getActiveSheet() -> getCell('J'.$i) -> getCalculatedValue();
        $departamento = $excelAcd -> getActiveSheet() -> getCell('K'.$i) -> getCalculatedValue();
        $horario = $excelAcd -> getActiveSheet() -> getCell('L'.$i) -> getCalculatedValue();
        $estado = $excelAcd -> getActiveSheet() -> getCell('M'.$i) -> getCalculatedValue();
        $alta = $excelAcd -> getActiveSheet() -> getCell('N'.$i) -> getCalculatedValue();
        $baja = $excelAcd -> getActiveSheet() -> getCell('O'.$i) -> getCalculatedValue();

        // se ejecuta la insercion
        $procearchivos->insertarAcd($region,$pdv,$nombre,$entrega,$pdvsisact,$codpdv,$descripcion,$direccion,$distrito,$provincia,$departamento,$horario,$estado,$alta,$baja);
    }
}

if ($_FILES['cadena']['name']) 
{
    // subiendo el archivo al sistema
    $cadena = $_FILES['cadena']['name'];
        $dirtCadena = "../../view/static/archivos/ubicaciones/cadena/".$cadena;
        copy($_FILES['cadena']['tmp_name'],$dirtCadena);
        
    // detenemos el codigo un momento para que procesen los datos
    sleep(0.8);

    // especificando la ubicacion del archivo
    $archivoCadena = $dirtCadena;

    // cargando el archivo con la libreria
    $excelCadena = PHPExcel_IOFactory::load($archivoCadena);

    // cargar la hoja escefica que queremos
    $excelCadena -> setActiveSheetIndex(0);

    // obtener el numero de filas del archivo
    $numerofila = $excelCadena -> setActiveSheetIndex(0) -> getHighestRow();
    // echo $numerofila;

    // eliminamos la tabla antigua para reemplazar los datos
    $sqlcadena = "delete from cadena";
    $rsd=sqlsrv_query($con,$sqlcadena);

    for ($i=2; $i <= $numerofila ; $i++) 
    {
        // se especifican las variables
        $region = $excelCadena -> getActiveSheet() -> getCell('A'.$i) -> getCalculatedValue();
        $razonsocial = $excelCadena -> getActiveSheet() -> getCell('B'.$i) -> getCalculatedValue();
        $codigointer = $excelCadena -> getActiveSheet() -> getCell('C'.$i) -> getCalculatedValue();
        $codpdv = $excelCadena -> getActiveSheet() -> getCell('D'.$i) -> getCalculatedValue();
        $pdvsisact = $excelCadena -> getActiveSheet() -> getCell('E'.$i) -> getCalculatedValue();
        $entrega = $excelCadena -> getActiveSheet() -> getCell('F'.$i) -> getCalculatedValue();
        $direccion = $excelCadena -> getActiveSheet() -> getCell('G'.$i) -> getCalculatedValue();
        $distrito = $excelCadena -> getActiveSheet() -> getCell('H'.$i) -> getCalculatedValue();
        $provincia = $excelCadena -> getActiveSheet() -> getCell('I'.$i) -> getCalculatedValue();
        $departamento = $excelCadena -> getActiveSheet() -> getCell('J'.$i) -> getCalculatedValue();
        $dias = $excelCadena -> getActiveSheet() -> getCell('K'.$i) -> getCalculatedValue();
        $horario = $excelCadena -> getActiveSheet() -> getCell('L'.$i) -> getCalculatedValue();
        $estado = $excelCadena -> getActiveSheet() -> getCell('M'.$i) -> getCalculatedValue();

        // se ejecuta la insercion
        $procearchivos->insertarCadena($region,$razonsocial,$codigointer,$codpdv,$pdvsisact,$entrega,$direccion,$distrito,$provincia,$departamento,$dias,$horario,$estado);
    }
}
?>
<script>
    window.history.back();
</script>