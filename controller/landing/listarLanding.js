let paginaActualL = 1

getDataL(paginaActualL)

document.getElementById('numRegistrosL').addEventListener("change", function() {
    getDataL(paginaActualL)
}, false)

function getDataL(pagina) {

    let input = document.getElementById('busquedaL').value
    let select = document.getElementById('numRegistrosL').value
    let contenido=document.getElementById('resultadosL')
    // verificar si trae los valores

    // console.log(input)
    // console.log(select)
    // console.log(pagina)

    // le damos el origen de los datos
    let url='controller/landing/listar.php';
    let formaData = new FormData()
    formaData.append('busqueda', input)
    formaData.append('registros', select)
    formaData.append('pagina', pagina)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenido.innerHTML=data.data
        document.getElementById('msgL').innerHTML = data.mensaje
        document.getElementById('munL').innerHTML = data.paginacion
    }).catch(err=>console.log(err))
}