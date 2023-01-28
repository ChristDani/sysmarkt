<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Argosal | 404</title>
    <link rel="icon" href="view/static/img/<?php echo $iconoglobalyfijodeempresa; ?>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@300;400;500;600;700;800;900&display=swap');
        *{
            top:0; left:0;
            margin:0;
            padding:0;
        }

        .containt{
        height: 100vh;
        background: -webkit-linear-gradient(to top, #040308, #AD4A28, #DD723C, #FC7001, #DCB697, #9BA5AE, #3E5879, #020B1A);
        background: -moz-linear-gradient(to top, #040308, #AD4A28, #DD723C, #FC7001, #DCB697, #9BA5AE, #3E5879, #020B1A);
        background: linear-gradient(to top, #AD4A28, #DD723C, #FC7001, #DCB697, #9BA5AE, #3E5879);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items:center;
        }
        
        .cloud{
            display: flex;
            flex-direction: column;
            justify-content: center;
            font-family: 'Montserrat Alternates', sans-serif;
            align-items: center;
            color: #f6f6f9;
        }

        a{
            text-decoration: none;
            color: #f6f6f9;
        }

        .btn{
            margin-top: 2rem;
            font-size: 20px;
            background: #202528;
            padding: 10px 20px;
            border-radius: 20px;
            transition: .3s ease;
        }

        .btn:hover{
            transform: scale(1.5);
        }

        .start{
            font-size: 100px;
        }
        .body{
            font-size: 40px;
            text-align: center;
        }

        .end{
            font-size: 200px;
        }
    </style>
</head>
<body class="containt">
    <div class="cloud">
        <H1 class="end">404</H1>
        <P class="body">PAGINA NO ENCONTRADA</P>
        <a onclick="window.history.back();" href="#" class="btn">INICIO</a>
    </div>
</body>
</html>