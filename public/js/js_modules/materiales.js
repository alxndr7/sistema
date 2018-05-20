function editar_material(id){
    //alert(id );
    $.ajax({
        url: 'get_material_por_id',
        type: 'GET',
        data: {
            id_material: id
        },
        success: function (data) {
            //alert("retorne del controlador "  + data[0].NOMBRE_TRABAJADOR);
            document.getElementById("id_material").value = id;
            document.getElementById("desc_material_editar").value = data[0].desc_material;
            document.getElementById("unidad_medida_material_editar").value = data[0].unidad_medida_material;
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