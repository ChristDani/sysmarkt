<?php
require_once "conexion.php";

class planes
{
    public function listar()
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="select * from planes";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $conexion=$model->desconectar();
        return $filas;
    }
    public function listarFija()
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="select * from planesfija";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $conexion=$model->desconectar();
        return $filas;
    }
    public function listarPromo()
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="select * from promociones";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $conexion=$model->desconectar();
        return $filas;
    }

    public function agregarFija($plan)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="INSERT into planesfija(nombre) values('$plan')";
        $rs=mysqli_query($conexion,$sql);
        
        $conexion=$model->desconectar();
    }

    public function editarFija($code,$plan)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="UPDATE planesfija set nombre='$plan' where codigo='$code'";
        $rs=mysqli_query($conexion,$sql);
        
        $conexion=$model->desconectar();
    }

    public function eliminarFija($code)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="DELETE from planesfija where codigo='$code'";
        $rs=mysqli_query($conexion,$sql);
        
        $conexion=$model->desconectar();
    }

    public function agregarMovil($plan)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="INSERT into planes(nombre) values('$plan')";
        $rs=mysqli_query($conexion,$sql);
        
        $conexion=$model->desconectar();
    }

    public function editarMovil($code,$plan)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="UPDATE planes set nombre='$plan' where codigo='$code'";
        $rs=mysqli_query($conexion,$sql);
        
        $conexion=$model->desconectar();
    }
    
    public function eliminarMovil($code)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="DELETE from planes where codigo='$code'";
        $rs=mysqli_query($conexion,$sql);
        
        $conexion=$model->desconectar();
    }
}
?>