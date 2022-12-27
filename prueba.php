<?php
// $cadena = "Estos serian algunos numeros 12345, texto y simbolos !£$%^&";
$cadena = "S/ 69.90 MAX ILIMITADO";
?>
<p id="toma"><?php echo $cadena;?></p>
<p id="mostra"></p>

<script>
    let frase = document.getElementById('toma').textContent;
    let mostrar = document.getElementById('mostra');

    mostrar.innerHTML = frase.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
</script>