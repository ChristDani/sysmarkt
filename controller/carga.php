<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargando...</title>
    <link rel="icon" href="../view/static/img/icono.png">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #121212;
            color: white;
            min-height: 100vh;
        }

        body, .cubo, .loading {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 20%;
            height: 300px;
        }

        .cubo {
            height: 60%;
            transform-style: preserve-3d;
            animation: rotar 8s linear infinite;
        }

        .cubo > span {
            position: absolute;
            width: 4em;
            height: 4em;
            border: 2px solid white;
            box-shadow: inset 0px 0px 15px 5px rgba(67, 195, 255, .2), 0px 0px 40px 1px rgba(67,195,255, .15);
            border-radius: 4px;
        }

        .cubo > span:nth-child(1) {
            transform: rotateY(90deg)translateZ(2em);
        }
        
        .cubo > span:nth-child(2) {
            transform: rotateY(90deg)translateZ(-2em);
        }
        
        .cubo > span:nth-child(3) {
            transform: rotateY(90deg)translateZ(-2em);
        }
        
        .cubo > span:nth-child(4) {
            transform: rotateY(90deg)translateZ(2em);
        }
        
        .cubo > span:nth-child(5) {
            transform: translateZ(-2em);
        }
        
        .cubo > span:nth-child(6) {
            transform: translateZ(2em);
        }
        
        .loading {
            height: 40%;
        }

        @keyframes rotar {
            0% {
                transform: rotateY(0deg)rotateX(0deg);
            }
            50% {
                transform: rotateY(360deg)rotateX(360deg);
            }
            100% {
                transform: rotateY(0deg)rotateX(0deg);
            }
        }

        h1, p {
            text-align: center;
            font-family: arial;
            font-weight: 100;
            letter-spacing: 2px;
            font-size: 18px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="cubo">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="loading">
            <div>
                <h1>Procesando Operaciones</h1>
                <p>. . . . . . . . . .</p>
            </div>
        </div>
    </div>
</body>
</html>