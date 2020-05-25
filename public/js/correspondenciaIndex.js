$(document).ready(function(){

    /* Automatizar por peticion AJAX los campos de encargado y cargo */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     
 });

 //funcion para saber que documentos se dara de baja
 function fnBajaCorr(comp){
    let id = comp.id;
    let bajaValue = comp.value;
    console.log("el id es: " + id + " el valor es: " +bajaValue);

    Swal.fire({
        title: '¿Deseas dar de baja este turno de correspondencia?',
        html:
            '<form class="form-horizontal">' +
                '<div class="form-group">' +
                    '<label class="control-label" for="fechSalida">Fecha de salida</label>' +
                        '<input type="date" id="fechSalida" class="bajaFormInput form-control fechSalida" name="fechSalida">' +
                '</div>' +
                '<div class="form-group">' +
                    '<label class="control-label" for="fechBaja">Fecha de baja</label>' +
                        '<input type="date" id="fechBaja" class="bajaFormInput form-control fechBaja" name="fechBaja">' +
                '</div>' +
                '<div class="form-group">' +
                    '<label class="control-label" for="distribuyo">Distribuyo</label>' +
                        '<input type="text" id="distribuyo" class="bajaFormInput form-control distribuyo" name="distribuyo">' +
                '</div>' +
                '<div class="form-group">' +
                    '<label class="control-label" for="ots">O.T.S</label>' +
                        '<input type="text" id="ots" class="bajaFormInput form-control ots" name="ots">' +
                '</div>' +
                '<div class="form-group">' +
                    '<label class="control-label" for="dirigido">Dirigido</label>' +
                        '<input type="text" id="dirigido" class="bajaFormInput form-control dirigido" name="dirigido">' +
                '</div>' +
                '<div class="form-group">' +
                    '<label class="control-label" for="acuseSellos">Acuse GIF con sellos</label>' +
                        '<input type="text" id="acuseSellos" class="bajaFormInput form-control acuseSellos" name="acuseSellos">' +
                '</div>' +
                '<div class="form-group">' +
                    '<label class="control-label" for="observac">Observaciones</label>' +
                        '<input type="text" id="observac" class="bajaFormInput form-control observac" name="observac">' +
                '</div>' +
                '<div class="form-group">' +
                    '<label class="control-label" for="exp">Expediente</label>' +
                        '<input type="text" id="exp" class="bajaFormInput form-control exp" name="exp">' +
                '</div>' +
                '<div class="form-group">' +
                    '<label class="control-label" for="nomArch">Nombre de archivo electrónico</label>' +
                        '<input type="text" id="nomArch" class="bajaFormInput form-control nomArch" name="nomArch">' +
                '</div>' +
            '</form>',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var fechSalida = jQuery("input[name='fechSalida']" ).val();
            var fechBaja = jQuery("input[name='fechBaja']" ).val();
            var distribuyo = jQuery("input[name='distribuyo']" ).val();
            var ots = jQuery("input[name='ots']" ).val();
            var dirigido = jQuery("input[name='dirigido']" ).val();
            var acuseSellos = jQuery("input[name='acuseSellos']" ).val();
            var observac = jQuery("input[name='observac']" ).val();
            var exp = jQuery("input[name='exp']" ).val();
            var nomArch = jQuery("input[name='nomArch']" ).val();
            jQuery.ajax({
                type: "POST",
                url: "correspondencia/baja",
                data: { 
                    'idBaja': bajaValue, 
                    'fechSalida': fechSalida,
                    'fechBaja': fechBaja,
                    'distribuyo': distribuyo,
                    'ots': ots,
                    'dirigido': dirigido,
                    'acuseSellos': acuseSellos,
                    'observac': observac,
                    'exp': exp,
                    'nomArch': nomArch
                },
                success: function(resp) {
                    console.log("respuesta",resp);
                    if (resp.s == 1) {
                        swal.fire({
                            title: 'Baja exitosa',
                            icon: 'success',
                            html: 'La baja de este documento ha sido exitosa',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if(result.value){
                                window.location.href = "/correspondencia";
                            }
                        });

                    } else {
                        swal.fire({
                            title: 'Oops..',
                            icon: 'error',
                            html: 'Dificultades en la baja del documento',
                            confirmButtonText: 'Aceptar'
                        })
                    }


                },
            });
        } 
    });
}