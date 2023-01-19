
// funciones de mostrado de elementos

    // planes de linea fija
        function mostrarAgregarFija()
        {
            document.getElementById('contenidoagregarplanFija').classList.remove('d-none');
            document.getElementById('contenidoeditarplanFija').classList.add('d-none');
        } 

        function ocultarAgregarFija()
        {
            document.getElementById('contenidoagregarplanFija').classList.add('d-none');
        } 


        function mostrarEdicionFija(code,plan)
        {
            document.getElementById('contenidoeditarplanFija').classList.remove('d-none');
            document.getElementById('contenidoagregarplanFija').classList.add('d-none');
            document.getElementById('codigoFija').value = code;
            document.getElementById('planeditFija').value = plan;
            document.getElementById('planeditFijaactual').value = plan;
        } 

        function ocultarEdicionFija()
        {
            document.getElementById('contenidoeditarplanFija').classList.add('d-none');
        }

    // planes de linea movil
        function mostrarAgregarMovil()
        {
            document.getElementById('contenidoagregarplanMovil').classList.remove('d-none');
            document.getElementById('contenidoeditarplanMovil').classList.add('d-none');
        } 

        function ocultarAgregarMovil()
        {
            document.getElementById('contenidoagregarplanMovil').classList.add('d-none');
        } 

        function mostrarEdicionMovil(code,plan)
        {
            document.getElementById('contenidoeditarplanMovil').classList.remove('d-none');
            document.getElementById('contenidoagregarplanMovil').classList.add('d-none');
            document.getElementById('codigoMovil').value = code;
            document.getElementById('planeditMovil').value = plan;
            document.getElementById('planeditMovilactual').value = plan;
        } 

        function ocultarEdicionMovil()
        {
            document.getElementById('contenidoeditarplanMovil').classList.add('d-none');
        }

    // pomociones
        function mostrarAgregarPromo()
        {
            document.getElementById('contenidoagregarPromo').classList.remove('d-none');
            document.getElementById('contenidoeditarPromo').classList.add('d-none');
        } 

        function ocultarAgregarPromo()
        {
            document.getElementById('contenidoagregarPromo').classList.add('d-none');
        } 

        function mostrarEdicionPromo(code,plan)
        {
            document.getElementById('contenidoeditarPromo').classList.remove('d-none');
            document.getElementById('contenidoagregarPromo').classList.add('d-none');
            document.getElementById('codigoPromo').value = code;
            document.getElementById('editPromoactual').value = plan;
            document.getElementById('editPromo').value = plan;
        } 

        function ocultarEdicionPromo()
        {
            document.getElementById('contenidoeditarPromo').classList.add('d-none');
        }
    
// funciones con operaciones

    // planes de linea fija
        function listarFija() 
        {
            let contenido = document.getElementById('contenidoFija');

            let url='controller/planes/listarFija.php';
            let formaData = new FormData()

            fetch(url,{
                method: "POST",
                body: formaData
            }).then(response=>response.json())
            .then(data=>{
                contenido.innerHTML = data.data;
            }).catch(err=>console.log(err))
        }

        function agregarplanFija() 
        {
            let plan = document.getElementById('planFija').value;

            let url='controller/planes/agregarFija.php';
            let formaData = new FormData()
            formaData.append('plan', plan)

            fetch(url,{
                method: "POST",
                body: formaData
            }).then(response=>response.json())
            .then(data=>{
                console.log(data);
            }).catch(err=>console.log(err))

            setTimeout(() => {
                listarFija();
            }, 200);
            
            document.getElementById('contenidoagregarplanFija').classList.add('d-none');
        }

        function editarplanFija() 
        {
            let code = document.getElementById('codigoFija').value;
            let plan = document.getElementById('planeditFija').value;
            let planactual = document.getElementById('planeditFijaactual').value;

            let url='controller/planes/editarFija.php';
            let formaData = new FormData()
            formaData.append('code', code)
            formaData.append('plan', plan)
            formaData.append('planactual', planactual)

            fetch(url,{
                method: "POST",
                body: formaData
            }).then(response=>response.json())
            .then(data=>{
                console.log(data);
            }).catch(err=>console.log(err))
            
            setTimeout(() => {
                listarFija();
            }, 200);
            
            document.getElementById('contenidoeditarplanFija').classList.add('d-none');
        }

    // planes de linea movil
        function listarMovil() 
        {
            let contenido = document.getElementById('contenidoMovil');

            let url='controller/planes/listarMovil.php';
            let formaData = new FormData()

            fetch(url,{
                method: "POST",
                body: formaData
            }).then(response=>response.json())
            .then(data=>{
                contenido.innerHTML = data.data;
            }).catch(err=>console.log(err))
        }

        function agregarplanMovil() 
        {
            let plan = document.getElementById('planMovil').value;

            let url='controller/planes/agregarMovil.php';
            let formaData = new FormData()
            formaData.append('plan', plan)

            fetch(url,{
                method: "POST",
                body: formaData
            }).then(response=>response.json())
            .then(data=>{
                console.log(data);
            }).catch(err=>console.log(err))

            setTimeout(() => {
                listarMovil();
            }, 200);
            
            document.getElementById('contenidoagregarplanMovil').classList.add('d-none');
        }

        function editarplanMovil() 
        {
            let code = document.getElementById('codigoMovil').value;
            let plan = document.getElementById('planeditMovil').value;
            let planactual = document.getElementById('planeditMovilactual').value;

            let url='controller/planes/editarMovil.php';
            let formaData = new FormData()
            formaData.append('code', code)
            formaData.append('plan', plan)
            formaData.append('planactual', planactual)

            fetch(url,{
                method: "POST",
                body: formaData
            }).then(response=>response.json())
            .then(data=>{
                console.log(data);
            }).catch(err=>console.log(err))
            
            setTimeout(() => {
                listarMovil();
            }, 200);
            
            document.getElementById('contenidoeditarplanMovil').classList.add('d-none');
        }
        
    // promociones
        function listarPromo() 
        {
            let contenido = document.getElementById('contenidoPromo');

            let url='controller/planes/listarPromo.php';
            let formaData = new FormData()

            fetch(url,{
                method: "POST",
                body: formaData
            }).then(response=>response.json())
            .then(data=>{
                contenido.innerHTML = data.data;
            }).catch(err=>console.log(err))
        }

        function agregarPromo() 
        {
            let promo = document.getElementById('Promo').value;

            let url='controller/planes/agregarPromo.php';
            let formaData = new FormData()
            formaData.append('promo', promo)

            fetch(url,{
                method: "POST",
                body: formaData
            }).then(response=>response.json())
            .then(data=>{
                console.log(data);
            }).catch(err=>console.log(err))

            setTimeout(() => {
                listarPromo();
            }, 200);
            
            document.getElementById('contenidoagregarPromo').classList.add('d-none');
        }

        function editarPromo() 
        {
            let code = document.getElementById('codigoPromo').value;
            let promo = document.getElementById('editPromo').value;
            let promoactual = document.getElementById('editPromoactual').value;

            let url='controller/planes/editarPromo.php';
            let formaData = new FormData()
            formaData.append('code', code)
            formaData.append('promo', promo)
            formaData.append('promoactual', promoactual)

            fetch(url,{
                method: "POST",
                body: formaData
            }).then(response=>response.json())
            .then(data=>{
                console.log(data);
            }).catch(err=>console.log(err))
            
            setTimeout(() => {
                listarPromo();
            }, 200);
            
            document.getElementById('contenidoeditarPromo').classList.add('d-none');
        }


