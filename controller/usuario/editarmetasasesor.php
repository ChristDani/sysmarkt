<?php
require_once "../../model/metas.php";

$metas = new metas();

$dnimetasasesor= isset($_POST['dni']) ? $_POST['dni'] : null;

$listaMetasasesor = $metas->listarAsesor($dnimetasasesor);

$output=[];
$output['data']= '';

if ($listaMetasasesor != null) 
{
    foreach ($listaMetasasesor as $m) 
    {
        $editasesorportamen69 = trim($m[1]);
        $editasesorportamay69 = trim($m[2]);
        $editasesoraltapost = trim($m[3]);
        $editasesoraltaprepa = trim($m[4]);
        $editasesorportaprepa = trim($m[5]);
        $editasesorrenovacion = trim($m[6]);
        $editasesorhfc_ftth = trim($m[7]);
        $editasesorifi = trim($m[8]);
    }

    $output['data'].= "<input hidden type='text' name='dni' id='dni' value='$dnimetasasesor'>";

    $output['data'].= "<div class='form-floating mb-3'>";
    $output['data'].= "<input class='form-control' placeholder='Portabilidad menor a 69' autocomplete='off' oninput='this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');' maxlength='3' type='text' name='portamen69' id='portamen69' value='$editasesorportamen69'>";
    $output['data'].= "<label for='portamen69'>Portabilidad menor a 69</label>";
    $output['data'].= "</div>";
    $output['data'].= "<div class='form-floating mb-3'>";
    $output['data'].= "<input class='form-control' placeholder='Portabilidad mayor a 69' autocomplete='off' oninput='this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');' maxlength='3' type='text' name='portamay69' id='portamay69' value='$editasesorportamay69'>";
    $output['data'].= "<label for='portamay69'>Portabilidad mayor a 69</label>";
    $output['data'].= "</div>";
    $output['data'].= "<div class='form-floating mb-3'>";
    $output['data'].= "<input class='form-control' placeholder='Alta Postpago' autocomplete='off' oninput='this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');' maxlength='3' type='text' name='altapost' id='altapost' value='$editasesoraltapost'>";
    $output['data'].= "<label for='altapost'>Alta Postpago</label>";
    $output['data'].= "</div>";
    $output['data'].= "<div class='form-floating mb-3'>";
    $output['data'].= "<input class='form-control' placeholder='Alta Prepago' autocomplete='off' oninput='this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');' maxlength='3' type='text' name='altaprepa' id='altaprepa' value='$editasesoraltaprepa'>";
    $output['data'].= "<label for='altaprepa'>Alta Prepago</label>";
    $output['data'].= "</div>";
    $output['data'].= "<div class='form-floating mb-3'>";
    $output['data'].= "<input class='form-control' placeholder='Portabilidad Prepago' autocomplete='off' oninput='this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');' maxlength='3' type='text' name='portaprepa' id='portaprepa' value='$editasesorportaprepa'>";
    $output['data'].= "<label for='portaprepa'>Portabilidad Prepago</label>";
    $output['data'].= "</div>";
    $output['data'].= "<div class='form-floating mb-3'>";
    $output['data'].= "<input class='form-control' placeholder='Renovacion' autocomplete='off' oninput='this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');' maxlength='3' type='text' name='renovacion' id='renovacion' value='$editasesorrenovacion'>";
    $output['data'].= "<label for='renovacion'>Renovacion</label>";
    $output['data'].= "</div>";
    $output['data'].= "<div class='form-floating mb-3'>";
    $output['data'].= "<input class='form-control' placeholder='HFC_FTTH' autocomplete='off' oninput='this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');' maxlength='3' type='text' name='hfc_ftth' id='hfc_ftth' value='$editasesorhfc_ftth'>";
    $output['data'].= "<label for='hfc_ftth'>HFC, FTTH</label>";
    $output['data'].= "</div>";
    $output['data'].= "<div class='form-floating mb-3'>";
    $output['data'].= "<input class='form-control' placeholder='IFI' autocomplete='off' oninput='this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');' maxlength='3' type='text' name='ifi' id='ifi' value='$editasesorifi'>";
    $output['data'].= "<label for='ifi'>IFI</label>";
    $output['data'].= "</div>";
}

echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>