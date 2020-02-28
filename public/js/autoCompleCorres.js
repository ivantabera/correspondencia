$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $("#promotor").change(function(){
   
        var promotor=$("#promotor").val();
   
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

 });