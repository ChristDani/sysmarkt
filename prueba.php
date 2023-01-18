<?php
require_once "model/conexion.php";
require_once "model/planes.php";

$dniAsesor = "71574122";

$model=new conexion();
$consulta=$model->conectar();

// planes
$planeslist = new planes;
$planesMov = $planeslist->listar();

$abecedario = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z','+','-','/',' '];

$cantidadtotal = 0;
if ($planesMov != null) 
{
    foreach ($planesMov as $pr) 
    {
        $plan = str_replace($abecedario, '', $pr[1]);
        if ($plan < 69.90)
        {
            $p = $pr[1];
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='0' and u.dniModerador like '%$dniAsesor%'";
            $resultado = mysqli_query($consulta,$sql);
            $cantidad = $resultado->num_rows;
            $cantidadtotal = $cantidadtotal+$cantidad;
            echo $sql,"<br>";
            echo $cantidad,"<br>";
        }
    }
}
echo $cantidadtotal,"<br>";

?>