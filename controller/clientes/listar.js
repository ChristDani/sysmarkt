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

function abrirModalEditarcliente(dni) 
{
    let contenido = document.getElementById('formularioeditarcliente');

    // le damos el origen de los datos
    let url='controller/clientes/editcliente.php';
    let formaData = new FormData()
    formaData.append('dni', dni)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenido.innerHTML=data.data
    }).catch(err=>console.log(err))
}

function abrirModalEditartelefono(telefono) 
{
    let contenido = document.getElementById('formularioeditartelefono');

    // le damos el origen de los datos
    let url='controller/clientes/edittelefono.php';
    let formaData = new FormData()
    formaData.append('telefono', telefono)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenido.innerHTML=data.data
    }).catch(err=>console.log(err))
}

function abrirModaleliminar(tipo,codigo,name) 
{
    let contenido = document.getElementById('textodeeliminacion');
    let tipoam = document.getElementById('tipo');
    let codigoam = document.getElementById('codigo');

    tipoam.value=tipo;
    codigoam.value=codigo;
    if (tipo == "0") 
    {
        contenido.innerHTML="al cliente \'<span class='text-info'>"+name+"</span>\'?";
    }
    else if (tipo == "1") 
    {
        contenido.innerHTML="el telefono \'<span class='text-info'>"+codigo+"</span>\'?";
    }
}
