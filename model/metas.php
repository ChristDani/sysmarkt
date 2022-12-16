<?php
require_once "conexion.php";

class metas
{
    public function listar()
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="select * from metas where dniAsesor='general'";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $conexion=$model->desconectar();
        return $filas;
    }

    public function listarAsesor($dni)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="select * from metas where dniAsesor='$dni'";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $conexion=$model->desconectar();
        return $filas;
    }

    public function editar($portamen69,$portamay69,$altapost,$altaprepa,$portaprepa,$renovacion,$hfc_ftth,$ifi)
    {
        $model=new conexion();
        $con=$model->conectar();

        $sql="update metas set portamenor69='$portamen69', portamayor69='$portamay69', altapost='$altapost', altaprepa='$altaprepa', portaprepa='$portaprepa', renovacion='$renovacion', hfc_ftth='$hfc_ftth', ifi='$ifi' where dniAsesor='general'";

        $rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function editarasesor($dni,$portamen69,$portamay69,$altapost,$altaprepa,$portaprepa,$renovacion,$hfc_ftth,$ifi)
    {
        $model=new conexion();
        $con=$model->conectar();

        $sql="update metas set portamenor69='$portamen69', portamayor69='$portamay69', altapost='$altapost', altaprepa='$altaprepa', portaprepa='$portaprepa', renovacion='$renovacion', hfc_ftth='$hfc_ftth', ifi='$ifi' where dniAsesor='$dni'";

        $rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }
}
?>