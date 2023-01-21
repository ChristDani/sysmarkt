<div class="modal fade" id="AgregarCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar</h1>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="contenidocliente">
                    <div class="row m-0">
                        <div class="form-floating mb-3 d-none" id="dnombre">
                            <input class="form-control" autocomplete="off" type="text" id="nombre" placeholder="..." required>
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class='col text-center'>
                            <div class='card'>
                                <div class='card-body m-2'>       
                                    <p class='text-muted'>Nombre</p>
                                    <h3 id="mostrarnamenewcliente"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col" id="nptdn">
                            <div class="form-floating mb-3">                
                                <input class="form-control" autocomplete="off" type="number" id="dni" maxlength=8 placeholder="..." onkeyup="dnipuesto();arreglarnombre();" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                <label for="dni">DNI</label>
                            </div>
                        </div>
                        <div class='col text-center d-none' id="ltrrdn">
                            <div class='card' ondblclick="cambiardni();">
                                <div class='card-body m-2'>       
                                    <p class='text-muted'>DNI</p>
                                    <h3 id="mostrarndinewcliente"></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3" id="ddistrito">
                                <textarea class="form-control" autocomplete="off" type="text" id="distrito" placeholder="..."></textarea>
                                <label for="distrito">Distrito</label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col">
                            <div class="form-floating mb-3" id="dubicacion">
                                <textarea class="form-control" autocomplete="off" type="text" id="ubicacion" placeholder="..."></textarea>
                                <label for="ubicacion">Ubicación</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-0 gap-1 d-none" id="listartelefonosaagregar">

                </div>
                <div class="d-none" id="contenidotelefono">
                    <div class="row m-0">
                        <div class="col">
                            <div class="form-floating mb-3">                
                                <input class="form-control" autocomplete="off" type="number" id="telefono" onkeyup="telefono();" maxlength=9 placeholder="..." oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                <label for="telefono">Telefono</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">                
                                <select class="form-select form-select-sm" id="tipotelefono">
                                    <option value="-" style="color: gray;">(vacio)</option>
                                    <option value="0">Fijo</option>
                                    <option value="1">Movil</option>
                                </select>
                                <label for="tipotelefono">Tipo</label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col">
                            <div class="form-floating mb-3">                
                                <select class="form-select form-select-sm" id="operador">
                                    <option value="---" style="color: gray;">(vacio)</option>
                                    <option value="Bitel">Bitel</option>
                                    <option value="Claro">Claro</option>
                                    <option value="Entel">Entel</option>
                                    <option value="Movistar">Movistar</option>
                                </select>
                                <label for="operador">Operador</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">                
                                <select class="form-select form-select-sm" id="modalidad">
                                    <option value="-" style="color: gray;">(vacio)</option>
                                    <option value="1">Postpago</option>
                                    <option value="0">Prepago</option>
                                </select>
                                <label for="modalidad">Modalidad</label>
                            </div>
                        </div>
                    </div>
                    <div class='row m-0'>
                        <div class="col text-center d-none" id="btnccngrgrtlfncnclr">
                            <a href='#' class='btn color' onclick="ocultarformularionewtelefono()">Cancelar</a>
                        </div>
                        <div class="col text-center d-none" id="btnccngrgrtlfngrgr">
                            <a href='#' class='btn color' onclick="añadirtelefonoalista()">Agregar</a>
                        </div>
                    </div>
                </div>                    
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary d-none" id="btnaddnewcliente" onclick="agregarcliente();">Agregar</button>
            </div>
        </div>
    </div>
</div>