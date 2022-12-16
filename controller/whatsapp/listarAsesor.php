<?php
require_once '../../model/conexion.php';

$model=new conexion();
$con=$model->conectar();

// en el caso de solo querer determinadas columnas usar esto con el mismo nombre de las columnas...
$columnas=['w.codigo','u.nombre','w.nombre','w.dni','w.telefono','w.producto','w.lineaProcedente','w.operadorCedente','w.modalidad','w.tipo','w.planR','w.equipo','w.formaDePago','w.numeroReferencia','w.sec','w.tipoFija','w.planFija','w.modoFija','w.estado','observaciones','w.promocion','w.ubicacion','w.distrito','w.fechaRegistro','w.fechaActualizacion'];

$columnasBusqueda=['w.codigo','u.nombre','w.nombre','w.dni','w.telefono','w.producto','w.lineaProcedente','w.operadorCedente','w.modalidad','w.tipo','w.planR','w.equipo','w.formaDePago','w.numeroReferencia','w.sec','w.tipoFija','w.planFija','w.modoFija','observaciones','w.promocion','w.ubicacion','w.distrito'];

// tabla a seleccionar
$tabla='whatsapp as w inner join usuarios as u on w.dniAsesor=u.dni';

// $buscar=isset($_POST['busqueda']) ? $con->mssql_escape($_POST['busqueda']) : null;
$dniAsesor = isset($_POST['dniAsesor']) ? $_POST['dniAsesor'] : null;
$buscar= isset($_POST['busqueda']) ? $_POST['busqueda'] : null;
$tipoU= isset($_POST['tipoUser']) ? $_POST['tipoUser'] : null;
$buscarestado= isset($_POST['busestate']) ? $_POST['busestate'] : null;

// busqueda de datos
$where="where w.dniAsesor='".$dniAsesor."' and (month(w.fechaRegistro)=month(CURRENT_TIMESTAMP) and year(w.fechaRegistro)=year(CURRENT_TIMESTAMP)) ";

