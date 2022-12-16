<?php

$dni = isset($_POST['dni']) ? $_POST['dni'] : '73179455';

$linkdni = "https://dniruc.apisperu.com/api/v1/dni/$dni?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9saXZlcmRnMkBob3RtYWlsLmNvbSJ9.pnGANDWZM-k_JFQGPowjSinW949B3bfeqN-DIp9Fe_o";

$datos = json_decode(file_get_contents($linkdni), true);

$output[] = '';
$output['data'] = $datos;

echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>