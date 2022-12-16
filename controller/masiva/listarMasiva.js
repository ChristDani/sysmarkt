let paginaActualM = 1

getDataM(paginaActualM)

document.getElementById('numRegistrosM').addEventListener("change", function() {
    getDataM(paginaActualM)
}, false)

function getDataM(pagina) {

    let depa = document.getElementById('busquedadepartamentoM').value
    let provi = document.getElementById('busquedaprovinciaM').value
    let distri = document.getElementById('busquedadistritoM').value
    let select = document.getElementById('numRegistrosM').value
    let contenido=document.getElementById('resultadosM')
    // verificar si trae los valores

    // console.log(input)
    // console.log(select)
    // console.log(pagina)

    // para mantener la pagina al cambiar el limite de datos
    // if (pagina != null) {
    //     paginaActualM = pagina
    // }

    // le damos el origen de los datos
    let url='controller/masiva/listar.php';
    let formaData = new FormData()
    formaData.append('busquedadepa', depa)
    formaData.append('busquedaprovi', provi)
    formaData.append('busquedadistri', distri)
    formaData.append('registros', select)
    formaData.append('pagina', pagina)
    // para mantener la pagina al cambiar el limite de datos
    // formaData.append('pagina', paginaActualM)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenido.innerHTML=data.data
        document.getElementById('munM').innerHTML = data.paginacion
    }).catch(err=>console.log(err))
}