<?php
require_once '../../model/conexion.php';
require_once '../../model/equipo.php';
require_once '../../model/usuarios.php';

$model=new conexion();
$con=$model->conectar();

// usuarios
$user = new user();
$listUser = $user->listar();

// productos
$produclist = new equipos;
$productsMov = $produclist->listar();

// en el caso de solo querer determinadas columnas usar esto con el mismo nombre de las columnas...
$columnas=['codigo','dniAsesor','nombre','dni','telefono','producto','lineaProcedente','operadorCedente','modalidad','tipo','planR','equipo','formaDePago','numeroReferencia','sec','tipoFija','planFija','modoFija','estado','observaciones','promocion','ubicacion','distrito','fechaRegistro','fechaActualizacion'];

// tabla a seleccionar
$tabla='whatsapp';

// posicion de registro
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '1';
$tipoU= isset($_POST['tipoUser']) ? $_POST['tipoUser'] : null;


// llamamos al registro
$sql = "select ".implode(", ", $columnas)." from $tabla where codigo='".$codigo."'";
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

        $codigo = $fila['codigo'];
        $asesor = $fila['dniAsesor'];
        $nombre = $fila['nombre'];
        $dni = $fila['dni'];
        $telefono = $fila['telefono'];
        $producto = $fila['producto'];
        $lineaProce = $fila['lineaProcedente'];
        $operadorCed = $fila['operadorCedente'];
        $modalidad = $fila['modalidad'];
        $tipo = $fila['tipo'];
        $planR = $fila['planR'];
        $equipo = $fila['equipo'];
        $formaPago = $fila['formaDePago'];
        $telefonoRef = $fila['numeroReferencia'];
        $sec = $fila['sec'];
        $tipoFija = $fila['tipoFija'];
        $planFija = $fila['planFija'];
        $modoFija = $fila['modoFija'];
        $estado = $fila['estado'];
        $observaciones = $fila['observaciones'];
        $promocion = $fila['promocion'];
        $ubicacion = $fila['ubicacion'];
        $distrito = $fila['distrito'];

    
        $output['data'].= "<div class='form-floating mb-3 d-none'>";
        $output['data'].= "<input class='form-control' type='text' name='codigo' id='codigo' value='$codigo'>";
        $output['data'].= "<label for='codigo'>Código de Venta</label>";
        $output['data'].= "</div> ";


        $output['data'].= "<div class='row'>";

        
        if ($tipoU === "1" || $tipoU === "2") 
        {
            $output['data'].= "<div class='col-lg-4'>";
            $output['data'].= "<div id='asesorEdit' class='form-floating mb-3'>";
            $output['data'].= "<select class='form-select form-select-sm' name='asesor' id='asesor'>";
            if ($listUser != null) 
            {
                foreach ($listUser as $x) 
                {
                    if ($x[0] === $asesor)
                    {
                        $output['data'] .= "<option selected hidden value='".$x[0]."'>".$x[1]."</option>";
                    }
                    elseif ($x[0] != $asesor && $x[3] === "0")
                    {
                        $output['data'] .= "<option value='".$x[0]."'>".$x[1]."</option>";
                    }
                }
            }
            
            $output['data'] .= "</select>";
            $output['data'] .= "<label for='asesor'>Asesor</label>";
            $output['data'] .= "</div> ";
            $output['data'] .= "</div> ";

        }
        elseif ($tipoU === "0") 
        {
            if ($listUser != null) 
            {
                foreach ($listUser as $x) 
                {
                    if ($x[0] === $asesor)
                    {
                        $output['data'].= "<div class='col-lg-4 d-none'>";
                        $output['data'].= "<input type='text' name='asesor' id='asesor' value='".$x[0]."'>";
                        $output['data'] .= "</div> ";
                    }
                }
            }
        }

        $output['data'].= "<div class='col-lg-4'>";
        
        // nombre
        $output['data'].= "<div class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control nombrearr' type='text' name='nombre' id='nombre' value='$nombre'>";
        $output['data'].= "<label for='nombre'>Nombre</label>";
        $output['data'].= "</div> ";

        $output['data'].= "</div> ";

        $output['data'].= "<div class='col-lg-4'>";

        // estado
        $output['data'].= "<div id='estadoEditM' class='form-floating mb-3'>";
        $output['data'] .= "<select class='form-select form-select-sm' name='estado' id='estado'>";
        if ($estado === "0") 
        {
            $output['data'].= "<option hidden value='$estado'>No Requiere</option>";
        }
        elseif ($estado === "1") 
        {
            $output['data'].= "<option hidden value='$estado'>Concretado</option>";
        }
        elseif ($estado === "2") 
        {
            $output['data'].= "<option hidden value='$estado'>Pendiente</option>";
        }
        $output['data'] .= "<option value='2'>Pendiente</option>
        <option value='1'>Concretado</option>
        <option value='0'>No Requiere</option> </select>";
        $output['data'].= "<label for='estado'>Estado</label>";            
        $output['data'].= "</div>"; 
        $output['data'] .= "</div> ";

        $output['data'] .= "</div> ";
        
        $output['data'].= "<div class='row'>";

        $output['data'].= "<div class='col-lg-6'>";
        $output['data'].= "<div class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control dniarr' type='text' name='dni' id='dni' value='$dni' onkeyup='arreglarnombreeditar();'>";
        $output['data'].= "<label for='dni'>DNI</label>";
        $output['data'].= "</div> ";        
        $output['data'] .= "</div> ";

        $output['data'].= "<div class='col-lg-6'>";
        // numero de referencia
        $output['data'].= "<div id='telefRefEditM' class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control' type='tel' name='telefonoRef' id='telefonoRef' value='$telefonoRef' maxlength=11 oninput="."this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');".">";
        $output['data'].= "<label for='telefonoRef'>Número de Referencia</label>";
        $output['data'].= "</div>";

        $output['data'] .= "</div> ";        

        $output['data'] .= "</div> ";   

        
        // producto
        $output['data'].= "<div id='producEdit' class='form-floating mb-3'>";
        $output['data'].= "<select class='form-select form-select-sm' name='producto' id='producto'>";
        if ($producto === "0") 
        {
            $output['data'].= "<option value='$producto'>Fija</option>";
        }
        elseif ($producto === "1") 
        {
            $output['data'].= "<option value='$producto'>Movil</option>";
        }
        $output['data'].= "</select>";
        $output['data'].= "<label for='producto'>Producto</label>";
        $output['data'].= "</div> ";
        
        if ($producto === $fija) 
        {

            // promocion
            $output['data'].= "<div id='promocionEdit' class='form-floating mb-3'>";
            $output['data'].= "<select class='form-select form-select-sm' name='promocion' id='promocion'> <option hidden value='$promocion'>$promocion</option>
            <option value='50% de Descuento en Planes Fija'>50% de Descuento en Planes Fija</option> </select>";
            $output['data'].= "<label for='promocion'>Promoción</label>";
            $output['data'].= "</div> ";

            // tipo de fija
            $output['data'].= "<div id='typeFijaEdit' class='form-floating mb-3'>";
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

            if ($tipoFija === "1") 
            {
                // telefono
                $output['data'].= "<div id='telefFijaEdit' class='form-floating mb-3'>";
                $output['data'].= "<input class='form-control' type='tel' name='telefono' id='telefono' value='$telefono' maxlength=9 oninput="."this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');".">";
                $output['data'].= "<label for='telefono'>Telefono</label>";
                $output['data'].= "</div>";
            }

            // plan de fija
            $output['data'].= "<div id='planFijaEditM' class='form-floating mb-3'>";
            $output['data'].= "<select class='form-select form-select-sm' name='planFija' id='planFija'> <option hidden value='$planFija'>$planFija</option> <option value='1 Play - Telefonia'>1 Play - Telefonia</option>
            <option value='1 Play - Television'>1 Play - Television</option>
            <option value='1 Play - Internet'>1 Play - Internet</option>
            <option value='2 Play - Telefonia + Internet'>2 Play - Telefonia + Internet</option>
            <option value='2 Play - Internet + Cable Avanzado'>2 Play - Internet + Cable Avanzado</option>
            <option value='2 Play - Internet + Cable Superior'>2 Play - Internet + Cable Superior</option>
            <option value='3 Play - Telefonia + Internet + Cable Avanzado'>3 Play - Telefonia + Internet + Cable Avanzado</option>
            <option value='3 Play - Telefonia + Internet + Cable Superior'>3 Play - Telefonia + Internet + Cable Superior</option> </select>";
            $output['data'].= "<label for='planFija'>Plan</label>"; 
            $output['data'].= "</div> ";

            // modo de fija
            $output['data'].= "<div id='planFijaEditM' class='form-floating mb-3'>";
            $output['data'].= "<select class='form-select form-select-sm' name='modoFija' id='modoFija'> <option hidden value='$modoFija'>$modoFija</option> <option value='HFC'>HFC</option>
            <option value='FTTH'>FTTH</option>
            <option value='IFI'>IFI</option></select>";
            $output['data'].= "<label for='modoFija'>Modo de Fija</label>"; 
            $output['data'].= "</div> ";

            // forma de pago
            $output['data'].= "<div id='formaPgEdit' class='form-floating mb-3'>";
            $output['data'].= "<select class='form-select form-select-sm' name='formaPago' id='formaPago'> <option hidden value='$formaPago'>$formaPago</option> <option value='Contado'>Contado</option></select>";
            $output['data'].= "<label for='formaPago'>Forma de Pago</label>";            
            $output['data'].= "</div>";
        } 
        elseif ($producto === $movil) 
        {

            // promocion
            $output['data'].= "<div id='promocionEdit' class='form-floating mb-3'>";
            $output['data'].= "<select class='form-select form-select-sm' name='promocion' id='promocion'> <option hidden value='$promocion'>$promocion</option> <option value='50% de Descuento con Lineas Adicionales'>50% de Descuento con Lineas Adicionales</option> <option value='20% de Descuento en Portabilidad Movil'>20% de Descuento en Portabilidad Movil</option> </select>";
            $output['data'].= "<label for='promocion'>Promoción</label>";
            $output['data'].= "</div> ";

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
                    $output['data'].= "<select class='form-select form-select-sm' name='plan' id='plan'> <option hidden value='$planR'>$planR</option> <option value='S/ 29.90 MAX'>S/ 29.90 MAX</option> 
                    <option value='S/ 39.90'>S/ 39.90</option>
                    <option value='S/ 49.90'>S/ 49.90</option>
                    <option value='S/ 55.90'>S/ 55.90</option>
                    <option value='S/ 69.90 MAX ILIMITADO'>S/ 69.90 MAX ILIMITADO</option>
                    <option value='S/ 79.90 MAX ILIMITADO'>S/ 79.90 MAX ILIMITADO</option>
                    <option value='S/ 95.90 MAX ILIMITADO'>S/ 95.90 MAX ILIMITADO</option>
                    <option value='S/ 109.90 MAX ILIMITADO'>S/ 109.90 MAX ILIMITADO</option>
                    <option value='S/ 159.90 MAX ILIMITADO'>S/ 159.90 MAX ILIMITADO</option>
                    <option value='S/ 189.90 MAX ILIMITADO'>S/ 189.90 MAX ILIMITADO</option>
                    <option value='S/ 289.90 MAX ILIMITADO'>S/ 289.90 MAX ILIMITADO</option>
                    <option value='S/ 95.00 MAX PLAY - NETFLIX'>S/ 95.00 MAX PLAY - NETFLIX</option>
                    <option value='S/ 115.00 MAX PLAY - NETFLIX'>S/ 115.00 MAX PLAY - NETFLIX</option>
                    <option value='S/ 145.00 MAX PLAY - NETFLIX'>S/ 145.00 MAX PLAY - NETFLIX</option> </select> </span>";
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
                    $output['data'].= "<select class='form-select form-select-sm' name='plan' id='plan'> <option hidden value='$planR'>$planR</option> <option value='S/ 29.90 MAX'>S/ 29.90 MAX</option> 
                    <option value='S/ 39.90'>S/ 39.90</option>
                    <option value='S/ 49.90'>S/ 49.90</option>
                    <option value='S/ 55.90'>S/ 55.90</option>
                    <option value='S/ 69.90 MAX ILIMITADO'>S/ 69.90 MAX ILIMITADO</option>
                    <option value='S/ 79.90 MAX ILIMITADO'>S/ 79.90 MAX ILIMITADO</option>
                    <option value='S/ 95.90 MAX ILIMITADO'>S/ 95.90 MAX ILIMITADO</option>
                    <option value='S/ 109.90 MAX ILIMITADO'>S/ 109.90 MAX ILIMITADO</option>
                    <option value='S/ 159.90 MAX ILIMITADO'>S/ 159.90 MAX ILIMITADO</option>
                    <option value='S/ 189.90 MAX ILIMITADO'>S/ 189.90 MAX ILIMITADO</option>
                    <option value='S/ 289.90 MAX ILIMITADO'>S/ 289.90 MAX ILIMITADO</option>
                    <option value='S/ 95.00 MAX PLAY - NETFLIX'>S/ 95.00 MAX PLAY - NETFLIX</option>
                    <option value='S/ 115.00 MAX PLAY - NETFLIX'>S/ 115.00 MAX PLAY - NETFLIX</option>
                    <option value='S/ 145.00 MAX PLAY - NETFLIX'>S/ 145.00 MAX PLAY - NETFLIX</option> </select> </span>";
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
                    $output['data'].= "<select class='form-select form-select-sm' name='plan' id='plan'> <option hidden value='$planR'>$planR</option> <option value='S/ 29.90 MAX'>S/ 29.90 MAX</option> 
                    <option value='S/ 39.90'>S/ 39.90</option>
                    <option value='S/ 49.90'>S/ 49.90</option>
                    <option value='S/ 55.90'>S/ 55.90</option>
                    <option value='S/ 69.90 MAX ILIMITADO'>S/ 69.90 MAX ILIMITADO</option>
                    <option value='S/ 79.90 MAX ILIMITADO'>S/ 79.90 MAX ILIMITADO</option>
                    <option value='S/ 95.90 MAX ILIMITADO'>S/ 95.90 MAX ILIMITADO</option>
                    <option value='S/ 109.90 MAX ILIMITADO'>S/ 109.90 MAX ILIMITADO</option>
                    <option value='S/ 159.90 MAX ILIMITADO'>S/ 159.90 MAX ILIMITADO</option>
                    <option value='S/ 189.90 MAX ILIMITADO'>S/ 189.90 MAX ILIMITADO</option>
                    <option value='S/ 289.90 MAX ILIMITADO'>S/ 289.90 MAX ILIMITADO</option>
                    <option value='S/ 95.00 MAX PLAY - NETFLIX'>S/ 95.00 MAX PLAY - NETFLIX</option>
                    <option value='S/ 115.00 MAX PLAY - NETFLIX'>S/ 115.00 MAX PLAY - NETFLIX</option>
                    <option value='S/ 145.00 MAX PLAY - NETFLIX'>S/ 145.00 MAX PLAY - NETFLIX</option> </select> </span>";
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
        else 
        {
            $output['data'].= "<div class='form-floating mb-3'>";
            $output['data'].= "<div class='col-xs-2'>";
            $output['data'].= "<center><label><em>Elija un producto a vender, actualice y vuelva generar los detalles...</em></label></center>";
            $output['data'].= "</div> ";
            $output['data'].= "</div> ";
        }

        // sec
        $output['data'].= "<div id='secEditM' class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control' maxlength=15 type='text' name='sec' id='sec' value='$sec'>";
        $output['data'].= "<label for='sec'>SEC</label>";
        $output['data'].= "</div>";


        // observaciones
        $output['data'].= "<div id='obsEditM' class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control' maxlength=15 type='text' name='observaciones' id='observaciones' value='$observaciones'>";
        $output['data'].= "<label for='observaciones'>Observaciones</label>";
        $output['data'].= "</div>";

        // ubicacion
        $output['data'].= "<div id='ubiEditM' class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control' maxlength=15 type='text' name='ubicacion' id='ubicacion' value='$ubicacion'>";
        $output['data'].= "<label for='ubicacion'>Ubicacion</label>";
        $output['data'].= "</div>";

        // distrito
        $output['data'].= "<div id='disEditM' class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control' maxlength=15 type='text' name='distrito' id='distrito' value='$distrito'>";
        $output['data'].= "<label for='distrito'>Distrito</label>";
        $output['data'].= "</div>";
    }
}


echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>