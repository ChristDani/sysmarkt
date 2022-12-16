function mostrarOrigenLanding() {
    let letrero = document.getElementById('MostrarOrigenClientes');
    let Seleccionar = document.getElementById('origenClientes');
    let Cwhats = document.getElementById('headerWhatsapp');
    let Cland = document.getElementById('headerLanding');
    let Rwhats = document.getElementById('resultadosW');
    let Rland = document.getElementById('resultadosL');
    let Pwhats = document.getElementById('paginacionW');
    let Pland = document.getElementById('paginacionL');
    
    letrero.innerHTML = "LANDING";
    Seleccionar.innerHTML = "<li><a class='dropdown-item' href='#' onclick='mostrarOrigenWhastapp();'>WHATSAPP</a></li>";
    Cwhats.classList.toggle('desaparecido');
    Cland.classList.toggle('desaparecido');
    Rwhats.classList.toggle('desaparecido');
    Rland.classList.toggle('desaparecido');
    Pwhats.classList.toggle('desaparecido');
    Pland.classList.toggle('desaparecido');
}

function mostrarOrigenWhastapp() {
    let letrero = document.getElementById('MostrarOrigenClientes');
    let Seleccionar = document.getElementById('origenClientes');
    let Cwhats = document.getElementById('headerWhatsapp');
    let Cland = document.getElementById('headerLanding');
    let Rwhats = document.getElementById('resultadosW');
    let Rland = document.getElementById('resultadosL');
    let Pwhats = document.getElementById('paginacionW');
    let Pland = document.getElementById('paginacionL');
    
    letrero.innerHTML = "WHATSAPP";
    Seleccionar.innerHTML = "<li><a class='dropdown-item' href='#' onclick='mostrarOrigenLanding();'>LANDING</a></li>";
    Cwhats.classList.toggle('desaparecido');
    Cland.classList.toggle('desaparecido');
    Rwhats.classList.toggle('desaparecido');
    Rland.classList.toggle('desaparecido');
    Pwhats.classList.toggle('desaparecido');
    Pland.classList.toggle('desaparecido');
}