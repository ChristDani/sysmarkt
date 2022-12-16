function limpiar() 
{
    document.getElementById('dpromocion').classList.add('d-none'); 
    document.getElementById('dtipo').classList.add('d-none'); 
    document.getElementById('dtipoFija').classList.add('d-none'); 
    document.getElementById('dtelefono').classList.add('d-none'); 
    document.getElementById('dlineaProce').classList.add('d-none'); 
    document.getElementById('doperadorCeden').classList.add('d-none'); 
    document.getElementById('dmodalidad').classList.add('d-none'); 
    document.getElementById('dplan').classList.add('d-none'); 
    document.getElementById('dequipos').classList.add('d-none'); 
    document.getElementById('dformaPago').classList.add('d-none'); 
    document.getElementById('dsec').classList.add('d-none'); 
    document.getElementById('dplanFija').classList.add('d-none'); 
    document.getElementById('dmodoFija').classList.add('d-none'); 
    document.getElementById('dubicacion').classList.add('d-none'); 
    document.getElementById('ddistrito').classList.add('d-none'); 
    document.getElementById('dobservacion').classList.add('d-none'); 
    document.getElementById('destado').classList.add('d-none'); 
}

function mostrarTelefonoRef() 
{
    const dni = document.getElementById('dni').value.length
    if (dni == 8) 
    {
        document.getElementById('dtelefonoRef').classList.remove('d-none');
    }
    else
    {
        document.getElementById('dtelefonoRef').classList.add('d-none');
        document.getElementById('telefonoRef').value='';
        document.getElementById('dproducto').classList.add('d-none');
        document.getElementById('producto').selectedIndex = 0;
    }
}

function mostrarProductos() 
{
    const telefonoref = document.getElementById('telefonoRef').value.length
    if (telefonoref == 9) 
    {
        document.getElementById('dproducto').classList.remove('d-none');
    }
    else
    {
        document.getElementById('dproducto').classList.add('d-none');
        document.getElementById('producto').selectedIndex = 0;
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
    const any = "---"
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
    }
    else if(valor == fija)
    {
        document.getElementById('dpromocion').classList.remove('d-none');
        document.getElementById('promocion').selectedIndex = 0;
        document.getElementById('dtipoFija').classList.remove('d-none');
        document.getElementById('tipoFija').selectedIndex = 0;

        document.getElementById('dtipo').classList.add('d-none');
        document.getElementById('tipo').selectedIndex = 0;
    }
    else if(valor == any)
    {
        document.getElementById('dpromocion').classList.add('d-none');
        document.getElementById('promocion').selectedIndex = 0;
        document.getElementById('dtipo').classList.add('d-none');
        document.getElementById('tipo').selectedIndex = 0;
        document.getElementById('dtipoFija').classList.add('d-none');
        document.getElementById('tipoFija').selectedIndex = 0;
    }
}

function mostrarTipoFija(valor) 
{
    const any = "---"
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
        document.getElementById('dsec').classList.remove('d-none');
        document.getElementById('sec').value = '';
        document.getElementById('destado').classList.add('d-none');
        document.getElementById('dobservacion').classList.remove('d-none');
        document.getElementById('observaciones').value = '';
        document.getElementById('dubicacion').classList.remove('d-none');
        document.getElementById('ubicacion').value = '';
        document.getElementById('ddistrito').classList.remove('d-none');
        document.getElementById('distrito').value = '';
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
        document.getElementById('dsec').classList.remove('d-none');
        document.getElementById('sec').value = '';
        document.getElementById('destado').classList.add('d-none');
        document.getElementById('dobservacion').classList.remove('d-none');
        document.getElementById('observaciones').value = '';
        document.getElementById('dubicacion').classList.remove('d-none');
        document.getElementById('ubicacion').value = '';
        document.getElementById('ddistrito').classList.remove('d-none');
        document.getElementById('distrito').value = '';
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
        document.getElementById('dsec').classList.add('d-none');
        document.getElementById('sec').value = '';
        document.getElementById('destado').classList.add('d-none');
        document.getElementById('estado').selectedIndex = 2;
        document.getElementById('dobservacion').classList.add('d-none');
        document.getElementById('dubicacion').classList.add('d-none');
        document.getElementById('ddistrito').classList.add('d-none');        
    }
}

