let paginaActualE = 1

getDataE(paginaActualE)

document.getElementById('numRegistrosE').addEventListener("change", function() {
    getDataE(paginaActualE)
}, false)

document.getElementById('busquedaER').addEventListener("change", function() {
    getDataE(paginaActualE)
}, false)

function getDataE(pagina) {

    let region = document.getElementById('busquedaER').value
    let cac = document.getElementById('busquedaEC').value
    let input = document.getElementById('busquedaE').value
    let select = document.getElementById('numRegistrosE').value
    let contenido=document.getElementById('resultadosE')

    // console.log(region)
    // console.log(cac)
    // console.log(input)

    // le damos el origen de los datos
    let url='controller/equipos/listar.php';
    let formaData = new FormData()
    formaData.append('BusReg', region)
    formaData.append('busCac', cac)
    formaData.append('busqueda', input)
    formaData.append('registros', select)
    formaData.append('pagina', pagina)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenido.innerHTML=data.data
        document.getElementById('munE').innerHTML = data.paginacion
    }).catch(err=>console.log(err))
}