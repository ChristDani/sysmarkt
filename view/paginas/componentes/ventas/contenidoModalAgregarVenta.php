<?php
require_once 'model/equipo.php';
require_once "model/planes.php";
require_once 'model/usuarios.php';

// usuarios
$user = new user();
$listUser = $user->listar();

// productos
$produclist = new equipos;
$productsMov = $produclist->listar();

// planes
$planeslist = new planes;
$planesMov = $planeslist->listar();
$planesFija = $planeslist->listarFija();
$promociones = $planeslist->listarPromo();
?>
<div class="modal fade" id="AgregarVenta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Venta</h1>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="contenedorFormularioaddventa">
                    <div>
                        <div class='col text-center'>
                            <div class='card'>
                                <div class='card-body m-2'>       
                                    <p class='text-muted'>Asesor a Cargo</p>
                                    <h3><?php echo $nombreUsuario; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input hidden name="asesor" id="asesor" value="<?php echo $dniUsuario; ?>">               
                    
                    <div class="form-floating mb-3 d-none">
                        <input class="form-control" autocomplete="off" type="text" name="nombre" id="nombre" placeholder="..." required>
                        <label for="nombre">Nombre</label>
                    </div>

                    <div class='col text-center'>
                        <div class='card'>
                            <div class='card-body m-2'>       
                                <p class='text-muted'>Nombre del Cliente</p>
                                <h3 id="mostrarnamecliente"></h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row m-0">
                        <div class='col text-center d-none' id="letrerodni">
                            <div class='card' ondblclick="cambiardni();">
                                <div class='card-body m-2'>       
                                    <p class='text-muted'>DNI</p>
                                    <h3 id="mostrardni"></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col" id="inputdni">
                            <div class="form-floating mb-3">
                                <input class="form-control" autocomplete="off" type="number" name="dni" id="dni" maxlength=8 placeholder="..." onblur="dnipuesto();" onkeyup="arreglarnombre();dnipuesto();" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                <label for="dni">DNI</label>
                            </div>
                        </div>
                        <div class='col text-center d-none' id="letrerosec">
                            <div class='card' ondblclick="cambiarsec();">
                                <div class='card-body m-2'>       
                                    <p class='text-muted'>Sec</p>
                                    <h3 id="mostrarsec"></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col d-none" id="inputsec">
                            <div class="form-floating mb-3">                
                                <input class="form-control" autocomplete="off" type="number" name="sec" id="sec" placeholder="..." maxlength=15 required onblur="secpuesta();" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                <label for="sec">SEC</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row m-0 d-none gap-1' id="btnaddnewproduc">
                    
                </div>
                <div id="contenidonuevoproducto" class="d-none">

                    <div class="form-floating mb-3" id="dtelefonoRef">                
                        <input required class="form-control" autocomplete="off" type="number" name="telefonoRef" id="telefonoRef" maxlength=9 placeholder="..." onkeyup="mostrarProductos()" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        <label for="telefono">Telefono de Referencia</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="dproducto">                
                        <select class="form-select form-select-sm" name="producto" id="producto">
                            <option value="-" style="color: gray;">(vacio)</option>
                            <option value="1">Movil</option>
                            <option value="0">Fija</option>
                        </select>
                        <label for="producto">Producto</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="dpromocion">                
                        <select class="form-select form-select-sm" name="promocion" id="promocion">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <?php 
                            if ($promociones != null) 
                            {
                                foreach ($promociones as $pr) 
                                {?>
                                    <option value="<?php echo $pr[1]; ?>"><?php echo $pr[1]; ?></option>
                            <?php }
                            }?>
                        </select>
                        <label for="promocion">Promoción</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="dtipo">                
                        <select class="form-select form-select-sm" name="tipo" id="tipo">
                            <option value="-" style="color: gray;">(vacio)</option>
                            <option value="0">Linea Nueva</option>
                            <option value="1">Portabilidad</option>
                            <option value="2">Renovacion</option>
                        </select>
                        <label for="tipo">Tipo</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="dtipoFija">                
                        <select class="form-select form-select-sm" name="tipoFija" id="tipoFija">
                            <option value="-" style="color: gray;">(vacio)</option>
                            <option value="1">Portabilidad</option>
                            <option value="0">Alta</option>
                        </select>
                        <label for="tipoFija">Tipo Fija</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="dtelefono">                
                        <input class="form-control" autocomplete="off" type="number" name="telefono" id="telefono" maxlength=9 placeholder="..." oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        <label for="telefono">Telefono</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="dlineaProce">                
                        <select class="form-select form-select-sm" name="lineaProce" id="lineaProce">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="Prepago">Prepago</option>
                            <option value="Postpago">Postpago</option>
                        </select>
                        <label for="lineaProce">Linea Procedente</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="doperadorCeden">                
                        <select class="form-select form-select-sm" name="operadorCeden" id="operadorCeden">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="Movistar">Movistar</option>
                            <option value="Entel">Entel</option>
                            <option value="Bitel">Bitel</option>
                        </select>
                        <label for="operadorCeden">Operador Cedente</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="dmodalidad">                
                        <select class="form-select form-select-sm" name="modalidad" id="modalidad">
                            <option value="-" style="color: gray;">(vacio)</option>
                            <option value="0">Prepago</option>
                            <option value="1">Postpago</option>
                        </select>
                        <label for="modalidad">Modalidad</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="dmodoReno">                
                        <select class="form-select form-select-sm" name="modoReno" id="modoReno">
                            <option value="-" style="color: gray;">(vacio)</option>
                            <option value="0">Descendente</option>
                            <option value="1">Ascendente</option>
                        </select>
                        <label for="modoReno">Modo Renovación</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="dplan">                
                        <select class="form-select form-select-sm" name="plan" id="plan">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <?php 
                            if ($planesMov != null) 
                            {
                                foreach ($planesMov as $pr) 
                                {?>
                                    <option value="<?php echo $pr[1]; ?>"><?php echo $pr[1]; ?></option>
                            <?php }
                            }?>
                        </select>
                        <label for="plan">Plan</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="dequipos">                
                        <select class="form-select form-select-sm" name="equipos" id="equipos">
                            <option select value="---">(vacio)</option>
                            <option select value="Chip">Chip</option>
                            <?php
                                if ($productsMov != null) 
                                {
                                    foreach ($productsMov as $pr) 
                                    {
                                        echo "<option value='".$pr[0]."'>".$pr[0]."</option>";
                                    }
                                }
                            ?>
                        </select>
                        <label for="equipos">Equipos</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="dplanFija">                
                        <select class="form-select form-select-sm" name="planFija" id="planFija">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <?php 
                            if ($planesFija != null) 
                            {
                                foreach ($planesFija as $pr) 
                                {?>
                                    <option value="<?php echo $pr[1]; ?>"><?php echo $pr[1]; ?></option>
                            <?php }
                            }?>
                        </select>
                        <label for="planFija">Plan Fija</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="dmodoFija">                
                        <select class="form-select form-select-sm" name="modoFija" id="modoFija">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="HFC">HFC</option>
                            <option value="FTTH">FTTH</option>
                            <option value="IFI">IFI</option>
                        </select>
                        <label for="modoFija">Modo Fija</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="dformaPago">                
                        <select class="form-select form-select-sm" name="formaPago" id="formaPago">
                            <option value="-" style="color: gray;">(vacio)</option>
                            <option value="0">Contado</option>
                            <option value="1">Cuotas</option>
                        </select>
                        <label for="formaPago">Formas de Pago</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="ddistrito">
                        <input class="form-control" autocomplete="off" type="text" name="distrito" id="distrito" placeholder="Distrito del cliente...">
                        <label for="distrito">Distrito</label>
                    </div>
                    
                    <div class="form-floating mb-3 d-none" id="dubicacion">
                        <input class="form-control" autocomplete="off" type="text" name="ubicacion" id="ubicacion" placeholder="Ubicación del cliente...">
                        <label for="ubicacion">Ubicación</label>
                    </div>
                        
                    <div class="form-floating mb-3 d-none" id="dobservacion">
                        <textarea class="form-control" autocomplete="off" type="text" name="observaciones" id="observaciones" placeholder="Leave a comment here"></textarea>
                        <label for="observaciones">Observaciones</label>
                    </div>

                    <div class='row m-0'>
                        <div class="col text-center d-none" id="botonesdeaccionalagregarproductocancelar">
                            <a href='#' class='btn color' onclick="ocultarcontenidonewproduc()">Cancelar</a>
                        </div>
                        <div class="col text-center d-none" id="botonesdeaccionalagregarproductoagregar">
                            <a href='#' class='btn color' onclick="añadirproductoalista()">Agregar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary d-none" id="btnaddnewventa" onclick="agregarventa();">Agregar</button>
            </div>
        </div>
    </div>
</div>
<script src="controller/ventas/validaciones.js"></script>
