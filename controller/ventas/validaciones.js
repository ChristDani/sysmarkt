
let listadeproductos = [];
let listadetelefono = [];

function litarproductosparaagregar() 
{
    let campo =document.getElementById('btnaddnewproduc');
    if (listadeproductos.length == 0) 
    {
        campo.innerHTML = "<a href='#' class='btn color' onclick='mostrarcontenidonewproduc()'>Nuevo Producto</a>";
    }
    else
    {
        let tablaproduc = "<div class='text-center'><h3 class='text-info'>Productos</h3></div>";

        listadeproductos.forEach(function(i) 
        {
            let pro = "";
            let ty = "";
            let mod = "";
            if (i[2] == "0") {
                pro = "Fija";
                if (i[12] == "0") {
                    ty = "Alta";
                }
                else if (i[12] == "1") {
                    ty = "Protabilidad";
                }
                mod = i[14];
            }
            else if (i[2] == "1") {
                pro = "Movil";
                if (i[4] == "0") {
                    ty = "Linea Nueva";
                }
                else if (i[4] == "1") {
                    ty = "Protabilidad";
                }
                else if (i[4] == "2") {
                    ty = "Renovacion";
                }
                if (i[8] == "0") {
                    mod = "Prepago";
                }
                else if (i[8] == "1") {
                    mod = "Postpago";
                }
            }

            tablaproduc = tablaproduc + "<div class='text-center'><div class='card'><div class='card-body m-0'><div class='row m-0'><div class='col'><p>"+pro+"</p></div><div class='col'><p>"+ty+"</p></div><div class='col'><p>"+mod+"</p></div></div></div></div></div>";
            
        });
        if (listadeproductos[0][2] == "1") 
        {            
            tablaproduc = tablaproduc + "<a href='#' class='btn color' onclick='mostrarcontenidonewproduc();'>Nuevo Producto</a>";
        }
        campo.innerHTML = tablaproduc;
        document.getElementById('btnaddnewventa').classList.remove('d-none');
    }
}
function cambiardni() 
{
    document.getElementById('letrerodni').classList.add('d-none');
    document.getElementById('inputdni').classList.remove('d-none');
}
function dnipuesto() 
{ 
    if (document.getElementById('dni').value.length == 8) 
    {
        document.getElementById('letrerodni').classList.remove('d-none');
        document.getElementById('inputdni').classList.add('d-none');
        
        document.getElementById('mostrardni').innerHTML = document.getElementById('dni').value;
    }

    if (document.getElementById('dni').value.length == 8 && document.getElementById('sec').value.length == 0) 
    {
        document.getElementById('inputsec').classList.remove('d-none');
    }
}
function cambiarsec() 
{
    if (listadeproductos.length == 0) 
    {
        document.getElementById('letrerosec').classList.add('d-none');
        document.getElementById('inputsec').classList.remove('d-none');
        document.getElementById('btnaddnewproduc').classList.add('d-none');
    }
}
function secpuesta() 
{
    if (document.getElementById('sec').value.length > 0) 
    {
        document.getElementById('letrerosec').classList.remove('d-none');
        document.getElementById('inputsec').classList.add('d-none');
        
        document.getElementById('mostrarsec').innerHTML = document.getElementById('sec').value;

        document.getElementById('btnaddnewproduc').classList.remove('d-none');
        litarproductosparaagregar()
    }
}
function añadirproductoalista()
{
    let listita = [];
    
    let sec = document.getElementById('sec').value;
    let referencia = document.getElementById('telefonoRef').value;
    let producto = document.getElementById('producto').value;
    let promocion = document.getElementById('promocion').value;
    let tipo = document.getElementById('tipo').value;
    let telefop = document.getElementById('telefono').value;
    let lineaproce = document.getElementById('lineaProce').value;
    let operaceden = document.getElementById('operadorCeden').value;
    let modalidad = document.getElementById('modalidad').value;
    let modoreno = document.getElementById('modoReno').value;
    let plan = document.getElementById('plan').value;
    let equipo = document.getElementById('equipos').value;
    let tipofija = document.getElementById('tipoFija').value;
    let planfija = document.getElementById('planFija').value;
    let modofija = document.getElementById('modoFija').value;
    let formapago = document.getElementById('formaPago').value;
    let distrito = document.getElementById('distrito').value;
    let ubicacion = document.getElementById('ubicacion').value;
    let observacion = document.getElementById('observaciones').value;
    let estado = "2";

    listita = [sec,referencia,producto,promocion,tipo,telefop,lineaproce,operaceden,modalidad,modoreno,plan,equipo,tipofija,planfija,modofija,formapago,distrito,ubicacion,observacion,estado];
    
    listadeproductos.push(listita);

    let telf = [];
    
    let dni = document.getElementById('dni').value;

    if (listadeproductos.length > 0) 
    {
        listadeproductos.forEach(function(i) 
        {

        });
    }
    else
    {
        if (referencia != telefop) 
        {
            telf = [dni,referencia];
            listadetelefono.push(telf);
            telf = [dni,telefop];
            listadetelefono.push(telf);
        }
        else
        {
            telf = [dni,referencia];
            listadetelefono.push(telf);
        }
    }

    ocultarcontenidonewproduc();
    litarproductosparaagregar();
}
function mostrarcontenidonewproduc() 
{
    document.getElementById('contenedorFormularioaddventa').classList.add('d-none');
    document.getElementById('contenidonuevoproducto').classList.remove('d-none');
    document.getElementById('btnaddnewproduc').classList.add('d-none');
    document.getElementById('btnaddnewventa').classList.add('d-none');

    limpiarcampos();
    ocultarcampos();
    if (listadeproductos.length > 0) {
        mostrarProducto('1');
        document.getElementById('dproducto').classList.add('d-none');
        document.getElementById('producto').selectedIndex = 1;
        document.getElementById('dtipo').classList.add('d-none');
        if (listadeproductos[0][4] == "0") {
            mostrarTipoMovil('0');
            document.getElementById('tipo').selectedIndex = 1;
        }
        else if (listadeproductos[0][4] == "1") {
            mostrarTipoMovil('1');
            document.getElementById('tipo').selectedIndex = 2;
            document.getElementById('dmodalidad').classList.add('d-none');
            if (listadeproductos[0][8] == "0"){
                document.getElementById('dlineaProce').classList.add('d-none');
                document.getElementById('lineaProce').selectedIndex = 1;    
                mostrarModalidadMovil('0')
                document.getElementById('modalidad').selectedIndex = 1;
            }
            else if (listadeproductos[0][8] == "1"){
                if (listadeproductos[0][6] == "Prepago"){
                    document.getElementById('dlineaProce').classList.add('d-none');
                    document.getElementById('lineaProce').selectedIndex = 1; 
                }
                else if (listadeproductos[0][6] == "Postpago"){
                    document.getElementById('dlineaProce').classList.add('d-none');
                    document.getElementById('lineaProce').selectedIndex = 2; 
                }
                mostrarModalidadMovil('1');
                document.getElementById('modalidad').selectedIndex = 2;
            }
        }
        else if (listadeproductos[0][4] == "2") {
            mostrarTipoMovil('2');
            document.getElementById('tipo').selectedIndex = 3;
        }
    }       
}
function ocultarcampos() 
{    
    document.getElementById('dproducto').classList.add('d-none');
    document.getElementById('dpromocion').classList.add('d-none');
    document.getElementById('dtipo').classList.add('d-none');
    document.getElementById('dtelefono').classList.add('d-none');
    document.getElementById('dlineaProce').classList.add('d-none');
    document.getElementById('doperadorCeden').classList.add('d-none');
    document.getElementById('dmodalidad').classList.add('d-none');
    document.getElementById('dmodoReno').classList.add('d-none');
    document.getElementById('dplan').classList.add('d-none');
    document.getElementById('dequipos').classList.add('d-none');
    document.getElementById('dtipoFija').classList.add('d-none');
    document.getElementById('dplanFija').classList.add('d-none');
    document.getElementById('dmodoFija').classList.add('d-none');
    document.getElementById('dformaPago').classList.add('d-none');
    document.getElementById('ddistrito').classList.add('d-none');
    document.getElementById('dubicacion').classList.add('d-none');
    document.getElementById('dobservacion').classList.add('d-none');
    document.getElementById('botonesdeaccionalagregarproductocancelar').classList.remove('d-none');
    document.getElementById('botonesdeaccionalagregarproductoagregar').classList.add('d-none');
}
function limpiarcampos() 
{
    document.getElementById('telefonoRef').value = '';
    document.getElementById('producto').selectedIndex = 0;
    document.getElementById('promocion').selectedIndex = 0;
    document.getElementById('tipo').selectedIndex = 0;
    document.getElementById('telefono').value = '';
    document.getElementById('lineaProce').selectedIndex = 0;
    document.getElementById('operadorCeden').selectedIndex = 0;
    document.getElementById('modalidad').selectedIndex = 0;
    document.getElementById('modoReno').selectedIndex = 0;
    document.getElementById('plan').selectedIndex = 0;
    document.getElementById('equipos').selectedIndex = 0;
    document.getElementById('tipoFija').selectedIndex = 0;
    document.getElementById('planFija').selectedIndex = 0;
    document.getElementById('modoFija').selectedIndex = 0;
    document.getElementById('formaPago').selectedIndex = 0;
    document.getElementById('distrito').value = '';
    document.getElementById('ubicacion').value = '';
    document.getElementById('observaciones').value = '';
}
function ocultarcontenidonewproduc() 
{
    document.getElementById('contenedorFormularioaddventa').classList.remove('d-none');
    document.getElementById('contenidonuevoproducto').classList.add('d-none');
    document.getElementById('btnaddnewproduc').classList.remove('d-none');
}
function arreglarnombre()
{
    let dni = document.getElementById('dni');
    let nombre = document.getElementById('nombre');
    let muestranombre = document.getElementById('mostrarnamecliente');
    
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
function agregarventa()
{
    let dniasesor = document.getElementById('asesor').value;
    let dnicliente = document.getElementById('dni').value;
    let nombrecliente = document.getElementById('nombre').value;
    let ubicacioncliente = listadeproductos[0][17];
    let distritocliente = listadeproductos[0][16];
    let sec = document.getElementById('sec').value;

    // le damos el origen de los datos
    let url='controller/ventas/agregarventa.php';
    let formaData = new FormData()
    formaData.append('dniasesor', dniasesor)
    formaData.append('dnicliente', dnicliente)
    formaData.append('nombrecliente', nombrecliente)
    formaData.append('ubicacioncliente', ubicacioncliente)
    formaData.append('distritocliente', distritocliente)
    formaData.append('sec', sec)

    fetch(url,{
        method: "POST",
        body: formaData
    }).then(response=>response.json())
    .then(data=>{
        console.log(data);
    }).catch(err=>console.log(err))
    
    setTimeout(() => {
        agregardetalleventa();        
    }, 400);
}
function agregardetalleventa()
{
    let clave = 0;
    listadeproductos.forEach(function(i) 
    {
        // le damos el origen de los datos
        let url='controller/ventas/agregardetalleventa.php';
        let formaData = new FormData()
        formaData.append('sec', i[0])
        formaData.append('referencia', i[1])
        formaData.append('producto', i[2])
        formaData.append('promocion', i[3])
        formaData.append('tipo', i[4])
        formaData.append('telefop', i[5])
        formaData.append('lineaproce', i[6])
        formaData.append('operaceden', i[7])
        formaData.append('modalidad', i[8])
        formaData.append('modoreno', i[9])
        formaData.append('plan', i[10])
        formaData.append('equipo', i[11])
        formaData.append('tipofija', i[12])
        formaData.append('planfija', i[13])
        formaData.append('modofija', i[14])
        formaData.append('formapago', i[15])
        formaData.append('distrito', i[16])
        formaData.append('ubicacion', i[17])
        formaData.append('observacion', i[18])
        formaData.append('estado', i[19])
    
        fetch(url,{
            method: "POST",
            body: formaData
        }).then(response=>response.json())
        .then(data=>{
            console.log(data);
        }).catch(err=>console.log(err))
        clave = clave + 1;
    });
    if (listadeproductos.length == clave) 
    {
        location.reload();
    }
}



// validaciones de muestra de inputs

function mostrarProductos() 
{
    const telefonoref = document.getElementById('telefonoRef').value.length
    if (telefonoref == 9) 
    {
        if (listadeproductos.length == 0){
            document.getElementById('dproducto').classList.remove('d-none');
        }
    }
    else if (telefonoref == 0) 
    {
        document.getElementById('dproducto').classList.add('d-none');
        if (listadeproductos.length == 0){
            document.getElementById('producto').selectedIndex = 0;
            mostrarProducto('-');
            mostrarTipoFija('-');
            mostrarTipoMovil('-');
        }
    }
}

// funciones con valores 

document.getElementById('producto').addEventListener("change", function() {
    let valor = document.getElementById('producto').value
    mostrarProducto(valor)
}, false)

document.getElementById('tipoFija').addEventListener("change", function() {
    let valor = document.getElementById('tipoFija').value
    mostrarTipoFija(valor)
}, false)

document.getElementById('tipo').addEventListener("change", function() {
    let valor = document.getElementById('tipo').value
    mostrarTipoMovil(valor)
}, false)

document.getElementById('modalidad').addEventListener("change", function() {
    let valor = document.getElementById('modalidad').value
    mostrarModalidadMovil(valor)
}, false)

function mostrarProducto(valor)
{
    const any = "-"
    const movil = "1"
    const fija = "0"

    if (valor == movil)
    {
        document.getElementById('dpromocion').classList.remove('d-none');
        document.getElementById('promocion').selectedIndex = 0;
        document.getElementById('dtipo').classList.remove('d-none');
        document.getElementById('tipo').selectedIndex = 0;
        
        document.getElementById('dtipoFija').classList.add('d-none');
        document.getElementById('tipoFija').selectedIndex = 0;
        mostrarTipoFija('-');
    }
    else if(valor == fija)
    {
        document.getElementById('dpromocion').classList.remove('d-none');
        document.getElementById('promocion').selectedIndex = 0;
        document.getElementById('dtipoFija').classList.remove('d-none');
        document.getElementById('tipoFija').selectedIndex = 0;

        document.getElementById('dtipo').classList.add('d-none');
        document.getElementById('tipo').selectedIndex = 0;
        mostrarTipoMovil('-');
        mostrarModalidadMovil('-'); 
    }
    else if(valor == any)
    {
        document.getElementById('dpromocion').classList.add('d-none');
        document.getElementById('promocion').selectedIndex = 0;
        document.getElementById('dtipo').classList.add('d-none');
        document.getElementById('tipo').selectedIndex = 0;
        document.getElementById('dtipoFija').classList.add('d-none');
        document.getElementById('tipoFija').selectedIndex = 0;
        mostrarTipoFija('-');
        mostrarTipoMovil('-');
        mostrarModalidadMovil('-'); 
    }
}

function mostrarTipoFija(valor) 
{
    const any = "-"
    const alta = "0"
    const porta = "1"
    
    if (valor == alta) 
    {
        document.getElementById('dtelefono').classList.add('d-none');
        document.getElementById('telefono').value = '';
        document.getElementById('dplanFija').classList.remove('d-none');
        document.getElementById('planFija').selectedIndex = 0;
        document.getElementById('dmodoFija').classList.remove('d-none');
        document.getElementById('modoFija').selectedIndex = 0;
        document.getElementById('dformaPago').classList.add('d-none');
        document.getElementById('formaPago').selectedIndex = 1;
        document.getElementById('dobservacion').classList.remove('d-none');
        document.getElementById('observaciones').value = '';
        document.getElementById('dubicacion').classList.remove('d-none');
        document.getElementById('ubicacion').value = '';
        document.getElementById('ddistrito').classList.remove('d-none');
        document.getElementById('distrito').value = '';
        document.getElementById('dmodoReno').classList.add('d-none');
        document.getElementById('modoReno').selectedIndex = 0;  
        document.getElementById('botonesdeaccionalagregarproductocancelar').classList.remove('d-none');
        document.getElementById('botonesdeaccionalagregarproductoagregar').classList.remove('d-none');
    }
    else if (valor == porta) 
    {
        document.getElementById('dtelefono').classList.remove('d-none');
        document.getElementById('telefono').value = '';
        document.getElementById('dplanFija').classList.remove('d-none');
        document.getElementById('planFija').selectedIndex = 0;
        document.getElementById('dmodoFija').classList.remove('d-none');
        document.getElementById('modoFija').selectedIndex = 0;
        document.getElementById('dformaPago').classList.add('d-none');
        document.getElementById('formaPago').selectedIndex = 1;
        document.getElementById('dobservacion').classList.remove('d-none');
        document.getElementById('observaciones').value = '';
        document.getElementById('dubicacion').classList.remove('d-none');
        document.getElementById('ubicacion').value = '';
        document.getElementById('ddistrito').classList.remove('d-none');
        document.getElementById('distrito').value = '';
        document.getElementById('dmodoReno').classList.add('d-none');
        document.getElementById('modoReno').selectedIndex = 0;  
        document.getElementById('botonesdeaccionalagregarproductocancelar').classList.remove('d-none');
        document.getElementById('botonesdeaccionalagregarproductoagregar').classList.remove('d-none');
    }
    else if (valor == any) 
    {
        document.getElementById('dtelefono').classList.add('d-none');
        document.getElementById('telefono').value = '';
        document.getElementById('dplanFija').classList.add('d-none');
        document.getElementById('planFija').selectedIndex = 0;
        document.getElementById('dmodoFija').classList.add('d-none');
        document.getElementById('modoFija').selectedIndex = 0;
        document.getElementById('dformaPago').classList.add('d-none');
        document.getElementById('formaPago').selectedIndex = 0;
        document.getElementById('dobservacion').classList.add('d-none');
        document.getElementById('observaciones').value = '';
        document.getElementById('dubicacion').classList.add('d-none');
        document.getElementById('ubicacion').value = '';
        document.getElementById('ddistrito').classList.add('d-none');
        document.getElementById('distrito').value = '';
        document.getElementById('dmodoReno').classList.add('d-none');
        document.getElementById('modoReno').selectedIndex = 0;  
        document.getElementById('botonesdeaccionalagregarproductocancelar').classList.remove('d-none');        
        document.getElementById('botonesdeaccionalagregarproductoagregar').classList.add('d-none');        
    }
}

function mostrarTipoMovil(valor) 
{
    const any = "-"
    const alta = "0"
    const porta = "1"    
    const reno = "2" 
    
    if (valor == alta) 
    {
        document.getElementById('dtelefono').classList.add('d-none');
        document.getElementById('telefono').value = '';
        document.getElementById('dlineaProce').classList.add('d-none');
        document.getElementById('lineaProce').selectedIndex = 0;        
        document.getElementById('doperadorCeden').classList.add('d-none');
        document.getElementById('operadorCeden').selectedIndex = 0; 
        document.getElementById('dmodalidad').classList.add('d-none');
        document.getElementById('modalidad').selectedIndex = 2;
        document.getElementById('dmodoReno').classList.add('d-none');
        document.getElementById('modoReno').selectedIndex = 0;  
        mostrarModalidadMovil('1'); 
    }
    else if (valor == porta) 
    {
        document.getElementById('dtelefono').classList.remove('d-none');
        document.getElementById('telefono').value = '';
        document.getElementById('dlineaProce').classList.remove('d-none');
        document.getElementById('lineaProce').selectedIndex = 0;        
        document.getElementById('doperadorCeden').classList.remove('d-none');
        document.getElementById('operadorCeden').selectedIndex = 0;        
        document.getElementById('dmodalidad').classList.add('d-none');
        document.getElementById('modalidad').selectedIndex = 0;
        document.getElementById('dmodoReno').classList.add('d-none');
        document.getElementById('modoReno').selectedIndex = 0;  
        mostrarModalidadMovil('-');
        
        document.getElementById('lineaProce').addEventListener("change", function() {
            if (listadeproductos.length == 0){
                if (document.getElementById('lineaProce').value == "Postpago") 
                {
                    document.getElementById('dmodalidad').classList.add('d-none');
                    document.getElementById('modalidad').selectedIndex = 2;
                    document.getElementById('dmodoReno').classList.add('d-none');
                    document.getElementById('modoReno').selectedIndex = 0;  
                    mostrarModalidadMovil('1'); 
                }
                else if (document.getElementById('lineaProce').value == "Prepago")
                {
                    document.getElementById('dmodalidad').classList.remove('d-none');
                    document.getElementById('modalidad').selectedIndex = 0;
                    document.getElementById('dmodoReno').classList.add('d-none');
                    document.getElementById('modoReno').selectedIndex = 0;  
                    mostrarModalidadMovil('-');           
                }
                else if (document.getElementById('lineaProce').value == "---")
                {
                    document.getElementById('dmodalidad').classList.add('d-none');
                    document.getElementById('modalidad').selectedIndex = 0;
                    document.getElementById('dmodoReno').classList.add('d-none');
                    document.getElementById('modoReno').selectedIndex = 0;  
                    mostrarModalidadMovil('-');           
                }
            }
        }, false)       
    }
    else if (valor == reno) 
    {
        document.getElementById('dtelefono').classList.remove('d-none');
        document.getElementById('telefono').value = '';
        document.getElementById('dlineaProce').classList.add('d-none');
        document.getElementById('lineaProce').selectedIndex = 1;
        document.getElementById('doperadorCeden').classList.add('d-none');
        document.getElementById('operadorCeden').selectedIndex = 0; 
        document.getElementById('dmodalidad').classList.add('d-none');
        document.getElementById('modalidad').selectedIndex = 2;
        document.getElementById('dmodoReno').classList.remove('d-none');
        document.getElementById('modoReno').selectedIndex = 0;
        mostrarModalidadMovil('1');
    }
    else if (valor == any) 
    {
        document.getElementById('dtelefono').classList.add('d-none');
        document.getElementById('telefono').value = '';
        document.getElementById('dlineaProce').classList.add('d-none');
        document.getElementById('lineaProce').selectedIndex = 0;        
        document.getElementById('doperadorCeden').classList.add('d-none');
        document.getElementById('operadorCeden').selectedIndex = 0; 
        document.getElementById('dmodalidad').classList.add('d-none');
        document.getElementById('modalidad').selectedIndex = 0; 
        document.getElementById('dmodoReno').classList.add('d-none');
        document.getElementById('modoReno').selectedIndex = 0;   
        mostrarModalidadMovil('-');     
    }
}

function mostrarModalidadMovil(valor) 
{  
    const any = "-"
    const prepa = "0"
    const post = "1" 

    if (valor == prepa) 
    {
        document.getElementById('dplan').classList.add('d-none');
        document.getElementById('plan').selectedIndex = 0;
        document.getElementById('dequipos').classList.remove('d-none');
        document.getElementById('equipos').selectedIndex = 0;
        document.getElementById('dformaPago').classList.add('d-none');
        document.getElementById('formaPago').selectedIndex = 1;
        document.getElementById('dobservacion').classList.remove('d-none');
        document.getElementById('observaciones').selectedIndex = 0;
        document.getElementById('dubicacion').classList.remove('d-none');
        document.getElementById('ubicacion').selectedIndex = 0;
        document.getElementById('ddistrito').classList.remove('d-none');
        document.getElementById('distrito').selectedIndex = 0;
        document.getElementById('botonesdeaccionalagregarproductocancelar').classList.remove('d-none');
        document.getElementById('botonesdeaccionalagregarproductoagregar').classList.remove('d-none');
    }
    else if (valor == post) 
    {
        document.getElementById('dplan').classList.remove('d-none');
        document.getElementById('plan').selectedIndex = 0;
        document.getElementById('dequipos').classList.remove('d-none');
        document.getElementById('equipos').selectedIndex = 0;
        document.getElementById('dformaPago').classList.remove('d-none');
        document.getElementById('formaPago').selectedIndex = 0;
        document.getElementById('dobservacion').classList.remove('d-none');
        document.getElementById('observaciones').selectedIndex = 0;
        document.getElementById('dubicacion').classList.remove('d-none');
        document.getElementById('ubicacion').selectedIndex = 0;
        document.getElementById('ddistrito').classList.remove('d-none');
        document.getElementById('distrito').selectedIndex = 0;        
        document.getElementById('botonesdeaccionalagregarproductocancelar').classList.remove('d-none'); 
        document.getElementById('botonesdeaccionalagregarproductoagregar').classList.remove('d-none'); 
    }
    else if (valor == any) 
    {   
        document.getElementById('dplan').classList.add('d-none');
        document.getElementById('plan').selectedIndex = 0;
        document.getElementById('dequipos').classList.add('d-none');
        document.getElementById('equipos').selectedIndex = 0;
        document.getElementById('dformaPago').classList.add('d-none');
        document.getElementById('formaPago').selectedIndex = 0;
        document.getElementById('dobservacion').classList.add('d-none');
        document.getElementById('observaciones').selectedIndex = 0;
        document.getElementById('dubicacion').classList.add('d-none');
        document.getElementById('ubicacion').selectedIndex = 0;
        document.getElementById('ddistrito').classList.add('d-none');
        document.getElementById('distrito').selectedIndex = 0;     
        document.getElementById('botonesdeaccionalagregarproductocancelar').classList.remove('d-none');
        document.getElementById('botonesdeaccionalagregarproductoagregar').classList.add('d-none');
    }
}
