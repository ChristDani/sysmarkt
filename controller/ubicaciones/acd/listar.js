let paginaActualacd = 1

getDataAcd(paginaActualacd)

document.getElementById('numRegistrosacd').addEventListener("change", function() {
    getDataAcd(paginaActualacd)
}, false)

function getDataAcd(pagina) {

    let depa = document.getElementById('busquedaacddepa').value
    let provi = document.getElementById('busquedaacdprovin').value
    let distri = document.getElementById('busquedaacddistri').value
    let select = document.getElementById('numRegistrosacd').value
    let contenido=document.getElementById('resultadosAcd')

    // console.log(region)
    // console.log(cac)
    // console.log(input)

    // le damos el origen de los datos
    let url='controller/ubicaciones/acd/listar.php';
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
        document.getElementById('munAcd').innerHTML = data.paginacion
    }).catch(err=>console.log(err))
}