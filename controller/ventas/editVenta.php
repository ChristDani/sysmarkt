<?php
require_once '../../model/conexion.php';
require_once '../../model/usuarios.php';

$model=new conexion();
$con=$model->conectar();

// usuarios
$user = new user();
$listUser = $user->listar();

// en el caso de solo querer determinadas columnas usar esto con el mismo nombre de las columnas...
$columnas=['v.dniAsesor','u.nombre','v.dniCliente','c.nombre','v.sec','v.estado'];

// tabla a seleccionar
$tabla='ventas as v inner join usuarios as u inner join clientes as c on u.dni=v.dniAsesor and c.dni=v.dniCliente';

// posicion de registro
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;
$tipoU= isset($_POST['tipoUser']) ? $_POST['tipoUser'] : null;


// llamamos al registro
$sql = "select ".implode(", ", $columnas)." from $tabla where v.sec='".$codigo."'";
// para verificar errores en la consulta
// echo $sql;


$resultado=mysqli_query($con,$sql);

// para saber el numero de filas
$filas = $resultado->num_rows;


$output=[];
$output['data']= '';

if ($filas>0) 
{
    $i=1;
    while ($fila=mysqli_fetch_array($resultado)) 
    {
        // variables asignadas de la base de datos

        $sec = $fila['sec'];
        $estado = $fila['estado'];
        $dniAsesor = $fila['dniAsesor'];
        $nombreasesor = $fila[1];
        $dniCliente = $fila['dniCliente'];
        $nombrecliente = $fila[3];

        $contarProductos="select * from detalleventas where sec='$sec'";
        $contarProductosCerrados="select * from detalleventas where sec='$sec' and estado = '1'";
        
        $resulcontarProductos=mysqli_query($con,$contarProductos);
        $resulcontarProductosCerrados=mysqli_query($con,$contarProductosCerrados);
        
        $totalcontarProductos = $resulcontarProductos->num_rows;
        $totalcontarProductosCerrados = $resulcontarProductosCerrados->num_rows;

        $output['data'].= "<div class='row m-0'>";

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

        $output['data'].= "</div> ";

        $output['data'].= "<div class='row m-0'>";
        $output['data'].= "<div class='col text-center'>";
        $output['data'].= "<div class='card'>";
        $output['data'].= "<div class='card-body m-2'>";
        $output['data'].= "<p class='text-muted'>Cliente</p>";
        $output['data'].= "<h3>$nombrecliente</h3>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";

        $output['data'].= "<div class='row m-0'>";
        if ($tipoU == "1") 
        {
            $output['data'].= "<div class='col'>";
            $output['data'].= "<div class='form-floating mb-3'>";
            $output['data'].= "<select class='form-select form-select-sm' name='asesor' id='asesor'>"; 
            $output['data'].= "<option hidden value='$dniAsesor'>$nombreasesor</option>";
            if ($listUser != null) 
            {
                foreach ($listUser as $user) 
                {
                    if ($user[0] != $dniAsesor && $user[3] === "0") {
                        $output['data'] .= "<option value='".$user[0]."'>".$user[1]."</option>";
                    }
                }
            }
            $output['data'].= "</select>";
            $output['data'].= "<label for='asesor'>Asesor</label>";
            $output['data'].= "</div>";
            $output['data'].= "</div>";
        }
        else 
        {
            $output['data'].= "<div class='form-floating mb-3 d-none'>";
            $output['data'].= "<input class='form-control' type='text' name='asesor' id='asesor' value='$dniAsesor'>";
            $output['data'].= "<label for='asesor'>Asesor</label>";
            $output['data'].= "</div>";
        }

        $output['data'].= "<div class='col'>";
        $output['data'].= "<div class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control' type='text' name='sec' id='sec' value='$sec'>";
        $output['data'].= "<label for='sec'>SEC</label>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";

        $output['data'].= "<div class='form-floating mb-3 d-none'>";
        $output['data'].= "<input class='form-control' type='text' name='secant' id='secant' value='$sec'>";
        $output['data'].= "<label for='secant'>SEC Actual</label>";
        $output['data'].= "</div>";

        $output['data'].= "</div>";
    }
}


echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>