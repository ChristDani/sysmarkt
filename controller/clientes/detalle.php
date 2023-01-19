<?php
require_once '../../model/conexion.php';

$model=new conexion();
$con=$model->conectar();

// posicion de registro
$dnib = isset($_POST['dni']) ? $_POST['dni'] : null;
$tipoUsuario = isset($_POST['tipouser']) ? $_POST['tipouser'] : null;

// llamamos al registro
$sql = "SELECT dni, nombre, ubicacion, distrito, registro from clientes where dni='$dnib'";

$resultado=mysqli_query($con,$sql);

// para saber el numero de filas
$filas = $resultado->num_rows;

$diassemana = array("Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$output=[];
$output['data']= '';
$output['fecha']= '';

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

        $dni = $fila['dni'];
        $nombre = $fila['nombre'];
        $distrito = $fila['distrito'];
        $ubicacion = $fila['ubicacion'];
        $fecha = $diassemana[$dia-1].", ".$numerodia." de ".$meses[$mes-1]." del ".$año." ".$hora;
        
        $output['fecha']= $fecha;
        
        $output['data'].= "<div class='row m-0'>";          
        
        $output['data'].= "<div class='col text-center'>";  
        $output['data'].= "<div class='card'>";
        $output['data'].= "<div class='card-body'>";       
        $output['data'].= "<p class='text-muted'>DNI</p>";
        $output['data'].= "<h2>$dni</h2>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";

        $output['data'].= "<div class='col text-center'>";  
        $output['data'].= "<div class='card'>";
        $output['data'].= "<div class='card-body'>";     
        $output['data'].= "<p class='text-muted'>Distrito</p>";
        $output['data'].= "<h2>$distrito</h2>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        
        $output['data'].= "</div> ";


        $output['data'].= "<div class='row m-0 text-center'>";

        $output['data'].= "<div class='col'>";
        $output['data'].= "<div class='card'>";
        $output['data'].= "<div class='card-body'>";        
        $output['data'].= "<p class='text-muted'>Nombre</p>";
        $output['data'].= "<h3 class='text-info'>$nombre</h3>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        
        $output['data'].= "</div>";

        $output['data'].= "<div class='row text-center'>";

        $output['data'].= "<div class='col'>";
        $output['data'].= "<div class='card'>";
        $output['data'].= "<div class='card-body'>";        
        $output['data'].= "<p class='text-muted'>Ubicación</p>";
        $output['data'].= "<h3>$ubicacion</h3>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        
        $output['data'].= "</div>";

        if ($tipoUsuario == "1") 
        {
            $output['data'].= "<div class='row text-center'>";
            $output['data'].= "<div class='col text-center'>";
            $output['data'].= "<a href='#' class='btn color' onclick='abrirModalEditarventa($dni);' data-bs-target='#EditarVenta' data-bs-toggle='modal'>Editar Cliente</a>";
            $output['data'].= "</div>";
            $output['data'].= "</div>";
        }

        // zona de telefonos

        $sqlpr = "SELECT telefono, tipo, operador, tipoLinea from telefonos where dniCliente='$dnib'";
        // para verificar errores en la consulta
        // echo $sqlpr;

        $resultpr=mysqli_query($con,$sqlpr);
        $resultprcontent=mysqli_query($con,$sqlpr);

        // para saber el numero de filas
        $fpr = $resultpr->num_rows;

        if ($fpr>0) {

            $i=1;
            $output['data'].= "<nav>";
            $output['data'].= "<div class='nav nav-tabs mx-2' id='nav-tab' role='tablist'>";
            while ($produc=mysqli_fetch_array($resultpr)) {
                if ($i == 1) {
                    $output['data'].= "<button class='nav-link active' id='nav-prod-tab' data-bs-toggle='tab' data-bs-target='#nav-prod' type='button' role='tab' aria-controls='nav-prod' aria-selected='true'>$i</button>";
                }else {
                    $output['data'].= "<button class='nav-link' id='nav-prod$i-tab' data-bs-toggle='tab' data-bs-target='#nav-prod$i' type='button' role='tab' aria-controls='nav-prod$i' aria-selected='false'>$i</button>";
                }
                $i+=1;
            }
            $output['data'].= "</div>";
            $output['data'].= "</nav>";

            $a=1;
            $output['data'].= "<div class='tab-content mx-3' id='nav-tabContent'>";
            while ($produconten=mysqli_fetch_array($resultprcontent)) {
            
                $telefono = $produconten['telefono'];
                $tipo = $produconten['tipo'];
                $operador = $produconten['operador'];
                $tipoLinea = $produconten['tipoLinea'];

                if ($a == 1) {
                    $output['data'].= "<div class='tab-pane fade show active' id='nav-prod' role='tabpanel' aria-labelledby='nav-prod-tab' tabindex='0'>";
                }else {
                    $output['data'].= "<div class='tab-pane fade' id='nav-prod$a' role='tabpanel' aria-labelledby='nav-prod$a-tab' tabindex='0'>";
                }

                $output['data'].= "<div class='row m-0'>";

                $output['data'].= "<div class='col'>";
                $output['data'].= "<div class='card'>";
                $output['data'].= "<div class='card-body'>";        
                $output['data'].= "<p class='text-muted'>Telefono</p>";
                $output['data'].= "<h3>$telefono</h3>";
                $output['data'].= "</div>";
                $output['data'].= "</div>";
                $output['data'].= "</div>";
                
                if ($tipo === "0") 
                {
                    $output['data'].= "<div class='col'>";
                    $output['data'].= "<div class='card'>";
                    $output['data'].= "<div class='card-body'>";        
                    $output['data'].= "<p class='text-muted'>Tipo</p>";
                    $output['data'].= "<h3>Tel. Fijo</h3>";
                    $output['data'].= "</div>";
                    $output['data'].= "</div>";
                    $output['data'].= "</div>";
                }
                elseif ($tipo === "1") 
                {
                    $output['data'].= "<div class='col'>";
                    $output['data'].= "<div class='card'>";
                    $output['data'].= "<div class='card-body'>";        
                    $output['data'].= "<p class='text-muted'>Tipo</p>";
                    $output['data'].= "<h3>Tel. Movil</h3>";
                    $output['data'].= "</div>";
                    $output['data'].= "</div>";
                    $output['data'].= "</div>";
                }
                
                $output['data'].= "</div>";

                $output['data'].= "<div class='row'>";
                $output['data'].= "<div class='col'>";
                
                $output['data'].= "<div class='card'>";
                $output['data'].= "<div class='card-body'>";        
                $output['data'].= "<p class='text-muted'>Operador</p>";
                $output['data'].= "<h3>$operador</h3>";
                $output['data'].= "</div>";
                $output['data'].= "</div>";
                
                $output['data'].= "</div> ";
                
                if ($tipo === "1") 
                {
                    if ($tipoLinea === "0") 
                    {
                        $output['data'].= "<div class='col'>";
                        $output['data'].= "<div class='card'>";
                        $output['data'].= "<div class='card-body'>";        
                        $output['data'].= "<p class='text-muted'>Modalidad</p>";
                        $output['data'].= "<h3>Prepago</h3>";
                        $output['data'].= "</div>";
                        $output['data'].= "</div>";
                        $output['data'].= "</div> ";
                    }
                    elseif ($tipoLinea === "1") 
                    {
                        $output['data'].= "<div class='col'>";
                        $output['data'].= "<div class='card'>";
                        $output['data'].= "<div class='card-body'>";        
                        $output['data'].= "<p class='text-muted'>Modalidad</p>";
                        $output['data'].= "<h3>Postpago</h3>";
                        $output['data'].= "</div>";
                        $output['data'].= "</div>";
                        $output['data'].= "</div> ";
                    }
                }


                $output['data'].= "</div> ";

                if ($tipoUsuario == "1") 
                {
                    $output['data'].= "<div class='row m-0'>";
                    $output['data'].= "<a href='#' class='btn color' onclick='abrirModalEditar($telefono);' data-bs-target='#EditarVentas' data-bs-toggle='modal'>Editar Telefono</a>";
                    $output['data'].= "</div>";
                }

                $output['data'].= "</div>";
                $a+=1;
            }
            $output['data'].= "</div>";
        }
    }
}


echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>