<?php
require_once "conexion.php";

class masiva
{
    public function eliminarportelefono($code)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="DELETE from masiva where celular='$code' or tel_Fijo='$code'";
        $rs=mysqli_query($conexion,$sql);
        
        $conexion=$model->desconectar();
    }

    public function eliminarpordni($code)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="DELETE from masiva where documento='$code'";
        $rs=mysqli_query($conexion,$sql);
        
        $conexion=$model->desconectar();
    }
}
?>