<?php 
require_once "model/conexion.php";

$cone = new conexion();
$consulta = $cone->conectar();

if ($tipoUsuario === "1") 
{ 
    // ventas totales
    $sql = "SELECT * from detalleventas where (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP))";
    $resultado = mysqli_query($consulta,$sql);
    $ventasTotales = $resultado->num_rows;
    // ventas rechazadas
    $sql3 = "SELECT * from detalleventas where (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP)) and estado='0'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasRechazadas = $resultado3->num_rows;
    // ventas concretadas
    $sql1 = "SELECT * from detalleventas where (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP)) and estado='1'";
    $resultado1 = mysqli_query($consulta,$sql1);
    $ventasConcretadas = $resultado1->num_rows;
    // ventas pendientes
    $sql2 = "SELECT * from detalleventas where (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP)) and estado='2'";
    $resultado2 = mysqli_query($consulta,$sql2);
    $ventasPendientes = $resultado2->num_rows;
}
elseif ($tipoUsuario === "2") 
{
    // ventas totales
    $sql = "SELECT * from detalleventas as dv inner join ventas as v INNER JOIN usuarios as u on v.dniAsesor=u.dni and dv.sec=v.sec where u.dniModerador='$dniUsuario' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP))";
    $resultado = mysqli_query($consulta,$sql);
    $ventasTotales = $resultado->num_rows;
    // ventas rechazadas
    $sql3 = "SELECT * from detalleventas as dv inner join ventas as v INNER JOIN usuarios as u on v.dniAsesor=u.dni and dv.sec=v.sec where u.dniModerador='$dniUsuario' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='0'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasRechazadas = $resultado3->num_rows;
    // ventas concretadas
    $sql1 = "SELECT * from detalleventas as dv inner join ventas as v INNER JOIN usuarios as u on v.dniAsesor=u.dni and dv.sec=v.sec where u.dniModerador='$dniUsuario' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='1'";
    $resultado1 = mysqli_query($consulta,$sql1);
    $ventasConcretadas = $resultado1->num_rows;
    // ventas pendientes
    $sql2 = "SELECT * from detalleventas as dv inner join ventas as v INNER JOIN usuarios as u on v.dniAsesor=u.dni and dv.sec=v.sec where u.dniModerador='$dniUsuario' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='2'";
    $resultado2 = mysqli_query($consulta,$sql2);
    $ventasPendientes = $resultado2->num_rows;
}
?>
<?php include_once "componentes/header.php"; ?>
<?php include_once "componentes/contenidoDashboard.php"; ?>
<?php include_once "componentes/footer.php"; ?>