<?php
require_once 'conexion.php';

class Whatsapp
{
    // insersiones

    // fija en porta 
    public function agregarFijaPortabilidad($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipoFija,$telefono,$planFija,$modoFija,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into whatsapp(dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values('$asesor','$nombre','$dni','$telefono','$producto','---','---','-','-','---','---','$formaPago','$telefonoRef','$sec','$tipoFija','$planFija','$modoFija','$estado','$observacion','$promocion','$ubicacion','$distrito')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }
    
    // fija en alta
    public function agregarFijaAlta($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipoFija,$planFija,$modoFija,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into whatsapp(dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values('$asesor','$nombre','$dni','---','$producto','---','---','-','-','---','---','$formaPago','$telefonoRef','$sec','$tipoFija','$planFija','$modoFija','$estado','$observacion','$promocion','$ubicacion','$distrito')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }
    
    // movil en alta pre
    public function agregarMovilNewPre($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$modalidad,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into whatsapp(dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values('$asesor','$nombre','$dni','---','$producto','---','---','$modalidad','$tipo','---','$equipos','$formaPago','$telefonoRef','$sec','-','---','---','$estado','$observacion','$promocion','$ubicacion','$distrito')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // movil en alta post
    public function agregarMovilNewPost($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$modalidad,$plan,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into whatsapp(dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values('$asesor','$nombre','$dni','---','$producto','---','---','$modalidad','$tipo','$plan','$equipos','$formaPago','$telefonoRef','$sec','-','---','---','$estado','$observacion','$promocion','$ubicacion','$distrito')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // movil en porta pre
    public function agregarMovilPortaPre($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$telefono,$lineaProce,$operadorCeden,$modalidad,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into whatsapp(dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values('$asesor','$nombre','$dni','$telefono','$producto','$lineaProce','$operadorCeden','$modalidad','$tipo','---','$equipos','$formaPago','$telefonoRef','$sec','-','---','---','$estado','$observacion','$promocion','$ubicacion','$distrito')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // movil en porta post
    public function agregarMovilPortaPost($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$telefono,$lineaProce,$operadorCeden,$modalidad,$plan,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into whatsapp(dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values('$asesor','$nombre','$dni','$telefono','$producto','$lineaProce','$operadorCeden','$modalidad','$tipo','$plan','$equipos','$formaPago','$telefonoRef','$sec','-','---','---','$estado','$observacion','$promocion','$ubicacion','$distrito')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // movil en reno pre
    public function agregarMovilRenoPre($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$telefono,$lineaProce,$modalidad,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into whatsapp(dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values('$asesor','$nombre','$dni','$telefono','$producto','$lineaProce','---','$modalidad','$tipo','---','$equipos','$formaPago','$telefonoRef','$sec','-','---','---','$estado','$observacion','$promocion','$ubicacion','$distrito')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // movil en reno post
    public function agregarMovilRenoPost($asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$telefono,$lineaProce,$modalidad,$plan,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into whatsapp(dniAsesor,nombre,dni,telefono,producto,lineaProcedente,operadorCedente,modalidad,tipo,planR,equipo,formaDePago,numeroReferencia,sec,tipoFija,planFija,modoFija,estado,observaciones,promocion,ubicacion,distrito) values('$asesor','$nombre','$dni','$telefono','$producto','$lineaProce','---','$modalidad','$tipo','$plan','$equipos','$formaPago','$telefonoRef','$sec','-','---','---','$estado','$observacion','$promocion','$ubicacion','$distrito')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // ediciones

    // fija en alta
    public function editarFijaAlta($codigo,$asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipoFija,$planFija,$modoFija,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();

        $sql="update whatsapp set dniAsesor='$asesor', nombre='$nombre', dni='$dni', numeroReferencia='$telefonoRef', producto='$producto', promocion='$promocion', tipoFija='$tipoFija', planFija='$planFija', modoFija='$modoFija', formaDePago='$formaPago', sec='$sec', estado='$estado', observaciones='$observacion', ubicacion='$ubicacion', distrito='$distrito', fechaActualizacion=CURRENT_TIMESTAMP where codigo='$codigo'";

        $rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // fija en porta
    public function editarFijaPortabilidad($codigo,$asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipoFija,$telefono,$planFija,$modoFija,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();

        $sql="update whatsapp set dniAsesor='$asesor', nombre='$nombre', dni='$dni', numeroReferencia='$telefonoRef', producto='$producto', promocion='$promocion', tipoFija='$tipoFija', telefono='$telefono', planFija='$planFija', modoFija='$modoFija', formaDePago='$formaPago', sec='$sec', estado='$estado', observaciones='$observacion', ubicacion='$ubicacion', distrito='$distrito', fechaActualizacion=CURRENT_TIMESTAMP where codigo='$codigo'";

        $rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // movil en alta pre
    public function editarMovilNewPre($codigo,$asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$modalidad,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();

        $sql="update whatsapp set dniAsesor='$asesor', nombre='$nombre', dni='$dni', numeroReferencia='$telefonoRef', producto='$producto', promocion='$promocion', tipo='$tipo', modalidad='$modalidad', equipo='$equipos', formaDePago='$formaPago', sec='$sec', estado='$estado', observaciones='$observacion', ubicacion='$ubicacion', distrito='$distrito', fechaActualizacion=CURRENT_TIMESTAMP where codigo='$codigo'";

        $rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // movil en alta post
    public function editarMovilNewPost($codigo,$asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$modalidad,$plan,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();

        $sql="update whatsapp set dniAsesor='$asesor', nombre='$nombre', dni='$dni', numeroReferencia='$telefonoRef', producto='$producto', promocion='$promocion', tipo='$tipo', modalidad='$modalidad', planR='$plan', equipo='$equipos', formaDePago='$formaPago', sec='$sec', estado='$estado', observaciones='$observacion', ubicacion='$ubicacion',distrito='$distrito', fechaActualizacion=CURRENT_TIMESTAMP where codigo='$codigo'";

        $rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // movil en porta pre
    public function editarMovilPortaPre($codigo,$asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$telefono,$lineaProce,$operadorCeden,$modalidad,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();

        $sql="update whatsapp set dniAsesor='$asesor', nombre='$nombre', dni='$dni', numeroReferencia='$telefonoRef', producto='$producto', promocion='$promocion', tipo='$tipo', telefono='$telefono', lineaProcedente='$lineaProce', operadorCedente='$operadorCeden', modalidad='$modalidad', equipo='$equipos', formaDePago='$formaPago', sec='$sec', estado='$estado', observaciones='$observacion', ubicacion='$ubicacion', distrito='$distrito', fechaActualizacion=CURRENT_TIMESTAMP where codigo='$codigo'";

        $rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // movil en porta post
    public function editarMovilPortaPost($codigo,$asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$telefono,$lineaProce,$operadorCeden,$modalidad,$plan,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();

        $sql="update whatsapp set dniAsesor='$asesor', nombre='$nombre', dni='$dni', numeroReferencia='$telefonoRef', producto='$producto', promocion='$promocion', tipo='$tipo', telefono='$telefono', lineaProcedente='$lineaProce', operadorCedente='$operadorCeden', modalidad='$modalidad', planR='$plan', equipo='$equipos', formaDePago='$formaPago', sec='$sec', estado='$estado', observaciones='$observacion', ubicacion='$ubicacion', distrito='$distrito', fechaActualizacion=CURRENT_TIMESTAMP where codigo='$codigo'";

        $rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    // movil en reno pre
    public function editarMovilRenoPre($codigo,$asesor,$nombre,$dni,$telefonoRef,$producto,$promocion,$tipo,$telefono,$lineaProce,$modalidad,$equipos,$formaPago,$sec,$estado,$observacion,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();

        $sql="update whatsapp set dniAsesor='$asesor', nombre='$nombre', dni='$dni', numeroReferencia='$telefonoRef', producto='$producto', promocion='$promocion', tipo='$tipo', telefono='$telefono', lineaProcedente='$lineaProce', modalidad='$modalidad', equipo='$equipos', formaDePago='$formaPago', sec='$sec', estado='$estado', observaciones='$observacion', ubicacion='$ubicacion', distrito='$distrito', fechaActualizacion=CURRENT_TIMESTAMP where codigo='$codigo'";

        $rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

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