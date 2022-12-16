function mostrarUbicac() 
{
    let letrero = document.getElementById('MostrarOrigenUbicacion');
    let Seleccionar = document.getElementById('origenUbicacion');

    let Ccac = document.getElementById('headerCac');
    let Rcac = document.getElementById('resultadosCac');
    let Pcac = document.getElementById('paginacionCac');

    let Cdac = document.getElementById('headerDac');
    let Rdac = document.getElementById('resultadosDac');
    let Pdac = document.getElementById('paginacionDac');

    let Cacd = document.getElementById('headerAcd');
    let Racd = document.getElementById('resultadosAcd');
    let Pacd = document.getElementById('paginacionAcd');

    let Ccade = document.getElementById('headerCade');
    let Rcade = document.getElementById('resultadosCade');
    let Pcade = document.getElementById('paginacionCade');
    
    letrero.innerHTML = "CAC'S";
    Seleccionar.innerHTML = "<li><a class='dropdown-item' href='#' onclick='mostrarUbidac();'>DAC'S</a></li><li><a class='dropdown-item' href='#' onclick='mostrarUbiacd();'>ACD'S</a></li><li><a class='dropdown-item' href='#' onclick='mostrarUbicadena();'>CADENAS</a></li>";

    Ccac.classList.remove('desaparecido');
    Rcac.classList.remove('desaparecido');
    Pcac.classList.remove('desaparecido');

    Cdac.classList.add('desaparecido');
    Rdac.classList.add('desaparecido');
    Pdac.classList.add('desaparecido');

    Cacd.classList.add('desaparecido');
    Racd.classList.add('desaparecido');
    Pacd.classList.add('desaparecido');

    Ccade.classList.add('desaparecido');
    Rcade.classList.add('desaparecido');
    Pcade.classList.add('desaparecido');
}

function mostrarUbidac() 
{
    let letrero = document.getElementById('MostrarOrigenUbicacion');
    let Seleccionar = document.getElementById('origenUbicacion');
    
    let Ccac = document.getElementById('headerCac');
    let Rcac = document.getElementById('resultadosCac');
    let Pcac = document.getElementById('paginacionCac');

    let Cdac = document.getElementById('headerDac');
    let Rdac = document.getElementById('resultadosDac');
    let Pdac = document.getElementById('paginacionDac');

    let Cacd = document.getElementById('headerAcd');
    let Racd = document.getElementById('resultadosAcd');
    let Pacd = document.getElementById('paginacionAcd');

    let Ccade = document.getElementById('headerCade');
    let Rcade = document.getElementById('resultadosCade');
    let Pcade = document.getElementById('paginacionCade');
    
    letrero.innerHTML = "DAC'S";
    Seleccionar.innerHTML = "<li><a class='dropdown-item' href='#' onclick='mostrarUbicac();'>CAC'S</a></li><li><a class='dropdown-item' href='#' onclick='mostrarUbiacd();'>ACD'S</a></li><li><a class='dropdown-item' href='#' onclick='mostrarUbicadena();'>CADENAS</a></li>";
    
    Ccac.classList.add('desaparecido');
    Rcac.classList.add('desaparecido');
    Pcac.classList.add('desaparecido');

    Cdac.classList.remove('desaparecido');
    Rdac.classList.remove('desaparecido');
    Pdac.classList.remove('desaparecido');

    Cacd.classList.add('desaparecido');
    Racd.classList.add('desaparecido');
    Pacd.classList.add('desaparecido');

    Ccade.classList.add('desaparecido');
    Rcade.classList.add('desaparecido');
    Pcade.classList.add('desaparecido');
}

function mostrarUbiacd() 
{
    let letrero = document.getElementById('MostrarOrigenUbicacion');
    let Seleccionar = document.getElementById('origenUbicacion');
    
    let Ccac = document.getElementById('headerCac');
    let Rcac = document.getElementById('resultadosCac');
    let Pcac = document.getElementById('paginacionCac');

    let Cdac = document.getElementById('headerDac');
    let Rdac = document.getElementById('resultadosDac');
    let Pdac = document.getElementById('paginacionDac');

    let Cacd = document.getElementById('headerAcd');
    let Racd = document.getElementById('resultadosAcd');
    let Pacd = document.getElementById('paginacionAcd');

    let Ccade = document.getElementById('headerCade');
    let Rcade = document.getElementById('resultadosCade');
    let Pcade = document.getElementById('paginacionCade');
    
    letrero.innerHTML = "ACD'S";
    Seleccionar.innerHTML = "<li><a class='dropdown-item' href='#' onclick='mostrarUbicac();'>CAC'S</a></li><li><a class='dropdown-item' href='#' onclick='mostrarUbidac();'>DAC'S</a></li><li><a class='dropdown-item' href='#' onclick='mostrarUbicadena();'>CADENAS</a></li>";
    
    Ccac.classList.add('desaparecido');
    Rcac.classList.add('desaparecido');
    Pcac.classList.add('desaparecido');

    Cdac.classList.add('desaparecido');
    Rdac.classList.add('desaparecido');
    Pdac.classList.add('desaparecido');

    Cacd.classList.remove('desaparecido');
    Racd.classList.remove('desaparecido');
    Pacd.classList.remove('desaparecido');

    Ccade.classList.add('desaparecido');
    Rcade.classList.add('desaparecido');
    Pcade.classList.add('desaparecido');
}

function mostrarUbicadena() 
{
    let letrero = document.getElementById('MostrarOrigenUbicacion');
    let Seleccionar = document.getElementById('origenUbicacion');
    
    let Ccac = document.getElementById('headerCac');
    let Rcac = document.getElementById('resultadosCac');
    let Pcac = document.getElementById('paginacionCac');

    let Cdac = document.getElementById('headerDac');
    let Rdac = document.getElementById('resultadosDac');
    let Pdac = document.getElementById('paginacionDac');

    let Cacd = document.getElementById('headerAcd');
    let Racd = document.getElementById('resultadosAcd');
    let Pacd = document.getElementById('paginacionAcd');

    let Ccade = document.getElementById('headerCade');
    let Rcade = document.getElementById('resultadosCade');
    let Pcade = document.getElementById('paginacionCade');
    
    letrero.innerHTML = "CADENAS";
    Seleccionar.innerHTML = "<li><a class='dropdown-item' href='#' onclick='mostrarUbicac();'>CAC'S</a></li><li><a class='dropdown-item' href='#' onclick='mostrarUbidac();'>DAC'S</a></li><li><a class='dropdown-item' href='#' onclick='mostrarUbiacd();'>ACD'S</a></li>";
    
    Ccac.classList.add('desaparecido');
    Rcac.classList.add('desaparecido');
    Pcac.classList.add('desaparecido');

    Cdac.classList.add('desaparecido');
    Rdac.classList.add('desaparecido');
    Pdac.classList.add('desaparecido');

    Cacd.classList.add('desaparecido');
    Racd.classList.add('desaparecido');
    Pacd.classList.add('desaparecido');

    Ccade.classList.remove('desaparecido');
    Rcade.classList.remove('desaparecido');
    Pcade.classList.remove('desaparecido');
}