// funciones de eliminacion para cualquier plan o promocion

    function eliminarplan(tipo,code,plan) 
    {
        if (tipo == 0) 
        {
            document.getElementById('botondevolveralosplanes').innerHTML="<div class='btn btn-secondary' data-bs-target='#planesFija' data-bs-toggle='modal'>Volver</div>";
            document.getElementById('botoneliminarplan').innerHTML="<button class='btn btn-danger' onclick='yadeunavezplan(\""+tipo+"\",\""+code+"\",\""+plan+"\");' data-bs-target='#planesFija' data-bs-toggle='modal'>Eliminar</button>";
            document.getElementById('nombreplanEliminar').innerHTML=" el plan de lineas fijas '<span class='text-info'>"+plan+"</span>'";
        }
        else if (tipo == 1) 
        {
            document.getElementById('botondevolveralosplanes').innerHTML="<div class='btn btn-secondary' data-bs-target='#planesMoviles' data-bs-toggle='modal'>Volver</div>";
            document.getElementById('botoneliminarplan').innerHTML="<button class='btn btn-danger' onclick='yadeunavezplan(\""+tipo+"\",\""+code+"\",\""+plan+"\");' data-bs-target='#planesMoviles' data-bs-toggle='modal'>Eliminar</button>";
            document.getElementById('nombreplanEliminar').innerHTML=" el plan de lineas moviles  '<span class='text-info'>"+plan+"</span>'";
        }
        else if (tipo == 2) 
        {
            document.getElementById('botondevolveralosplanes').innerHTML="<div class='btn btn-secondary' data-bs-target='#Promociones' data-bs-toggle='modal'>Volver</div>";
            document.getElementById('botoneliminarplan').innerHTML="<button class='btn btn-danger' onclick='yadeunavezplan(\""+tipo+"\",\""+code+"\",\""+plan+"\");' data-bs-target='#Promociones' data-bs-toggle='modal'>Eliminar</button>";
            document.getElementById('nombreplanEliminar').innerHTML=" la promoción '<span class='text-info'>"+plan+"</span>'";
        }
    }

    function yadeunavezplan(tipo,code,plan)
    {
        let url='controller/planes/eliminarplan.php';
        let formaData = new FormData()
        formaData.append('tipo', tipo)
        formaData.append('code', code)
        formaData.append('plan', plan)

        fetch(url,{
            method: "POST",
            body: formaData
        }).then(response=>response.json())
        .then(data=>{
            console.log(data);
        }).catch(err=>console.log(err))
        
        if (tipo == 0) {
            setTimeout(() => {
                listarFija();
            }, 200);
        }
        else if (tipo == 1) {
            setTimeout(() => {
                listarMovil();
            }, 200);
        }
        else if (tipo == 2) {
            setTimeout(() => {
                listarPromo();
            }, 200);
        }
    }