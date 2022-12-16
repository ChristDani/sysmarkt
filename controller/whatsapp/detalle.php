<?php
require_once '../../model/conexion.php';

$model=new conexion();
$con=$model->conectar();

// en el caso de solo querer determinadas columnas usar esto con el mismo nombre de las columnas...
$columnas=['w.codigo','u.nombre','w.nombre','w.dni','w.telefono','w.producto','w.lineaProcedente','w.operadorCedente','w.modalidad','w.tipo','w.planR','w.equipo','w.formaDePago','w.numeroReferencia','w.sec','w.tipoFija','w.planFija','w.modoFija','w.estado','observaciones','w.promocion','w.ubicacion','w.distrito','w.fechaRegistro','w.fechaActualizacion'];

// tabla a seleccionar
$tabla='whatsapp as w inner join usuarios as u on w.dniAsesor=u.dni';

// posicion de registro
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;
$tipoUsuario = isset($_POST['tipoUser']) ? $_POST['tipoUser'] : null;


// llamamos al registro
$sql = "select ".implode(", ", $columnas)." from $tabla where w.codigo='".$codigo."'";
// para verificar errores en la consulta
// echo $sql;


$resultado=mysqli_query($con,$sql);

// para saber el numero de filas
$filas = $resultado->num_rows;

