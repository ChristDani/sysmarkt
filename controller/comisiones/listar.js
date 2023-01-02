
getComision()

document.getElementById('fechacomision').addEventListener("change", function() {
    getComision()
}, false)

function getComision() {

    let fecha = document.getElementById('fechacomision').value
    let dniasesor = document.getElementById('dniasesor').value
    let tipoasesor = document.getElementById('tipoasesor').value
    let contenido1=document.getElementById('contenidoMovilComision')
    let contenido2=document.getElementById('contenidoFijaComision')
    let comiTotal=document.getElementById('comisionTotal')
    let comiMovil=document.getElementById('comisionTotalMovil')
    let comiFija=document.getElementById('comisionTotalFija')
    let c1mes=document.getElementById('comision1mes')
    let c3meses=document.getElementById('comision3meses')
    
    // console.log(fecha)

    // le damos el origen de los datos
    let url='controller/comisiones/listar.php';
    let formaData = new FormData()
    formaData.append('fecha', fecha)
    if (tipoasesor != 1) 
    {
        formaData.append('dniasesor', dniasesor)
    }

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenido1.innerHTML=data.movil
        contenido2.innerHTML=data.fija
        comiTotal.innerHTML=data.comiTotal
        comiMovil.innerHTML=data.comiMovil
        comiFija.innerHTML=data.comiFija
        c1mes.innerHTML=data.c1mes
        c3meses.innerHTML=data.c3meses
    }).catch(err=>console.log(err))
}

function detalles(tipo) {

    let fecha = document.getElementById('fechacomision').value
    let dniasesor = document.getElementById('dniasesor').value
    let tipoasesor = document.getElementById('tipoasesor').value
    let contenido=document.getElementById('detallesComi')
    let letrero=document.getElementById('tipocomi')
    let letrero2=document.getElementById('cantcomi')

    if (tipo == 'lne') 
    {
        letrero.innerHTML = 'Linea Nueva Con Equipo'
    }
    else if (tipo == 'ln') 
    {
        letrero.innerHTML = 'Linea Nueva Sin Equipo'
    }
    else if (tipo == 'pe') 
    {
        letrero.innerHTML = 'Portabilidad Con Equipo'
    }
    else if (tipo == 'p') 
    {
        letrero.innerHTML = 'Portabilidad Sin Equipo'
    }
    else if (tipo == 'r') 
    {
        letrero.innerHTML = 'Renovación'
    }
    
    // console.log(fecha)

    // le damos el origen de los datos
    let url='controller/comisiones/detalles.php';
    let formaData = new FormData()
    formaData.append('fecha', fecha)
    formaData.append('tipo', tipo)
    if (tipoasesor != 1) 
    {
        formaData.append('dniasesor', dniasesor)
    }

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenido.innerHTML=data.data
        letrero2.innerHTML=data.total
    }).catch(err=>console.log(err))
}