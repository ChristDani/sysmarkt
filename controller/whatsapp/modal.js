
// detalles

function abrirModalDetalle(codigo,tipo) {
    // obtenemos el div donde poner los datos
    let contenidoD = document.getElementById('detallesWhats');
    let btnedit = document.getElementById('btnEdit');
    btnedit.addEventListener("click", abrirModalEditar(codigo,tipo), false);
    
    //mandamos la posicion al controller
    let url = 'controller/whatsapp/detalle.php';
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
        }).catch(err => console.log(err))
}

// edicion

function abrirModalEditar(codigo,tipo) {
    // obtenemos el div donde poner los datos
    let contenidoD = document.getElementById('editarWhats');

    //mandamos la posicion al controller
    let url = 'controller/whatsapp/edit.php';
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
        }).catch(err => console.log(err))
}
