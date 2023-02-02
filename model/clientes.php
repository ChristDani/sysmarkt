<?php
require_once "conexion.php";

class cliente
{
    public function buscarCliente($dni)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="select * from clientes where dni='".$dni."'";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $conexion=$model->desconectar();
        return $filas;
    }

    public function buscarTelefono($telef)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="select * from telefonos where telefono='$telef'";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $conexion=$model->desconectar();
        return $filas;
    }

    public function listar()
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="select * from clientes";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $conexion=$model->desconectar();
        return $filas;
    }

    public function insertarCliente($dni,$nombre,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into clientes(dni,nombre,ubicacion,distrito) values('$dni','$nombre','$ubicacion','$distrito')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function editarCliente($dni,$ubicacion,$distrito)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="update clientes set ubicacion='$ubicacion', distrito='$distrito' where dni='$dni'";

        $rs=mysqli_query($con,$sql);

        $con=$model->desconectar();
    }

    public function eliminarCliente($dni)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="DELETE from clientes where dni='$dni'";

        $rs=mysqli_query($con,$sql);

        $con=$model->desconectar();
    }

    public function insertarTelefono($dni,$telefono,$tipo,$operador,$linea)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into telefonos(dniCliente,telefono,tipo,operador,tipoLinea) values('$dni','$telefono','$tipo','$operador','$linea')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function editarTelefono($dni,$telefono,$tipo,$operador,$linea)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="update telefonos set dniCliente='$dni', tipo='$tipo', operador='$operador', tipoLinea='$linea' where telefono='$telefono'";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function eliminarTelefono($telefono)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="DELETE from telefonos where telefono='$telefono'";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }
}
?>