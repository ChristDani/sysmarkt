
function mostrarAgregarFija()
{
    document.getElementById('contenidoagregarplan').classList.remove('d-none');
    document.getElementById('contenidoeditarplan').classList.add('d-none');
} 

function ocultarAgregarFija()
{
    document.getElementById('contenidoagregarplan').classList.add('d-none');
} 

function mostrarEdicionFija(code,plan)
{
    document.getElementById('contenidoeditarplan').classList.remove('d-none');
    document.getElementById('contenidoagregarplan').classList.add('d-none');
    document.getElementById('codigoFija').value = code;
    document.getElementById('planeditFija').value = plan;
    document.getElementById('planeditFijaactual').value = plan;
} 

function ocultarEdicionFija()
{
    document.getElementById('contenidoeditarplan').classList.add('d-none');
}

function listarFija() 
{
    let contenido = document.getElementById('contenidoFija');

    let url='controller/planes/listarFija.php';
    let formaData = new FormData()

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        contenido.innerHTML = data.data;
    }).catch(err=>console.log(err))
}

function agregarplanFija() 
{
    let plan = document.getElementById('planFija').value;

    let url='controller/planes/agregarFija.php';
    let formaData = new FormData()
    formaData.append('plan', plan)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        console.log(data);
    }).catch(err=>console.log(err))

    setTimeout(() => {
        listarFija();
    }, 200);
    
    document.getElementById('contenidoagregarplan').classList.add('d-none');
}

function editarplanFija() 
{
    let code = document.getElementById('codigoFija').value;
    let plan = document.getElementById('planeditFija').value;
    let planactual = document.getElementById('planeditFijaactual').value;

    let url='controller/planes/editarFija.php';
    let formaData = new FormData()
    formaData.append('code', code)
    formaData.append('plan', plan)
    formaData.append('planactual', planactual)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        console.log(data);
    }).catch(err=>console.log(err))
    
    setTimeout(() => {
        listarFija();
    }, 200);
    
    document.getElementById('contenidoeditarplan').classList.add('d-none');
}



function eliminarplan(tipo,code,plan) 
{
    if (tipo == 0) 
    {
        document.getElementById('botondevolveralosplanes').innerHTML="<div class='btn btn-secondary' data-bs-target='#planesFija' data-bs-toggle='modal'>Volver</div>";
        document.getElementById('botoneliminarplan').innerHTML="<button class='btn btn-danger' onclick='yadeunavezplan(\""+tipo+"\",\""+code+"\",\""+plan+"\");' data-bs-target='#planesFija' data-bs-toggle='modal'>Eliminar</button>";
    }
    else if (tipo == 1) 
    {
        document.getElementById('botondevolveralosplanes').innerHTML="<div class='btn btn-secondary' data-bs-target='#planesMoviles' data-bs-toggle='modal'>Volver</div>";
        document.getElementById('botoneliminarplan').innerHTML="<button class='btn btn-danger' onclick='yadeunavezplan(\""+tipo+"\",\""+code+"\",\""+plan+"\");' data-bs-target='#planesMoviles' data-bs-toggle='modal'>Eliminar</button>";
    }
    document.getElementById('nombreplanEliminar').innerHTML=plan;
}

function yadeunavezplan(tipo,code,plan)
{
    let url='controller/planes/eliminarplan.php';
    let formaData = new FormData()
    formaData.append('tipo', tipo)
    formaData.append('code', code)
    formaData.append('plan', plan)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        console.log(data);
    }).catch(err=>console.log(err))
    
    setTimeout(() => {
        listarFija();
    }, 200);
}