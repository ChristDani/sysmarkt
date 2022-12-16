<?php
require_once '../../model/conexion.php';

$model=new conexion();
$con=$model->conectar();

// en el caso de solo querer determinadas columnas usar esto con el mismo nombre de las columnas...
$columnas=['region', 'nombre', 'centro', 'almacen',	'nombreAlmacen', 'material', 'descripcion', 'libres', 'bloqueados'];

// tabla a seleccionar
$tabla='productos';

// $buscar=isset($_POST['busqueda']) ? $con->mssql_escape($_POST['busqueda']) : null;
$buscarRegion= isset($_POST['BusReg']) ? $_POST['BusReg'] : null;
$buscarCac= isset($_POST['busCac']) ? $_POST['busCac'] : null;
$buscar= isset($_POST['busqueda']) ? $_POST['busqueda'] : null;

// busqueda de datos
$where="";

if ($buscarRegion!=null) {
    if ($buscarRegion!='---') {
        $where.="where region like '%".$buscarRegion."%'";
        if ($buscarCac!=null) {
            $where.=" and nombre like '%".$buscarCac."%'";
            if ($buscar!=null) {
                $where.=" and descripcion like '%".$buscar."%'";
            }
        }
        elseif ($buscar!=null) {
            $where.=" and descripcion like '%".$buscar."%'";
        }
    }
}
elseif ($buscarCac!=null and $buscarRegion==null) {
    $where.="where nombre like '%".$buscarCac."%'";
        if ($buscar!=null) {
            $where.=" and descripcion like '%".$buscar."%'";
        }
}
elseif ($buscar!=null and $buscarCac==null and $buscarRegion==null) {
    $where.="where descripcion like '%".$buscar."%'";

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

$sql = "select ".implode(", ", $columnas)." from $tabla $where order by region $sLimite";
// para verificar errores en la consulta
// echo $sql;
// echo "<br>";
// echo "<br>";


// $resulContar=mysqli_query($con,$contar, array("Scrollable"=>"buffered"));
$resulContar=mysqli_query($con,$contar);

$resultado=mysqli_query($con,$sql);
// $resultado=mysqli_query($con,$sql, array("Scrollable"=>mysqli_CURSOR_KEYSET));
// para saber el numero de filas

$totalContar = $resulContar->num_rows;

$filas = $resultado->num_rows;

$output=[];
$output['data']= '';
$output['paginacion']= '';

if ($filas>0) {
    while ($fila=mysqli_fetch_array($resultado)) {
        $total = $fila['libres']+$fila['bloqueados'];

        $output['data'] .= "<div class='col-xl-3 col-md-6'>";
        $output['data'] .= "<div class='card'>";
        $output['data'] .= "<div class='card-body'>";
        $output['data'] .= "<div class='head d-flex justify-content-around'>";
        $output['data'] .= "<p>".$fila['region']."</p>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "<p>".$fila['nombre']."</p>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "<p>".$fila['centro']."</p>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "<p>".$fila['almacen']."</p>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='body'>";
        $output['data'] .= "<div class='row my-2'>";
        $output['data'] .= "<h4 class='text-center'>".$fila['descripcion']."</h4>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='row text-center'>";
        $output['data'] .= "<div class='col'>";
        $output['data'] .= "<p class='success'>".$fila['libres']."</p>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='col'>";
        $output['data'] .= "<p class='danger'>".$fila['bloqueados']."</p>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='col'>";
        $output['data'] .= "<p>$total</p>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='row text-center' style='border-top: 1px solid #b9b9b9;'>";
        $output['data'] .= "<p class='my-1 text-muted'>".$fila['nombreAlmacen']."</p>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";
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
    
        $output['paginacion'] .= "<div class='btn-toolbar mb-3 justify-content-end' role='toolbar'><div class='btn-group btn-group-sm' role='group'>";

        // activacion del boton anterior
        if ($pagina!=$pagInicio) 
        {
            $output['paginacion'] .= "<button type='button' onclick='getDataE(".$pagina-1 .");' class='btn rounded-5 mx-1 d-flex justify-content-center align-items-center'><ion-icon name='arrow-back-outline'></ion-icon></button>";
        }

        // pagina inicial anclada
        if ($pagInicio>2) {
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataE(1);'>1</button>";
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
                $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataE($i);'>$i</button>";
            }
        }
    
        // pagina final anclada
        if ($pagFinal<($paginasTotal-1)) {
            // $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 disabled'>...</button>";
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataE($paginasTotal);'>$paginasTotal</button>";
        }
    
        // activacion del boton siguiente
        if ($pagina!=$pagFinal) 
        {
            $output['paginacion'] .= "<button type='button' onclick='getDataE(".$pagina+1 .");' class='btn mx-1 d-flex justify-content-center rounded-5 align-items-center'><ion-icon name='arrow-forward-outline'></ion-icon></button>";
        }
        $output['paginacion'] .= "</div>";
    }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>