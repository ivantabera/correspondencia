$(document).ready(function(){

    /* Automatizar por peticion AJAX los campos de encargado y cargo */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $("#promotor_id").change(function(){
   
        var promotor=$("#promotor_id").val();
        $.ajax({
           type:'POST',
           url:"/promoremit/"+promotor,
           data:{id:promotor},
           success:function(data){
               if(data != ''){
                if(data.s == 1){
                    $(".firmado_por").val(data.promotordata.encargado);
                    $(".cargo").val(data.promotordata.cargo);
                } 
               } else {
                   console.log("no hay respuesta");
               }
              
           }
        });
  
    });

    /* Uso de select2 para los distintos select del formulario */
    $('.promotor').select2();
    $('.remitente').select2();
    $('.dirigido').select2();
    $('.tipo').select2();
    $('.expediente').select2();
    $('.turnado_a').select2();
     
 });