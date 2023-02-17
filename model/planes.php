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
        
        $model->desconectar($conexion);
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
        
        $model->desconectar($conexion);
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
        
        $model->desconectar($conexion);
        return $filas;
    }

    public function agregarFija($plan)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="INSERT into planesfija(nombre) values('$plan')";
        $rs=mysqli_query($conexion,$sql);
        
        $model->desconectar($conexion);
    }

    public function editarFija($code,$plan)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="UPDATE planesfija set nombre='$plan' where codigo='$code'";
        $rs=mysqli_query($conexion,$sql);
        
        $model->desconectar($conexion);
    }

    public function eliminarFija($code)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="DELETE from planesfija where codigo='$code'";
        $rs=mysqli_query($conexion,$sql);
        
        $model->desconectar($conexion);
    }

    public function agregarMovil($plan)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="INSERT into planes(nombre) values('$plan')";
        $rs=mysqli_query($conexion,$sql);
        
        $model->desconectar($conexion);
    }

    public function editarMovil($code,$plan)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="UPDATE planes set nombre='$plan' where codigo='$code'";
        $rs=mysqli_query($conexion,$sql);
        
        $model->desconectar($conexion);
    }
    
    public function eliminarMovil($code)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="DELETE from planes where codigo='$code'";
        $rs=mysqli_query($conexion,$sql);
        
        $model->desconectar($conexion);
    }

    public function agregarPromo($promo)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="INSERT into promociones(nombre) values('$promo')";
        $rs=mysqli_query($conexion,$sql);
        
        $model->desconectar($conexion);
    }

    public function editarPromo($code,$promo)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="UPDATE promociones set nombre='$promo' where codigo='$code'";
        $rs=mysqli_query($conexion,$sql);
        
        $model->desconectar($conexion);
    }
    
    public function eliminarPromo($code)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="DELETE from promociones where codigo='$code'";
        $rs=mysqli_query($conexion,$sql);
        
        $model->desconectar($conexion);
    }
}
?>