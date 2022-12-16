<?php
require_once '../../model/conexion.php';

$model=new conexion();
$con=$model->conectar();

// en el caso de solo querer determinadas columnas usar esto con el mismo nombre de las columnas...
$columnas=['documento',	'telefono',	'planes',	'fechaRegistro', 'estado'];

// tabla a seleccionar
$tabla='landing';

// $buscar=isset($_POST['busqueda']) ? $con->mssql_escape($_POST['busqueda']) : null;
$buscar= isset($_POST['busqueda']) ? $_POST['busqueda'] : null;

// busqueda de datos
$where='';

if ($buscar!=null) {
    // $buscar='jorge';
    $where="where (";
    $cont= count($columnas);
    for ($i=0; $i < $cont; $i++) { 
        $where.=$columnas[$i]." like '%".$buscar."%' or ";
    }
    $where=substr_replace($where, "", -3);
    $where.=")";
}

// limite de registros
$limite = isset($_POST['registros']) ? $_POST['registros'] : 10;
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

$sql = "select ".implode(", ", $columnas)." from $tabla $where order by documento $sLimite";
// para verificar errores en la consulta
// echo $sql;


// $resulContar=mysqli_query($con,$contar, array(), array("Scrollable"=>"buffered"));
$resulContar=mysqli_query($con,$contar);

$resultado=mysqli_query($con,$sql);
// para saber el numero de filas

$totalContar = $resulContar->num_rows;

$filas = $resultado->num_rows;

// validacion del mensaje

$msg = '';

if ($totalContar===0) {
    $msg = '';
} elseif ($totalContar===1) {
    $msg = "Mostrando 1 Registro de un Total de 1 Registro.";
} elseif ($inicio+$limite>$totalContar) {
    $msg = "Mostrando Registros del ".$inicio+1 ." al $totalContar de un Total de $totalContar Registros.";
} else {
    $msg = "Mostrando Registros del ".$inicio+1 ." al ".$inicio+$limite." de un Total de $totalContar Registros.";
}

$diassemana = array("Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$output=[];
$output['mensaje']= $msg;
$output['data']= '';
$output['paginacion']= '';

if ($filas>0) {
    while ($fila=mysqli_fetch_array($resultado)) {

        $dia= date('N', strtotime($fila['fechaRegistro']));
        $numerodia= date('d', strtotime($fila['fechaRegistro']));
        $mes= date('m', strtotime($fila['fechaRegistro']));
        $año= date('Y', strtotime($fila['fechaRegistro']));
        
        $fecha = $diassemana[$dia-1].", ".$numerodia." de ".$meses[$mes-1]." del ".$año;

        $output['data'] .= "<div class='col-xl-3 col-md-6'>";
        $output['data'] .= "<div class='card'>";
        $output['data'] .= "<a href='#' type='button' data-bs-toggle='modal' data-bs-target='#Detalles'>";
        $output['data'] .= "<div class='card-body'>";
        $output['data'] .= "<div class='head d-flex justify-content-around'>";
        $output['data'] .= "<p>Giftcard</p>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "<p>".$fila['documento']."</p>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='body'>";
        $output['data'] .= "<div class='row my-2'>";
        $output['data'] .= "<h4 class='text-center'>Oliver Delgado Gonzales</h4>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='row text-center'>";
        $output['data'] .= "<div class='col'>";
        $output['data'] .= "<p>Postpago</p>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='col'>";
        $output['data'] .= "<p>".$fila['telefono']."</p>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='col'>";
        $output['data'] .= "<p>".$fila['planes']."</p>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='row text-center' style='border-top: 1px solid #b9b9b9;'>";
        $output['data'] .= "<p class='my-1 text-muted'>$fecha</p>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";
        $output['data'] .= "</a>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";
    }
} else {
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

        $output['paginacion'] .= "<div class='btn-toolbar mb-3 justify-content-end' role='toolbar'><div class='btn-group me-2' role='group'>";
    
        // activacion del boton anterior
        if ($pagina==$pagInicio) 
        {
            $output['paginacion'] .= "<button type='button' class='rounded-5 btn disabled mx-1 d-flex justify-content-center align-items-center'><ion-icon name='arrow-back-outline'></ion-icon></button>";
        }
        else 
        {
            $output['paginacion'] .= "<button type='button' onclick='getDataL(".$pagina-1 .");' class='btn btn-outline-secondary rounded-5 mx-1 d-flex justify-content-center align-items-center'><ion-icon name='arrow-back-outline'></ion-icon></button>";
        }
    
        // pagina inicial anclada
        if ($pagInicio>2) {
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataL(1);'>1</button>";
            // $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 disabled'>...</button>";
        }
    
        // paginas dinamicas
        for ($i = $pagInicio; $i <= $pagFinal; $i++) {
            if ($pagina==$i) 
            {
                $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary rounded-5 mx-1 active'>$i</button>";
            }
            else 
            {
                $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataL($i);'>$i</button>";
            }
        }
    
        // pagina final anclada
        if ($pagFinal<($paginasTotal-1)) {
            // $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 disabled'>...</button>";
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataL($paginasTotal);'>$paginasTotal</button>";
        }

        // activacion del boton siguiente    
        if ($pagina==$pagFinal) {
            $output['paginacion'] .= "<button type='button' class='btn disabled d-flex justify-content-center mx-1 rounded-5 align-items-center'><ion-icon name='arrow-forward-outline'></ion-icon></button>";
        } else {
            $output['paginacion'] .= "<button type='button' onclick='getDataL(".$pagina+1 .");' class='btn btn-outline-secondary mx-1 d-flex justify-content-center rounded-5 align-items-center'><ion-icon name='arrow-forward-outline'></ion-icon></button>";
        }
        $output['paginacion'] .= "</div>";
    }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>