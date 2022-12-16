<?php 
require_once "model/conexion.php";

$cone = new conexion();
$consulta = $cone->conectar();

// ventas totales
$sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP))";
$resultado = mysqli_query($consulta,$sql);
$ventasTotales = $resultado->num_rows;
// ventas concretadas
$sql1 = "select * from whatsapp where estado='1' and (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP))";
$resultado1 = mysqli_query($consulta,$sql1);
$ventasConcretadas = $resultado1->num_rows;
// ventas pendientes
$sql2 = "select * from whatsapp where estado='2' and (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP))";
$resultado2 = mysqli_query($consulta,$sql2);
$ventasPendientes = $resultado2->num_rows;
// ventas rechazadas
$sql3 = "select * from whatsapp where estado='0' and (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP))";
$resultado3 = mysqli_query($consulta,$sql3);
$ventasRechazadas = $resultado3->num_rows;
?>
<?php include_once "componentes/header.php"; ?>
<?php include_once "componentes/contenidoDashboard.php"; ?>
<?php include_once "componentes/footer.php"; ?>