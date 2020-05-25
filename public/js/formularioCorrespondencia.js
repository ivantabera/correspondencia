$(document).ready(function(){

    
    $("#hora_acuse").hide();
    $("#remitente_id").hide();
    $("#dirigido_id").hide();
    $("#antecedente").hide();
    $("#particular").hide();
    $("#firmado_por").hide();
    $("#cargo").hide();
    $("#expediente_id").hide();
    $("#clasificacion").hide();
    $('#evento').hide();
    $('#date_evento').hide();
    $('#hora_evento').hide();
    $('#lbEvento').hide();
    $('#lbDateEvent').hide();
    $('#lbHorEvento').hide();
    
    $("#regEvent").on('change', function(){
        if(this.checked){
            $('#evento').show();
            $('#date_evento').show();
            $('#hora_evento').show();
            $('#lbEvento').show();
            $('#lbDateEvent').show();
            $('#lbHorEvento').show();
        }else{
            $('#evento').hide();
            $('#date_evento').hide();
            $('#hora_evento').hide();
            $('#lbEvento').hide();
            $('#lbDateEvent').hide();
            $('#lbHorEvento').hide();
        }
    });

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
    /* $('.remitente').select2();
    $('.dirigido').select2(); 
    $('.expediente').select2();*/
    $('.tipo').select2();
    
   /*  $('.turnado_a').select2(); */
     
 });