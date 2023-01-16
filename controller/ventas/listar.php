<?php
require_once '../../model/conexion.php';

$model=new conexion();
$con=$model->conectar();

// en el caso de solo querer determinadas columnas usar esto con el mismo nombre de las columnas...
$columnas=['u.nombre, v.dniCliente, c.nombre, v.estado, v.sec, v.origen, v.registro'];

// tabla a seleccionar
$tabla='ventas as v INNER JOIN usuarios as u INNER JOIN clientes as c on v.dniAsesor=u.dni and v.dniCliente=c.dni';

$dniAsesorV= !empty($_POST['dniAsesor']) ? $_POST['dniAsesor'] : null;
$dniModeradorV= !empty($_POST['dniModerador']) ? $_POST['dniModerador'] : null;

$buscarmoderador= !empty($_POST['moderador']) ? $_POST['moderador'] : null;
$buscarasesor= !empty($_POST['asesor']) ? $_POST['asesor'] : null;
$buscarestado= isset($_POST['estado']) ? $_POST['estado'] : null;
$buscarcliente= !empty($_POST['cliente']) ? $_POST['cliente'] : null;
$buscarsec= isset($_POST['sec']) ? $_POST['sec'] : null;

$tipoAsesor= isset($_POST['tipoAsesor']) ? $_POST['tipoAsesor'] : null;

// busqueda de datos
$where="where ((month(v.registro)=month(CURRENT_TIMESTAMP) and year(v.registro)=year(CURRENT_TIMESTAMP)) and v.dniAsesor like '%$dniAsesorV%' and u.dniModerador like '%$dniModeradorV%') ";