function mostrarTipoMovil(valor) 
{
    const any = "---"
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
        document.getElementById('dmodalidad').classList.remove('d-none');
        document.getElementById('modalidad').selectedIndex = 0;
        mostrarModalidadMovil('---'); 
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
        mostrarModalidadMovil('---');
        
        document.getElementById('lineaProce').addEventListener("change", function() {
            if (document.getElementById('lineaProce').value == "Postpago") 
            {
                document.getElementById('dmodalidad').classList.add('d-none');
                document.getElementById('modalidad').selectedIndex = 1;
                mostrarModalidadMovil('1'); 
            }
            else if (document.getElementById('lineaProce').value == "Prepago")
            {
                document.getElementById('dmodalidad').classList.remove('d-none');
                document.getElementById('modalidad').selectedIndex = 0;
                mostrarModalidadMovil('---');           
            }
            else if (document.getElementById('lineaProce').value == "---")
            {
                document.getElementById('dmodalidad').classList.add('d-none');
                document.getElementById('modalidad').selectedIndex = 0;
                mostrarModalidadMovil('---');           
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
        document.getElementById('modalidad').selectedIndex = 1;
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
        mostrarModalidadMovil('---');     
    }
}

function mostrarModalidadMovil(valor) 
{  
    const any = "---"
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
        document.getElementById('dsec').classList.remove('d-none');
        document.getElementById('sec').selectedIndex = 0;
        document.getElementById('destado').classList.add('d-none');
        document.getElementById('dobservacion').classList.remove('d-none');
        document.getElementById('observaciones').selectedIndex = 0;
        document.getElementById('dubicacion').classList.remove('d-none');
        document.getElementById('ubicacion').selectedIndex = 0;
        document.getElementById('ddistrito').classList.remove('d-none');
        document.getElementById('distrito').selectedIndex = 0;
    }
    else if (valor == post) 
    {
        document.getElementById('dplan').classList.remove('d-none');
        document.getElementById('plan').selectedIndex = 0;
        document.getElementById('dequipos').classList.remove('d-none');
        document.getElementById('equipos').selectedIndex = 0;
        document.getElementById('dformaPago').classList.remove('d-none');
        document.getElementById('formaPago').selectedIndex = 0;
        document.getElementById('dsec').classList.remove('d-none');
        document.getElementById('sec').selectedIndex = 0;
        document.getElementById('destado').classList.add('d-none');
        document.getElementById('dobservacion').classList.remove('d-none');
        document.getElementById('observaciones').selectedIndex = 0;
        document.getElementById('dubicacion').classList.remove('d-none');
        document.getElementById('ubicacion').selectedIndex = 0;
        document.getElementById('ddistrito').classList.remove('d-none');
        document.getElementById('distrito').selectedIndex = 0; 
    }
    else if (valor == any) 
    {   
        document.getElementById('dplan').classList.add('d-none');
        document.getElementById('plan').selectedIndex = 0;
        document.getElementById('dequipos').classList.add('d-none');
        document.getElementById('equipos').selectedIndex = 0;
        document.getElementById('dformaPago').classList.add('d-none');
        document.getElementById('formaPago').selectedIndex = 0;
        document.getElementById('dsec').classList.add('d-none');
        document.getElementById('sec').selectedIndex = 0;
        document.getElementById('destado').classList.add('d-none');
        document.getElementById('dobservacion').classList.add('d-none');
        document.getElementById('observaciones').selectedIndex = 0;
        document.getElementById('dubicacion').classList.add('d-none');
        document.getElementById('ubicacion').selectedIndex = 0;
        document.getElementById('ddistrito').classList.add('d-none');
        document.getElementById('distrito').selectedIndex = 0;     
    }
}
