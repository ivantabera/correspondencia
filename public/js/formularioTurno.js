$(document).ready(function(){
    /* Automatizar por peticion AJAX los campos de encargado y cargo */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("input[name=semaforo]").css("display", "none");
    
    $("input[name=semaforo]").click(function(){
   
        var semaforo=  $('input:radio[name=semaforo]:checked').val();

        if(semaforo == 1){
            dias = 0;
        } else if(semaforo == 4){
            dias = 1;
        } else if(semaforo ==3){
            dias = 3;
        } else if(semaforo ==2){
            dias = 5;
        }

        $.ajax({
           type:'POST',
           url:"/turno/getajax",
           data:{semaforo:semaforo, dias:dias},
           success:function(data){
               if(data != ''){
                if(data.s == 1){
                    $(".respuesta_auto").val(data.semaforodata.nombre);
                    $(".compromiso_date").val(data.fechaCompromiso);
                } 
               } else {
                   console.log("no hay respuesta");
               }
              
           }
        });
    });

});