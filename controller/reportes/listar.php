<?php
require_once '../../model/conexion.php';

$model=new conexion();
$con=$model->conectar();

$fecharequerida= !empty($_POST['fecha']) ? $_POST['fecha'] : null;
$dniAsesorMeta= !empty($_POST['busasesormet']) ? $_POST['busasesormet'] : null;
$dniModeradorMeta= !empty($_POST['busmoderadormet']) ? $_POST['busmoderadormet'] : null;

if ($fecharequerida != null) 
{
    // ventas totales
    $sqlvt = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecharequerida') and year(dv.registro)=year('$fecharequerida')) and v.dniAsesor like '%$dniAsesorMeta%' and u.dniModerador like '%$dniModeradorMeta%'";
    $resultadovt = mysqli_query($con,$sqlvt);
    $vt = $resultadovt->num_rows;
    // ventas concretadas
    $sqlvc = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where dv.estado='1' and (month(dv.registro)=month('$fecharequerida') and year(dv.registro)=year('$fecharequerida')) and dniAsesor like '%$dniAsesorMeta%' and u.dniModerador like '%$dniModeradorMeta%'";
    $resultadovc = mysqli_query($con,$sqlvc);
    $vc = $resultadovc->num_rows;
    // ventas pendientes
    $sqlvp = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where dv.estado='2' and (month(dv.registro)=month('$fecharequerida') and year(dv.registro)=year('$fecharequerida')) and dniAsesor like '%$dniAsesorMeta%' and u.dniModerador like '%$dniModeradorMeta%'";
    $resultadovp = mysqli_query($con,$sqlvp);
    $vp = $resultadovp->num_rows;
    // ventas rechazadas
    $sqlvr = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where dv.estado='0' and (month(dv.registro)=month('$fecharequerida') and year(dv.registro)=year('$fecharequerida')) and dniAsesor like '%$dniAsesorMeta%' and u.dniModerador like '%$dniModeradorMeta%'";
    $resultadovr = mysqli_query($con,$sqlvr);
    $vr = $resultadovr->num_rows;
}
elseif ($fecharequerida == null) 
{
    // ventas totales
    $sqlvt = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesorMeta%' and u.dniModerador like '%$dniModeradorMeta%'";
    $resultadovt = mysqli_query($con,$sqlvt);
    $vt = $resultadovt->num_rows;
    // ventas concretadas
    $sqlvc = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where dv.estado='1' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesorMeta%' and u.dniModerador like '%$dniModeradorMeta%'";
    $resultadovc = mysqli_query($con,$sqlvc);
    $vc = $resultadovc->num_rows;
    // ventas pendientes
    $sqlvp = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where dv.estado='2' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesorMeta%' and u.dniModerador like '%$dniModeradorMeta%'";
    $resultadovp = mysqli_query($con,$sqlvp);
    $vp = $resultadovp->num_rows;
    // ventas rechazadas
    $sqlvr = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where dv.estado='0' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesorMeta%' and u.dniModerador like '%$dniModeradorMeta%'";
    $resultadovr = mysqli_query($con,$sqlvr);
    $vr = $resultadovr->num_rows;
}

// echo "$vt | $vc | $vp | $vr";

// en el caso de solo querer determinadas columnas usar esto con el mismo nombre de las columnas...
$columnas=['u.nombre, v.dniCliente, c.nombre, v.estado, v.sec, v.registro'];

// tabla a seleccionar
$tabla='ventas as v INNER JOIN usuarios as u INNER JOIN clientes as c on v.dniAsesor=u.dni and v.dniCliente=c.dni';

$buscar= isset($_POST['busqueda']) ? $_POST['busqueda'] : null;
$buscarestado= isset($_POST['busestate']) ? $_POST['busestate'] : null;

// busqueda de datos
$where='';
if ($fecharequerida != null) 
{
    $where.="where (month(v.registro)=month('$fecharequerida') and year(v.registro)=year('$fecharequerida')) ";
}
elseif ($fecharequerida == null) 
{
    $where.="where (month(v.registro)=month(CURRENT_TIMESTAMP) and year(v.registro)=year(CURRENT_TIMESTAMP)) ";
}

