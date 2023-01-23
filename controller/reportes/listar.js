let paginaActualRM = 1

getDataRM(paginaActualRM);
ponerasesores();

document.getElementById('fecharequerida').addEventListener("change", function() {
    getDataRM(paginaActualRM)
}, false)

document.getElementById('numRegistrosRM').addEventListener("change", function() {
    getDataRM(paginaActualRM)
    ahsdgjahdgasd()
}, false)


document.getElementById('busquedaestadoRM').addEventListener("change", function() {
    getDataRM(paginaActualRM)
    ahsdgjahdgasd()
}, false)

document.getElementById('busquedaxasesormetas').addEventListener("change", function() {
    getDataRM(paginaActualRM)
    ahsdgjahdgasd()
}, false)

document.getElementById('busquedaxmoderadormetas').addEventListener("change", function() {
    getDataRM(paginaActualRM);
    ahsdgjahdgasd();
    ponerasesores();
}, false)

function getDataRM(pagina) 
{
    let vt = document.getElementById('vt')
    let vc = document.getElementById('vc')
    let vp = document.getElementById('vp')
    let vr = document.getElementById('vr')
    let graficosfeos = document.getElementById('graficosfeos')
    let fecha = document.getElementById('fecharequerida').value
    let input = document.getElementById('busquedaRM').value
    let estado = document.getElementById('busquedaestadoRM').value
    let asesor = document.getElementById('busquedaxasesormetas').value
    let moderador = document.getElementById('busquedaxmoderadormetas').value
    let select = document.getElementById('numRegistrosRM').value
    let contenido=document.getElementById('resultadosRM')

    // le damos el origen de los datos
    let url='controller/reportes/listar.php';
    let formaData = new FormData()
    formaData.append('fecha', fecha)
    formaData.append('busqueda', input)
    formaData.append('busestate', estado)
    formaData.append('busasesormet', asesor)
    formaData.append('busmoderadormet', moderador)
    formaData.append('registros', select)
    formaData.append('pagina', pagina)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenido.innerHTML=data.data
        vt.innerHTML=data.vt
        vc.innerHTML=data.vc
        vp.innerHTML=data.vp
        vr.innerHTML=data.vr
        graficosfeos.innerHTML=data.graficosfeos
        document.getElementById('munRM').innerHTML = data.paginacion
    }).catch(err=>console.log(err))
}

function ahsdgjahdgasd()
{
    setTimeout(() => {
        let vt = document.getElementById('vt').textContent;
        let vc = document.getElementById('vc').textContent;
        let vp = document.getElementById('vp').textContent;
        let vr = document.getElementById('vr').textContent;
      
        graficobarra(vt,vc,vp,vr);  
        graficopie(vc,vp,vr);
      }, 500);
}

function ponerasesores() 
{
    let asesor = document.getElementById('busquedaxasesormetas')
    let moderador = document.getElementById('busquedaxmoderadormetas').value

    // le damos el origen de los datos
    let url='controller/reportes/asesores.php';
    let formaData = new FormData()
    formaData.append('moderador', moderador)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        asesor.innerHTML=data.data
    }).catch(err=>console.log(err))
}