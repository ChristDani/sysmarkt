let telefonoscliente = [];

function dnipuesto() 
{
    let dni = document.getElementById('dni');
    if (dni.value.length == 8) 
    {
        document.getElementById('ltrrdn').classList.remove('d-none');
        document.getElementById('nptdn').classList.add('d-none');
        
        document.getElementById('mostrarndinewcliente').innerHTML = dni.value;

        document.getElementById('listartelefonosaagregar').classList.remove('d-none');
        listartelefonosparaagregar();
    }
}
function cambiardni() 
{
    let dni = document.getElementById('dni');
    if (telefonoscliente.length == 0) 
    {
        document.getElementById('ltrrdn').classList.add('d-none');
        document.getElementById('nptdn').classList.remove('d-none');

        document.getElementById('listartelefonosaagregar').classList.add('d-none');
    }
}
function listartelefonosparaagregar() 
{    
    let campo =document.getElementById('listartelefonosaagregar');
    if (telefonoscliente.length == 0) 
    {
        campo.innerHTML = "<a href='#' class='btn color' onclick='mostrarformularionewtelefono()'>Nuevo Telefono</a>";
    }
    else
    {
        let tablaproduc = "<div class='text-center'><h3 class='text-info'>Telefonos</h3></div>";

        telefonoscliente.forEach(function(i) 
        {
            let pro = "";
            if (i[2] == "0") {
                pro = "Fijo";
            }
            else if (i[2] == "1") {
                pro = "Movil";
            }

            tablaproduc = tablaproduc + "<div class='text-center'><div class='card'><div class='card-body m-0'><div class='row m-0'><div class='col'><p>"+pro+"</p></div><div class='col'><p>"+i[1]+"</p></div><div class='col'><p>"+i[3]+"</p></div></div></div></div></div>";
        });
        tablaproduc = tablaproduc + "<a href='#' class='btn color' onclick='mostrarformularionewtelefono();'>Nuevo Telefono</a>";
        campo.innerHTML = tablaproduc;
        document.getElementById('btnaddnewcliente').classList.remove('d-none');
    }
}
function mostrarformularionewtelefono() 
{
    document.getElementById('contenidocliente').classList.add('d-none');
    document.getElementById('listartelefonosaagregar').classList.add('d-none');
    document.getElementById('btnccngrgrtlfngrgr').classList.add('d-none');
    document.getElementById('btnaddnewcliente').classList.add('d-none');
    document.getElementById('contenidotelefono').classList.remove('d-none');
    document.getElementById('btnccngrgrtlfncnclr').classList.remove('d-none');

    limpiarcampos();     
}
function limpiarcampos() 
{
    document.getElementById('telefono').value = '';
    document.getElementById('tipotelefono').selectedIndex = 0;
    document.getElementById('operador').selectedIndex = 0;
    document.getElementById('modalidad').selectedIndex = 0;
}
function ocultarformularionewtelefono() 
{
    document.getElementById('contenidocliente').classList.remove('d-none');
    document.getElementById('listartelefonosaagregar').classList.remove('d-none');
    document.getElementById('contenidotelefono').classList.add('d-none');
    listartelefonosparaagregar();
}
function arreglarnombre()
{
    let dni = document.getElementById('dni');
    let nombre = document.getElementById('nombre');
    let letrero = document.getElementById('mostrarnamenewcliente');
    
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
            letrero.innerHTML=data.data.nombres+" "+data.data.apellidoPaterno+" "+data.data.apellidoMaterno;
        }).catch(err=>console.log(err))
    }
}
function telefono()
{
    let telefono = document.getElementById('telefono');

    if (telefono.value.length == 9) 
    {
        document.getElementById('btnccngrgrtlfngrgr').classList.remove('d-none');
    }
    else
    {
        document.getElementById('btnccngrgrtlfngrgr').classList.add('d-none');        
    }
}

function añadirtelefonoalista()
{
    let telf = [];
    
    let insertt = null;
    
    let dni = document.getElementById('dni').value;
    let telefono = document.getElementById('telefono').value;
    let tipotelefono = document.getElementById('tipotelefono').value;
    let operador = document.getElementById('operador').value;
    let modalidad = document.getElementById('modalidad').value;

    insertt = telefonoscliente.find(telefsea => telefsea[1] == telefono);
    if (insertt == undefined) 
    {
        telf = [dni,telefono,tipotelefono,operador,modalidad];
        telefonoscliente.push(telf);
    }

    ocultarformularionewtelefono();
    listartelefonosparaagregar();
}


function agregarcliente()
{
    let dni = document.getElementById('dni').value;
    let nombre = document.getElementById('nombre').value;
    let distrito = document.getElementById('distrito').value;
    let ubicacion = document.getElementById('ubicacion').value;

    // le damos el origen de los datos
    let url='controller/clientes/agregarcliente.php';
    let formaData = new FormData()
    formaData.append('dni', dni)
    formaData.append('nombre', nombre)
    formaData.append('ubicacion', ubicacion)
    formaData.append('distrito', distrito)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        console.log(data);
    }).catch(err=>console.log(err))
    
    setTimeout(() => {  
        agregartelefonoscliente();
    }, 400);
}
function agregartelefonoscliente()
{
    let t = 0;
    telefonoscliente.forEach(function(i) 
    {
        // le damos el origen de los datos
        let url='controller/clientes/agregartelefono.php';
        let formaData = new FormData()
        formaData.append('dni', i[0])
        formaData.append('telefono', i[1])
        formaData.append('tipo', i[2])
        formaData.append('operador', i[3])
        formaData.append('tipoLinea', i[4])
    
        fetch(url,{
            method: "POST",
            body: formaData
        }).then(response=>response.json())
        .then(data=>{
            console.log(data);
        }).catch(err=>console.log(err))
        t = t + 1;
    });
    if (telefonoscliente.length == t) 
    {
        location.reload();
    }
}