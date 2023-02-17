<?php
require_once "conexion.php";

class user
{
    public function buscarUser($dni)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="SELECT * from usuarios where dni='".$dni."'";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $model->desconectar($conexion);
        return $filas;
    }

    public function listar()
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="SELECT * from usuarios where activo='1' order by nombre";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $model->desconectar($conexion);
        return $filas;
    }

    public function listaruseradmin($dni)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="SELECT * from usuarios where activo='1' and dni!='$dni' order by nombre";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $model->desconectar($conexion);
        return $filas;
    }

    public function listarusermoderador($dni)
    {
        $filas=null;
        $model=new conexion();
		$conexion=$model->conectar();
        $sql="SELECT * from usuarios where activo='1' and dniModerador='$dni' order by nombre";
        $rs=mysqli_query($conexion,$sql);

        while($row=mysqli_fetch_array($rs))
		{
            $filas[]=$row;
        }
        
        $model->desconectar($conexion);
        return $filas;
    }

    public function insertarUsuario($dni,$nombre,$clave,$tipo,$dniModerador)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="INSERT into usuarios(dni,nombre,clave,tipo,dniModerador) values('$dni','$nombre','$clave','$tipo','$dniModerador')";

		$rs=mysqli_query($con,$sql);

        $model->desconectar($con);
    }

    public function editarUsuario($dni,$clave,$fotoPerfil)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="UPDATE usuarios set clave='$clave', fotoPerfil='$fotoPerfil' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

        $model->desconectar($con);
    }

    public function reactivar($dni)
    {
        $model=new conexion();
        $con=$model->conectar();

        $clave = sha1(strrev($dni));
        
        $sql="UPDATE usuarios set clave='$clave', tipo='0', fotoPerfil='default.png', estado='0', activo='1', fechaRegistro=CURRENT_TIMESTAMP where dni='$dni'";

		$rs=mysqli_query($con,$sql);

        $model->desconectar($con);
    }

    public function cambiarTipoUsuario($dni,$tipo)
    {
        
        if ($tipo === "0") 
        {
            $moderador = "---";
        }
        elseif ($tipo === "1") 
        {
            $moderador = "---";
        }
        elseif ($tipo === "2") 
        {
            $moderador = "---";
        }

        $model=new conexion();
        $con=$model->conectar();
        
        $sql="UPDATE usuarios set tipo='$tipo', dniModerador='$moderador' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

        $model->desconectar($con);
    }

    public function activarEstado($dni)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="UPDATE usuarios set estado='1' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

        $model->desconectar($con);
    }

    public function desactivarEstado($dni)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="UPDATE usuarios set estado='0' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

        $model->desconectar($con);
    }

    public function reposarEstado($dni)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="UPDATE usuarios set estado='2' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

        $model->desconectar($con);
    }

    public function ocuparEstado($dni)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="UPDATE usuarios set estado='3' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

        $model->desconectar($con);
    }

    public function eliminarUsuario($dni)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="UPDATE usuarios set activo='0' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

        $model->desconectar($con);
    }

    public function cambiarmoderador($dni,$moderador)
    {
        $model=new conexion();
        $con=$model->conectar();
        
        $sql="UPDATE usuarios set dniModerador='$moderador' where dni='$dni'";

		$rs=mysqli_query($con,$sql);

        $model->desconectar($con);
    }
}
?>