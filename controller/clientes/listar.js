let paginaActualClientes = 1

getDataClientes(paginaActualClientes)

document.getElementById('numRegistrosClientes').addEventListener("change", function() {
    getDataClientes(paginaActualClientes)
}, false)

function getDataClientes(pagina) 
{
    let input = document.getElementById('busquedaCliente').value
    let select = document.getElementById('numRegistrosClientes').value
    let contenido = document.getElementById('resultadosClientes')

    // le damos el origen de los datos
    let url='controller/clientes/listar.php';
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
        document.getElementById('munClientes').innerHTML = data.paginacion
    }).catch(err=>console.log(err))
}

function detallecliente(dni) 
{
    let tipouser = document.getElementById('tipouser').value;
    let contenido = document.getElementById('detallesCliente');
    let contenidoF = document.getElementById('fechaDetalleCL');

    // le damos el origen de los datos
    let url='controller/clientes/detalle.php';
    let formaData = new FormData()
    formaData.append('dni', dni)
    formaData.append('tipouser', tipouser)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenido.innerHTML=data.data
        contenidoF.innerHTML = data.fecha
    }).catch(err=>console.log(err))
}
