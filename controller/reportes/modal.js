
function mostrardetallesreportesmes(codigo) {
    // obtenemos el div donde poner los datos
    let contenidoD = document.getElementById('detallesReportesMes')

    //mandamos la posicion al controller
    let url='controller/reportes/detalle.php';
    let formaData = new FormData()
    formaData.append('codigo', codigo)

    // traemos los datos del controller
    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenidoD.innerHTML=data.data
    }).catch(err=>console.log(err))
}

function cerrarModalDetalle() {
    modal.classList.toggle("modalClose");
    setTimeout(function () {
        contenedorModal.style.display='none';        
    }, 200)
}
