<?php
require_once '../../model/conexion.php';

$model=new conexion();
$con=$model->conectar();

// en el caso de solo querer determinadas columnas usar esto con el mismo nombre de las columnas...
$columnas=['dni', 'nombre', 'ubicacion', 'distrito', 'registro'];

// tabla a seleccionar
$tabla='clientes';

$buscar= isset($_POST['busqueda']) ? $_POST['busqueda'] : null;

// busqueda de datos
$where='';

if ($buscar!=null) {
    $where="where dni like '%$buscar%' or nombre like '%$buscar%'";
}

// limite de registros
$limite = isset($_POST['registros']) ? $_POST['registros'] : 12;
$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : 0;

if (!$pagina) {
    $inicio=0;
    $pagina=1;
}else {
    $inicio=($pagina-1) * $limite;
}

$sLimite = " limit $inicio,$limite";

//usamos las columnas o la consulta personalisada...
// $sql = "select $sLimite ".implode(", ", $columnas)." from $tabla $where";
// cantidad de registros devueltos en la consulta
$contar="select * from $tabla $where";

$sql = "select ".implode(", ", $columnas)." from $tabla $where order by nombre asc $sLimite";
// para verificar errores en la consulta
// echo "$sql<br>";


$resulContar=mysqli_query($con,$contar);

$resultado=mysqli_query($con,$sql);

// para saber el numero de filas
$totalContar = $resulContar->num_rows;

$filas = $resultado->num_rows;

$diassemana = array("Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$output=[];
$output['data']= '';
$output['paginacion']= '';

if ($filas>0) 
{    
    while ($fila=mysqli_fetch_array($resultado)) 
    {
        $dni = $fila['dni'];
        $nombre=$fila['nombre'];
        $ubicacion=$fila['ubicacion'];
        $distrito=$fila['distrito'];

        $dia= date('N', strtotime($fila['registro']));
        $numerodia= date('d', strtotime($fila['registro']));
        $mes= date('m', strtotime($fila['registro']));
        $año= date('Y', strtotime($fila['registro']));
        $fecha = $diassemana[$dia-1].", ".$numerodia." de ".$meses[$mes-1]." del ".$año;

        $output['data'].= "<div class='col-xl-3 col-md-6'>";
        $output['data'].= "<div class='card'>";
        $output['data'].= "<a href='#' type='button' data-bs-toggle='modal' data-bs-target='#DetallesClient' onclick=detallecliente('$dni');>";
        $output['data'].= "<div class='card-body'>";
        
        $output['data'].= "<div class='head d-flex justify-content-around'>";
        $output['data'].= "<p>$dni</p>";
        $output['data'].= "<p></p>";
        $output['data'].= "<p></p>";
        $output['data'].= "<p></p>";
        $output['data'].= "<p></p>";
        $output['data'].= "<p>$distrito</p>";
        $output['data'].= "</div>";
        $output['data'].= "<div class='body'>";
        $output['data'].= "<div class='row my-2'>";
        $output['data'].= "<h4 class='text-center'>$nombre</h4>";
        $output['data'].= "</div>";
        $output['data'].= "<div class='row text-center'>";
        $output['data'].= "<div class='col'>";
        $output['data'].= "<p>$ubicacion</p>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        $output['data'].= "<div class='row text-center' style='border-top: 1px solid #b9b9b9;'>";
        $output['data'].= "<p class='my-1 text-muted'>".$fecha."</p>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        $output['data'].= "</a>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
    }
} 
else 
{
    $output['data'].= "<div>";
    $output['data'].= "<h1 class='text-muted text-center my-5'>Sin Resultados...</h1>";
    $output['data'].= "</div>";
}

// paginacion
if ($totalContar===1) {
    $output['paginacion']= '';
} elseif ($totalContar>0) {
    $paginasTotal = ceil($totalContar / $limite);

    if ($paginasTotal==1) {
        $output['paginacion']= '';
    }else {
        
        // condiciones para mostrar las paginas
        $pagInicio = 1;
    
        if (($pagina - 3)>1) {
            $pagInicio = $pagina - 2;
        }
    
        $pagFinal = $pagInicio + 4;
    
        if ($pagFinal>$paginasTotal) {
            $pagFinal =  $paginasTotal;
        }
        
        $output['paginacion'] .= "<div class='btn-toolbar mb-3' role='toolbar'><div class='btn-group btn-group-sm' role='group'>";
        
        // activacion del boton anterior
        if ($pagina!=$pagInicio) 
        {
            $output['paginacion'] .= "<button type='button' onclick='getDataClientes(".$pagina-1 .");' class='btn rounded-5 mx-1 d-flex justify-content-center align-items-center'><ion-icon name='arrow-back-outline'></ion-icon></button>";
        }  
    
        // pagina inicial anclada
        if ($pagInicio>2) {
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataClientes(1);'>1</button>";
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 disabled'>...</button>";
        }
    
        // paginas dinamicas
        for ($i = $pagInicio; $i <= $pagFinal; $i++) {
            if ($pagina==$i) 
            {
                $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary rounded-5 mx-1 active'>$i</button>";
            }
            else 
            {
                $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataClientes($i);'>$i</button>";
            }
        }
    
        // pagina final anclada
        if ($pagFinal<($paginasTotal-1)) {
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 disabled'>...</button>";
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataClientes($paginasTotal);'>$paginasTotal</button>";
        }
    
        
        // activacion del boton siguiente
        
        if ($pagina!=$pagFinal) 
        {
            $output['paginacion'] .= "<button type='button' onclick='getDataClientes(".$pagina+1 .");' class='btn mx-1 d-flex justify-content-center rounded-5 align-items-center'><ion-icon name='arrow-forward-outline'></ion-icon></button>";
        }
        $output['paginacion'] .= "</div>";
    }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>