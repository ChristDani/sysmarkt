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
    public function agregarDetalleVenta($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$telefono,$lineaProce,$modalidad,$plan,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into whatsapp(dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values('$asesor','$nombre','$dni','$telefono','$producto','$lineaProce','---','$modalidad','$tipo','$plan','$equipos','$formaPago','$telefonoRef','$sec','-','---','---','$estado','$observacion','$promocion','$ubicacion','$distrito')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // ediciones

    // movil en reno post
    public function editarMovilRenoPost($codigo,$asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$telefono,$lineaProce,$modalidad,$plan,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();

        $sql="update whatsapp set dniAsesor='$asesor', nombre='$nombre', dni='$dni', numeroReferencia='$telefonoRef', producto='$producto', promocion='$promocion', tipo='$tipo', telefono='$telefono', lineaProcedente='$lineaProce', modalidad='$modalidad', planR='$plan', equipo='$equipos', formaDePago='$formaPago', sec='$sec', estado='$estado', observaciones='$observacion', ubicacion='$ubicacion', distrito='$distrito', fechaActualizacion=CURRENT_TIMESTAMP where codigo='$codigo'";

        $rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }
}

?>