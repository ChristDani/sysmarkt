<?php
    // error_reporting(0);
    session_start();
    if (!isset($_SESSION["usersysmarkt"])) 
    {
        require_once "model/conexion.php";
        $modelconelogin = new conexion();
        $conexionpruebalogin = $modelconelogin->conectar();
        if ($conexionpruebalogin) 
        {
            include_once "paginas/login.php";
        } 
        elseif (!$conexionpruebalogin) 
        {
            include_once "paginas/500.php";
        }
    }
    elseif (isset($_SESSION["usersysmarkt"]) && !isset($_GET["pagina"])) 
    {
        require_once "model/conexion.php";
        $modelconelogin = new conexion();
        $conexionpruebalogin = $modelconelogin->conectar();
        if ($conexionpruebalogin) 
        {
            $dniUsuario = $_SESSION["dnisysmarkt"];
            $nombreUsuario = $_SESSION["usersysmarkt"];
            $tipoUsuario = $_SESSION["tiposysmarkt"];

            include_once "paginas/dashboard.php";
        } 
        elseif (!$conexionpruebalogin) 
        {
            include_once "paginas/500.php";
        }
    }
    elseif (isset($_SESSION["usersysmarkt"]) && isset($_GET["pagina"])) 
    {
        require_once "model/conexion.php";
        $modelconelogin = new conexion();
        $conexionpruebalogin = $modelconelogin->conectar();
        if ($conexionpruebalogin) 
        {
            $dniUsuario = $_SESSION["dnisysmarkt"];
            $nombreUsuario = $_SESSION["usersysmarkt"];
            $tipoUsuario = $_SESSION["tiposysmarkt"];

            if($tipoUsuario === "1") 
            {
                if($_GET["pagina"]==="Dashboard")
                {
                    include_once "paginas/dashboard.php";
                }
                elseif ($_GET["pagina"]==="Clientes") 
                {
                    include_once "paginas/clientes.php";
                }
                elseif ($_GET["pagina"]==="Ventas") 
                {
                    include_once "paginas/ventas.php";
                }
                elseif ($_GET["pagina"]==="Datos") 
                {
                    include_once "paginas/datos.php";
                }
                elseif ($_GET["pagina"]==="Productos") 
                {
                    include_once "paginas/productos.php";
                }
                elseif ($_GET["pagina"]==="Ubicaciones") 
                {
                    include_once "paginas/ubicaciones.php";
                }
                elseif ($_GET["pagina"]==="Reportes") 
                {
                    include_once "paginas/reportes.php";
                }
                elseif ($_GET["pagina"]==="Herramientas") 
                {
                    include_once "paginas/herramientas.php";
                }
                elseif ($_GET["pagina"]==="Comisiones") 
                {
                    include_once "paginas/comisiones.php";
                }
                elseif ($_GET["pagina"]==="Configuracion") 
                {
                    include_once "paginas/configuracion.php";
                }
                else 
                {
                    include_once "paginas/404.php";
                }
            }
            elseif ($tipoUsuario === "0" || $tipoUsuario === "2") 
            {
                if($_GET["pagina"]==="Dashboard")
                {
                    include_once "paginas/dashboard.php";
                }
                elseif ($_GET["pagina"]==="Clientes") 
                {
                    include_once "paginas/clientes.php";
                }
                elseif ($_GET["pagina"]==="Ventas") 
                {
                    include_once "paginas/ventas.php";
                }
                elseif ($_GET["pagina"]==="Datos") 
                {
                    include_once "paginas/401.php";
                }
                elseif ($_GET["pagina"]==="Productos") 
                {
                    include_once "paginas/productos.php";
                }
                elseif ($_GET["pagina"]==="Ubicaciones") 
                {
                    include_once "paginas/ubicaciones.php";
                }
                elseif ($_GET["pagina"]==="Reportes") 
                {
                    include_once "paginas/401.php";
                }
                elseif ($_GET["pagina"]==="Herramientas") 
                {
                    include_once "paginas/herramientas.php";
                }
                elseif ($_GET["pagina"]==="Comisiones") 
                {
                    include_once "paginas/comisiones.php";
                }
                elseif ($_GET["pagina"]==="Configuracion") 
                {
                    include_once "paginas/configuracion.php";
                }
                else 
                {
                    include_once "paginas/404.php";
                }
            }
        } 
        elseif (!$conexionpruebalogin) 
        {
            include_once "paginas/500.php";
        }
    }
?>