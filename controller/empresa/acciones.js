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

document.getElementById('logoempresa').addEventListener("change", function() 
{
    let valor = document.getElementById('logoempresa').files[0].name;
    let letrero = document.getElementById('letrerologo')

    letrero.innerHTML = valor;

    const input = document.getElementById("logoempresa")
    const preview = document.getElementById("contimagendelogoempresa")

    const [file] = input.files
    if (file) {
        preview.src = URL.createObjectURL(file)
    }
}, false)

document.getElementById('iconoempresa').addEventListener("change", function() 
{
    let valor = document.getElementById('iconoempresa').files[0].name;
    let letrero = document.getElementById('letreroicono')

    letrero.innerHTML = valor;
    
    const input = document.getElementById("iconoempresa")
    const preview = document.getElementById("contimagendeiconoempresa")

    const [file] = input.files
    if (file) {
        preview.src = URL.createObjectURL(file)
    }
}, false)

function agregarempresa()
{
    let nombre = document.getElementById('nombreempresa').value;
    let logo = document.getElementById('logoempresa').files[0];
    let icono = document.getElementById('iconoempresa').files[0];

    if (nombre.length > 0) 
    {
        // le damos el origen de los datos
        let url='controller/empresa/asignarem.php';
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

        setTimeout(() => {
            cambio(3);
        }, 400);
    }
    else
    {
        alert("Especifique el nombre de la empresa");
    }
}

function agregarmetas() 
{
    let portamen69 = document.getElementById('portamen69metasempresa').value;
    let portamay69 = document.getElementById('portamay69metasempresa').value;
    let altapost = document.getElementById('altapostmetasempresa').value;
    let altaprepa = document.getElementById('altaprepametasempresa').value;
    let portaprepa = document.getElementById('portaprepametasempresa').value;
    let renovacion = document.getElementById('renovacionmetasempresa').value;
    let hfc_ftth = document.getElementById('hfc_ftthmetasempresa').value;
    let ifi = document.getElementById('ifimetasempresa').value;

    // le damos el origen de los datos
    let url='controller/empresa/primerasmetas.php';
    let formaData = new FormData()
    formaData.append('portamen69', portamen69)
    formaData.append('portamay69', portamay69)
    formaData.append('altapost', altapost)
    formaData.append('altaprepa', altaprepa)
    formaData.append('portaprepa', portaprepa)
    formaData.append('renovacion', renovacion)
    formaData.append('hfc_ftth', hfc_ftth)
    formaData.append('ifi', ifi)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        console.log(data);
    }).catch(err=>console.log(err))

    if (portamen69.length > 0 && portamay69.length > 0 && altapost.length > 0 && altaprepa.length > 0 && portaprepa.length > 0 && renovacion.length > 0 && hfc_ftth.length > 0 && ifi.length > 0) 
    {
        cambio(2);
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
        met.classList.remove('d-none');
    }
    else if (num == 2) 
    {
        met.classList.add('d-none');
        emp.classList.remove('d-none');
    }
    else if (num == 3) 
    {
        location.reload();
    }
}