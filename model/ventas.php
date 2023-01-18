<?php
require_once 'conexion.php';

class ventas
{

    public function agregarVenta($dniAsesor,$dniCliente,$sec)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="INSERT INTO ventas(dniAsesor,dniCliente,estado,sec,origen) VALUES ('$dniAsesor','$dniCliente','0','$sec','0');";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function agregarDetalleVenta($sec,$referencia,$producto,$promocion,$tipo,$telefop,$lineaproce,$operaceden,$modalidad,$modoreno,$plan,$equipo,$tipofija,$planfija,$modofija,$formapago,$distrito,$ubicacion,$observacion,$estado)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="INSERT INTO detalleventas(sec, telefonoRefencia, producto, promocion, tipo, telefonoOperacion, lineaProcedente, operadorCendente, modalidad, modoReno, plan, equipo, tipoFija, planFija, modoFija, formaPago, distrito, ubicacion, observaciones, estado) VALUES ('$sec','$referencia','$producto','$promocion','$tipo','$telefop','$lineaproce','$operaceden','$modalidad','$modoreno','$plan','$equipo','$tipofija','$planfija','$modofija','$formapago','$distrito','$ubicacion','$observacion','$estado')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function editarventa($dniAsesor,$sec,$secant)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="UPDATE ventas set dniAsesor='$dniAsesor',sec='$sec' where sec='$secant'";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }
    
    public function editarDetalle($codigo,$sec,$telefonoRef,$promocion,$tipo,$telefono,$lineaProce,$operadorCeden,$modalidad,$modoReno,$plan,$equipos,$tipoFija,$planFija,$modoFija,$formaPago,$distrito,$ubicacion,$observacion,$estado)
    {
        $model=new conexion();
        $con=$model->conectar();

        $sql="UPDATE detalleventas set telefonoRefencia='$telefonoRef',promocion='$promocion',tipo='$tipo',telefonoOperacion='$telefono',lineaProcedente='$lineaProce',operadorCendente='$operadorCeden',modalidad='$modalidad',modoReno='$modoReno',plan='$plan',equipo='$equipos',tipoFija='$tipoFija',planFija='$planFija',modoFija='$modoFija',formaPago='$formaPago',distrito='$distrito',ubicacion='$ubicacion',observaciones='$observacion',estado='$estado' where CodDetalle='$codigo'";

        $contarProductos="select * from detalleventas where sec='$sec'";
        $contarProductosCerrados="select * from detalleventas where sec='$sec' and estado != '2'";

        $rs=mysqli_query($con,$sql);

        $resulcontarProductos=mysqli_query($con,$contarProductos);
        $resulcontarProductosCerrados=mysqli_query($con,$contarProductosCerrados);
        
        $totalcontarProductos = $resulcontarProductos->num_rows;
        $totalcontarProductosCerrados = $resulcontarProductosCerrados->num_rows;

        if ($totalcontarProductos > $totalcontarProductosCerrados) 
        {
            $cambio = "update ventas set estado = 0 where sec = '$sec'";
            $cam=mysqli_query($con,$cambio);
        }
        elseif ($totalcontarProductos = $totalcontarProductosCerrados) 
        {
            $cambio = "update ventas set estado = 1 where sec = '$sec'";
            $cam=mysqli_query($con,$cambio);
        }

		$con=$model->desconectar();
    }
}

?>