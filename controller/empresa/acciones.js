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

document.getElementById('logoempresa').addEventListener("change", function() {
    cambiarlogo();
    
    
    // $("#logoempresa").change(function () {
    // // Código a ejecutar cuando se detecta un cambio de archivO
    // readImage(this);
    // });
    // let hdsjfcjsdf = document.getElementById('logoempresa');
}, false)

document.getElementById('iconoempresa').addEventListener("change", function() {
    cambiaricono();
}, false)

function cambiarlogo() 
{
    let cont = document.getElementById('logoempresa');
    let valor = document.getElementById('logoempresa').files[0].name;
    let letrero = document.getElementById('letrerologo')

    letrero.innerHTML = valor;
    
    function readImage(input) 
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#contimagendelogoempresa').attr('src', e.target.result); // Renderizamos la imagen
                // document.getElementById('contimagendelogoempresa').attr('src', e.target.result); // Renderizamos la imagen
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    readImage(cont);
}

function cambiaricono() 
{
    let valor = document.getElementById('iconoempresa').files[0].name;
    let letrero = document.getElementById('letreroicono')

    letrero.innerHTML = valor;

    document.getElementById('contimagendelogoempresa').src="view/static/img/icono.png";
}

function agregarempresa()
{
    let nombre = document.getElementById('nombreempresa').value;
    let logo = document.getElementById('logoempresa').files;
    let icono = document.getElementById('iconoempresa').files;

    console.log(logo);
    console.log(icono);

    // le damos el origen de los datos
    let url='controller/empresa/primeruser.php';
    let formaData = new FormData()
    formaData.append('nombre', nombre)
    formaData.append('logo', logo)
    formaData.append('icono', icono)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        console.log(data);
    }).catch(err=>console.log(err))
}

function cambio(num) 
{
    let usu = document.getElementById('conteusu');
    let emp = document.getElementById('contempr');
    let met = document.getElementById('contemetas');

    // if (num == 1) 
    // {
    //     usu.classList.add('d-none');
    //     emp.classList.remove('d-none');
    // }
    // else if (num == 2) 
    // {
    //     emp.classList.add('d-none');
    //     met.classList.remove('d-none');
    // }
    // else if (num == 3) 
    // {
        
    // }
}