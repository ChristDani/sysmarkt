<?php

$abecedario = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z','+','-','/',' '];
// $cadena = "Estos serian algunos numeros 12345, texto y simbolos !£$%^&";
// $cadena = "S/ 69.90 MAX ILIMITADO";
$cadena = "2 Play - Internet + Cable Superior S/ 150.00";

$dsjfsdf = ['asda', 'sadasd', 'hola'];
$jsjs = 'nuevo';

array_push($dsjfsdf, $jsjs);

for ($i = 0; $i < count($dsjfsdf); $i++)
{
    echo $dsjfsdf[$i]."<br>";
}

$arr_clientes = array('nombre'=> 'Jose', 'edad'=> '20', 'genero'=> 'masculino',
        'email'=> 'correodejose@dominio.com', 'localidad'=> 'Madrid', 'telefono'=> '91000000');


// //Creamos el JSON
// $json_string = json_encode($arr_clientes);
// $file = 'clientes.json';
// file_put_contents($file, $json_string);


// //Leemos el JSON
// $datos_clientes = file_get_contents("clientes.json");
// $json_clientes = json_decode($datos_clientes, true);
// echo $datos_clientes;
// foreach ($json_clientes as $cliente) {
    
//     echo $cliente."<br>";
// }

echo "<br>".str_replace($abecedario, '', substr($cadena,10));
echo "<br>".substr($cadena,10);

?>
<p id="toma"><?php echo $cadena;?></p>
<p id="mostra"></p>
<p id="mostra2"></p>

<script>
    let frase1 = document.getElementById('toma').textContent;
    let frase = frase1.substring(frase1.length - 10);
    let mostrar = document.getElementById('mostra');
    let mostrar2 = document.getElementById('mostra2');

    mostrar2.innerHTML = frase.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    mostrar.innerHTML = frase1.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
</script>


<!-- de comisiones -->














































































<?php
// $abecedario = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z','+','-','/',' '];
// $comisionTotalMovil = 0;
// $comisionTotalFija = 0;

// $porcentajeFija = 50;

// // planes
// $planeslist = new planes;
// $planesMov = $planeslist->listar();
// $planesFija = $planeslist->listarFija();

// if ($planesMov != null) 
// {
//     foreach ($planesMov as $pr) 
//     {
//         $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor=$dniUsuario and planR='".trim($pr[0])."' and estado='1'";
//         $resultado = mysqli_query($consulta,$sql);
//         $cantidad = $resultado->num_rows;

//         if ($cantidad >= 0 and $cantidad <= 10) 
//         {
//             $porcentajeMovil = 60;
//         }
//         elseif ($cantidad >= 11 and $cantidad <= 15) 
//         {
//             $porcentajeMovil = 80;
//         }
//         elseif ($cantidad >= 16 and $cantidad <= 20) 
//         {
//             $porcentajeMovil = 100;
//         }
//         elseif ($cantidad >= 21) 
//         {
//             $porcentajeMovil = 120;
//         }

//         $plan = str_replace($abecedario, '', $pr[0]);
//         $comi = ($plan*$cantidad)*($porcentajeMovil/100);
//         $comisionTotalMovil = $comisionTotalMovil+$comi;
//     }
// }
// if ($planesFija != null) 
// {
//     foreach ($planesFija as $pr) 
//     {
//         $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor=$dniUsuario and planFija='".trim($pr[0])."' and estado='1'";
//         $resultado = mysqli_query($consulta,$sql);
//         $cantidad = $resultado->num_rows;

//         $plan = str_replace($abecedario, '', substr($pr[0],10));
//         $comiF = ($plan*$cantidad)*($porcentajeFija/100);
//         $comisionTotalFija = $comisionTotalFija+$comiF;
//     }
// }

// $comisionTotal = $comisionTotalMovil+$comisionTotalFija;
?>
<!-- <div class="d-flex gap-3 align-items-start">
    <h1>Comisiones del Mes</h1>
    <input type="date" class="form-control-sm " name="fecharequerida" id="fecharequerida">
    <h1 class='success' id="comisionTotalMovil">S/ <?php //echo $comisionTotal; ?></h1>
