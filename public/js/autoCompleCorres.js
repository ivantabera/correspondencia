$(document).ready(function(){
    

    $("#promotor").click(function(){
        var promotor=$("#promotor").val();
        console.log("promotor",promotor);

       
        /* $.ajax
        ({
            url:'test',
            type:'post',
            dataType:'json',
            data:{'email':correo,'_token': llave},

            
            success: function (data)
            {
                var nombre=data.nombre;
                var twitter=data.twitter;
                
                alert(nombre);
                alert(twitter);
            }
            
            
        }); */
    });
 });