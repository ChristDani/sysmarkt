<?php
require_once "conexion.php";

class metas
{
    public function listar()
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="select * from metas";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $conexion=$model->desconectar();
        return $filas;
    }

    public function eliminar()
    {
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="DELETE from metas";
        $rs=mysqli_query($conexion,$sql);
        
        $conexion=$model->desconectar();
    }

    public function listarAsesor($dni)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="select * from metasasesor where dniAsesor='$dni'";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $conexion=$model->desconectar();
        return $filas;
    }

    public function insertarmetadefault()
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="INSERT into metas values('22','25','5','1','1','10','10','1')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function insertarmeta($portamen69,$portamay69,$altapost,$altaprepa,$portaprepa,$renovacion,$hfc_ftth,$ifi)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="INSERT into metas values('$portamen69','$portamay69','$altapost','$altaprepa','$portaprepa','$renovacion','$hfc_ftth','$ifi')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function insertarmetausuario($dni,$portamen69,$portamay69,$altapost,$altaprepa,$portaprepa,$renovacion,$hfc_ftth,$ifi)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="INSERT into metasasesor values('$dni','$portamen69','$portamay69','$altapost','$altaprepa','$portaprepa','$renovacion','$hfc_ftth','$ifi')";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function editar($portamen69,$portamay69,$altapost,$altaprepa,$portaprepa,$renovacion,$hfc_ftth,$ifi)
    {
        $prtmn69 = ceil($portamen69*0.5);
        $prtmy69 = ceil($portamay69*0.5);
        $ltpst = ceil($altapost*0.5);
        $ltprp = ceil($altaprepa*0.5);
        $prtprp = ceil($portaprepa*0.5);
        $rnvcn = ceil($renovacion*0.5);
        $hfc = ceil($hfc_ftth*0.5);
        $f = ceil($ifi*0.5);

        $model=new conexion();
        $con=$model->conectar();

        $sql="UPDATE metas set portamenor69='$portamen69', portamayor69='$portamay69', altapost='$altapost', altaprepa='$altaprepa', portaprepa='$portaprepa', renovacion='$renovacion', hfc_ftth='$hfc_ftth', ifi='$ifi'";

        $sql3 = "UPDATE metasasesor set portamenor69='$prtmn69', portamayor69='$prtmy69', altapost='$ltpst', altaprepa='$ltprp', portaprepa='$prtprp', renovacion='$rnvcn', hfc_ftth='$hfc', ifi='$f'";

        $rs=mysqli_query($con,$sql);
        $rs3=mysqli_query($con,$sql3);

		$con=$model->desconectar();
    }

    public function editarasesor($dni,$portamen69,$portamay69,$altapost,$altaprepa,$portaprepa,$renovacion,$hfc_ftth,$ifi)
    {
        $model=new conexion();
        $con=$model->conectar();

        $sql="update metasasesor set portamenor69='$portamen69', portamayor69='$portamay69', altapost='$altapost', altaprepa='$altaprepa', portaprepa='$portaprepa', renovacion='$renovacion', hfc_ftth='$hfc_ftth', ifi='$ifi' where dniAsesor='$dni'";

        $rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }
}
?>