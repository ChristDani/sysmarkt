<h1>CONFIGURACIONES</h1>

<div class="row mx-auto mb-3">
    <div class="col-lg-6">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h1>Datos</h1>
                    </div>
                    <div class="row">
                        <div class="col mb-3 d-flex justify-content-center align-items-center my-2">
                            <img class="img-fluid rounded-5" src="view/static/ProfileIMG/<?php echo $configfotoUser;?>">                                
                        </div>
                        <div class="gap-3 col-xl-6 my-2 d-grid align-items-center">
                            <h2><?php echo $configdniUser; ?></h2>
                            <h2><?php echo $configNombreUser; ?></h2>
                            <?php if ($configTipoUser === "1") { ?>
                                <h2>Administrador</h2>
                            <?php }elseif ($configTipoUser === "0") { ?>
                                <h2>Asesor</h2>
                            <?php }elseif ($configTipoUser === "2") { ?>
                                <h2>Moderador</h2>
                            <?php } ?>
                            <?php if ($configEstadoUser === "0") { ?>
                                <h2 class="secondary">Desconectado</h2>
                            <?php }elseif ($configEstadoUser === "1") { ?>
                                <h2 class="success">Conectado</h2>
                            <?php }elseif ($configEstadoUser === "2") { ?>
                                <h2 class="warning">Ausente</h2>
                            <?php }elseif ($configEstadoUser === "3") { ?>
                                <h2 class="danger">Ocupado</h2>
                            <?php } ?>
                        </div>
                    </div>   
                    <div class="align-items-baseline d-flex justify-content-between my-2">
                        <h4 class="text-muted text-center">Desde el<?php echo " $configFechaUser"; ?></h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditarUsuario" onclick="editarUsuario('<?php echo$configdniUser;?>','<?php echo$configNombreUser;?>','<?php echo$configClaveUser;?>','<?php echo$configfotoUser;?>');">Editar</button>
                    </div>                     
                </div>
            </div>
        </div>
        <?php if ($tipoUsuario === "1") {?>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mt-1">
                        <h1>Archivos</h1>
                        <button type="submit" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#agregararchivos">Administrar</button>
                    </div>
                </div>    
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mt-1">
                        <h1>Planes Moviles</h1>
                        <button type="submit" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#planesMoviles" onclick="listarMovil();">Administrar</button>
                    </div>
                </div>    
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mt-1">
                        <h1>Planes Fija</h1>
                        <button type="submit" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#planesFija" onclick="listarFija();">Administrar</button>
                    </div>
                </div>    
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mt-1">
                        <h1>Promociones</h1>
                        <button type="submit" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#Promociones" onclick="listarPromo();">Administrar</button>
                    </div>
                </div>    
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mt-1">
                        <h1>Empresa</h1>
                        <button type="submit" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#Empresad" onclick="listarPromo();">Administrar</button>
                    </div>
                </div>    
            </div>
        </div>
        <?php }?>
    </div>
    <?php if ($tipoUsuario === "1" || $tipoUsuario === "2") { ?>        
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h1>Usuarios</h1>
                </div>
            <?php   if ($listaUsuarios != null) 
                    {
                        foreach ($listaUsuarios as $u) 
                        {?>
                            <div class="row">
                    <?php   if($tipoUsuario === "1")
                            {?>
                                <a class="delete btn col d-flex gap-1 align-items-center my-1" data-bs-toggle="modal" data-bs-target="#InfoUser" onclick="infoUsuario('<?php echo$u[0];?>','<?php echo trim($u[1]);?>','<?php echo trim($u[3]);?>');">
                    <?php   }
                            elseif($tipoUsuario === "2")
                            {?>
                                <a class="delete btn col d-flex gap-1 align-items-center my-1" data-bs-toggle="modal" data-bs-target="#InfoUser" onclick="infoUsuarioModera('<?php echo$u[0];?>','<?php echo trim($u[3]);?>');">
                    <?php   }?>
                                    <div class="col-auto">
                                        <?php if ($u[5] === "0") { ?>
                                            <div class="profile-photo secondary-bc rounded-circle img-fluid" style="background-image: url('view/static/ProfileIMG/<?php echo trim($u[6]);?>');">
                                            </div>
                                        <?php }elseif ($u[5] === "1") { ?>
                                            <div class="profile-photo success-bc rounded-circle img-fluid" style="background-image: url('view/static/ProfileIMG/<?php echo trim($u[6]);?>');">
                                            </div>
                                        <?php }elseif ($u[5] === "2") { ?>
                                            <div class="profile-photo warning-bc rounded-circle img-fluid" style="background-image: url('view/static/ProfileIMG/<?php echo trim($u[6]);?>');">
                                            </div>
                                        <?php }elseif ($u[5] === "3") { ?>
                                            <div class="profile-photo danger-bc" style="background-image: url('view/static/ProfileIMG/<?php echo trim($u[6]);?>');">
                                            </div>
                                        <?php } ?> 
                                    </div>                                                   
                                    <div class="col text-start">
                                        <h2><?php echo strtoupper($u[1]); ?></h2>            
                                    </div>                                                   
                                    <div class="col-auto text-end">
                                        <?php if ($u[3] === "1") { ?>
                                        <h4 class="text-muted">Administrador</h4>
                                        <?php }elseif ($u[3] === "0") { ?>
                                        <h4 class="text-muted">Asesor</h4>
                                        <?php }elseif ($u[3] === "2") { ?>
                                        <h4 class="text-muted">Moderador</h4>
                                        <?php } ?>
                                    </div>                                                   
                                </a>
                            </div>
                <?php   }
                    }
                    else
                    {?>
                        <div class="row">
                            <div class="col text-center">
                    <?php   if ($tipoUsuario === "1") 
                            {?>
                                <h2>No cuentas con Moderadores y/o Asesores disponibles ):</h2>
                    <?php   } 
                            elseif ($tipoUsuario === "2") 
                            {?>
                                <h2>No cuentas con Asesores disponibles ):</h2>
                    <?php   } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <h3 class="text-muted">A??ade algunos...</h3>
                            </div>
                        </div>
            <?php   }

                    if ($tipoUsuario === "1") 
                    {?>
                        <div class="d-flex justify-content-end mt-1">
                            <button type="submit" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#A??adir">A??adir Usuario</button>
                        </div>
            <?php   } 
                    elseif ($tipoUsuario === "2") 
                    {?>
                        <div class="d-flex justify-content-end mt-1">
                            <button type="submit" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#A??adir">A??adir Asesor</button>
                        </div>
            <?php   } ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<?php include_once "contenidoModalEditarUsuario.php"; ?>
<?php include_once "contenidoModalA??adirUsuario.php"; ?>
<?php include_once "ContenidoModalInfo.php"; ?>
<?php include_once "contenidomodalarchivosasubir.php"; ?>
<?php include_once "contenidomodalplanesmoviles.php"; ?>
<?php include_once "contenidomodalplanesfija.php"; ?>
<?php include_once "contenidomodalpromociones.php"; ?>
<?php include_once "contenidomodalempresa.php"; ?>
<?php include_once "contenidomodalEliminarplan.php"; ?>
<script src="controller/usuario/usuarios.js"></script>
<script src="controller/planes/planes.js"></script>