if ($buscarestado != null) {
    $where.="and w.estado='".$buscarestado."' ";
    if ($buscar!=null) {
        $where.=" and (";
        $cont= count($columnasBusqueda);
        for ($i=0; $i < $cont; $i++) { 
            $where.=$columnasBusqueda[$i]." like '%".$buscar."%' or ";
        }
        $where=substr_replace($where, "", -3);
        $where.=")";
    }
}
elseif ($buscar!=null) {
    $where.=" and (";
    $cont= count($columnasBusqueda);
    for ($i=0; $i < $cont; $i++) { 
        $where.=$columnasBusqueda[$i]." like '%".$buscar."%' or ";
    }
    $where=substr_replace($where, "", -3);
    $where.=")";
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

$sql = "select ".implode(", ", $columnas)." from $tabla $where order by w.fechaRegistro desc $sLimite";
// para verificar errores en la consulta
// echo "$sql<br>";


// $resulContar=mysqli_query($con,$contar, array(), array("Scrollable"=>"buffered"));
$resulContar=mysqli_query($con,$contar);

$resultado=mysqli_query($con,$sql);
// $resultado=mysqli_query($con,$sql, array(), array("Scrollable"=>mysqli_CURSOR_KEYSET));
// para saber el numero de filas

$totalContar = $resulContar->num_rows;

$filas = $resultado->num_rows;

$diassemana = array("Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$output=[];
$output['data']= '';
$output['paginacion']= '';

if ($filas>0) {
    
    while ($fila=mysqli_fetch_array($resultado)) {
        
        $dia= date('N', strtotime($fila['fechaRegistro']));
        $numerodia= date('d', strtotime($fila['fechaRegistro']));
        $mes= date('m', strtotime($fila['fechaRegistro']));
        $año= date('Y', strtotime($fila['fechaRegistro']));
        

        $code = $fila['codigo'];
        $tipoUser = $tipoU;
        $estado=$fila['estado'];
        $fecha= $diassemana[$dia-1].", ".$numerodia." de ".$meses[$mes-1]." del ".$año;

        $output['data'].= "<div class='col-xl-3 col-md-6'>";
        $output['data'].= "<div class='card'>";
        $output['data'].= "<a href='#' type='button' data-bs-toggle='modal' data-bs-target='#DetallesWhatsapp' onclick=abrirModalDetalle('$code','$tipoUser');>";
        $output['data'].= "<div class='card-body'>";

        if ($estado === "0") 
        {
            $output['data'].= "<div class='row'>";
            $output['data'].= "<div class='col mb-2 danger-bg rounded-3'>";
            $output['data'].= "<p class='text-center color'>No Requiere</p>";
            $output['data'].= "</div>";
            $output['data'].= "</div>";
        }
        elseif ($estado === "1") 
        {
            $output['data'].= "<div class='row'>";
            $output['data'].= "<div class='success-bg col mb-2 rounded-3'>";
            $output['data'].= "<p class='text-center color'>Concretado</p>";
            $output['data'].= "</div>";
            $output['data'].= "</div>";
        }
        elseif ($estado === "2") 
        {
            $output['data'].= "<div class='row'>";
            $output['data'].= "<div class='col mb-2 warning-bg rounded-3'>";
            $output['data'].= "<p class='text-center color'>Pendiente</p>";
            $output['data'].= "</div>";
            $output['data'].= "</div>";
        }
        
        $output['data'].= "<div class='head d-flex justify-content-around'>";
        $output['data'].= "<p>".$fila['promocion']."</p>";
        $output['data'].= "<p></p>";
        $output['data'].= "<p></p>";
        $output['data'].= "<p></p>";
        $output['data'].= "<p></p>";
        $output['data'].= "<p>".$fila['dni']."</p>";
        $output['data'].= "</div>";
        $output['data'].= "<div class='body'>";
        $output['data'].= "<div class='row my-2'>";
        $output['data'].= "<h4 class='text-center'>".$fila['nombre']."</h4>";
        $output['data'].= "</div>";
        $output['data'].= "<div class='row text-center'>";
        $output['data'].= "<div class='col'>";
        if ($fila['producto'] === "1") 
        {
            if ($fila['modalidad'] === "0") 
            {
                $output['data'].= "<p>Prepago</p>";
            }
            elseif ($fila['modalidad'] === "1") 
            {
                $output['data'].= "<p>Postpago</p>";
            }
        }
        elseif ($fila['producto'] === "0") 
        {
            if ($fila['tipoFija'] === "0") 
            {
                $output['data'].= "<p>Alta</p>";
            }
            elseif ($fila['tipoFija'] === "1") 
            {
                $output['data'].= "<p>Portabilidad</p>";
            }
        }
        $output['data'].= "</div>";
        $output['data'].= "<div class='col'>";
        $output['data'].= "<p>".$fila['numeroReferencia']."</p>";
        $output['data'].= "</div>";
        $output['data'].= "<div class='col'>";
        if ($fila['producto'] === "1") 
        {
            if ($fila['modalidad'] === "1") 
            {
            $output['data'].= "<p>".$fila['planR']."</p>";
            }
        }
        elseif ($fila['producto'] === "0") 
        {
            $output['data'].= "<p>".$fila['planFija']."</p>";
        }
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
            $output['paginacion'] .= "<button type='button' onclick='getDataW(".$pagina-1 .");' class='btn rounded-5 mx-1 d-flex justify-content-center align-items-center'><ion-icon name='arrow-back-outline'></ion-icon></button>";
        }  
    
        // pagina inicial anclada
        if ($pagInicio>2) {
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataW(1);'>1</button>";
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
                $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataW($i);'>$i</button>";
            }
        }
    
        // pagina final anclada
        if ($pagFinal<($paginasTotal-1)) {
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 disabled'>...</button>";
            $output['paginacion'] .= "<button type='button' class='btn btn-outline-secondary mx-1 rounded-5' onclick='getDataW($paginasTotal);'>$paginasTotal</button>";
        }
    
        
        // activacion del boton siguiente
        
        if ($pagina!=$pagFinal) {
            $output['paginacion'] .= "<button type='button' onclick='getDataW(".$pagina+1 .");' class='btn mx-1 d-flex justify-content-center rounded-5 align-items-center'><ion-icon name='arrow-forward-outline'></ion-icon></button>";
        }
        $output['paginacion'] .= "</div>";
    }


}

echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>