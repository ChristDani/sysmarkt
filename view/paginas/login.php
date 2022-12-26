<?php
$mensajeLogin = isset($_SESSION["Mensajesysmarkt"]) ? $_SESSION["Mensajesysmarkt"] : null;
$intentos = isset($_SESSION["intentossysmarkt"]) ? $_SESSION["intentossysmarkt"] : 0;

if ($intentos == 3) {?>
    <script>
        var timejsjs = 180000
        let timeshow = 0
            setInterval(() => {
                if (timejsjs > 0) {
                    timejsjs = timejsjs-1000;
                    timeshow = timejsjs / 1000;
                } else{
                    window.location.href = 'controller/acceso/logout.php';
                }
            }, 1000);
    </script>
<?php } ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Argosal</title>
    <link rel="icon" href="view/static/img/icono.png">
    <link rel="stylesheet" href="view/static/css/reset.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="view/static/css/styleLogin.css">
</head>
<body>
    <div class="m-0 vh-100" id="imagen">
        <div class="fondo m-0 vh-100 row">
            <div class="row justify-content-center align-items-center" >
                <div class="col-auto text-center">
                    <?php if ($intentos < 3) {?>
                    <div class="card login-card">
                        <div class="card-body">
                            <div class="login-card-header">
                                <h1>Iniciar sesion</h1>
                                <p><?php echo $mensajeLogin; ?></p>
                            </div>
                            <form action="controller/acceso/login.php" method="post" class="login-card-form">
                                <div class="form-item mb-3">
                                    <ion-icon name="person-outline"></ion-icon>
                                    <input class="form-control" type="number" name="dni" id="dni" required autocomplete='off' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="8" placeholder="Ingresa tu DNI">
                                </div>
                                <div class="form-item mb-3">
                                    <ion-icon name="lock-closed-outline"></ion-icon>
                                    <input class="form-control" type="password" name="clave" id="clave" required autocomplete='off' placeholder="Ingresa tu clave">
                                </div>
                                <div>
                                    <button type="submit" class="mx-2 px-5">Entrar</button>
                                </div>
                            </form>                
                    <?php }elseif ($intentos == 3) {?>
                        <div class="card login-card overflow-hidden" id="nope">
                            <div class="card-body">
                                <div class="login-card-header">
                                    <h1>Iniciar sesion</h1>
                                </div>
                                <div action="controller/acceso/login.php" method="post" class="login-card-form">
                                    <div class="form-item mb-3">
                                        <ion-icon name="person-outline"></ion-icon>
                                        <input class="form-control" type="text" placeholder="Ingresa tu DNI">
                                    </div>
                                    <div class="form-item mb-3">
                                        <ion-icon name="lock-closed-outline"></ion-icon>
                                        <input class="form-control" type="password" placeholder="Ingresa tu clave">
                                    </div>
                                    <div>
                                        <button type="submit" class="mx-2 px-5">Entrar</button>
                                    </div>
                                </div>                
                            <div class="blocked p-4">
                                <div class="blocked-header">
                                    <p class="color">Excedio el limite de intentos</p>
                                </div>
                                <p class="danger iconp"><ion-icon name="close-circle-outline"></ion-icon></p>
                                <div class="blocked-header">
                                    <p class='color'>Para volver a intentar<span id="tiempoespera" class="coldown">180</span><br><span class="text-muted">No recargue la web</span></p>
                                </div>
                            </div>
                            <script>
                                let timeespera = document.getElementById('tiempoespera');
                                setInterval(() => {
                                    timeespera.innerHTML = timeshow;
                                }, 1000);
                            </script>
                    <?php }?>
                        </div>
                    </div>
                </div>
                <div class="col-auto px-5">
                    <div class="hours">
                        <div class="date d-flex gap-3 align-items-center">
                            <p id="hora"></p>
                            <p id="min"></p>
                            <div class="two text-center">
                                <p id="second"></p>
                                <p id="pre"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
<script src="view/static/js/login.js"></script>
</body>
</html>