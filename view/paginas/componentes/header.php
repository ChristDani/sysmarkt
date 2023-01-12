<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title id="tituloPagina"></title>
    <link rel="icon" href="view/static/img/icono.png">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="view/static/css/styles.css">
    <link rel="stylesheet" href="view/static/css/style.css">
</head>

<?php
require_once "model/conexion.php";
require_once "model/usuarios.php";
require_once "model/clientes.php";

// usuarios
$model = new user();
$listar = $model->listar();

// clientes
$cliente = new cliente();
$listCliente = $cliente->listar();

// conexio
$cone = new conexion();
$consulta = $cone->conectar();

// clientes totales
$sql = "select * from clientes";
$resultado = mysqli_query($consulta,$sql);
$totalClientesMenu = $resultado->num_rows;

if ($tipoUsuario === "1") 
{ 
    // ventas totales para admin
    $sql = "SELECT * from detalleventas where (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP))";
    $resultado = mysqli_query($consulta,$sql);
    $totalVentasMenu = $resultado->num_rows;
}
elseif ($tipoUsuario === "2") 
{ 
    // ventas totales para admin
    $sql = "SELECT * from detalleventas as dv inner join ventas as v INNER JOIN usuarios as u INNER JOIN clientes as c on v.dniAsesor=u.dni and v.dniCliente=c.dni and dv.sec=v.sec where u.dniModerador='$dniUsuario' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP))";
    $resultado = mysqli_query($consulta,$sql);
    $totalVentasMenu = $resultado->num_rows;
}
elseif ($tipoUsuario === "0") 
{ 
    // ventas totales para admin
    $sql = "SELECT * from ventas where dniAsesor='$dniUsuario' and (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP))";
    $resultado = mysqli_query($consulta,$sql);
    $totalVentasMenu = $resultado->num_rows;
}
?>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand">
        <div class="navbar-nav mr-0 ml-md-3 my-2 my-md-0">
            <button class="mx-2 btn btn-link btn-sm d-flex justify-content-center" id="sidebarToggle">
                <ion-icon name="menu-outline"></ion-icon>
            </button>
            <button class="almrda Buttone mx-2 btn btn-link btn-sm d-flex justify-content-center">
                <div class="color d-flex justify-content-center align-items-center">
                    <ion-icon name="moon-outline"></ion-icon>
                </div>
            </button>
        </div>
        <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <button class="mx-2 btn btn-link btn-sm d-flex justify-content-center" data-bs-toggle="offcanvas" data-bs-target="#Metas" aria-controls="offcanvasRight">
                <ion-icon name="analytics-outline"></ion-icon>
            </button>  
        </ul>      			 
    </nav>
    <?php require_once 'contenidoMetas.php'; ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="top mb-4">
                            <h2>ARGO<span class="danger">SAL</span></h2>
                        </div>
                        <a class="nav-link" href="index.php?pagina=Dashboard">
                            <div class="sb-nav-link-icon">
                                <ion-icon name="speedometer-outline"></ion-icon>
                            </div>
                            Dashboard
                        </a>				
                        <a class="nav-link" href="index.php?pagina=Ventas">
                            <div class="sb-nav-link-icon">
                                <ion-icon name="cart-outline"></ion-icon>
                            </div>
                            Ventas	
                            <span class="badge primary-bg"><?php echo $totalVentasMenu; ?></span>							
                        </a>
                        <?php if($tipoUsuario === "1" || $tipoUsuario === "2") { ?>
                            <a class="nav-link" href="index.php?pagina=Clientes">
                                <div class="sb-nav-link-icon">
                                    <ion-icon name="people-outline"></ion-icon>
                                </div>
                                Clientes	
                                <span class="badge primary-bg"><?php echo $totalClientesMenu; ?></span>							
                            </a>										
                        <?php } ?>
                        <?php if($tipoUsuario === "1") { ?>
                            <a class="nav-link" href="index.php?pagina=Datos">
                                <div class="sb-nav-link-icon">
                                    <ion-icon name="document-text-outline"></ion-icon>
                                </div>
                                Datos
                            </a>										
                        <?php } ?>			
                        <a class="nav-link" href="index.php?pagina=Productos">
                            <div class="sb-nav-link-icon">
                                <ion-icon name="phone-portrait-outline"></ion-icon>
                            </div>
                            Productos
                        </a>
                        <a class="nav-link" href="index.php?pagina=Ubicaciones">
                            <div class="sb-nav-link-icon">
                                <ion-icon name="map-outline"></ion-icon>
                            </div>
                            Ubicaciones
                        </a>
                        <?php if($tipoUsuario === "1") { ?>
                            <a class="nav-link" href="index.php?pagina=Reportes">
                                <div class="sb-nav-link-icon">
                                    <ion-icon name="newspaper-outline"></ion-icon>
                                </div>
                                Reportes
                            </a>
                        <?php } ?>
                        <a href="index.php?pagina=Herramientas" class="nav-link">
                            <div class="sb-nav-link-icon">
                                <ion-icon name="construct-outline"></ion-icon>
                            </div>
                            Herramientas
                        </a>			
                        <a class="nav-link" href="index.php?pagina=Configuracion">
                            <div class="sb-nav-link-icon"> 
                                <ion-icon name="cog-outline"></ion-icon>
                            </div>
                            Configuracion
                        </a>
                        <a href="index.php?pagina=Comisiones" class="nav-link">
                            <div class="sb-nav-link-icon">
                                <ion-icon name="wallet-outline"></ion-icon>
                            </div>
                            Comisiones
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="row mb-1">
                        <div class="col d-flex gap-2 align-items-end">
                            <?php if ($listar != null)
                                {
                                    foreach ($listar as $x)
                                    {
                                        if ($x[0] === $dniUsuario)
                                        { $fotoUsuario = trim($x[6]);?>
                                <?php } } } ?>
                                <div class="profile-photo rounded-5" style="background-image: url('view/static/ProfileIMG/<?php echo $fotoUsuario;?>');"></div>
                                <h3><?php echo $nombreUsuario; ?></h3>
                        </div>
                    </div>
                    <div class="align-items-end d-flex row"> 
                        <div class="col d-flex justify-content-start">
                            <?php if ($tipoUsuario === "1") { ?>
                                <p>Administrador</p>
                                <?php } elseif ($tipoUsuario === "2") { ?>
                                <p>Moderador</p>
                                <?php } elseif ($tipoUsuario === "0") { ?>
                                <p>Asesor</p>
                            <?php } ?>
                        </div>
                        <div class="col d-flex justify-content-end">
                        <?php if ($listar != null)
    
                            {
                                foreach ($listar as $x)
                                {
                                    if ($x[0] === $dniUsuario)
                                    {
                                        if ($x[5] === "0")
                                        
                                        {?>
                                            <div class="dropdown">
                                                <a class="btn btn-sm dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <div class="bg-secondary" style="height:10px; width:10px ; border-radius:10px;"></div>
                                                </a>
                                                <ul class="dropdown-menu bg">
                                                    <li><a class="dropdown-item d-flex align-items-baseline gap-3" href="controller/usuario/conectarUsuario.php?dni=<?php echo $dniUsuario;?>"><div class="bg-success" style="height:10px; width:10px ; border-radius:10px;"></div>Conectado</a></li>
                                                    <li><a class="dropdown-item d-flex align-items-baseline gap-3" href="controller/usuario/reposarUsuario.php?dni=<?php echo $dniUsuario;?>"><div class="bg-warning" style="height:10px; width:10px ; border-radius:10px;"></div>Ausente</a></li>
                                                    <li><a class="dropdown-item d-flex align-items-baseline gap-3" href="controller/usuario/ocuparUsuario.php?dni=<?php echo $dniUsuario;?>"><div class="bg-danger" style="height:10px; width:10px ; border-radius:10px;"></div>Ocupado</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item d-flex align-items-center gap-3 justify-content-end" href="controller/acceso/logout.php?dni=<?php echo $dniUsuario;?>"><ion-icon class="danger" name="log-out-outline"></ion-icon>Cerrar sesion</a></li>
                                                </ul>
                                            </div>
                        <?php           }
                                        elseif($x[5] === "1")
                                        {?>

                                            <div class="dropdown">
                                                <a class="btn btn-sm dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <div class="bg-success" style="height:10px; width:10px ; border-radius:10px;"></div>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item d-flex align-items-baseline gap-3" href="controller/usuario/reposarUsuario.php?dni=<?php echo $dniUsuario;?>"><div class="bg-warning" style="height:10px; width:10px ; border-radius:10px;"></div>Ausente</a></li>
                                                    <li><a class="dropdown-item d-flex align-items-baseline gap-3" href="controller/usuario/ocuparUsuario.php?dni=<?php echo $dniUsuario;?>"><div class="bg-danger" style="height:10px; width:10px ; border-radius:10px;"></div>Ocupado</a></li>
                                                    <li><a class="dropdown-item d-flex align-items-baseline gap-3" href="controller/usuario/desconectarUsuario.php?dni=<?php echo $dniUsuario;?>"><div class="bg-secondary" style="height:10px; width:10px ; border-radius:10px;"></div>Desconectado</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item d-flex align-items-center gap-3 justify-content-end" href="controller/acceso/logout.php?dni=<?php echo $dniUsuario;?>"><ion-icon class="danger" name="log-out-outline"></ion-icon>Cerrar sesion</a></li>
                                                </ul>
                                            </div>
                        <?php           }
                                        elseif($x[5] === "2")
                                        {?>
                                            <div class="dropdown">
                                                <a class="btn btn-sm dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <div class="bg-warning" style="height:10px; width:10px ; border-radius:10px;"></div>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item d-flex align-items-baseline gap-3" href="controller/usuario/conectarUsuario.php?dni=<?php echo $dniUsuario;?>"><div class="bg-success" style="height:10px; width:10px ; border-radius:10px;"></div>Conectado</a></li>
                                                    <li><a class="dropdown-item d-flex align-items-baseline gap-3" href="controller/usuario/ocuparUsuario.php?dni=<?php echo $dniUsuario;?>"><div class="bg-danger" style="height:10px; width:10px ; border-radius:10px;"></div>Ocupado</a></li>
                                                    <li><a class="dropdown-item d-flex align-items-baseline gap-3" href="controller/usuario/desconectarUsuario.php?dni=<?php echo $dniUsuario;?>"><div class="bg-secondary" style="height:10px; width:10px ; border-radius:10px;"></div>Desconectado</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item d-flex align-items-center gap-3 justify-content-end" href="controller/acceso/logout.php?dni=<?php echo $dniUsuario;?>"><ion-icon class="danger" name="log-out-outline"></ion-icon>Cerrar Sesion</a></li>
                                                </ul>
                                            </div>

                        <?php           }
                                        elseif($x[5] === "3")
                                        {?>
                                            <div class="dropdown">
                                                <a class="btn btn-sm dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <div class="bg-danger" style="height:10px; width:10px ; border-radius:10px;"></div>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item d-flex align-items-baseline gap-3" href="controller/usuario/conectarUsuario.php?dni=<?php echo $dniUsuario;?>"><div class="bg-success" style="height:10px; width:10px ; border-radius:10px;"></div>Conectado</a></li>
                                                    <li><a class="dropdown-item d-flex align-items-baseline gap-3" href="controller/usuario/reposarUsuario.php?dni=<?php echo $dniUsuario;?>"><div class="bg-warning" style="height:10px; width:10px ; border-radius:10px;"></div>Ausente</a></li>
                                                    <li><a class="dropdown-item d-flex align-items-baseline gap-3" href="controller/usuario/desconectarUsuario.php?dni=<?php echo $dniUsuario;?>"><div class="bg-secondary" style="height:10px; width:10px ; border-radius:10px;"></div>Desconectado</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item d-flex align-items-center gap-3 justify-content-end" href="controller/acceso/logout.php?dni=<?php echo $dniUsuario;?>"><ion-icon class="danger" name="log-out-outline"></ion-icon>Cerrar Sesion</a></li>
                                                </ul>
                                            </div>

                        <?php           }
                                    }
                                }
                            }
                        ?>
                        </div>                            
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">              
                        
                  