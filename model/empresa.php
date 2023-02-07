<?php
require_once "conexion.php";

class empresa
{
    public function listar()
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="SELECT nombre, logo, icono from empresa";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $conexion=$model->desconectar();
        return $filas;
    }
    
    public function eliminarEmpresa()
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="DELETE from empresa";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function insertarEmpresa($nombre,$logo,$icono)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql=" INSERT into empresa(nombre,logo,icono) values('$nombre','$logo','$icono');";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function editarEmpresa($nombre,$logo,$icono)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="UPDATE empresa set nombre='$nombre', logo='$logo', icono='$icono'";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }
}
?>