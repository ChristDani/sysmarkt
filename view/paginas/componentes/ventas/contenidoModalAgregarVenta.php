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
?>
<div class="modal fade" id="AgregarVenta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Venta</h1>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="contenedorFormularioaddventa">
                    <form id="formularionewVenta" action='controller/ventas/agregar.php' method='post'>
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
                                    <input class="form-control" autocomplete="off" type="number" name="dni" id="dni" maxlength=8 placeholder="..." onblur="dnipuesto();" onkeyup="arreglarnombre();" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
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
                            <div class="col" id="inputsec">
                                <div class="form-floating mb-3 /*d-none*/" id="dsec">                
                                    <input class="form-control" autocomplete="off" type="number" name="sec" id="sec" placeholder="..." maxlength=15 required onblur="secpuesta();" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    <label for="sec">SEC</label>
                                </div>
                            </div>
                        </div>
    
                    </form>
                </div>
                <div class='row m-0 d-none gap-1' id="btnaddnewproduc">
                    
                    <div class='text-center'>
                        <h3 class='text-info'>Productos</h3>
                    </div>
                    <div class='text-center'>
                        <div class='card'>
                            <div class='card-body m-0'> 
                                <div class='row m-0'>
                                    <div class='col'><p>Movil</p></div>
                                    <div class='col'><p>Chip</p></div>
                                    <div class='col'><p>Postpago</p></div>
                                </div>      
                            </div>
                        </div>
                    </div>
                    <div class='text-center'>
                        <div class='card'>
                            <div class='card-body m-0'> 
                                <div class="row m-0">
                                    <div class="col"><p>Movil</p></div>
                                    <div class="col"><p>SMG</p></div>
                                    <div class="col"><p>Prepago</p></div>
                                </div>      
                            </div>
                        </div>
                    </div>
                    <a href='#' class='btn color' onclick="mostrarcontenidonewproduc()">Nuevo Producto</a>
                </div>
                <div id="contenidonuevoproducto" class="d-none">

                    <div class="form-floating mb-3 /*d-none*/" id="dtelefonoRef">                
                        <input required class="form-control" autocomplete="off" type="tel" name="telefonoRef" id="telefonoRef" maxlength=9 placeholder="999 999 999" onkeyup="mostrarProductos()" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        <label for="telefono">Telefono de Referencia</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dproducto">                
                        <select class="form-select form-select-sm" name="producto" id="producto">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="1">Movil</option>
                            <option value="0">Fija</option>
                        </select>
                        <label for="producto">Producto</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dpromocion">                
                        <select class="form-select form-select-sm" name="promocion" id="promocion">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="50% de Descuento con Lineas Adicionales">50% de Descuento con Lineas Adicionales</option>
                            <option value="20% de Descuento en Portabilidad Movil">20% de Descuento en Portabilidad Movil</option>
                            <option value="50% de Descuento en Planes Fija">50% de Descuento en Planes Fija</option>
                        </select>
                        <label for="promocion">Promoción</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dtipo">                
                        <select class="form-select form-select-sm" name="tipo" id="tipo">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="0">Linea Nueva</option>
                            <option value="1">Portabilidad</option>
                            <option value="2">Renovacion</option>
                        </select>
                        <label for="tipo">Tipo</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dtipoFija">                
                        <select class="form-select form-select-sm" name="tipoFija" id="tipoFija">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="1">Portabilidad</option>
                            <option value="0">Alta</option>
                        </select>
                        <label for="tipoFija">Tipo Fija</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dtelefono">                
                        <input class="form-control" autocomplete="off" type="tel" name="telefono" id="telefono" maxlength=9 placeholder="999 999 999" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        <label for="telefono">Telefono</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dlineaProce">                
                        <select class="form-select form-select-sm" name="lineaProce" id="lineaProce">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="Postpago">Postpago</option>
                            <option value="Prepago">Prepago</option>
                        </select>
                        <label for="lineaProce">Linea Procedente</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="doperadorCeden">                
                        <select class="form-select form-select-sm" name="operadorCeden" id="operadorCeden">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="Movistar">Movistar</option>
                            <option value="Entel">Entel</option>
                            <option value="Bitel">Bitel</option>
                        </select>
                        <label for="operadorCeden">Operador Cedente</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dmodalidad">                
                        <select class="form-select form-select-sm" name="modalidad" id="modalidad">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="1">Postpago</option>
                            <option value="0">Prepago</option>
                        </select>
                        <label for="modalidad">Modalidad</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dplan">                
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
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dequipos">                
                        <select class="form-select form-select-sm" name="equipos" id="equipos">
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
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dplanFija">                
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
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dmodoFija">                
                        <select class="form-select form-select-sm" name="modoFija" id="modoFija">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="HFC">HFC</option>
                            <option value="FTTH">FTTH</option>
                            <option value="IFI">IFI</option>
                        </select>
                        <label for="modoFija">Modo Fija</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dformaPago">                
                        <select class="form-select form-select-sm" name="formaPago" id="formaPago">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="Contado">Contado</option>
                            <option value="Cuotas">Cuotas</option>
                        </select>
                        <label for="formaPago">Formas de Pago</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dsec">                
                        <input class="form-control" autocomplete="off" type="text" name="sec" id="sec" placeholder="SEC..." maxlength=15 oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        <label for="sec">SEC</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="destado">                
                        <select class="form-select form-select-sm" name="estado" id="estado">
                            <option value="0">No Requiere</option>
                            <option value="1">Concretado</option>
                            <option selected value="2">Pendiente</option>
                        </select>
                        <label for="estado">Estado</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dobservacion">
                        <textarea class="form-control" autocomplete="off" type="text" name="observaciones" id="observaciones" placeholder="Leave a comment here"></textarea>
                        <label for="observaciones">Observaciones</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="dubicacion">
                        <input class="form-control" autocomplete="off" type="text" name="ubicacion" id="ubicacion" placeholder="Ubicación del cliente...">
                        <label for="ubicacion">Ubicación</label>
                    </div>
                        
                    <div class="form-floating mb-3 /*d-none*/" id="ddistrito">
                        <input class="form-control" autocomplete="off" type="text" name="distrito" id="distrito" placeholder="Distrito del cliente...">
                        <label for="distrito">Distrito</label>
                    </div>

                    <div class='row m-0'>
                        <div class="col text-center">
                            <a href='#' class='btn color' onclick="ocultarcontenidonewproduc()">Cancelar</a>
                        </div>
                        <div class="col text-center">
                            <a href='#' class='btn color' onclick="añadirproductoalista()">Agregar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button form="formularionewVenta" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<script>
    // let listadeproductos = new Array();
    let listadeproductos = [["1", "chip", "porta"],["1", "smg", "prepa"]];
    function cambiardni() 
    {
        document.getElementById('letrerodni').classList.add('d-none');
        document.getElementById('inputdni').classList.remove('d-none');
    }
    function dnipuesto() 
    { 
        document.getElementById('letrerodni').classList.remove('d-none');
        document.getElementById('inputdni').classList.add('d-none');

        document.getElementById('mostrardni').innerHTML = document.getElementById('dni').value;
    }
    function cambiarsec() 
    {
        console.log(listadeproductos.length);
        if (listadeproductos.length == 0) 
        {
            document.getElementById('letrerosec').classList.add('d-none');
            document.getElementById('inputsec').classList.remove('d-none');
            document.getElementById('btnaddnewproduc').classList.add('d-none');
        }
    }
    function secpuesta() 
    {
        document.getElementById('letrerosec').classList.remove('d-none');
        document.getElementById('inputsec').classList.add('d-none');
        document.getElementById('btnaddnewproduc').classList.remove('d-none');
        
        document.getElementById('mostrarsec').innerHTML = document.getElementById('sec').value;
        // if (listadeproductos.length == 0) 
        // {
        //     document.getElementById('btnaddnewproduc').innerHTML = "<a href='#' class='btn color' onclick='mostrarcontenidonewproduc()'>Nuevo Producto</a>";
        // }
        // else
        // {
        //     listadeproductos.forEach(function(i) {
                
        //     });
        // }
    }
    function añadirproductoalista()
    {
        let sec = document.getElementById('').value;
        let referencia = document.getElementById('').value;
        let producto = document.getElementById('').value;
        let promocion = document.getElementById('').value;
        let tipo = document.getElementById('').value;
        let telefop = document.getElementById('').value;
        let lineaproce = document.getElementById('').value;
        let operaceden = document.getElementById('').value;
        let modalidad = document.getElementById('').value;
        let modoreno = document.getElementById('').value;
        let plan = document.getElementById('').value;
        let equipo = document.getElementById('').value;
        let tipofija = document.getElementById('').value;
        let planfija = document.getElementById('').value;
        let modofija = document.getElementById('').value;
        let formapago = document.getElementById('').value;
        let distrito = document.getElementById('').value;
        let ubicacion = document.getElementById('').value;
        let observacion = document.getElementById('').value;
        let estado = document.getElementById('').value;
    }
    function mostrarcontenidonewproduc() 
    {
        document.getElementById('contenedorFormularioaddventa').classList.add('d-none');
        document.getElementById('contenidonuevoproducto').classList.remove('d-none');
        document.getElementById('btnaddnewproduc').classList.add('d-none');
    }
    function ocultarcontenidonewproduc() 
    {
        document.getElementById('contenedorFormularioaddventa').classList.remove('d-none');
        document.getElementById('contenidonuevoproducto').classList.add('d-none');
        document.getElementById('btnaddnewproduc').classList.remove('d-none');
    }
    function arreglarnombre()
    {
        let dni = document.getElementById('dni');
        let nombre = document.getElementById('nombre');
        let muestranombre = document.getElementById('mostrarnamecliente');
        
        if (dni.value.length == 8) 
        { 
            let url='controller/arreglarnombre.php';
            let formaData = new FormData()
            formaData.append('dni', dni.value)
    
            fetch(url,{
                method: "POST",
                body: formaData
            }).then(response=>response.json())
            .then(data=>{
                nombre.value=data.data.nombres+" "+data.data.apellidoPaterno+" "+data.data.apellidoMaterno;
                muestranombre.innerHTML=data.data.nombres+" "+data.data.apellidoPaterno+" "+data.data.apellidoMaterno;
            }).catch(err=>console.log(err))
        }
    }
</script>
