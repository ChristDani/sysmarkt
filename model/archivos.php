<?php
require_once "conexion.php";

class archivos
{
    public function insertarProductos($region,$nombre,$centro,$almacen,$nombreAlmacen,$material,$descripcion,$libres,$bloqueados)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into productos(region,nombre,centro,almacen,nombreAlmacen,material,descripcion,libres,bloqueados) values('$region','$nombre','$centro','$almacen','$nombreAlmacen','$material','$descripcion','$libres','$bloqueados')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function insertarCac($region,$pdv,$nombre,$entrega,$direccion,$distrito,$provincia,$departamento,$horario)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into cac(region,pdv,nombre,entrega,direccion,distrito,provincia,departamento,horario) values('$region','$pdv','$nombre','$entrega','$direccion','$distrito','$provincia','$departamento','$horario')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function insertarDac($nombre,$distrito,$provincia,$departamento,$region,$direccion,$descripcion)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into dac(nombre,distrito,provincia,departamento,region,direccion,descripcion) values('$nombre','$distrito','$provincia','$departamento','$region','$direccion','$descripcion')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function insertarAcd($region,$pdv,$nombre,$entrega,$pdvsisact,$codpdv,$descripcion,$direccion,$distrito,$provincia,$departamento,$horario,$estado,$alta,$baja)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into acd(region,pdv,nombre,entrega,pdvsisact,codpdv,descripcion,direccion,distrito,provincia,departamento,horario,estado,alta,baja) values('$region','$pdv','$nombre','$entrega','$pdvsisact','$codpdv','$descripcion','$direccion','$distrito','$provincia','$departamento','$horario','$estado','$alta','$baja')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function insertarCadena($region,$razonsocial,$codigointer,$codpdv,$pdvsisact,$entrega,$direccion,$distrito,$provincia,$departamento,$dias,$horario,$estado)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into cadena(region,razonsocial,codigointer,codpdv,pdvsisact,entrega,direccion,distrito,provincia,departamento,dias,horario,estado) values('$region','$razonsocial','$codigointer','$codpdv','$pdvsisact','$entrega','$direccion','$distrito','$provincia','$departamento','$dias','$horario','$estado')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function insertarMasiva($documento,$nombre,$tel_Fijo,$celular,$fechaActivacion,$operador,$tipo_plan,$direccion,$distrito,$provincia,$departamento)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into masiva(documento,nombre,tel_Fijo,celular,fechaActivacion,operador,tipo_plan,direccion,distrito,provincia,departamento) values('$documento','$nombre','$tel_Fijo','$celular','$fechaActivacion','$operador','$tipo_plan','$direccion','$distrito','$provincia','$departamento')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
        return "Proceso realizado con éxito";
    }
}
?>