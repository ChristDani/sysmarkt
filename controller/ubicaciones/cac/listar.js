let paginaActualcac = 1

getDataCac(paginaActualcac)

document.getElementById('numRegistroscac').addEventListener("change", function() {
    getDataCac(paginaActualcac)
}, false)

function getDataCac(pagina) {

    let depa = document.getElementById('busquedacacdepa').value
    let provi = document.getElementById('busquedacacprovin').value
    let distri = document.getElementById('busquedacacdistri').value
    let select = document.getElementById('numRegistroscac').value
    let contenido=document.getElementById('resultadosCac')

    // console.log(region)
    // console.log(cac)
    // console.log(input)

    // le damos el origen de los datos
    let url='controller/ubicaciones/cac/listar.php';
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
        document.getElementById('munCac').innerHTML = data.paginacion
    }).catch(err=>console.log(err))
}