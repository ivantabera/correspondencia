$(document).ready(function(){
    

    $("#promotor").change(function(){
        var promotor=$("#promotor").val();
        console.log("promotor",promotor);


        Swal.fire({
            title: 'Este es el valor de su promotor?',
            text: 'El valor del promotor es: ' + promotor,
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'Es correcto',
            cancelButtonText: 'No es correcto'
        }).then((result) => {
        if (result.value) {
            Swal.fire(
            'Continuar!',
            'ok continua.',
            'success'
            )
        // For more information about handling dismissals please visit
        // https://sweetalert2.github.io/#handling-dismissals
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
            'Cancela',
            'ok estamos cancelando :)',
            'error'
            );
        }
        });

       
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