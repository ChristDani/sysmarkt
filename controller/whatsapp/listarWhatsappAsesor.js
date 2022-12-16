let paginaActualW = 1

getDataW(paginaActualW)

document.getElementById('numRegistrosW').addEventListener("change", function() {
    getDataW(paginaActualW)
}, false)

document.getElementById('busquedaestadowhats').addEventListener("change", function() {
    getDataW(paginaActualW)
}, false)

function getDataW(pagina) {

    let input = document.getElementById('busquedaW').value
    let select = document.getElementById('numRegistrosW').value
    let estado = document.getElementById('busquedaestadowhats').value
    let dniAsesor = document.getElementById('dniAsesor').value
    let tipoUser = document.getElementById('tipoUser').value
    let contenido=document.getElementById('resultadosW')

    // le damos el origen de los datos
    let url='controller/whatsapp/listarAsesor.php';
    let formaData = new FormData()
    formaData.append('busqueda', input)
    formaData.append('registros', select)
    formaData.append('dniAsesor', dniAsesor)
    formaData.append('busestate', estado)
    formaData.append('pagina', pagina)
    formaData.append('tipoUser', tipoUser)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenido.innerHTML=data.data
        document.getElementById('munW').innerHTML = data.paginacion
    }).catch(err=>console.log(err))
}