if ($dniModeradorMeta != null) {
    $where.="and u.dniModerador='".$dniModeradorMeta."' ";
    if ($dniAsesorMeta != null) {
        $where.="and v.dniAsesor='".$dniAsesorMeta."' ";
        if ($buscarestado != null) {
            $where.="and v.estado='".$buscarestado."' ";
            if ($buscar != null) {
                $where.="and v.sec like '%".$buscar."%' ";
            }
        }
        elseif ($buscar != null) {
            $where.="and v.sec like '%".$buscar."%' ";
        }
    }
    elseif ($buscarestado != null) {
        $where.="and v.estado='".$buscarestado."' ";
        if ($buscar != null) {
            $where.="and v.sec like '%".$buscar."%' ";
        }
    }
    elseif ($buscar != null) {
        $where.="and v.sec like '%".$buscar."%' ";
    }
}
elseif ($dniAsesorMeta != null and $dniModeradorMeta == null) {
    $where.="and v.dniAsesor='".$dniAsesorMeta."' ";
    if ($buscarestado != null) {
        $where.="and v.estado='".$buscarestado."' ";
        if ($buscar != null) {
            $where.="and v.sec like '%".$buscar."%' ";
        }
    }
    elseif ($buscar != null) {
        $where.="and v.sec like '%".$buscar."%' ";
    }
}
elseif ($buscarestado != null and $dniAsesorMeta == null and $dniModeradorMeta == null) {
    $where.="and v.estado='".$buscarestado."' ";
    if ($buscar != null) {
        $where.="and v.sec like '%".$buscar."%' ";
    }
}
elseif ($buscar!=null and $dniAsesorMeta == null and $buscarestado == null and $dniModeradorMeta == null) {
    $where.="and v.sec like '%".$buscar."%' ";
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

$sql = "select ".implode(", ", $columnas)." from $tabla $where order by v.registro $sLimite";
// para verificar errores en la consulta



// $resulContar=mysqli_query($con,$contar);
$resulContar=mysqli_query($con,$contar);

$resultado=mysqli_query($con,$sql);
// $resultado=mysqli_query($con,$sql, array(), array("Scrollable"=>mysqli_CURSOR_KEYSET));
// para saber el numero de filas

$totalContar = $resulContar->num_rows;

$filas = $resultado->num_rows;

$output=[];
$output['data']= '';
$output['paginacion']= '';
$output['vt']= $vt;
$output['vc']= $vc;
$output['vp']= $vp;
$output['vr']= $vr;
$output['graficosfeos'] = "";
$output['graficosfeos'] .= "<div class='col-lg-6'>";
$output['graficosfeos'] .= "<div class='card'>";
$output['graficosfeos'] .= "<div class='card-body'>";
$output['graficosfeos'] .= "<div class='chart-container' style='position: relative; height:50%; width:100%'>";
$output['graficosfeos'] .= "<canvas id='pie'></canvas>";
$output['graficosfeos'] .= "</div>";
$output['graficosfeos'] .= "</div>";
$output['graficosfeos'] .= "</div>";
$output['graficosfeos'] .= "</div>";
$output['graficosfeos'] .= "<div class='col-lg-6'>";
$output['graficosfeos'] .= "<div class='card'>";
$output['graficosfeos'] .= "<div class='card-body'>";
$output['graficosfeos'] .= "<div class='chart-container' style='position: relative; height:45%; width:100%'>";
$output['graficosfeos'] .= "<canvas id='bar'></canvas>";
$output['graficosfeos'] .= "</div>";
$output['graficosfeos'] .= "</div>";
$output['graficosfeos'] .= "</div>";
$output['graficosfeos'] .= "</div>";

if ($filas>0) {
    $i=$inicio+1;
    while ($fila=mysqli_fetch_array($resultado)) {
        
        $code = $fila['sec'];
        $fecha =date('d/m/y', strtotime($fila['registro']));

        $contarProductos="select * from detalleventas where sec='$code'";
        $contarProductosCerrados="select * from detalleventas where sec='$code' and estado = '1'";
        
        $resulcontarProductos=mysqli_query($con,$contarProductos);
        $resulcontarProductosCerrados=mysqli_query($con,$contarProductosCerrados);
        
        $totalcontarProductos = $resulcontarProductos->num_rows;
        $totalcontarProductosCerrados = $resulcontarProductosCerrados->num_rows;

        $output['data'].= "<tr>";
        $output['data'].= "<td align='center'>$i</td>";
        $output['data'].= "<td align='left'>".$fila[0]."</td>";
        $output['data'].= "<td align='center'>".$fila[2]."</td>";
        $output['data'].= "<td align='center'>".$fila['sec']."</td>";
        if ($fila['estado'] === "0") 
        {
            $output['data'].= "<td align='center'>En Proceso</td>";
        }
        elseif ($fila['estado'] === "1") 
        {
            $output['data'].= "<td align='center'>Cerrada</td>";
        }
        $output['data'].= "<td align='center'>$totalcontarProductosCerrados/$totalcontarProductos</td>";
        $output['data'].= "<td align='center'>".$fecha."</td>";
        $output['data'].= "<td align='center'><a class='btn' data-bs-target='#Detallesreportemes' data-bs-toggle='modal' onclick="."mostrardetallesreportesmes('$code');"."><ion-icon name='information-circle-outline'></ion-icon></a></td>";
        $output['data'].= "</tr>";
        $i+=1;
    }
} else {
    $output['data'].= "<tr>";
    $output['data'].= "<td align='center' colspan=8 height='100px'>Sin Resultados...</td>";
    $output['data'].= "</tr>";
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
            $output['paginacion'] .= "<button type='button' onclick='getDataRM(".$pagina-1 .");ahsdgjahdgasd();' class='btn rounded-5 mx-1 d-flex justify-content-center align-items-center'><ion-icon name='arrow-back-outline'></ion-icon></button>";
        }  
    
        // pagina inicial anclada
        if ($pagInicio>2) {
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataRM(1);ahsdgjahdgasd();'>1</button>";
        }
    
        // paginas dinamicas
        for ($i = $pagInicio; $i <= $pagFinal; $i++) {
            if ($pagina==$i) 
            {
                $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary rounded-5 mx-1 active'>$i</button>";
            }
            else 
            {
                $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataRM($i);ahsdgjahdgasd();'>$i</button>";
            }
        }
    
        // pagina final anclada
        if ($pagFinal<($paginasTotal-1)) {
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataRM($paginasTotal);ahsdgjahdgasd();'>$paginasTotal</button>";
        }
    
        
        // activacion del boton siguiente
        
        if ($pagina!=$pagFinal) 
        {
            $output['paginacion'] .= "<button type='button' onclick='getDataRM(".$pagina+1 .");ahsdgjahdgasd();' class='btn mx-1 d-flex justify-content-center rounded-5 align-items-center'><ion-icon name='arrow-forward-outline'></ion-icon></button>";
        }
        $output['paginacion'] .= "</div>";
    }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>