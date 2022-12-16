<div class="modal fade" id="EditarWhatsapp" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Editar</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editarWhats" action="controller/whatsapp/editar.php" method="post">
        
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <div class="btn btn-secondary" data-bs-target="#DetallesWhatsapp" data-bs-toggle="modal">Volver</div>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
      </div>
    </div>
  </div>
</div>
<script>

    function arreglarnombreeditar()
    {
        let dni = document.querySelector('.dniarr');
        let nombre = document.querySelector('.nombrearr');
        
        if (dni.value.length == 8) 
        { 
            let url='controller/whatsapp/arreglarnombre.php';
            let formaData = new FormData()
            formaData.append('dni', dni.value)
    
            fetch(url,{
                method: "POST",
                body: formaData
            }).then(response=>response.json())
            .then(data=>{
                nombre.value=data.data.nombres+" "+data.data.apellidoPaterno+" "+data.data.apellidoMaterno;
            }).catch(err=>console.log(err))
        }


    }

</script>