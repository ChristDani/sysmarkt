<?php
require_once '../../model/conexion.php';

$model=new conexion();
$con=$model->conectar();

// posicion de registro
$secSo = isset($_POST['codigo']) ? $_POST['codigo'] : '70756062';
$tipoUsuario = isset($_POST['tipoUser']) ? $_POST['tipoUser'] : null;


// llamamos al registro
$sql = "SELECT v.dniAsesor, u.nombre, v.dniCliente, c.nombre, v.estado, v.sec, v.origen, v.registro from ventas as v INNER JOIN usuarios as u INNER JOIN clientes as c on v.dniAsesor=u.dni and v.dniCliente=c.dni where v.sec='".$secSo."'";
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
    
    while ($fila=mysqli_fetch_array($resultado)) {

        // variables para la comparacion
        $movil = "1";
        $fija = "0";

        $dia= date('N', strtotime($fila['registro']));
        $numerodia= date('d', strtotime($fila['registro']));
        $mes= date('m', strtotime($fila['registro']));
        $año= date('Y', strtotime($fila['registro']));
        $hora= date('h:i:s A', strtotime($fila['registro']));

        // variables asignadas de la base de datos

        $sec = $fila['sec'];
        $asesor = $fila[1];
        $nombre = $fila[3];
        $dni = $fila['dniCliente'];
        $estado = $fila['estado'];
        $fecha = $diassemana[$dia-1].", ".$numerodia." de ".$meses[$mes-1]." del ".$año."<br>".$hora;
        
        // contador de productosa concretados
        $contarProductos="select * from detalleventas where sec='$sec'";
        $contarProductosCerrados="select * from detalleventas where sec='$sec' and estado = '1'";
        
        $resulcontarProductos=mysqli_query($con,$contarProductos);
        $resulcontarProductosCerrados=mysqli_query($con,$contarProductosCerrados);
        
        $totalcontarProductos = $resulcontarProductos->num_rows;
        $totalcontarProductosCerrados = $resulcontarProductosCerrados->num_rows;

        // $output['data'].= "<div class='row'>";

        if ($estado === "0") 
        {
            $output['data'].= "<div class='warning-bc d-flex justify-content-between mb-2 rounded-3'>";
            $output['data'].= "<h3 class='color'>Venta En Proceso</h3>";
            $output['data'].= "<h3 class='color'> $totalcontarProductosCerrados/$totalcontarProductos</h3>";
            $output['data'].= "</div>";
        }
        elseif ($estado === "1") 
        {
            $output['data'].= "<div class='secondary-bc d-flex justify-content-between mb-2 rounded-3 p-3'>";
            $output['data'].= "<h3 class='color'>Venta Cerrada</h3>";
            $output['data'].= "<h3 class='color'> $totalcontarProductosCerrados/$totalcontarProductos</h3>";
            $output['data'].= "</div>";

        }
        // $output['data'].= "</div> ";
        
        $output['data'].= "<div class='align-items-center d-flex'>";

        if ($tipoUsuario === "1" || $tipoUsuario === "2") 
        {
            // asesor
            $output['data'].= "<div class='col'><h3>Asesorada por $asesor</h3></div>";
        }            
        
        // dni
        $output['data'].= "<div class='col text-end'>";
        $output['data'].= "<p class='text-muted'>DNI del Cliente</p>";
        $output['data'].= "<h3>$dni</h3>";
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
        $output['data'].= "<h3 class='text-info'>$sec</h3>";
        $output['data'].= "</div> ";
        $output['data'].= "</div> ";

        $output['data'].= "</div> ";
        
        $output['data'].= "</div> ";

        // zona de productos

        $sqlpr = "SELECT CodDetalle, sec, telefonoRefencia, producto, promocion, tipo, telefonoOperacion, lineaProcedente, operadorCendente, modalidad, modoReno, plan, equipo, tipoFija, planFija, modoFija, formaPago, distrito, ubicacion, observaciones, estado, registro, actualizacion from detalleventas where sec='".$secSo."'";
        // para verificar errores en la consulta
        // echo $sqlpr;

        $resultpr=mysqli_query($con,$sqlpr);
        $resultprcontent=mysqli_query($con,$sqlpr);

        // para saber el numero de filas
        $fpr = $resultpr->num_rows;

        if ($fpr>0) {

            $i=1;
            $output['data'].= "<nav>";
            $output['data'].= "<div class='nav nav-tabs' id='nav-tab' role='tablist'>";
            while ($produc=mysqli_fetch_array($resultpr)) {
                if ($i == 1) {
                    $output['data'].= "<button class='nav-link color active' id='nav-home-tab' data-bs-toggle='tab' data-bs-target='#nav-home' type='button' role='tab' aria-controls='nav-home' aria-selected='true'>$i</button>";
                }else {
                    $output['data'].= "<button class='nav-link color' id='nav-profile-tab' data-bs-toggle='tab' data-bs-target='#nav-profile' type='button' role='tab' aria-controls='nav-profile' aria-selected='false'>$i</button>";
                }
                $i+=1;
            }
            $output['data'].= "</div>";
            $output['data'].= "</nav>";

            $a=1;
            $output['data'].= "<div class='tab-content' id='nav-tabContent'>";
            while ($produconten=mysqli_fetch_array($resultprcontent)) {
            
                $codigoDetalle = $produconten['CodDetalle'];
                $secdetalle = $produconten['sec'];
                $referencia = $produconten['telefonoRefencia'];
                $producto = $produconten['producto'];
                $promocion = $produconten['promocion'];
                $tipo = $produconten['tipo'];
                $telefono = $produconten['telefonoOperacion'];
                $lineaProcedente = $produconten['lineaProcedente'];
                $operadorCendente = $produconten['operadorCendente'];
                $modalidad = $produconten['modalidad'];
                $modoReno = $produconten['modoReno'];
                $plan = $produconten['plan'];
                $equipo = $produconten['equipo'];
                $tipoFija = $produconten['tipoFija'];
                $planFija = $produconten['planFija'];
                $modoFija = $produconten['modoFija'];
                $formaPago = $produconten['formaPago'];
                $distrito = $produconten['distrito'];
                $ubicacion = $produconten['ubicacion'];
                $observaciones = $produconten['observaciones'];
                $estado = $produconten['estado'];
                $registrodetalle = $produconten['registro'];
                $actualizaciondetalle = $produconten['actualizacion'];
    
                $diaprcnt= date('N', strtotime($produconten['actualizacion']));
                $numerodiaprcnt= date('d', strtotime($produconten['actualizacion']));
                $mesprcnt= date('m', strtotime($produconten['actualizacion']));
                $añoprcnt= date('Y', strtotime($produconten['actualizacion']));
                $horaprcnt= date('h:i:s A', strtotime($produconten['actualizacion']));
    
                $fechaactualizacion = $diassemana[$diaprcnt-1].", ".$numerodiaprcnt." de ".$meses[$mesprcnt-1]." del ".$añoprcnt."<br>".$horaprcnt;

                if ($a == 1) {
                    $output['data'].= "<div class='tab-pane fade show active' id='nav-home' role='tabpanel' aria-labelledby='nav-home-tab' tabindex='0'>";
                    $output['data'].= "primer producto";
                    $output['data'].= "</div>";
                }else {
                    $output['data'].= "<div class='tab-pane fade' id='nav-profile' role='tabpanel' aria-labelledby='nav-profile-tab' tabindex='0'>";
                    $output['data'].= "Segundo Producto";
                    $output['data'].= "</div>";
                }
                $a+=1;
            }
            $output['data'].= "</div>";
        }
        
        // $output['data'].= "<div class='row'>";

        // if ($estado === "0") 
        // {
        //     $output['data'].= "<div class='warning-bc d-flex justify-content-between mb-2 rounded-3'>";
        //     $output['data'].= "<h3 class='color'>Venta En Proceso</h3>";
        //     $output['data'].= "<h3 class='color'> $totalcontarProductosCerrados/$totalcontarProductos</h3>";
        //     $output['data'].= "</div>";
        // }
        // elseif ($estado === "1") 
        // {
        //     $output['data'].= "<div class='/*secondary-bc*/ d-flex justify-content-between mb-2 rounded-3'>";
        //     $output['data'].= "<h3 class='color'>Venta Cerrada</h3>";
        //     $output['data'].= "<h3 class='color'> $totalcontarProductosCerrados/$totalcontarProductos</h3>";
        //     $output['data'].= "</div>";

        // }
        // $output['data'].= "</div> ";
        // // dni
        // $output['data'].= "<p class='text-muted'>Documento de identidad</p>";
        // $output['data'].= "<h3>$dni</h3>";

        // $output['data'].= "</div> ";

//         $output['data'].= "<div class='col text-end'>";
        
//         // numero de referencia
//         $output['data'].= "<p class='text-muted'>Telefono referente</p>";
//         $output['data'].= "<h3>$telefonoRef</h3>";

//         $output['data'].= "</div> ";
        
//         $output['data'].= "</div> ";
        
//         $output['data'].= "<div class='row'>";
        
//         $output['data'].= "<div class='col'>";

//         // producto
//         $output['data'].= "<p class='text-muted'>Producto solicitado</p>";
//         if ($producto === "0") 
//         {
//             $output['data'].= "<h3>Fija</h3>";
//         }
//         elseif ($producto === "1") 
//         {
//             $output['data'].= "<h3>Movil</h3>";
//         }

//         $output['data'].= "</div> ";

//         $output['data'].= "<div class='col text-end'>";
        
//         // promocion
//         $output['data'].= "<p class='text-muted'>Promocion</p>";
//         $output['data'].= "<h3 id='promol'>$promocion</h3>";

//         $output['data'].= "</div> ";

//         $output['data'].= "</div> ";
        
        
//         if ($producto === $fija) 
//         {
//             $output['data'].= "<div class='row'>";
//             // tipo de fija
//             $output['data'].= "<div class='col'>";
//             $output['data'].= "<p class='text-muted'>Tipo de Linea</p>";
//             if ($tipoFija === "0") 
//             {
//                 $output['data'].= "<h3>Alta</h3>";
//             }
//             elseif ($tipoFija === "1") 
//             {
//                 $output['data'].= "<h3>Portabilidad</h3>";
//             }
//             $output['data'].= "</div> ";
            
            
//             if ($tipoFija === "1") 
//             {
//                 $output['data'].= "<div class='col text-end'>";
//                 // telefono
//                 $output['data'].= "<p class='text-muted'>Telefono</p>";
//                 $output['data'].= "<h3>$telefono</h3>";

//                 $output['data'].= "</div> ";
//             }        

//             $output['data'].= "</div> ";


//             $output['data'].= "<div class='row'>";
            
//             $output['data'].= "<div class='col'>";

//             // plan de fija
//             $output['data'].= "<p class='text-muted'>Plan</p>";
//             $output['data'].= "<h3>$planFija</h3>";

//             $output['data'].= "</div> ";
//             $output['data'].= "<div class='col-auto'>";
            
//             $output['data'].= "<p class='text-muted'>Modo</p>";
//             $output['data'].= "<h3>$modoFija</h3>";     //Modo Fija

//             $output['data'].= "</div> ";

//         } 
        
//         elseif ($producto === $movil) 
//         {
//             $output['data'].= "<div class='row'>";
            
//             // tipo
//             $output['data'].= "<div class='col'>";
            
//             $output['data'].= "<p class='text-muted'>Tipo de Linea</p>";
//             if ($tipo === "0") 
//             {
//                 $output['data'].= "<h3>Linea Nueva</h3>"; 
//             }
//             elseif ($tipo === "1") 
//             {
//                 $output['data'].= "<h3>Portabilidad</h3>"; 
//             }
//             elseif ($tipo === "2") 
//             {
//                 $output['data'].= "<h3>Renovación</h3>"; 
//             }

//             $output['data'].= "</div> ";
            
//             if ($tipo == "0") 
//             {
//                 // modalidad
//                 $output['data'].= "<div class='col text-end'>";
                
//                 $output['data'].= "<p class='text-muted'>Modalidad</p>";
//                 if ($modalidad === "0") 
//                 {
//                     $output['data'].= "<h3>Prepago</h3>";
//                 }
//                 elseif ($modalidad === "1") 
//                 {
//                     $output['data'].= "<h3>Postpago</h3>";
//                 }
                
//                 $output['data'].= "</div> ";
//                 $output['data'].= "</div> ";
//                 $output['data'].= "</div> ";
                
//                 $output['data'].= "<div class='row'>";            

//                 if ($modalidad == "1") 
//                 {
//                     $output['data'].= "<div class='col'>";            
//                     $output['data'].= "<p class='text-muted'>Plan Requerido</p>";
//                     $output['data'].= "<h3>$planR</h3>";     //Plan Requerido
//                     $output['data'].= "</div> ";
//                 }
                
//                 $output['data'].= "<div class='col-auto'>";            
//                 $output['data'].= "<p class='text-muted'>Equipo</p>";
//                 $output['data'].= "<h3>$equipo</h3>";     //Equipo
//                 $output['data'].= "</div> ";


//             }
//             elseif ($tipo == "1") 
//             {

//                 $output['data'].= "<div class='col text-center'>";            
//                 $output['data'].= "<p class='text-muted'>Telefono a portar</p>";
//                 $output['data'].= "<h3>$telefono</h3>";     //Telefono
//                 $output['data'].= "</div> ";
//                 $output['data'].= "<div class='col text-end'>";            
//                 $output['data'].= "<p class='text-muted'>Linea Procedente</p>";
//                 $output['data'].= "<h3>$lineaProce</h3>";     //Linea Procedente
//                 $output['data'].= "</div> ";
//                 $output['data'].= "</div> ";

                
//                 $output['data'].= "<div class='row'>";
//                 // operador cedente
//                 $output['data'].= "<div class='col'>";            
//                 $output['data'].= "<p class='text-muted'>Operador Cedente</p>";
//                 $output['data'].= "<h3>$operadorCed</h3>";     //Operador Cedente
//                 $output['data'].= "</div> ";                
//                 // modalidad
//                 $output['data'].= "<div class='col text-end'>";            
//                 $output['data'].= "<p class='text-muted'>Modalidad</p>";
//                 if ($modalidad === "0") 
//                 {
//                     $output['data'].= "<h3>Prepago</h3>";
//                 }
//                 elseif ($modalidad === "1") 
//                 {
//                     $output['data'].= "<h3>Postpago</h3>";
//                 }
//                 $output['data'].= "</div> ";
//                 $output['data'].= "</div> ";

//                 $output['data'].= "<div class='row'>";            
                
//                 if ($modalidad == "1") 
//                 {
//                     // plan requerido
//                     $output['data'].= "<div class='col'>";            
//                     $output['data'].= "<p class='text-muted'>Plan Requerido</p>";
//                     $output['data'].= "<h3>$planR</h3>";
//                     $output['data'].= "</div> ";
//                 }
                
//                 // equipo
//                 $output['data'].= "<div class='col-auto'>";            
//                 $output['data'].= "<p class='text-muted'>Equipo</p>";
//                 $output['data'].= "<h3>$equipo</h3>";    
//                 $output['data'].= "</div> ";


//             }
//             elseif ($tipo == "2") 
//             {
//                 // telefono
//                 $output['data'].= "<div class='col-auto text-center'>";            
//                 $output['data'].= "<p class='text-muted'>Telefono</p>";
//                 $output['data'].= "<h3>$telefono</h3>";
//                 $output['data'].= "</div> ";  
                
//                 // linea procedente
//                 $output['data'].= "<div class='col text-end'>";            
//                 $output['data'].= "<p class='text-muted'>Linea Procedente</p>";
//                 $output['data'].= "<h3>$lineaProce</h3>";
//                 $output['data'].= "</div> ";  
//                 $output['data'].= "</div> ";  
                
//                 $output['data'].= "<div class='row'>";            

//                 // modalidad
//                 $output['data'].= "<div class='col'>";            
//                 $output['data'].= "<p class='text-muted'>Modalidad</p>";
//                 if ($modalidad === "0") 
//                 {
//                     $output['data'].= "<h3>Prepago</h3>";
//                 }
//                 elseif ($modalidad === "1") 
//                 {
//                     $output['data'].= "<h3>Postpago</h3>";
//                 }
//                 $output['data'].= "</div> ";  

//                 if ($modalidad == "1") 
//                 {
//                     // plan requerido
//                     $output['data'].= "<div class='col text-end'>";            
//                     $output['data'].= "<p class='text-muted'>Plan</p>";
//                     $output['data'].= "<h3>$planR</h3>";
//                     $output['data'].= "</div> ";  
//                 }

//                 $output['data'].= "</div> ";  
//                 $output['data'].= "<div class='row'>";            
                
//                 // equipo
//                 $output['data'].= "<div class='col'>";            
//                 $output['data'].= "<p class='text-muted'>Equipo</p>";
//                 $output['data'].= "<h3>$equipo</h3>";
//                 $output['data'].= "</div> ";  


//             }
//         }
//         else 
//         {
//             $output['data'].= "<div class='form-floating mb-3'>";
//             $output['data'].= "<div class='col-xs-2'>";
//             $output['data'].= "<center><label><em>Elija un producto a vender, actualice y vuelva generar los detalles...</em></label></center>";
//             $output['data'].= "</div> ";
//             $output['data'].= "</div> ";
//         }        
        
//         $output['data'].= "<div class='col text-end'>";            
//         $output['data'].= "<p class='text-muted'>Forma de Pago</p>";
//         $output['data'].= "<h3>$formaPago</h3>";
//         $output['data'].= "</div> ";        
//         $output['data'].= "</div> ";

//         $output['data'].= "</div> ";         

//         $output['data'].= "<div class='row'>";            
        
//         // observaciones
//         $output['data'].= "<div class='col text-center'>";            
//         $output['data'].= "<div class='card'>";
//         $output['data'].= "<div class='card-body'>";        
//         $output['data'].= "<p class='text-muted'>Observaciones</p>";
//         $output['data'].= "<h3>$observaciones</h3>";
//         $output['data'].= "</div> ";
//         $output['data'].= "</div> "; 
//         $output['data'].= "</div> "; 

//         $output['data'].= "</div> ";          
//         $output['data'].= "<div class='row'>";            
//         // ubicacion
        
//         // distrito
//         $output['data'].= "<div class='col'>";            
//         $output['data'].= "<p class='text-muted'>Distrito</p>";
//         $output['data'].= "<h3>$distrito</h3>";
//         $output['data'].= "</div> ";  
        
        
//         $output['data'].= "<div class='col text-end'>";            
//         $output['data'].= "<p class='text-muted'>Ubicacion</p>";
//         $output['data'].= "<h3>$ubicacion</h3>";
//         $output['data'].= "</div> ";  

        // $output['data'].= "</div> ";  

        // fecha de registro
        $output['data'].= "<div class='col text-center'>";            
        $output['data'].= "<div class='card'>";
        $output['data'].= "<div class='card-body'>";        
        $output['data'].= "<p class='text-muted'>Fecha de Registro</p>"; 
        $output['data'].= "<h3>$fecha</h3>";
        $output['data'].= "</div> ";
        $output['data'].= "</div> ";
        $output['data'].= "</div> ";
    }
}


echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>