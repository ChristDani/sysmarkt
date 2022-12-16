<?php
require_once '../../model/conexion.php';

$model=new conexion();
$con=$model->conectar();

$fecharequerida= !empty($_POST['fecha']) ? $_POST['fecha'] : null;
$dniAsesorMeta= !empty($_POST['busasesormet']) ? $_POST['busasesormet'] : null;

if ($fecharequerida != null) 
{
    // ventas totales
    $sqlvt = "select * from whatsapp where (month(fechaRegistro)=month('$fecharequerida') and year(fechaRegistro)=year('$fecharequerida')) and dniAsesor like '%$dniAsesorMeta%'";
    $resultadovt = mysqli_query($con,$sqlvt);
    $vt = $resultadovt->num_rows;
    // ventas concretadas
    $sqlvc = "select * from whatsapp where estado='1' and (month(fechaRegistro)=month('$fecharequerida') and year(fechaRegistro)=year('$fecharequerida')) and dniAsesor like '%$dniAsesorMeta%'";
    $resultadovc = mysqli_query($con,$sqlvc);
    $vc = $resultadovc->num_rows;
    // ventas pendientes
    $sqlvp = "select * from whatsapp where estado='2' and (month(fechaRegistro)=month('$fecharequerida') and year(fechaRegistro)=year('$fecharequerida')) and dniAsesor like '%$dniAsesorMeta%'";
    $resultadovp = mysqli_query($con,$sqlvp);
    $vp = $resultadovp->num_rows;
    // ventas rechazadas
    $sqlvr = "select * from whatsapp where estado='0' and (month(fechaRegistro)=month('$fecharequerida') and year(fechaRegistro)=year('$fecharequerida')) and dniAsesor like '%$dniAsesorMeta%'";
    $resultadovr = mysqli_query($con,$sqlvr);
    $vr = $resultadovr->num_rows;
}
elseif ($fecharequerida == null) 
{
    // ventas totales
    $sqlvt = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesorMeta%'";
    $resultadovt = mysqli_query($con,$sqlvt);
    $vt = $resultadovt->num_rows;
    // ventas concretadas
    $sqlvc = "select * from whatsapp where estado='1' and (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesorMeta%'";
    $resultadovc = mysqli_query($con,$sqlvc);
    $vc = $resultadovc->num_rows;
    // ventas pendientes
    $sqlvp = "select * from whatsapp where estado='2' and (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesorMeta%'";
    $resultadovp = mysqli_query($con,$sqlvp);
    $vp = $resultadovp->num_rows;
    // ventas rechazadas
    $sqlvr = "select * from whatsapp where estado='0' and (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesorMeta%'";
    $resultadovr = mysqli_query($con,$sqlvr);
    $vr = $resultadovr->num_rows;
}

// echo "$vt | $vc | $vp | $vr";

// en el caso de solo querer determinadas columnas usar esto con el mismo nombre de las columnas...
$columnas=['codigo','dniAsesor','nombre','dni','telefono','producto','lineaProcedente','operadorCedente','modalidad','tipo','planR','equipo','formaDePago','numeroReferencia','sec','tipoFija','planFija','estado','observaciones','promocion','ubicacion','distrito','fechaRegistro','fechaActualizacion'];
$columnasBus=['codigo','nombre','dni','telefono','producto','lineaProcedente','operadorCedente','modalidad','tipo','planR','equipo','formaDePago','numeroReferencia','sec','tipoFija','planFija','observaciones','promocion','ubicacion','distrito','fechaActualizacion'];

// tabla a seleccionar
$tabla='whatsapp';

$buscar= isset($_POST['busqueda']) ? $_POST['busqueda'] : null;
$buscarestado= isset($_POST['busestate']) ? $_POST['busestate'] : null;

// busqueda de datos
$where='';
if ($fecharequerida != null) 
{
    $where.="where (month(fechaRegistro)=month('$fecharequerida') and year(fechaRegistro)=year('$fecharequerida')) ";
}
elseif ($fecharequerida == null) 
{
    $where.="where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) ";
}

if ($dniAsesorMeta != null) {
    $where.="and dniAsesor='".$dniAsesorMeta."' ";
    if ($buscarestado != null) {
        $where.="and estado='".$buscarestado."' ";
        if ($buscar!=null) {
            $where.=" and (";
            $cont= count($columnasBus);
            for ($i=0; $i < $cont; $i++) { 
                $where.=$columnasBus[$i]." like '%".$buscar."%' or ";
            }
            $where=substr_replace($where, "", -3);
            $where.=")";
        }
    }
    elseif ($buscar!=null) {
        $where.=" and (";
        $cont= count($columnasBus);
        for ($i=0; $i < $cont; $i++) { 
            $where.=$columnasBus[$i]." like '%".$buscar."%' or ";
        }
        $where=substr_replace($where, "", -3);
        $where.=")";
    }
}
if ($buscarestado != null and $dniAsesorMeta == null) {
    $where.="and estado='".$buscarestado."' ";
    if ($buscar!=null) {
        $where.=" and (";
        $cont= count($columnasBus);
        for ($i=0; $i < $cont; $i++) { 
            $where.=$columnasBus[$i]." like '%".$buscar."%' or ";
        }
        $where=substr_replace($where, "", -3);
        $where.=")";
    }
}
elseif ($buscar!=null and $dniAsesorMeta == null and $buscarestado == null) {
    $where.="and (";
    $cont= count($columnasBus);
    for ($i=0; $i < $cont; $i++) { 
        $where.=$columnasBus[$i]." like '%".$buscar."%' or ";
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

$sql = "select ".implode(", ", $columnas)." from $tabla $where order by codigo $sLimite";
// para verificar errores en la consulta
// echo $sql;


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
        
        $code = $fila['codigo'];
        $fecha =date('d/m/y', strtotime($fila['fechaRegistro']));

        $output['data'].= "<tr>";
        $output['data'].= "<td align='center'>$i</td>";
        $output['data'].= "<td align='left'>".$fila['nombre']."</td>";
        $output['data'].= "<td align='center'>".$fila['numeroReferencia']."</td>";
        if ($fila['producto'] === "0") 
        {
            $output['data'].= "<td align='center'>Fija</td>";
        }
        elseif ($fila['producto'] === "1") 
        {
            $output['data'].= "<td align='center'>Movil</td>";
        }
        $output['data'].= "<td align='center'>".$fila['sec']."</td>";
        if ($fila['estado'] === "1") 
        {
            $output['data'].= "<td align='center'>Concretado</td>";
        }
        elseif ($fila['estado'] === "2") 
        {
            $output['data'].= "<td align='center'>Pendiente</td>";
        }
        elseif ($fila['estado'] === "0") 
        {
            $output['data'].= "<td align='center'>No Requiere</td>";
        }
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