</div>

<h1>Movil - <span class='success' id="comisionTotalMovil">S/ <?php //echo $comisionTotalMovil; ?></span></h1>
<div class="row mb-4">
    <?php
        // if ($planesMov != null) 
        // {
        //     foreach ($planesMov as $pr) 
        //     {
        //         $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor=$dniUsuario and planR='".trim($pr[0])."' and estado='1'";
        //         $resultado = mysqli_query($consulta,$sql);
        //         $cantidad = $resultado->num_rows;

        //         if ($cantidad >= 0 and $cantidad <= 10) 
        //         {
        //             $porcentajeMovil = 60;
        //         }
        //         elseif ($cantidad >= 11 and $cantidad <= 15) 
        //         {
        //             $porcentajeMovil = 80;
        //         }
        //         elseif ($cantidad >= 16 and $cantidad <= 20) 
        //         {
        //             $porcentajeMovil = 100;
        //         }
        //         elseif ($cantidad >= 21) 
        //         {
        //             $porcentajeMovil = 120;
        //         }

        //         $plan = str_replace($abecedario, '', $pr[0]);
        //         $comision = ($plan*$cantidad)*($porcentajeMovil/100);
                ?>
                <div class='col-xl-3 col-md-6'>
                <div class='card'>
                <div class='card-body'>
                <div class='head d-flex justify-content-around'>
                <p></p>
                <p><?php //echo $pr[0]; ?></p>
                <p></p>
                <p></p>
                <p></p>
                <p class="warning"><?php //echo $porcentajeMovil; ?>%</p>
                <p></p>
                </div>
                <div class='body'>
                <div class='row my-2'>
                <h4 class='text-center'><?php //echo $cantidad; ?></h4>
                </div>
                <div class='row text-center'>
                <div class='col'>
                <p></p>
                </div>
                <div class='col'>
                <p></p>
                </div>
                <div class='col'>
                <p></p>
                </div>
                </div>
                <div class='row text-center' style='border-top: 1px solid #b9b9b9;'>
                <p class='my-1 success'>S/ <?php //echo $comision; ?></p>
                </div>
                </div>
                </div>
                </div>
                </div>
    <?php   //}
        // }
    ?>
</div>

<h1>Fija - <span class='success' id="comisionTotalFija">S/ <?php //echo $comisionTotalFija; ?></span></h1>
<div class="row mb-4">
    <?php
        // if ($planesFija != null) 
        // {
        //     foreach ($planesFija as $pr) 
        //     {
        //         $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor=$dniUsuario and planFija='".trim($pr[0])."' and estado='1'";
        //         $resultado = mysqli_query($consulta,$sql);
        //         $cantidad = $resultado->num_rows;

        //         $plan = str_replace($abecedario, '', substr($pr[0],10));
        //         $comisionFija = ($plan*$cantidad)*($porcentajeFija/100);
                ?>
                <div class='col-xl-3 col-md-6'>
                <div class='card'>
                <div class='card-body'>
                <div class='head d-flex justify-content-around'>
                <p></p>
                <p><?php //echo $pr[0]; ?></p>
                <p></p>
                <p></p>
                <p></p>
                <p class="warning"><?php //echo $porcentajeFija; ?>%</p>
                <p></p>
                </div>
                <div class='body'>
                <div class='row my-2'>
                <h4 class='text-center'><?php //echo $cantidad; ?></h4>
                </div>
                <div class='row text-center'>
                <div class='col'>
                <p></p>
                </div>
                <div class='col'>
                <p></p>
                </div>
                <div class='col'>
                <p></p>
                </div>
                </div>
                <div class='row text-center' style='border-top: 1px solid #b9b9b9;'>
                <p class='my-1 success'>S/ <?php //echo $comisionFija; ?></p>
                </div>
                </div>
                </div>
                </div>
                </div>
    <?php   //}
        // }
    ?>
</div> -->