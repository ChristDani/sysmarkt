let dni = document.getElementById('dniusuarioparaloscambiosdeestadoXD').textContent;
let estado = document.getElementById('estadousuarioparaloscambiosdeestadoXD').textContent;

console.log(dni,estado);

window.BeforeUnloadEvent = desconectarusuario(dni)
// document.documentElement.addEventListener('onunload', ausentarusuario(dni))
document.documentElement.addEventListener('onload', conectarusuario(dni, estado))

function desconectarusuario(dni) 
{
    // alert('sadasdads');
    let tipo = "3";

    let url='controller/usuario/estadoautomatico.php';
    let formaData = new FormData()
    formaData.append('dni', dni)
    formaData.append('tipo', tipo)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        console.log(data);
    }).catch(err=>console.log(err))
}

function conectarusuario(dni, estado) 
{
    if (estado != 1 && estado != 3) 
    {
        let tipo = "1";

        let url='controller/usuario/estadoautomatico.php';
        let formaData = new FormData()
        formaData.append('dni', dni)
        formaData.append('tipo', tipo)

        fetch(url,{
            method: "POST",
            body: formaData
        }).then(response=>response.json())
        .then(data=>{
            console.log(data);
        }).catch(err=>console.log(err))
    }
    else
    {
        console.log("Usuario Presente.");
    }
}

function ausentarusuario(dni) 
{
    let tipo = 2;

    let url='controller/usuario/estadoautomatico.php';
    let formaData = new FormData()
    formaData.append('dni', dni)
    formaData.append('tipo', tipo)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        console.log(data);
    }).catch(err=>console.log(err))
}
