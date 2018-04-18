function modal_nuevo_trabajador() {

    $.ajax({
        url: 'modal_nueva_portada_login',
        type: 'GET',
        success: function (data) {

            $('#myModal').modal('show');
            $('#myModal').show().html(data);

            /*
             fn_actualizar_grilla('tabla_sectores', 'list_sectores');
             MensajeExito('Nuevo Contribuyente', 'El Sector Ha sido Insertado.');*/
        },
        error: function (data) {
            // mostraralertas('* Contactese con el Administrador...');
        }
    });

}

function editar_trabajador(id){
    //alert(id );
    $.ajax({
        url: 'get_trabajador_por_id',
        type: 'GET',
        data: {
            id_trabajador: id
        },
        success: function (data) {

            //alert("retorne del controlador "  + data[0].NOMBRE_TRABAJADOR);
            document.getElementById("id_trabajador").value = data[0].ID_TRABAJADOR;
            document.getElementById("nombre_trabajador_edit").value = data[0].NOMBRE_TRABAJADOR;
            document.getElementById("apellido_trabajador_edit").value = data[0].APELLIDO_TRABAJADOR;
            document.getElementById("dni_trabajador_edit").value = data[0].DNI_TRABAJADOR;

            $('#myModalEditar').modal('show');

        },
        error: function (data) {

        }
    });
}

function eliminar_trabajador(id){

    $.ajax({
        url: 'get_trabajador_por_id',
        type: 'GET',
        data: {
            id_trabajador: id
        },
        success: function (data) {
            document.getElementById("id_trabajador_eliminar").value = data[0].ID_TRABAJADOR;
            //alert(data[0].NOMBRE_TRABAJADOR);
            document.getElementById("nombre").innerHTML = data[0].NOMBRE_TRABAJADOR
            $('#myModalEliminar').modal('show');

        },
        error: function (data) {

        }
    });

}

function update_estado_trabajador(){

}