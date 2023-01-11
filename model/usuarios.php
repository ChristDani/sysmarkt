<?php
require_once "conexion.php";

class user
{
    public function buscarUser($dni)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="select * from usuarios where dni='".$dni."'";
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
        $sql="select * from usuarios where activo='1'";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $conexion=$model->desconectar();
        return $filas;
    }

    public function insertarUsuario($dni,$nombre,$clave,$tipo,$dniModerador)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="insert into usuarios(dni,nombre,clave,tipo,dniModerador) values('$dni','$nombre','$clave','$tipo','$dniModerador')";
        $sql2="insert into metasasesor values('$dni','10','10','3','1','1','4','4','1')";

		$rs=mysqli_query($con,$sql);
		$rs2=mysqli_query($con,$sql2);

		$con=$model->desconectar();
    }

    public function editarUsuario($dni,$nombre,$clave,$fotoPerfil)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="update usuarios set nombre='$nombre', clave='$clave', fotoPerfil='$fotoPerfil' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function reactivar($dni)
    {
        $model=new conexion();
        $con=$model->conectar();

        $clave = sha1(strrev($dni));
        
        $sql="update usuarios set clave='$clave', tipo='0', fotoPerfil='default.png', estado='0', activo='1', fechaRegistro=CURRENT_TIMESTAMP where dni='$dni'";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function cambiarTipoUsuario($dni,$tipo)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="update usuarios set tipo='$tipo' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function activarEstado($dni)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="update usuarios set estado='1' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function desactivarEstado($dni)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="update usuarios set estado='0' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function reposarEstado($dni)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="update usuarios set estado='2' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function ocuparEstado($dni)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="update usuarios set estado='3' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }

    public function eliminarUsuario($dni)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="update usuarios set activo='0' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

		$con=$model->desconectar();
    }
}
?>