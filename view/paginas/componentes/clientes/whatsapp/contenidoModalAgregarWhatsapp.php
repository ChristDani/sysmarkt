<?php
require_once 'model/equipo.php';
require_once 'model/usuarios.php';

// usuarios
$user = new user();
$listUser = $user->listar();

// productos
$produclist = new equipos;
$productsMov = $produclist->listar();
?>
<div class="modal fade" id="AgregarWhatsapp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action='controller/whatsapp/agregar.php' method='post'>
                    <?php if ($tipoUsuario === "0") {?>
                        <div class="form-floating mb-3">                
                            <div class="form-floating mb-3">                
                                <div class="form-floating mb-3">                
                                    <div class="col-xs-2">
                                        <!-- valor para mostrar -->
                                        <center><label>Registrando venta como <?php echo "<b><em>$nombreUsuario</em></b>"; ?></label></center>
                                        <!-- valor para llevar datos -->
                                        <input hidden  name="asesor" id="asesor" value="<?php echo $dniUsuario; ?>"> 
                                    </div>
                                </div>                 
                            </div>                 
                        </div>                 
                    <?php } elseif ($tipoUsuario === "1" || $tipoUsuario === "2") {?>
                        <div class='form-floating mb-3'>
                            <select class='form-select form-select-sm' name='asesor' id='asesor'>
                        <?php if ($listUser != null) 
                            {
                                foreach ($listUser as $x) 
                                {
                                    if ($x[0] === $dniUsuario)
                                    {?>
                                        <option selected hidden value="<?php echo $x[0]; ?>"><?php echo $x[1]; ?></option>
                                <?php    }
                                    elseif ($x[0] != $dniUsuario && $x[3] === "0")
                                    {?>
                                        <option value="<?php echo $x[0]; ?>"><?php echo $x[1]; ?></option>
                        <?php       }
                                }
                            }?>
                            </select>
                            <label for='asesor'>Asesor</label>
                        </div> 
                    <?php } ?>
                    
                    <div class="form-floating mb-3">                
                        <input class="form-control" autocomplete="off" type="text" name="dni" id="dni" maxlength=8 placeholder="DNI del cliente..." onkeyup="mostrarTelefonoRef();arreglarnombre();" required oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        <label for="dni">DNI</label>
                    </div>

                    <div class="form-floating mb-3 d-none">
                        <input class="form-control" autocomplete="off" type="text" name="nombre" id="nombre" placeholder="Nombre del cliente..." required>
                        <label for="nombre">Nombre</label>
                    </div>
                    
                    <div class="form-floating mb-3 d-none" id="dtelefonoRef">                
                        <input required class="form-control" autocomplete="off" type="tel" name="telefonoRef" id="telefonoRef" maxlength=9 placeholder="999 999 999" onkeyup="mostrarProductos()" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        <label for="telefono">Telefono de Referencia</label>
                    </div>
                    
                    <div class="form-floating mb-3 d-none" id="dproducto">                
                        <select class="form-select form-select-sm" name="producto" id="producto">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="1">Movil</option>
                            <option value="0">Fija</option>
                        </select>
                        <label for="producto">Producto</label>
                    </div>
                    
                    <div class="form-floating mb-3 d-none" id="dpromocion">                
                        <select class="form-select form-select-sm" name="promocion" id="promocion">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="50% de Descuento con Lineas Adicionales">50% de Descuento con Lineas Adicionales</option>
                            <option value="20% de Descuento en Portabilidad Movil">20% de Descuento en Portabilidad Movil</option>
                            <option value="50% de Descuento en Planes Fija">50% de Descuento en Planes Fija</option>
                        </select>
                        <label for="promocion">Promoción</label>
                    </div>
    
                    <div class="form-floating mb-3 d-none" id="dtipo">                
                        <select class="form-select form-select-sm" name="tipo" id="tipo">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="0">Linea Nueva</option>
                            <option value="1">Portabilidad</option>
                            <option value="2">Renovacion</option>
                        </select>
                        <label for="tipo">Tipo</label>
                    </div>
                    
                    <div class="form-floating mb-3 d-none" id="dtipoFija">                
                        <select class="form-select form-select-sm" name="tipoFija" id="tipoFija">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="1">Portabilidad</option>
                            <option value="0">Alta</option>
                        </select>
                        <label for="tipoFija">Tipo Fija</label>
                    </div>
                    
                    <div class="form-floating mb-3 d-none" id="dtelefono">                
                        <input class="form-control" autocomplete="off" type="tel" name="telefono" id="telefono" maxlength=9 placeholder="999 999 999" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        <label for="telefono">Telefono</label>
                    </div>

                    <div class="form-floating mb-3 d-none" id="dlineaProce">                
                        <select class="form-select form-select-sm" name="lineaProce" id="lineaProce">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="Postpago">Postpago</option>
                            <option value="Prepago">Prepago</option>
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
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="1">Postpago</option>
                            <option value="0">Prepago</option>
                        </select>
                        <label for="modalidad">Modalidad</label>
                    </div>
                    
                    <div class="form-floating mb-3 d-none" id="dplan">                
                        <select class="form-select form-select-sm" name="plan" id="plan">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="S/ 29.90 MAX">S/ 29.90 MAX</option>
                            <option value="S/ 39.90">S/ 39.90</option>
                            <option value="S/ 49.90">S/ 49.90</option>
                            <option value="S/ 55.90">S/ 55.90</option>
                            <option value="S/ 69.90 MAX ILIMITADO">S/ 69.90 MAX ILIMITADO</option>
                            <option value="S/ 79.90 MAX ILIMITADO">S/ 79.90 MAX ILIMITADO</option>
                            <option value="S/ 95.90 MAX ILIMITADO">S/ 95.90 MAX ILIMITADO</option>
                            <option value="S/ 109.90 MAX ILIMITADO">S/ 109.90 MAX ILIMITADO</option>
                            <option value="S/ 159.90 MAX ILIMITADO">S/ 159.90 MAX ILIMITADO</option>
                            <option value="S/ 189.90 MAX ILIMITADO">S/ 189.90 MAX ILIMITADO</option>
                            <option value="S/ 289.90 MAX ILIMITADO">S/ 289.90 MAX ILIMITADO</option>
                            <option value="S/ 95.00 MAX PLAY - NETFLIX">S/ 95.00 MAX PLAY - NETFLIX</option>
                            <option value="S/ 115.00 MAX PLAY - NETFLIX">S/ 115.00 MAX PLAY - NETFLIX</option>
                            <option value="S/ 145.00 MAX PLAY - NETFLIX">S/ 145.00 MAX PLAY - NETFLIX</option>
                        </select>
                        <label for="plan">Plan</label>
                    </div>
                    
                    <div class="form-floating mb-3 d-none" id="dequipos">                
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
                    
                    <div class="form-floating mb-3 d-none" id="dplanFija">                
                        <select class="form-select form-select-sm" name="planFija" id="planFija">
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="1 Play - Telefonia">1 Play - Telefonia</option>
                            <option value="1 Play - Television">1 Play - Television</option>
                            <option value="1 Play - Internet">1 Play - Internet</option>
                            <option value="2 Play - Telefonia + Internet">2 Play - Telefonia + Internet</option>
                            <option value="2 Play - Internet + Cable Avanzado">2 Play - Internet + Cable Avanzado</option>
                            <option value="2 Play - Internet + Cable Superior">2 Play - Internet + Cable Superior</option>
                            <option value="3 Play - Telefonia + Internet + Cable Avanzado">3 Play - Telefonia + Internet + Cable Avanzado</option>
                            <option value="3 Play - Telefonia + Internet + Cable Superior">3 Play - Telefonia + Internet + Cable Superior</option>
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
                            <option value="---" style="color: gray;">(vacio)</option>
                            <option value="Contado">Contado</option>
                            <option value="Cuotas">Cuotas</option>
                        </select>
                        <label for="formaPago">Formas de Pago</label>
                    </div>
                    
                    <div class="form-floating mb-3 d-none" id="dsec">                
                        <input class="form-control" autocomplete="off" type="text" name="sec" id="sec" placeholder="SEC..." maxlength=15 oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        <label for="sec">SEC</label>
                    </div>
                    
                    <div class="form-floating mb-3 d-none" id="destado">                
                        <select class="form-select form-select-sm" name="estado" id="estado">
                            <option value="0">No Requiere</option>
                            <option value="1">Concretado</option>
                            <option selected value="2">Pendiente</option>
                        </select>
                        <label for="estado">Estado</label>
                    </div>

                    <div class="form-floating mb-3 d-none" id="dobservacion">
                        <textarea class="form-control" autocomplete="off" type="text" name="observaciones" id="observaciones" placeholder="Leave a comment here"></textarea>
                        <label for="observaciones">Observaciones</label>
                    </div>

                    <div class="form-floating mb-3 d-none" id="dubicacion">
                        <input class="form-control" autocomplete="off" type="text" name="ubicacion" id="ubicacion" placeholder="Ubicación del cliente...">
                        <label for="ubicacion">Ubicación</label>
                    </div>

                    <div class="form-floating mb-3 d-none" id="ddistrito">
                        <input class="form-control" autocomplete="off" type="text" name="distrito" id="distrito" placeholder="Distrito del cliente...">
                        <label for="distrito">Distrito</label>
                    </div>
                    
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>

    function arreglarnombre()
    {
        let dni = document.getElementById('dni');
        let nombre = document.getElementById('nombre');
        
        if (dni.value.length == 8) 
        { 
            let url='controller/whatsapp/arreglarnombre.php';
            let formaData = new FormData()
            formaData.append('dni', dni.value)
    
            fetch(url,{
                method: "POST",
                body: formaData
            }).then(response=>response.json())
            .then(data=>{
                nombre.value=data.data.nombres+" "+data.data.apellidoPaterno+" "+data.data.apellidoMaterno;
            }).catch(err=>console.log(err))
        }


    }

</script>