$diassemana = array("Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$output=[];
$output['data']= '';

if ($filas>0) {
    $i=1;
    while ($fila=mysqli_fetch_array($resultado)) {

        // variables para la comparacion
        $movil = "1";
        $fija = "0";

        $dia= date('N', strtotime($fila['fechaRegistro']));
        $numerodia= date('d', strtotime($fila['fechaRegistro']));
        $mes= date('m', strtotime($fila['fechaRegistro']));
        $año= date('Y', strtotime($fila['fechaRegistro']));
        $hora= date('h:i:s A', strtotime($fila['fechaRegistro']));

        $dia2= date('N', strtotime($fila['fechaActualizacion']));
        $numerodia2= date('d', strtotime($fila['fechaActualizacion']));
        $mes2= date('m', strtotime($fila['fechaActualizacion']));
        $año2= date('Y', strtotime($fila['fechaActualizacion']));
        $hora2= date('h:i:s A', strtotime($fila['fechaActualizacion']));

        // variables asignadas de la base de datos

        $codigo = $fila['codigo'];
        $asesor = $fila[1];
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
        $fecha = $diassemana[$dia-1].", ".$numerodia." de ".$meses[$mes-1]." del ".$año."<br>".$hora;
        $fechaUdp = $diassemana[$dia2-1].", ".$numerodia2." de ".$meses[$mes2-1]." del ".$año2."<br>".$hora2;
        
        $output['data'].= "<div class='row'>";

        if ($tipoUsuario === "1" || $tipoUsuario === "2") 
        {
            // asesor
            $output['data'].= "<div class='col'><h3>Venta de $asesor</h3></div>";
        }            
        
        // estado
        $output['data'].= "<div class='col text-end'>";
            if ($estado === "0") 
            {
                $output['data'].= "<h3 class='danger'>No requiere<h3>";
            }
            elseif ($estado === "1") 
            {
                $output['data'].= "<h3 class='success'>Concretado<h3>";

            }
            elseif ($estado === "2") 
            {
                $output['data'].= "<h3 class='warning'>Pendiente<h3>";
            }

        $output['data'].= "</div> ";
        $output['data'].= "</div> ";

        
        $output['data'].= "<div class='row align-items-start'>";
        
        $output['data'].= "<div class='col'>";     
            
        $output['data'].= "<p class='text-muted'>Nombre</p>";   //Nombre
        $output['data'].= "<h1>$nombre</h1>";

        $output['data'].= "</div> ";

        $output['data'].= "<div class='col-auto'>";

        $output['data'].= "<div class='card'>";
        $output['data'].= "<div class='card-body'>";        
        $output['data'].= "<p class='text-muted'>SEC</p>";  //Sec
        $output['data'].= "<h3>$sec</h3>";
        $output['data'].= "</div> ";
        $output['data'].= "</div> ";

        $output['data'].= "</div> ";
        
        $output['data'].= "</div> ";
        
        $output['data'].= "<div class='row'>";

        $output['data'].= "<div class='col'>";
        
        // dni
        $output['data'].= "<p class='text-muted'>Documento de identidad</p>";
        $output['data'].= "<h3>$dni</h3>";

        $output['data'].= "</div> ";

        $output['data'].= "<div class='col text-end'>";
        
        // numero de referencia
        $output['data'].= "<p class='text-muted'>Telefono referente</p>";
        $output['data'].= "<h3>$telefonoRef</h3>";

        $output['data'].= "</div> ";
        
        $output['data'].= "</div> ";
        
        $output['data'].= "<div class='row'>";
        
        $output['data'].= "<div class='col'>";

        // producto
        $output['data'].= "<p class='text-muted'>Producto solicitado</p>";
        if ($producto === "0") 
        {
            $output['data'].= "<h3>Fija</h3>";
        }
        elseif ($producto === "1") 
        {
            $output['data'].= "<h3>Movil</h3>";
        }

        $output['data'].= "</div> ";

        $output['data'].= "<div class='col text-end'>";
        
        // promocion
        $output['data'].= "<p class='text-muted'>Promocion</p>";
        $output['data'].= "<h3 id='promol'>$promocion</h3>";

        $output['data'].= "</div> ";

        $output['data'].= "</div> ";
        
        
        if ($producto === $fija) 
        {
            $output['data'].= "<div class='row'>";
            // tipo de fija
            $output['data'].= "<div class='col'>";
            $output['data'].= "<p class='text-muted'>Tipo de Linea</p>";
            if ($tipoFija === "0") 
            {
                $output['data'].= "<h3>Alta</h3>";
            }
            elseif ($tipoFija === "1") 
            {
                $output['data'].= "<h3>Portabilidad</h3>";
            }
            $output['data'].= "</div> ";
            
            
            if ($tipoFija === "1") 
            {
                $output['data'].= "<div class='col text-end'>";
                // telefono
                $output['data'].= "<p class='text-muted'>Telefono</p>";
                $output['data'].= "<h3>$telefono</h3>";

                $output['data'].= "</div> ";
            }        

            $output['data'].= "</div> ";


            $output['data'].= "<div class='row'>";
            
            $output['data'].= "<div class='col'>";

            // plan de fija
            $output['data'].= "<p class='text-muted'>Plan</p>";
            $output['data'].= "<h3>$planFija</h3>";

            $output['data'].= "</div> ";
            $output['data'].= "<div class='col-auto'>";
            
            $output['data'].= "<p class='text-muted'>Modo</p>";
            $output['data'].= "<h3>$modoFija</h3>";     //Modo Fija

            $output['data'].= "</div> ";

        } 
        
        elseif ($producto === $movil) 
        {
            $output['data'].= "<div class='row'>";
            
            // tipo
            $output['data'].= "<div class='col'>";
            
            $output['data'].= "<p class='text-muted'>Tipo de Linea</p>";
            if ($tipo === "0") 
            {
                $output['data'].= "<h3>Linea Nueva</h3>"; 
            }
            elseif ($tipo === "1") 
            {
                $output['data'].= "<h3>Portabilidad</h3>"; 
            }
            elseif ($tipo === "2") 
            {
                $output['data'].= "<h3>Renovación</h3>"; 
            }

            $output['data'].= "</div> ";
            
            if ($tipo == "0") 
            {
                // modalidad
                $output['data'].= "<div class='col text-end'>";
                
                $output['data'].= "<p class='text-muted'>Modalidad</p>";
                if ($modalidad === "0") 
                {
                    $output['data'].= "<h3>Prepago</h3>";
                }
                elseif ($modalidad === "1") 
                {
                    $output['data'].= "<h3>Postpago</h3>";
                }
                
                $output['data'].= "</div> ";
                $output['data'].= "</div> ";
                $output['data'].= "</div> ";
                
                $output['data'].= "<div class='row'>";            

                if ($modalidad == "1") 
                {
                    $output['data'].= "<div class='col'>";            
                    $output['data'].= "<p class='text-muted'>Plan Requerido</p>";
                    $output['data'].= "<h3>$planR</h3>";     //Plan Requerido
                    $output['data'].= "</div> ";
                }
                
                $output['data'].= "<div class='col-auto'>";            
                $output['data'].= "<p class='text-muted'>Equipo</p>";
                $output['data'].= "<h3>$equipo</h3>";     //Equipo
                $output['data'].= "</div> ";


            }
            elseif ($tipo == "1") 
            {

                $output['data'].= "<div class='col text-center'>";            
                $output['data'].= "<p class='text-muted'>Telefono a portar</p>";
                $output['data'].= "<h3>$telefono</h3>";     //Telefono
                $output['data'].= "</div> ";
                $output['data'].= "<div class='col text-end'>";            
                $output['data'].= "<p class='text-muted'>Linea Procedente</p>";
                $output['data'].= "<h3>$lineaProce</h3>";     //Linea Procedente
                $output['data'].= "</div> ";
                $output['data'].= "</div> ";

                
                $output['data'].= "<div class='row'>";
                // operador cedente
                $output['data'].= "<div class='col'>";            
                $output['data'].= "<p class='text-muted'>Operador Cedente</p>";
                $output['data'].= "<h3>$operadorCed</h3>";     //Operador Cedente
                $output['data'].= "</div> ";                
                // modalidad
                $output['data'].= "<div class='col text-end'>";            
                $output['data'].= "<p class='text-muted'>Modalidad</p>";
                if ($modalidad === "0") 
                {
                    $output['data'].= "<h3>Prepago</h3>";
                }
                elseif ($modalidad === "1") 
                {
                    $output['data'].= "<h3>Postpago</h3>";
                }
                $output['data'].= "</div> ";
                $output['data'].= "</div> ";

                $output['data'].= "<div class='row'>";            
                
                if ($modalidad == "1") 
                {
                    // plan requerido
                    $output['data'].= "<div class='col'>";            
                    $output['data'].= "<p class='text-muted'>Plan Requerido</p>";
                    $output['data'].= "<h3>$planR</h3>";
                    $output['data'].= "</div> ";
                }
                
                // equipo
                $output['data'].= "<div class='col-auto'>";            
                $output['data'].= "<p class='text-muted'>Equipo</p>";
                $output['data'].= "<h3>$equipo</h3>";    
                $output['data'].= "</div> ";


            }
            elseif ($tipo == "2") 
            {
                // telefono
                $output['data'].= "<div class='col-auto text-center'>";            
                $output['data'].= "<p class='text-muted'>Telefono</p>";
                $output['data'].= "<h3>$telefono</h3>";
                $output['data'].= "</div> ";  
                
                // linea procedente
                $output['data'].= "<div class='col text-end'>";            
                $output['data'].= "<p class='text-muted'>Linea Procedente</p>";
                $output['data'].= "<h3>$lineaProce</h3>";
                $output['data'].= "</div> ";  
                $output['data'].= "</div> ";  
                
                $output['data'].= "<div class='row'>";            

                // modalidad
                $output['data'].= "<div class='col'>";            
                $output['data'].= "<p class='text-muted'>Modalidad</p>";
                if ($modalidad === "0") 
                {
                    $output['data'].= "<h3>Prepago</h3>";
                }
                elseif ($modalidad === "1") 
                {
                    $output['data'].= "<h3>Postpago</h3>";
                }
                $output['data'].= "</div> ";  

                if ($modalidad == "1") 
                {
                    // plan requerido
                    $output['data'].= "<div class='col text-end'>";            
                    $output['data'].= "<p class='text-muted'>Plan</p>";
                    $output['data'].= "<h3>$planR</h3>";
                    $output['data'].= "</div> ";  
                }

                $output['data'].= "</div> ";  
                $output['data'].= "<div class='row'>";            
                
                // equipo
                $output['data'].= "<div class='col'>";            
                $output['data'].= "<p class='text-muted'>Equipo</p>";
                $output['data'].= "<h3>$equipo</h3>";
                $output['data'].= "</div> ";  


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
        
        $output['data'].= "<div class='col text-end'>";            
        $output['data'].= "<p class='text-muted'>Forma de Pago</p>";
        $output['data'].= "<h3>$formaPago</h3>";
        $output['data'].= "</div> ";        
        $output['data'].= "</div> ";

        $output['data'].= "</div> ";         

        $output['data'].= "<div class='row'>";            
        
        // observaciones
        $output['data'].= "<div class='col text-center'>";            
        $output['data'].= "<div class='card'>";
        $output['data'].= "<div class='card-body'>";        
        $output['data'].= "<p class='text-muted'>Observaciones</p>";
        $output['data'].= "<h3>$observaciones</h3>";
        $output['data'].= "</div> ";
        $output['data'].= "</div> "; 
        $output['data'].= "</div> "; 

        $output['data'].= "</div> ";          
        $output['data'].= "<div class='row'>";            
        // ubicacion
        
        // distrito
        $output['data'].= "<div class='col'>";            
        $output['data'].= "<p class='text-muted'>Distrito</p>";
        $output['data'].= "<h3>$distrito</h3>";
        $output['data'].= "</div> ";  
        
        
        $output['data'].= "<div class='col text-end'>";            
        $output['data'].= "<p class='text-muted'>Ubicacion</p>";
        $output['data'].= "<h3>$ubicacion</h3>";
        $output['data'].= "</div> ";  

        $output['data'].= "</div> ";  

        // fecha de registro
        $output['data'].= "<div class='col text-center'>";            
        $output['data'].= "<div class='card'>";
        $output['data'].= "<div class='card-body'>";        
        $output['data'].= "<p class='text-muted'>Fecha de Registro</p>";  //Sec
        $output['data'].= "<h3>$fecha</h3>";
        $output['data'].= "</div> ";
        $output['data'].= "</div> ";
        $output['data'].= "</div> ";

        
        if ($fila['fechaRegistro'] != $fila['fechaActualizacion']) 
        {
            // fecha de actualizacion
            $output['data'].= "<div class='col text-center'>";
            $output['data'].= "<div class='card'>";
            $output['data'].= "<div class='card-body'>";        
            $output['data'].= "<p class='text-muted'>Última Actualización</p>";
            $output['data'].= "<h3>$fechaUdp</h3>";
            $output['data'].= "</div> ";
            $output['data'].= "</div> ";
            $output['data'].= "</div> ";
        }
        $output['data'].= "</div>";
    }
}


echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>