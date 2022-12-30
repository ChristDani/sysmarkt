<?php
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


//Creamos el JSON
$json_string = json_encode($arr_clientes);
$file = 'clientes.json';
file_put_contents($file, $json_string);


//Leemos el JSON
$datos_clientes = file_get_contents("clientes.json");
$json_clientes = json_decode($datos_clientes, true);
echo $datos_clientes;
foreach ($json_clientes as $cliente) {
    
    echo $cliente."<br>";
}

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