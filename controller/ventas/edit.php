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
            $output['data'].= "<div class='form-floating mb-3'>";
            $output['data'].= "<select class='form-select form-select-sm' name='tipoFija' id='tipoFija'>";
            if ($tipoFija === "0") 
            {
                $output['data'].= "<option value='$tipoFija'>Alta</option>"; 
            }
            elseif ($tipoFija === "1") 
            {
                $output['data'].= "<option value='$tipoFija'>Portabilidad</option>"; 
            }
            $output['data'].= "</select>";
            $output['data'].= "<label for='tipoFija'>Tipo</label>";
            $output['data'].= "</div> ";
            $output['data'].= "</div> ";

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
            $output['data'].= "<h3 class='text-info'>Contado</h3>";
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
            // tipo
            $output['data'].= "<div id='typeEdit' class='form-floating mb-3'>";
            $output['data'].= "<select class='form-select form-select-sm' name='tipo' id='tipo'>";
            if ($tipo === "0") 
            {
                $output['data'].= "<option value='$tipo'>Linea Nueva</option>";
            }
            elseif ($tipo === "1") 
            {
                $output['data'].= "<option value='$tipo'>Portabilidad</option>";
            }
            elseif ($tipo === "2") 
            {
                $output['data'].= "<option value='$tipo'>Renovacion</option>";
            }
            $output['data'].= "</select>";
            $output['data'].= "<label for='tipo'>Tipo de Linea</label>";
            $output['data'].= "</div> ";
        
            if ($tipo == "0") 
            {
                // modalidad
                $output['data'].= "<div id='modalEdit' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='modalidad' id='modalidad'>";
                if ($modalidad === "0") 
                {
                    $output['data'].= "<option value='$modalidad'>Prepago</option>";
                }
                elseif ($modalidad === "1") 
                {
                    $output['data'].= "<option value='$modalidad'>Postpago</option>";
                }
                $output['data'].= "</select>";
                $output['data'].= "<label for='modalidad'>Modalidad</label>";
                $output['data'].= "</div> ";

                if ($modalidad == "1") 
                {
                    // plan requerido
                    $output['data'].= "<div id='planReEditM' class='form-floating mb-3'>";
                    $output['data'].= "<select class='form-select form-select-sm' name='plan' id='plan'>";
                    $output['data'].= "<option hidden value='$plan'>$plan</option>";  
                    if ($planesMov != null) 
                    {
                        foreach ($planesMov as $pr) 
                        {
                            $output['data'].= "<option value='$pr[0]'>$pr[0]</option>";
                        }
                    }
                    $output['data'].= " </select>";
                    $output['data'].= "<label for='plan'>Plan Requerido</label>";
                    $output['data'].= "</div> ";
                }

                // equipo
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

                if ($modalidad == "1") 
                {
                    //forma de pago
                    $output['data'].= "<div id='formaPgEditM' class='form-floating mb-3'>";
                    $output['data'].= "<select class='form-select form-select-sm' name='formaPago' id='formaPago'> <option hidden value='$formaPago'>$formaPago</option> <option value='Cuotas'>Cuotas</option> <option value='Contado'>Contado</option></select>";
                    $output['data'].= "<label for='formaPago'>Forma de Pago</label>";            
                    $output['data'].= "</div>";
                }
                elseif ($modalidad == "0") 
                {
                    //forma de pago
                    $output['data'].= "<div id='formaPgEditM' class='form-floating mb-3'>";
                    $output['data'].= "<select class='form-select form-select-sm' name='formaPago' id='formaPago'> <option hidden value='$formaPago'>$formaPago</option> <option value='Contado'>Contado</option></select>";
                    $output['data'].= "<label for='formaPago'>Forma de Pago</label>";            
                    $output['data'].= "</div>";
                }
            }
            elseif ($tipo == "1") 
            {
                // telefono
                $output['data'].= "<div id='telefEdit' class='form-floating mb-3'>";
                $output['data'].= "<input class='form-control' type='tel' name='telefono' id='telefono' value='$telefono' maxlength=9 oninput="."this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');".">";
                $output['data'].= "<label for='telefono'>Telefono</label>";
                $output['data'].= "</div>";

                // linea procedente
                $output['data'].= "<div id='lineProceEdit' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='lineaProce' id='lineaProce'> <option hidden value='$lineaProce'>$lineaProce</option> <option value='Postpago'>Postpago</option>
                <option value='Prepago'>Prepago</option> </select>";
                $output['data'].= "<label for='lineaProce'>Linea Procedente</label>";
                $output['data'].= "</div> ";

                // operador cedente
                $output['data'].= "<div id='operaCedenEdit' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='operadorCeden' id='operadorCeden'> <option hidden value='$operadorCed'>$operadorCed</option> <option value='Movistar'>Movistar</option>
                <option value='Entel'>Entel</option>
                <option value='Bitel'>Bitel</option> </select>";
                $output['data'].= "<label for='operadorCeden'>Operador Cedente</label>";
                $output['data'].= "</div> ";

                // modalidad
                $output['data'].= "<div id='modalEdit' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='modalidad' id='modalidad'>";
                if ($modalidad === "0") 
                {
                    $output['data'].= "<option value='$modalidad'>Prepago</option>";
                }
                elseif ($modalidad === "1") 
                {
                    $output['data'].= "<option value='$modalidad'>Postpago</option>";
                }
                $output['data'].= "</select>";
                $output['data'].= "<label for='modalidad'>Modalidad</label>";
                $output['data'].= "</div> ";

                if ($modalidad == "1") 
                {
                    // plan requerido
                    $output['data'].= "<div id='planReEditM' class='form-floating mb-3'>";
                    $output['data'].= "<select class='form-select form-select-sm' name='plan' id='plan'>";
                    $output['data'].= "<option hidden value='$plan'>$plan</option>";  
                    if ($planesMov != null) 
                    {
                        foreach ($planesMov as $pr) 
                        {
                            $output['data'].= "<option value='$pr[0]'>$pr[0]</option>";
                        }
                    }
                    $output['data'].= " </select>";
                    $output['data'].= "<label for='plan'>Plan Requerido</label>";
                    $output['data'].= "</div> ";
                }

                // equipo
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

                if ($modalidad == "1") 
                {
                    //forma de pago
                    $output['data'].= "<div id='formaPgEditM' class='form-floating mb-3'>";
                    $output['data'].= "<select class='form-select form-select-sm' name='formaPago' id='formaPago'> <option hidden value='$formaPago'>$formaPago</option> <option value='Contado'>Contado</option>
                    <option value='Cuotas'>Cuotas</option></select>";
                    $output['data'].= "<label for='formaPago'>Forma de Pago</label>";            
                    $output['data'].= "</div>";
                }

                elseif ($modalidad == "0") 
                {
                    //forma de pago
                    $output['data'].= "<div id='formaPgEditM' class='form-floating mb-3'>";
                    $output['data'].= "<select class='form-select form-select-sm' name='formaPago' id='formaPago'> <option hidden value='$formaPago'>$formaPago</option> <option value='Contado'>Contado</option></select>";
                    $output['data'].= "<label for='formaPago'>Forma de Pago</label>";            
                    $output['data'].= "</div>";
                }
            }
            elseif ($tipo == "2") 
            {
                // telefono
                $output['data'].= "<div id='telefEdit' class='form-floating mb-3'>";
                $output['data'].= "<input class='form-control' type='tel' name='telefono' id='telefono' value='$telefono' maxlength=9 oninput="."this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');".">";
                $output['data'].= "<label for='telefono'>Telefono</label>";
                $output['data'].= "</div>";

                // linea procedente
                $output['data'].= "<div id='lineProceEdit' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='lineaProce' id='lineaProce'> <option hidden value='$lineaProce'>$lineaProce</option> <option value='Postpago'>Postpago</option>
                <option value='Prepago'>Prepago</option> </select>";
                $output['data'].= "<label for='lineaProce'>Linea Procedente</label>";
                $output['data'].= "</div> ";
    
                // modalidad
                $output['data'].= "<div id='modalEdit' class='form-floating mb-3'>";
                $output['data'].= "<select class='form-select form-select-sm' name='modalidad' id='modalidad'>";
                if ($modalidad === "0") 
                {
                    $output['data'].= "<option value='$modalidad'>Prepago</option>";
                }
                elseif ($modalidad === "1") 
                {
                    $output['data'].= "<option value='$modalidad'>Postpago</option>";
                }
                $output['data'].= "</select>";
                $output['data'].= "<label for='modalidad'>Modalidad</label>";
                $output['data'].= "</div> ";

                if ($modalidad == "1") 
                {
        
                    // plan requerido
                    $output['data'].= "<div id='planReEditM' class='form-floating mb-3'>";
                    $output['data'].= "<select class='form-select form-select-sm' name='plan' id='plan'>";
                    $output['data'].= "<option hidden value='$plan'>$plan</option>";  
                    if ($planesMov != null) 
                    {
                        foreach ($planesMov as $pr) 
                        {
                            $output['data'].= "<option value='$pr[0]'>$pr[0]</option>";
                        }
                    }
                    $output['data'].= " </select>";
                    $output['data'].= "<label for='plan'>Plan Requerido</label>";
                    $output['data'].= "</div> ";
                }
    
                // equipo
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
                
                if ($modalidad == "1") 
                {
                    //forma de pago
                    $output['data'].= "<div id='formaPgEditM' class='form-floating mb-3'>";
                    $output['data'].= "<select class='form-select form-select-sm' name='formaPago' id='formaPago'> <option hidden value='$formaPago'>$formaPago</option> <option value='Contado'>Contado</option>
                    <option value='Cuotas'>Cuotas</option></select>";
                    $output['data'].= "<label for='formaPago'>Forma de Pago</label>";            
                    $output['data'].= "</div>";
                }

                elseif ($modalidad == "0") 
                {
                    //forma de pago
                    $output['data'].= "<div id='formaPgEditM' class='form-floating mb-3'>";
                    $output['data'].= "<select class='form-select form-select-sm' name='formaPago' id='formaPago'> <option hidden value='$formaPago'>$formaPago</option> <option value='Contado'>Contado</option></select>";
                    $output['data'].= "<label for='formaPago'>Forma de Pago</label>";            
                    $output['data'].= "</div>";
                }
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