function generar_comisiones(id){


    //alert(id );
    $.ajax({
        url: 'get_comision_por_fecha',
        type: 'GET',
        data: {
            fecha_inicio:  document.getElementById("fecha_inicio").value,
            fecha_fin:  document.getElementById("fecha_fin").value
        },
        success: function (data) {
            //alert("retorne del controlador "  + data[0].NOMBRE_TRABAJADOR);
            $('#tabla_ajax').html(data);
        },
        error: function (data) {
        }
    });
}

function eliminar_material(id){

    $.ajax({
        url: 'get_material_por_id',
        type: 'GET',
        data: {
            id_material: id
        },
        success: function (data) {
            document.getElementById("id_material_eliminar").value = id;
            document.getElementById("nombre").innerHTML = data[0].desc_material
            $('#myModalEliminar').modal('show');

        },
        error: function (data) {

        }
    });

}