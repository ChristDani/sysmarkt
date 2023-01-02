
getComision()

document.getElementById('fechacomision').addEventListener("change", function() {
    getComision()
}, false)

function getComision() {

    let fecha = document.getElementById('fechacomision').value
    let dniasesor = document.getElementById('dniasesor').value
    let tipoasesor = document.getElementById('tipoasesor').value
    let contenido1=document.getElementById('contenidoMovilComision')
    let contenido2=document.getElementById('contenidoFijaComision')

    console.log(fecha)

    // le damos el origen de los datos
    let url='controller/comisiones/listar.php';
    let formaData = new FormData()
    formaData.append('fecha', fecha)
    if (tipoasesor != 1) 
    {
        console.log('sadfas');
        formaData.append('dniasesor', dniasesor)
    }

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenido1.innerHTML=data.movil
        contenido2.innerHTML=data.fija
    }).catch(err=>console.log(err))
}