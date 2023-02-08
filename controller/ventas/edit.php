<?php
require_once '../../model/conexion.php';
require_once '../../model/equipo.php';
require_once "../../model/planes.php";
require_once '../../model/usuarios.php';

$model=new conexion();
$con=$model->conectar();

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

// en el caso de solo querer determinadas columnas usar esto con el mismo nombre de las columnas...
$columnas=['CodDetalle','sec','telefonoRefencia', 'producto', 'promocion', 'tipo', 'telefonoOperacion', 'lineaProcedente', 'operadorCendente', 'modalidad', 'modoReno', 'plan', 'equipo', 'tipoFija', 'planFija', 'modoFija', 'formaPago', 'distrito', 'ubicacion', 'observaciones', 'estado'];

// tabla a seleccionar
$tabla='detalleventas';

// posicion de registro
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;

// llamamos al registro
$sql = "select ".implode(", ", $columnas)." from $tabla where CodDetalle='".$codigo."'";
// para verificar errores en la consulta
// echo $sql;


$resultado=mysqli_query($con,$sql);

// para saber el numero de filas
$filas = $resultado->num_rows;


$output=[];
$output['data']= '';

if ($filas>0) {
    $i=1;
    while ($fila=mysqli_fetch_array($resultado)) {

        // variables para la comparacion
        $fija = "0";
        $movil = "1";

        // variables asignadas de la base de datos

        $codigo = $fila['CodDetalle'];
        $sec = $fila['sec'];
        $telefonoRef = $fila['telefonoRefencia'];
        $producto = $fila['producto'];
        $promocion = $fila['promocion'];
        $tipo = $fila['tipo'];
        $telefono = $fila['telefonoOperacion'];
        $lineaProce = $fila['lineaProcedente'];
        $operadorCed = $fila['operadorCendente'];
        $modalidad = $fila['modalidad'];
        $modoReno = $fila['modoReno'];
        $plan = $fila['plan'];
        $equipo = $fila['equipo'];
        $tipoFija = $fila['tipoFija'];
        $planFija = $fila['planFija'];
        $modoFija = $fila['modoFija'];
        $formaPago = $fila['formaPago'];
        $distrito = $fila['distrito'];
        $ubicacion = $fila['ubicacion'];
        $observaciones = $fila['observaciones'];
        $estado = $fila['estado'];

    
        // sec
        $output['data'].= "<div class='form-floating mb-3 d-none'>";
        $output['data'].= "<input class='form-control' type='text' name='sec' id='sec' value='$sec'>";
        $output['data'].= "<label for='sec'>SEC</label>";
        $output['data'].= "</div>";

        $output['data'].= "<div class='form-floating mb-3 d-none'>";
        $output['data'].= "<input class='form-control' type='text' name='codigo' id='codigo' value='$codigo'>";
        $output['data'].= "<label for='codigo'>Código de Venta</label>";
        $output['data'].= "</div>";


        $output['data'].= "<div class='row m-0'>";

        // producto
        $output['data'].= "<div class='col'>";
        $output['data'].= "<div class='card'>";
        $output['data'].= "<div class='card-body m-0'>";        
        $output['data'].= "<p class='text-muted'>Producto</p>";
        if ($producto === "0") 
        {
            $output['data'].= "<h3 class='text-info'>Fija</h3>";
        }
        elseif ($producto === "1") 
        {
            $output['data'].= "<h3 class='text-info'>Movil</h3>";
        }
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";

        // numero de referencia
        $output['data'].= "<div class='col'>";
        $output['data'].= "<div id='telefRefEditM' class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control' type='tel' name='telefonoRef' id='telefonoRef' value='$telefonoRef' maxlength=11 oninput="."this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');".">";
        $output['data'].= "<label for='telefonoRef'>Número de Referencia</label>";
        $output['data'].= "</div>";
        $output['data'] .= "</div> ";  
        
        // estado
        $output['data'].= "<div class='col'>";
        $output['data'].= "<div id='estadoEditM' class='form-floating mb-3'>";
        $output['data'] .= "<select class='form-select form-select-sm' name='estado' id='estado'>";
        if ($estado === "0") 
        {
            $output['data'].= "<option selected hidden value='0'>No Requiere</option>";
            $output['data'] .= "<option value='1' class='success'>Concretado</option>";
            $output['data'] .= "<option value='2' class='warning'>Pendiente</option>";
        }
        elseif ($estado === "1") 
        {
            $output['data'] .= "<option value='0' class='danger'>No Requiere</option>"; 
            $output['data'].= "<option selected hidden value='1'>Concretado</option>";
            $output['data'] .= "<option value='2' class='warning'>Pendiente</option>";
        }
        elseif ($estado === "2") 
        {
            $output['data'] .= "<option value='0' class='danger'>No Requiere</option>";
            $output['data'] .= "<option value='1' class='success'>Concretado</option>";
            $output['data'].= "<option selected hidden value='2'>Pendiente</option>";
        }
        $output['data'] .= "</select>";
        $output['data'].= "<label for='estado'>Estado</label>";            
        $output['data'].= "</div>"; 
        $output['data'] .= "</div> ";

        $output['data'] .= "</div> ";
        
        // $output['data'].= "<div class='row m-0'>";      

        // $output['data'] .= "</div> ";   
        
        // // promocion
        // $output['data'].= "<div id='promocionEdit' class='form-floating mb-3'>";
        // $output['data'].= "<select class='form-select form-select-sm' name='promocion' id='promocion'>"; 
        // $output['data'].= "<option hidden value='$promocion'>$promocion</option>";
        // if ($promociones != null) 
        // {
        //     foreach ($promociones as $pr) 
        //     {
        //         $output['data'].= "<option value='$pr[1]'>$pr[1]</option>";
        //     }
        // }
        // $output['data'].= "</select>";
        // $output['data'].= "<label for='promocion'>Promoción</label>";
        // $output['data'].= "</div> ";

        if ($producto === $fija) 
        {
            
            $output['data'].= "<div class='row m-0'>";      

            // promocion
            $output['data'].= "<div class='col'>";
            $output['data'].= "<div id='promocionEdit' class='form-floating mb-3'>";
            $output['data'].= "<select class='form-select form-select-sm' name='promocion' id='promocion'>"; 
            $output['data'].= "<option hidden value='$promocion'>$promocion</option>";
            if ($promociones != null) 
            {
                foreach ($promociones as $pr) 
                {
                    $output['data'].= "<option value='$pr[1]'>$pr[1]</option>";
                }
            }
            $output['data'].= "</select>";
            $output['data'].= "<label for='promocion'>Promoción</label>";
            $output['data'].= "</div> ";
            $output['data'].= "</div> ";

            // tipo de fija
            $output['data'].= "<div class='col'>";
            $output['data'].= "<div class='card'>";
            $output['data'].= "<div class='card-body m-0'>";        
            $output['data'].= "<p class='text-muted'>Tipo</p>";
            if ($tipoFija === "0") 
            {
                $output['data'].= "<h3 class='color'>Alta</h3>";
            }
            elseif ($tipoFija === "1") 
            {
                $output['data'].= "<h3 class='color'>Portabilidad</h3>";
            }
            $output['data'].= "</div>";
            $output['data'].= "</div>";
            $output['data'].= "</div>";

            $output['data'].= "<div class='form-floating mb-3 d-none'>";
            $output['data'].= "<input class='form-control' type='text' name='tipoFija' id='tipoFija' value='$tipoFija'>";
            $output['data'].= "<label for='tipoFija'>Tipo</label>";
            $output['data'].= "</div>";

            if ($tipoFija === "1") 
            {
                // telefono
            $output['data'].= "<div class='col'>";
                $output['data'].= "<div class='form-floating mb-3'>";
                $output['data'].= "<input class='form-control' type='tel' name='telefono' id='telefono' value='$telefono' maxlength=9 oninput="."this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');".">";
                $output['data'].= "<label for='telefono'>Telefono</label>";
                $output['data'].= "</div>";
                $output['data'].= "</div>";
            }

            $output['data'] .= "</div> ";   
            
            $output['data'].= "<div class='row m-0'>";      
 
            // plan de fija
            $output['data'].= "<div class='col'>";
            $output['data'].= "<div class='form-floating mb-3'>";
            $output['data'].= "<select class='form-select form-select-sm' name='planFija' id='planFija'>";
            $output['data'].= "<option hidden value='$planFija'>$planFija</option>";
            if ($planesFija != null) 
            {
                foreach ($planesFija as $pr) 
                {
                    $output['data'].= "<option value='$pr[1]'>$pr[1]</option>";
                }
            }
            $output['data'].= "</select>"; 
            $output['data'].= "<label for='planFija'>Plan</label>"; 
            $output['data'].= "</div> ";
            $output['data'].= "</div> ";

            // modo de fija
            $output['data'].= "<div class='col'>";
            $output['data'].= "<div class='form-floating mb-3'>";
            $output['data'].= "<select class='form-select form-select-sm' name='modoFija' id='modoFija'> <option hidden value='$modoFija'>$modoFija</option> <option value='HFC'>HFC</option>
            <option value='FTTH'>FTTH</option>
            <option value='IFI'>IFI</option></select>";
            $output['data'].= "<label for='modoFija'>Modo de Fija</label>"; 
            $output['data'].= "</div> ";
            $output['data'].= "</div> ";

            // forma de pago

            $output['data'].= "<div class='col'>";
            $output['data'].= "<div class='card'>";
            $output['data'].= "<div class='card-body m-0'>";        
            $output['data'].= "<p class='text-muted'>Forma de Pago</p>";
            $output['data'].= "<h3 class='color'>Contado</h3>";
            $output['data'].= "</div>";
            $output['data'].= "</div>";
            $output['data'].= "</div>";

            $output['data'].= "<div class='form-floating mb-3 d-none'>";
            $output['data'].= "<input class='form-control' type='text' name='formaPago' id='formaPago' value='$formaPago'>";
            $output['data'].= "<label for='formaPago'>Forma de Pago</label>";
            $output['data'].= "</div>";
            
            $output['data'].= "</div>";
        } 
        elseif ($producto === $movil) 
        {
            $output['data'].= "<div class='row m-0'>";      

            // promocion
            $output['data'].= "<div class='col'>";
            $output['data'].= "<div id='promocionEdit' class='form-floating mb-3'>";
            $output['data'].= "<select class='form-select form-select-sm' name='promocion' id='promocion'>"; 
            $output['data'].= "<option hidden value='$promocion'>$promocion</option>";
            if ($promociones != null) 
            {
                foreach ($promociones as $pr) 
                {
                    $output['data'].= "<option value='$pr[1]'>$pr[1]</option>";
                }
            }
            $output['data'].= "</select>";
            $output['data'].= "<label for='promocion'>Promoción</label>";
            $output['data'].= "</div> ";
            $output['data'].= "</div> ";

            // tipo
            $output['data'].= "<div class='col'>";
            $output['data'].= "<div class='card'>";
            $output['data'].= "<div class='card-body m-0'>";        
            $output['data'].= "<p class='text-muted'>Tipo de Linea</p>";
            if ($tipo === "0") 
            {
                $output['data'].= "<h3 class='color'>Linea Nueva</h3>";
            }
            elseif ($tipo === "1") 
            {
                $output['data'].= "<h3 class='color'>Portabilidad</h3>";
            }
            elseif ($tipo === "2") 
            {
                $output['data'].= "<h3 class='color'>Renovación</h3>";
            }
            $output['data'].= "</div>";
            $output['data'].= "</div>";
            $output['data'].= "</div>";

            $output['data'].= "<div class='form-floating mb-3 d-none'>";
            $output['data'].= "<input class='form-control' type='text' name='tipo' id='tipo' value='$tipo'>";
            $output['data'].= "<label for='tipo'>Tipo de Linea</label>";
            $output['data'].= "</div>";
        
            if ($tipo == "0") 
            {
                // modalidad
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div class='card'>";
                $output['data'].= "<div class='card-body m-0'>";        
                $output['data'].= "<p class='text-muted'>Modalidad</p>";
                if ($modalidad === "0") 
                {
                    $output['data'].= "<h3 class='color'>Prepago</h3>";
                }
                elseif ($modalidad === "1") 
                {
                    $output['data'].= "<h3 class='color'>Postpago</h3>";
                }
                $output['data'].= "</div>";
                $output['data'].= "</div>";
                $output['data'].= "</div>";

                $output['data'].= "<div class='form-floating mb-3 d-none'>";
                $output['data'].= "<input class='form-control' type='text' name='modalidad' id='modalidad' value='$modalidad'>";
                $output['data'].= "<label for='modalidad'>Modalidad</label>";
                $output['data'].= "</div>";

                $output['data'].= "</div> ";

                $output['data'].= "<div class='row m-0'>"; 

                if ($modalidad == "1") 
                {
                    // plan requerido
                    $output['data'].= "<div class='col'>";
                    $output['data'].= "<div id='planReEditM' class='form-floating mb-3'>";
                    $output['data'].= "<select class='form-select form-select-sm' name='plan' id='plan'>";
                    $output['data'].= "<option hidden value='$plan'>$plan</option>";  
                    if ($planesMov != null) 
                    {
                        foreach ($planesMov as $pr) 
                        {
                            $output['data'].= "<option value='$pr[1]'>$pr[1]</option>";
                        }
                    }
                    $output['data'].= " </select>";
                    $output['data'].= "<label for='plan'>Plan Requerido</label>";
                    $output['data'].= "</div> ";
                    $output['data'].= "</div> ";
                }

                // equipo
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div id='equipoEditM' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='equipos' id='equipos'> <option hidden value='$equipo'>$equipo</option><option value='Chip'>Chip</option>";
                if ($productsMov != null) 
                {
                    foreach ($productsMov as $pr) 
                    {
                        $output['data'] .= "<option value='".$pr[0]."'>".$pr[0]."</option>";
                    }
                }
                $output['data'].= "</select>";
                $output['data'].= "<label for='equipos'>Equipo</label>";
                $output['data'].= "</div>";
                $output['data'].= "</div>";

                //forma de pago
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div id='formaPgEditM' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='formaPago' id='formaPago'>";
                if ($formaPago == "0")
                {
                    $output['data'].= "<option selected hidden value='$formaPago'>Contado</option>";
                }
                elseif ($formaPago == "1")
                {
                    $output['data'].= "<option selected hidden value='$formaPago'>Cuotas</option>";
                }
                $output['data'].= "<option value='0'>Contado</option>";
                $output['data'].= "<option value='1'>Cuotas</option>";
                $output['data'].= "</select>";
                $output['data'].= "<label for='formaPago'>Forma de Pago</label>";            
                $output['data'].= "</div>";
                $output['data'].= "</div>";

                $output['data'].= "</div>";
            }
            elseif ($tipo == "1") 
            {
                // telefono
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div id='telefEdit' class='form-floating mb-3'>";
                $output['data'].= "<input class='form-control' type='tel' name='telefono' id='telefono' value='$telefono' maxlength=9 oninput="."this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');".">";
                $output['data'].= "<label for='telefono'>Telefono</label>";
                $output['data'].= "</div>";
                $output['data'].= "</div>";

                $output['data'].= "</div>";

                $output['data'].= "<div class='row m-0'>"; 
                
                // linea procedente
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div id='lineProceEdit' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='lineaProce' id='lineaProce'> <option hidden value='$lineaProce'>$lineaProce</option> <option value='Postpago'>Postpago</option>
                <option value='Prepago'>Prepago</option> </select>";
                $output['data'].= "<label for='lineaProce'>Linea Procedente</label>";
                $output['data'].= "</div> ";
                $output['data'].= "</div> ";

                // operador cedente
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div id='operaCedenEdit' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='operadorCeden' id='operadorCeden'> <option hidden value='$operadorCed'>$operadorCed</option> <option value='Movistar'>Movistar</option>
                <option value='Entel'>Entel</option>
                <option value='Bitel'>Bitel</option> </select>";
                $output['data'].= "<label for='operadorCeden'>Operador Cedente</label>";
                $output['data'].= "</div> ";
                $output['data'].= "</div> ";

                // modalidad
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div class='card'>";
                $output['data'].= "<div class='card-body m-0'>";        
                $output['data'].= "<p class='text-muted'>Modalidad</p>";
                if ($modalidad === "0") 
                {
                    $output['data'].= "<h3 class='color'>Prepago</h3>";
                }
                elseif ($modalidad === "1") 
                {
                    $output['data'].= "<h3 class='color'>Postpago</h3>";
                }
                $output['data'].= "</div>";
                $output['data'].= "</div>";
                $output['data'].= "</div>";

                $output['data'].= "<div class='form-floating mb-3 d-none'>";
                $output['data'].= "<input class='form-control' type='text' name='modalidad' id='modalidad' value='$modalidad'>";
                $output['data'].= "<label for='modalidad'>Modalidad</label>";
                $output['data'].= "</div>";

                $output['data'].= "</div> ";

                $output['data'].= "<div class='row m-0'>"; 

                if ($modalidad == "1") 
                {
                    // plan requerido
                    $output['data'].= "<div class='col'>";
                    $output['data'].= "<div id='planReEditM' class='form-floating mb-3'>";
                    $output['data'].= "<select class='form-select form-select-sm' name='plan' id='plan'>";
                    $output['data'].= "<option hidden value='$plan'>$plan</option>";  
                    if ($planesMov != null) 
                    {
                        foreach ($planesMov as $pr) 
                        {
                            $output['data'].= "<option value='$pr[1]'>$pr[1]</option>";
                        }
                    }
                    $output['data'].= " </select>";
                    $output['data'].= "<label for='plan'>Plan Requerido</label>";
                    $output['data'].= "</div> ";
                    $output['data'].= "</div> ";
                }

                // equipo
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div id='equipoEditM' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='equipos' id='equipos'> <option hidden value='$equipo'>$equipo</option><option value='Chip'>Chip</option>";
                if ($productsMov != null) 
                {
                    foreach ($productsMov as $pr) 
                    {
                        $output['data'] .= "<option value='".$pr[0]."'>".$pr[0]."</option>";
                    }
                }
                $output['data'].= "</select>";
                $output['data'].= "<label for='equipos'>Equipo</label>";
                $output['data'].= "</div>";
                $output['data'].= "</div>";
                
                //forma de pago
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div id='formaPgEditM' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='formaPago' id='formaPago'>";
                if ($formaPago == "0")
                {
                    $output['data'].= "<option selected hidden value='$formaPago'>Contado</option>";
                }
                elseif ($formaPago == "1")
                {
                    $output['data'].= "<option selected hidden value='$formaPago'>Cuotas</option>";
                }
                $output['data'].= "<option value='0'>Contado</option>";
                $output['data'].= "<option value='1'>Cuotas</option>";
                $output['data'].= "</select>";
                $output['data'].= "<label for='formaPago'>Forma de Pago</label>";            
                $output['data'].= "</div>";
                $output['data'].= "</div>";

                $output['data'].= "</div>";
            }
            elseif ($tipo == "2") 
            {
                // Modo de Renovacion
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div id='typeEdit' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='modoReno' id='modoReno'>";
                if ($modoReno == "0") 
                {
                    $output['data'].= "<option selected hidden value='$modoReno'>Descendente</option>";
                }
                elseif ($modoReno == "1") 
                {
                    $output['data'].= "<option selected hidden value='$modoReno'>Ascendente</option>";
                }
                $output['data'].= "<option value='0'>Descendente</option>";
                $output['data'].= "<option value='1'>Ascendente</option>";
                $output['data'].= "</select>";
                $output['data'].= "<label for='modoReno'>Modo de Renovación</label>";
                $output['data'].= "</div> ";
                $output['data'].= "</div> ";

                $output['data'].= "</div>";

                $output['data'].= "<div class='row m-0'>"; 
                
                // telefono
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div id='telefEdit' class='form-floating mb-3'>";
                $output['data'].= "<input class='form-control' type='tel' name='telefono' id='telefono' value='$telefono' maxlength=9 oninput="."this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');".">";
                $output['data'].= "<label for='telefono'>Telefono</label>";
                $output['data'].= "</div>";
                $output['data'].= "</div>";

                // linea procedente
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div class='card'>";
                $output['data'].= "<div class='card-body m-0'>";        
                $output['data'].= "<p class='text-muted'>Linea Procedente</p>";
                $output['data'].= "<h3 class='color'>$lineaProce</h3>";
                $output['data'].= "</div>";
                $output['data'].= "</div>";
                $output['data'].= "</div>";

                $output['data'].= "<div class='form-floating mb-3 d-none'>";
                $output['data'].= "<input class='form-control' type='text' name='lineaProce' id='lineaProce' value='$lineaProce'>";
                $output['data'].= "<label for='lineaProce'>Linea Procedente</label>";
                $output['data'].= "</div>";
    
                // modalidad
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div class='card'>";
                $output['data'].= "<div class='card-body m-0'>";        
                $output['data'].= "<p class='text-muted'>Modalidad</p>";
                if ($modalidad === "0") 
                {
                    $output['data'].= "<h3 class='color'>Prepago</h3>";
                }
                elseif ($modalidad === "1") 
                {
                    $output['data'].= "<h3 class='color'>Postpago</h3>";
                }
                $output['data'].= "</div>";
                $output['data'].= "</div>";
                $output['data'].= "</div>";

                $output['data'].= "<div class='form-floating mb-3 d-none'>";
                $output['data'].= "<input class='form-control' type='text' name='modalidad' id='modalidad' value='$modalidad'>";
                $output['data'].= "<label for='modalidad'>Modalidad</label>";
                $output['data'].= "</div>";

                $output['data'].= "</div> ";

                $output['data'].= "<div class='row m-0'>"; 
                
                // plan requerido
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div id='planReEditM' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='plan' id='plan'>";
                $output['data'].= "<option hidden value='$plan'>$plan</option>";  
                if ($planesMov != null) 
                {
                    foreach ($planesMov as $pr) 
                    {
                        $output['data'].= "<option value='$pr[1]'>$pr[1]</option>";
                    }
                }
                $output['data'].= " </select>";
                $output['data'].= "<label for='plan'>Plan Requerido</label>";
                $output['data'].= "</div> ";
                $output['data'].= "</div> ";

                // equipo
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div id='equipoEditM' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='equipos' id='equipos'> <option hidden value='$equipo'>$equipo</option><option value='Chip'>Chip</option>";
                if ($productsMov != null) 
                {
                    foreach ($productsMov as $pr) 
                    {
                        $output['data'] .= "<option value='".$pr[0]."'>".$pr[0]."</option>";
                    }
                }
                $output['data'].= "</select>";
                $output['data'].= "<label for='equipos'>Equipo</label>";
                $output['data'].= "</div>";
                $output['data'].= "</div>";
                
                //forma de pago
                $output['data'].= "<div class='col'>";
                $output['data'].= "<div id='formaPgEditM' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='formaPago' id='formaPago'>";
                if ($formaPago == "0")
                {
                    $output['data'].= "<option selected hidden value='$formaPago'>Contado</option>";
                }
                elseif ($formaPago == "1")
                {
                    $output['data'].= "<option selected hidden value='$formaPago'>Cuotas</option>";
                }
                $output['data'].= "<option value='0'>Contado</option>";
                $output['data'].= "<option value='1'>Cuotas</option>";
                $output['data'].= "</select>";
                $output['data'].= "<label for='formaPago'>Forma de Pago</label>";            
                $output['data'].= "</div>";
                $output['data'].= "</div>";

                $output['data'].= "</div>";
            }
        }
        
        $output['data'].= "<div class='row m-0'>";      

        // distrito
        $output['data'].= "<div class='col'>";
        $output['data'].= "<div id='disEditM' class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control' type='text' name='distrito' id='distrito' value='$distrito'>";
        $output['data'].= "<label for='distrito'>Distrito</label>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        
        // ubicacion
        $output['data'].= "<div class='col'>";
        $output['data'].= "<div id='ubiEditM' class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control' type='text' name='ubicacion' id='ubicacion' value='$ubicacion'>";
        $output['data'].= "<label for='ubicacion'>Ubicacion</label>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";

        $output['data'] .= "</div> ";   

        
        $output['data'].= "<div class='row m-0'>";      

        // observaciones
        $output['data'].= "<div class='col'>";
        $output['data'].= "<div id='obsEditM' class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control' type='textarea' name='observaciones' id='observaciones' value='$observaciones'>";
        $output['data'].= "<label for='observaciones'>Observaciones</label>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";

        $output['data'] .= "</div> ";   
    }
}


echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>