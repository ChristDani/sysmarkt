<?php
require_once 'conexion.php';

class ventas
{
    // insersiones

    // fija en porta 
    public function agregarVenta($dniAsesor,$dniCliente,$sec)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="INSERT INTO ventas(dniAsesor,dniCliente,estado,sec,origen) VALUES ('$dniAsesor','$dniCliente','0','$sec','0');";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // movil en reno post
    public function agregarDetalleVenta($sec,$referencia,$producto,$promocion,$tipo,$telefop,$lineaproce,$operaceden,$modalidad,$modoreno,$plan,$equipo,$tipofija,$planfija,$modofija,$formapago,$distrito,$ubicacion,$observacion,$estado)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="INSERT INTO detalleventas(sec, telefonoRefencia, producto, promocion, tipo, telefonoOperacion, lineaProcedente, operadorCendente, modalidad, modoReno, plan, equipo, tipoFija, planFija, modoFija, formaPago, distrito, ubicacion, observaciones, estado) VALUES ('$sec','$referencia','$producto','$promocion','$tipo','$telefop','$lineaproce','$operaceden','$modalidad','$modoreno','$plan','$equipo','$tipofija','$planfija','$modofija','$formapago','$distrito','$ubicacion','$observacion','$estado')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // ediciones

    // $contarProductos="select * from detalleventas where sec='".$fila['sec']."'";
    // $contarProductosCerrados="select * from detalleventas where sec='".$fila['sec']."' and estado != '2'";
    
    // $resulcontarProductos=mysqli_query($con,$contarProductos);
    // $resulcontarProductosCerrados=mysqli_query($con,$contarProductosCerrados);
    
    // $totalcontarProductos = $resulcontarProductos->num_rows;
    // $totalcontarProductosCerrados = $resulcontarProductosCerrados->num_rows;
    // if ($totalcontarProductos > $totalcontarProductosCerrados) {
    //     $cambio = "update ventas set estado = 0 where sec = '".$fila['sec']."'";
    //     $cam=mysqli_query($con,$cambio);
    // }
    // elseif ($totalcontarProductos = $totalcontarProductosCerrados) {
    //     $cambio = "update ventas set estado = 1 where sec = '".$fila['sec']."'";
    //     $cam=mysqli_query($con,$cambio);
    // }

    // movil en reno post
    public function editarDetalle($codigo,$asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$telefono,$lineaProce,$modalidad,$plan,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();

        $sql="update whatsapp set dniAsesor='$asesor', nombre='$nombre', dni='$dni', numeroReferencia='$telefonoRef', producto='$producto', promocion='$promocion', tipo='$tipo', telefono='$telefono', lineaProcedente='$lineaProce', modalidad='$modalidad', planR='$plan', equipo='$equipos', formaDePago='$formaPago', sec='$sec', estado='$estado', observaciones='$observacion', ubicacion='$ubicacion', distrito='$distrito', fechaActualizacion=CURRENT_TIMESTAMP where codigo='$codigo'";

        $rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }
}

?>