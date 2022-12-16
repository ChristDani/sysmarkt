let paginaActualdac = 1

getDataDac(paginaActualdac)

document.getElementById('numRegistrosdac').addEventListener("change", function() {
    getDataDac(paginaActualdac)
}, false)

function getDataDac(pagina) {

    let depa = document.getElementById('busquedadacdepa').value
    let provi = document.getElementById('busquedadacprovin').value
    let distri = document.getElementById('busquedadacdistri').value
    let select = document.getElementById('numRegistrosdac').value
    let contenido=document.getElementById('resultadosDac')

    // console.log(region)
    // console.log(cac)
    // console.log(input)

    // le damos el origen de los datos
    let url='controller/ubicaciones/dac/listar.php';
    let formaData = new FormData()
    formaData.append('busdepa', depa)
    formaData.append('busprovi', provi)
    formaData.append('busdistri', distri)
    formaData.append('registros', select)
    formaData.append('pagina', pagina)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenido.innerHTML=data.data
        document.getElementById('munDac').innerHTML = data.paginacion
    }).catch(err=>console.log(err))
}