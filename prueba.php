<a href="#" onclick="mostrarXD();">prueba</a>
<div id="pruebaleter"></div>
<script>
    let lista = ["hosl"];
    function mostrarXD() 
    {
        console.log(lista.length);
        document.getElementById('pruebaleter').innerHTML = lista;
    }
</script>


<?php
for ($i = 0; $i <= 30; $i++)
{
    echo "<br>";
}
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