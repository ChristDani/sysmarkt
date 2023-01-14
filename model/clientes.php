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
}
?>