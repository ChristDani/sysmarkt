<?php
    error_reporting(0);
    require_once 'model/empresa.php';
    require_once "model/conexion.php";
    require_once "model/usuarios.php";
    require_once "model/metas.php";

    $modelconelogin = new conexion();
    $conexionpruebalogin = $modelconelogin->conectar();

    $modelempresa = new empresa();
    $modelusuarios = new user();
    $modelmetas = new metas();
    
    if ($conexionpruebalogin) 
    {
        $primerusuario=$modelusuarios->listar();
        if ($primerusuario != null) 
        {
            $empresa=$modelempresa->listar();
            if ($empresa != null) 
            {
                foreach($empresa as $row)
                {
                    $nombreglobalyfijodeempresa = $row[0];
                    $iconoglobalyfijodeempresa = $row[2];
                }
            }
            else 
            {
                $nombreglobalyfijodeempresa = "sysmarkt";
                $iconoglobalyfijodeempresa = "iconosysmarkt.png";
            }
            $primerasmetas=$modelmetas->listar();
            if ($primerasmetas == null) 
            {
                $modelmetas->insertarmetadefault();
            }
            
            session_start();
            if (!isset($_SESSION["usersysmarkt"])) 
            {
                    include_once "paginas/login.php";
            }
            elseif (isset($_SESSION["usersysmarkt"]) && !isset($_GET["pagina"])) 
            {
                $dniUsuario = $_SESSION["dnisysmarkt"];
                $nombreUsuario = $_SESSION["usersysmarkt"];
                $tipoUsuario = $_SESSION["tiposysmarkt"];
        
                include_once "paginas/dashboard.php";
            }
            elseif (isset($_SESSION["usersysmarkt"]) && isset($_GET["pagina"])) 
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
        }
        else 
        {
            $iconoglobalyfijodeempresa = "iconosysmarkt.png";
            include_once "paginas/configempre.php";
        }
    }
    if (!$conexionpruebalogin) 
    {
        include_once "paginas/500.php";
    }
?>