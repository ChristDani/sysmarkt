let paginaActualcade = 1

getDataCade(paginaActualcade)

document.getElementById('numRegistroscade').addEventListener("change", function() {
    getDataCade(paginaActualcade)
}, false)

function getDataCade(pagina) {

    let depa = document.getElementById('busquedacadedepa').value
    let provi = document.getElementById('busquedacadeprovin').value
    let distri = document.getElementById('busquedacadedistri').value
    let select = document.getElementById('numRegistroscade').value
    let contenido=document.getElementById('resultadosCade')

    // console.log(region)
    // console.log(cac)
    // console.log(input)

    // le damos el origen de los datos
    let url='controller/ubicaciones/cadena/listar.php';
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
        document.getElementById('munCade').innerHTML = data.paginacion
    }).catch(err=>console.log(err))
}