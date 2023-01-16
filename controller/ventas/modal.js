
// detalles

function abrirModalDetalle(codigo,tipo) 
{
    // obtenemos el div donde poner los datos
    let contenidoD = document.getElementById('detallesVenta');
    let contenidoF = document.getElementById('fechaDetalle');
    
    //mandamos la posicion al controller
    let url = 'controller/ventas/detalle.php';
    let formaData = new FormData();
    formaData.append('codigo', codigo)
    formaData.append('tipoUser', tipo)

    // traemos los datos del controller
    fetch(url, {
        method: "POST",
        body: formaData
    }).then(response => response.json())
        .then(data => {
            contenidoD.innerHTML = data.data
            contenidoF.innerHTML = data.fecha
        }).catch(err => console.log(err))
}

// edicion

function abrirModalEditar(codigo) 
{
    // obtenemos el div donde poner los datos
    let contenidoD = document.getElementById('formularioeditarVentas');

    //mandamos la posicion al controller
    let url = 'controller/ventas/edit.php';
    let formaData = new FormData();
    formaData.append('codigo', codigo)

    // traemos los datos del controller
    fetch(url, {
        method: "POST",
        body: formaData
    }).then(response => response.json())
    .then(data => {
        contenidoD.innerHTML = data.data
    }).catch(err => console.log(err))
}
