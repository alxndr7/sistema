function editar_comision(id){
    //alert(id );
    $.ajax({
        url: 'get_comision_por_id',
        type: 'GET',
        data: {
            id_comision: id
        },
        success: function (data) {
            //alert("retorne del controlador "  + data[0].NOMBRE_TRABAJADOR);
            document.getElementById("id_comision").value = id;
            document.getElementById("i_deco_basico").value = data[0].i_deco_adi;
            document.getElementById("i_deco_adi").value = data[0].i_deco_basico;
            document.getElementById("s_mudanza").value = data[0].s_mudanza;
            document.getElementById("s_otros").value = data[0].s_otros;
            document.getElementById("s_deco_adi").value = data[0].s_deco_adi;


            $('#myModalEditar').modal('show');
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