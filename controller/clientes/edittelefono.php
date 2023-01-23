<?php
require_once '../../model/conexion.php';
require_once '../../model/clientes.php';

$cliente = new cliente();
$listCliente = $cliente->listar();

$model=new conexion();
$con=$model->conectar();

// posicion de registro
$telefonobus = isset($_POST['telefono']) ? $_POST['telefono'] : null;

// llamamos al registro
$sql = "SELECT dniCliente, telefono, tipo, operador, tipoLinea from telefonos where telefono='$telefonobus'";

$resultado=mysqli_query($con,$sql);

// para saber el numero de filas
$filas = $resultado->num_rows;

$output=[];
$output['data']= '';

if ($filas>0) 
{
    while ($fila=mysqli_fetch_array($resultado)) 
    {
        // variables asignadas de la base de datos

        $telefono = $fila['telefono'];
        $tipo = $fila['tipo'];
        $operador = $fila['operador'];
        $tipoLinea = $fila['tipoLinea'];
        $dni = $fila['dniCliente'];

        $output['data'].= "<div class='form-floating mb-3 d-none'>";
        $output['data'].= "<input class='form-control' type='text' name='telefono' id='telefono' value='$telefono'>";
        $output['data'].= "<label for='telefono'>Telefono</label>";
        $output['data'].= "</div>";

        $output['data'].= "<div class='row text-center'>";

        $output['data'].= "<div class='col'>";
        $output['data'].= "<div class='card'>";
        $output['data'].= "<div class='card-body'>";        
        $output['data'].= "<p class='text-muted'>Telefono</p>";
        $output['data'].= "<h3 class='text-info'>$telefono</h3>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        
        $output['data'].= "</div>";

        $output['data'].= "<div class='form-floating mb-3'>";
        $output['data'].= "<select class='form-select form-select-sm' name='dni' id='dni'>"; 
        if ($listCliente != null) 
        {
            foreach ($listCliente as $c) 
            {
                if ($c[0] == $dni) 
                {
                    $output['data'] .= "<option selected hidden value='".$c[0]."'>".$c[1]."</option>";
                }
                else 
                {
                    $output['data'] .= "<option value='".$c[0]."'>".$c[1]."</option>";
                }
            }
        }
        $output['data'].= "</select>";
        $output['data'].= "<label for='dni'>DNI Cliente</label>";
        $output['data'].= "</div>";

        $output['data'].= "<div class='form-floating mb-3'>";
        $output['data'].= "<select class='form-select form-select-sm' name='tipo' id='tipo'>"; 
        if ($tipo === "0") 
        {
            $output['data'] .= "<option selected hidden value='0'>Tel. Fijo</option>";
            $output['data'] .= "<option value='1'>Tel. Movil</option>";
        }
        elseif ($tipo === "1") 
        {
            $output['data'] .= "<option selected hidden value='1'>Tel. Movil</option>";
            $output['data'] .= "<option value='0'>Tel. Fijo</option>";
        }
        else
        {
            $output['data'] .= "<option selected hidden value='-'>sin especificar</option>";
            $output['data'] .= "<option value='0'>Tel. Fijo</option>";
            $output['data'] .= "<option value='1'>Tel. Movil</option>";
        }
        $output['data'].= "</select>";
        $output['data'].= "<label for='tipo'>Tipo</label>";
        $output['data'].= "</div>";

        $output['data'].= "<div class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control' type='text' name='operador' id='operador' value='$operador'>";
        $output['data'].= "<label for='operador'>Operador</label>";
        $output['data'].= "</div>";
                
        if ($tipo == "1")
        {
            $output['data'].= "<div class='form-floating mb-3'>";
            $output['data'].= "<select class='form-select form-select-sm' name='tipoLinea' id='tipoLinea'>"; 
            if ($tipoLinea === "0") 
            {
                $output['data'] .= "<option selected hidden value='0'>Prepago</option>";
                $output['data'] .= "<option value='1'>Postpago</option>";
            }
            elseif ($tipoLinea === "1") 
            {
                $output['data'] .= "<option selected hidden value='1'>Postpago</option>";
                $output['data'] .= "<option value='0'>Prepago</option>";
            }
            else
            {
                $output['data'] .= "<option selected hidden value='-'>sin especificar</option>";
                $output['data'] .= "<option value='0'>Prepago</option>";
                $output['data'] .= "<option value='1'>Postpago</option>";
            }
            $output['data'].= "</select>";
            $output['data'].= "<label for='tipoLinea'>Tipo de Linea</label>";
            $output['data'].= "</div>";
        }
    }
}


echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>