if ($buscarmoderador != null) {
    $where.="and u.dniModerador='".$buscarmoderador."' ";
    if ($buscarestado != null) {
        $where.="and v.estado='".$buscarestado."' ";
        if ($buscarcliente != null) {
            $where.="and v.dniCliente='".$buscarcliente."' ";
            if ($buscarsec != null) {
                $where.="and v.sec like '%".$buscarsec."%' ";
            }
        }
    }
    elseif ($buscarcliente != null) {
        $where.="and v.dniCliente='".$buscarcliente."' ";
        if ($buscarsec != null) {
            $where.="and v.sec like '%".$buscarsec."%' ";
        }
    }
    elseif ($buscarsec != null) {
        $where.="and v.sec like '%".$buscarsec."%' ";
    }
}
elseif ($buscarasesor != null) {
    $where.="and v.dniAsesor='".$buscarasesor."' ";
    if ($buscarestado != null) {
        $where.="and v.estado='".$buscarestado."' ";
        if ($buscarcliente != null) {
            $where.="and v.dniCliente='".$buscarcliente."' ";
            if ($buscarsec != null) {
                $where.="and v.sec like '%".$buscarsec."%' ";
            }
        }
    }
    elseif ($buscarcliente != null) {
        $where.="and v.dniCliente='".$buscarcliente."' ";
        if ($buscarsec != null) {
            $where.="and v.sec like '%".$buscarsec."%' ";
        }
    }
    elseif ($buscarsec != null) {
        $where.="and v.sec like '%".$buscarsec."%' ";
    }
}
elseif ($buscarestado != null and $buscarasesor == null) {
    $where.="and v.estado='".$buscarestado."' ";
    if ($buscarcliente != null) {
        $where.="and v.dniCliente='".$buscarcliente."' ";
        if ($buscarsec != null) {
            $where.="and v.sec like '%".$buscarsec."%' ";
        }
    }
    elseif ($buscarsec != null) {
        $where.="and v.sec like '%".$buscarsec."%' ";
    }
}
elseif ($buscarcliente!=null and $buscarasesor == null and $buscarestado == null) {
    $where.="and v.dniCliente='".$buscarcliente."' ";
    if ($buscarsec != null) {
        $where.="and v.sec like '%".$buscarsec."%' ";
    }
}
elseif ($buscarsec!=null and $buscarcliente == null  and $buscarasesor == null and $buscarestado == null) {
    $where.="and v.sec like '%".$buscarsec."%' ";
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
$contar="select * from $tabla $where";

$sql = "select ".implode(", ", $columnas)." from $tabla $where order by v.registro desc $sLimite";
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
        $contarProductos="select * from detalleventas where sec='".$fila['sec']."'";
        $contarProductosCerrados="select * from detalleventas where sec='".$fila['sec']."' and estado = '1'";
        
        $resulcontarProductos=mysqli_query($con,$contarProductos);
        $resulcontarProductosCerrados=mysqli_query($con,$contarProductosCerrados);
        
        $totalcontarProductos = $resulcontarProductos->num_rows;
        $totalcontarProductosCerrados = $resulcontarProductosCerrados->num_rows;

        $dia= date('N', strtotime($fila['registro']));
        $numerodia= date('d', strtotime($fila['registro']));
        $mes= date('m', strtotime($fila['registro']));
        $año= date('Y', strtotime($fila['registro']));
        
        $code = $fila['sec'];
        $tipoUser = $tipoAsesor;
        $estado=$fila['estado'];
        $fecha = $diassemana[$dia-1].", ".$numerodia." de ".$meses[$mes-1]." del ".$año;

        $output['data'].= "<div class='col-xl-3 col-md-6'>";
        $output['data'].= "<div class='card'>";
        $output['data'].= "<a href='#' type='button' data-bs-toggle='modal' data-bs-target='#DetallesVentas' onclick=abrirModalDetalle('$code','$tipoUser');>";
        $output['data'].= "<div class='card-body'>";
        
        if ($estado === "0") 
        {
            $output['data'].= "<div class='row'>";
            $output['data'].= "<div class='warning-bc d-flex justify-content-between mb-2 rounded-3'>";
            $output['data'].= "<p class='color'>Venta En Proceso</p>";
            $output['data'].= "<p class='color'> $totalcontarProductosCerrados/$totalcontarProductos</p>";
            $output['data'].= "</div>";
            $output['data'].= "</div>";
        }
        elseif ($estado === "1") 
        {
            $output['data'].= "<div class='row'>";
            $output['data'].= "<div class='secondary-bc d-flex justify-content-between mb-2 rounded-3'>";
            $output['data'].= "<p class='color'>Venta Cerrada</p>";
            $output['data'].= "<p class='color'> $totalcontarProductosCerrados/$totalcontarProductos</p>";
            $output['data'].= "</div>";
            $output['data'].= "</div>";
        }
        

        $output['data'].= "<div class='head d-flex justify-content-around'>";
        $output['data'].= "<p>".$fila['sec']."</p>";
        $output['data'].= "<p></p>";
        $output['data'].= "<p></p>";
        $output['data'].= "<p></p>";
        $output['data'].= "<p></p>";
        $output['data'].= "<p>".$fila['dniCliente']."</p>";
        $output['data'].= "</div>";
        $output['data'].= "<div class='body'>";
        $output['data'].= "<div class='row my-2'>";
        $output['data'].= "<h4 class='text-center'>".$fila[2]."</h4>";
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
            $output['paginacion'] .= "<button type='button' onclick='getDataVentas(".$pagina-1 .");' class='btn rounded-5 mx-1 d-flex justify-content-center align-items-center'><ion-icon name='arrow-back-outline'></ion-icon></button>";
        }  
    
        // pagina inicial anclada
        if ($pagInicio>2) {
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataVentas(1);'>1</button>";
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
                $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataVentas($i);'>$i</button>";
            }
        }
    
        // pagina final anclada
        if ($pagFinal<($paginasTotal-1)) {
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 disabled'>...</button>";
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataVentas($paginasTotal);'>$paginasTotal</button>";
        }
    
        
        // activacion del boton siguiente
        
        if ($pagina!=$pagFinal) 
        {
            $output['paginacion'] .= "<button type='button' onclick='getDataVentas(".$pagina+1 .");' class='btn mx-1 d-flex justify-content-center rounded-5 align-items-center'><ion-icon name='arrow-forward-outline'></ion-icon></button>";
        }
        $output['paginacion'] .= "</div>";
    }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>