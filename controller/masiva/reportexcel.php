<?php
require_once '../../model/conexion.php';

$conexion = new conexion();
$con = $conexion->conectar();

$columnas=['documento', 'nombre', 'tel_Fijo', 'celular', 'fechaActivacion', 'operador', 'tipo_plan', 'direccion', 'distrito', 'provincia', 'departamento', 'fechaRegistro'];
$tabla='masiva';
$where='';

$busquedaconsultareportedepamasiva = $_POST['busquedareportedepartamentomasiva'];
$busquedaconsultareporteprovimasiva = $_POST['busquedareporteprovinciamasiva'];
$busquedaconsultareportedistrimasiva = $_POST['busquedareportedistritomasiva'];

$name = "";
if ($busquedaconsultareportedepamasiva != null) {
    $name = "-".$busquedaconsultareportedepamasiva;
    if ($busquedaconsultareporteprovimasiva != null) {
        $name = "-".$busquedaconsultareportedepamasiva."-".$busquedaconsultareporteprovimasiva;        
        if ($busquedaconsultareportedistrimasiva != null) {
            $name = "-".$busquedaconsultareportedepamasiva."-".$busquedaconsultareporteprovimasiva."-".$busquedaconsultareportedistrimasiva;        
        }
    }
    elseif ($busquedaconsultareportedistrimasiva != null) {
        $name = "-".$busquedaconsultareportedepamasiva."-".$busquedaconsultareportedistrimasiva;    
    }
}
elseif ($busquedaconsultareporteprovimasiva != null and $busquedaconsultareportedepamasiva == null) {
    $name = "-".$busquedaconsultareporteprovimasiva;    
    if ($busquedaconsultareportedistrimasiva != null) {
        $name = "-".$busquedaconsultareporteprovimasiva."-".$busquedaconsultareportedistrimasiva;    
    }
}
elseif ($busquedaconsultareportedistrimasiva !=null and $busquedaconsultareportedepamasiva == null and $busquedaconsultareporteprovimasiva == null) {
    $name = "-".$busquedaconsultareportedistrimasiva;
}

if (isset($_POST['btngenerarreportemasiva'])) 
{
    // nombre del archivo
    header('Content-Type:text/csv; charset=latin1');
    header('Content-Disposition: attachment; filename="Reporte-Masiva'.$name.'.csv"');

    // salida de archivo
    $salida = fopen('php://output', 'w');
    // encabezados
    fputcsv($salida, array('documento', 'nombre', 'tel_Fijo', 'celular', 'fechaActivacion', 'operador', 'tipo_plan', 'direccion', 'distrito', 'provincia', 'departamento', 'fechaRegistro'));
    // consulta para crear el reporte
    if ($busquedaconsultareportedepamasiva != null) {
        $where .= "where departamento like '%".$busquedaconsultareportedepamasiva."%'";
        if ($busquedaconsultareporteprovimasiva != null) {
            $where .= " and provincia like '%".$busquedaconsultareporteprovimasiva."%'";
            if ($busquedaconsultareportedistrimasiva != null) {
                $where .= " and distrito like '%".$busquedaconsultareportedistrimasiva."%'";
            }
        }
        elseif ($busquedaconsultareportedistrimasiva != null) {
            $where .= " and distrito like '%".$busquedaconsultareportedistrimasiva."%'";
        }
    }
    elseif ($busquedaconsultareporteprovimasiva != null and $busquedaconsultareportedepamasiva == null) {
        $where .= "where provincia like '%".$busquedaconsultareporteprovimasiva."%'";
        if ($busquedaconsultareportedistrimasiva != null) {
            $where .= " and distrito like '%".$busquedaconsultareportedistrimasiva."%'";
        }
    }
    elseif ($busquedaconsultareportedistrimasiva !=null and $busquedaconsultareportedepamasiva == null and $busquedaconsultareporteprovimasiva == null) {
        $where .= "where distrito like '%".$busquedaconsultareportedistrimasiva."%'";
    }

    $sql = "select ".implode(", ", $columnas)." from $tabla $where order by documento desc";
    $reportecsv = mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($reportecsv))
    {
        $fechaac = date('d/m/y', strtotime($row['fechaActivacion']));
        $fecha = date('d/m/y', strtotime($row['fechaRegistro']));
        fputcsv($salida, array($row['documento'],
                                $row['nombre'],
                                $row['tel_Fijo'],
                                $row['celular'],
                                $fechaac,
                                $row['operador'],
                                $row['tipo_plan'],
                                $row['direccion'],
                                $row['distrito'],
                                $row['provincia'],
                                $row['departamento'],
                                $fecha));
    }
}
?>