function arreglarnombreprimeruser()
{
    let dni = document.getElementById('dniprimiruser');
    let nombre = document.getElementById('nombreprimeruser');
    let muestranombre = document.getElementById('mostrarnameprimeruser');

    if (dni.value.length == 8) 
    { 
        let url='controller/arreglarnombre.php';
        let formaData = new FormData()
        formaData.append('dni', dni.value)

        fetch(url,{
            method: "POST",
            body: formaData
        }).then(response=>response.json())
        .then(data=>{
            nombre.value=data.data.nombres+" "+data.data.apellidoPaterno+" "+data.data.apellidoMaterno;
            muestranombre.innerHTML=data.data.nombres+" "+data.data.apellidoPaterno+" "+data.data.apellidoMaterno;
        }).catch(err=>console.log(err))
    }
}

function agregarprimerusuario()
{
    let dni = document.getElementById('dniprimiruser').value;
    let nombre = document.getElementById('nombreprimeruser').value;

    // le damos el origen de los datos
    let url='controller/empresa/primeruser.php';
    let formaData = new FormData()
    formaData.append('dni', dni)
    formaData.append('nombre', nombre)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        console.log(data);
    }).catch(err=>console.log(err))

    if (dni.length == 8 && nombre != null) 
    {
        cambio(1);
    }
    else
    {
        alert('Campos incompletos o vacios');
    }
}

function cambio(num) 
{
    let usu = document.getElementById('conteusu');
    let emp = document.getElementById('contempr');
    let met = document.getElementById('contemetas');

    if (num == 1) 
    {
        usu.classList.add('d-none');
        emp.classList.remove('d-none');
    }
    else if (num == 2) 
    {
        emp.classList.add('d-none');
        met.classList.remove('d-none');
    }
    else if (num == 3) 
    {
        
    }
}