function editar_deco(id){
    //alert(id );
    $.ajax({
        url: 'get_deco_por_id',
        type: 'GET',
        data: {
            id_deco: id
        },
        success: function (data) {

            //alert("retorne del controlador "  + data[0].NOMBRE_TRABAJADOR);
            document.getElementById("id_deco").value = id;
            document.getElementById("smart_card_editar").value = data[0].smart_card;
            document.getElementById("serial_editar").value = data[0].serie;
            $('#myModalEditar').modal('show');
        },
        error: function (data) {
        }
    });
}

function eliminar_deco(id){

    $.ajax({
        url: 'get_deco_por_id',
        type: 'GET',
        data: {
            id_deco: id
        },
        success: function (data) {
            document.getElementById("id_deco_eliminar").value = id;
            document.getElementById("nombre").innerHTML = data[0].serie
            $('#myModalEliminar').modal('show');

        },
        error: function (data) {

        }
    });

}