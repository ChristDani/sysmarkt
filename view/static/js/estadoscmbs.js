let dni = document.getElementById('dniusuarioparaloscambiosdeestadoXD').textContent;
let estado = document.getElementById('estadousuarioparaloscambiosdeestadoXD').textContent;

console.log(dni,estado);

document.documentElement.addEventListener('load', conectarusuario(dni, estado))

function desconectarusuario(dni) 
{
    
}

function conectarusuario(dni, estado) 
{
    if (estado != 1 && estado != 3)
    {
        // window.location.href = "controller/usuario/conectarUsuario.php?dni="+dni;
    }
    else
    {
        console.log('El usuario ya se encuentra presente :D');
    }
}

function ausentarusuario(dni) 
{
    window.location.href = "controller/usuario/reposarUsuario.php?dni="+dni;
}
