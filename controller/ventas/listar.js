let paginaActualVenta = 1

getDataVentas(paginaActualVenta)

document.getElementById('numRegistrosVenta').addEventListener("change", function() {
    getDataVentas(paginaActualVenta)
}, false)

document.getElementById('busquedaestadoventa').addEventListener("change", function() {
    getDataVentas(paginaActualVenta)
}, false)

document.getElementById('busquedaxasesor').addEventListener("change", function() {
    getDataVentas(paginaActualVenta)
}, false)

document.getElementById('busquedaVenta').addEventListener("change", function() {
    getDataVentas(paginaActualVenta)
}, false)

function getDataVentas(pagina) {

    let input = document.getElementById('busquedaVentaSec').value
    let cliente = document.getElementById('busquedaVenta').value
    let select = document.getElementById('numRegistrosVenta').value
    let estado = document.getElementById('busquedaestadoventa').value
    let asesor = document.getElementById('busquedaxasesor').value
    let tipoAsesor = document.getElementById('tipoasesor').value
    let dniAsesor = document.getElementById('dniAsesor').value
    let contenido = document.getElementById('resultadosVenta')

    // le damos el origen de los datos
    let url='controller/ventas/listar.php';
    let formaData = new FormData()
    formaData.append('sec', input)
    formaData.append('cliente', cliente)
    formaData.append('registros', select)
    formaData.append('estado', estado)
    formaData.append('asesor', asesor)
    formaData.append('tipoAsesor', tipoAsesor)
    if (tipoAsesor == 3)
    {
        formaData.append('dniAsesor', dniAsesor)
    }
    else if (tipoAsesor == 2)
    {
        // formaData.append('dniAsesor', dniAsesor)
        formaData.append('dniModerador', dniAsesor)
    }
    formaData.append('pagina', pagina)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenido.innerHTML=data.data
        document.getElementById('munVenta').innerHTML = data.paginacion
    }).catch(err=>console.log(err))
}
