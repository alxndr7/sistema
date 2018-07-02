cont_decos = 1;
array_decos = [];
array_materiales = [];
array_validar_decos= [];
array_eliminar_decos = [];

function agregar_deco(){
    //alert(id );
   //alert(document.getElementById('select_deco').value);
    var id_deco = document.getElementById('select_deco').value;
    var decoSelect = document.getElementById("select_deco");
    var selectedText = decoSelect.options[decoSelect.selectedIndex].text;
    var fila = document.createElement("tr");
    fila.id = 'deco_' + id_deco;
    var tabla = document.getElementById("tabla_decos").getElementsByTagName('tbody')[0];
    //var tableRef = document.getElementById('myTable').getElementsByTagName('tbody')[0];
    var col1 = document.createElement("td");
    col1.align = "center";
    var col2 = document.createElement("td");
    col2.align = "center";
    var col3 = document.createElement("td");
    col3.align = "center";
    col1.innerHTML = cont_decos++;
    col2.innerHTML = selectedText;
    col3.innerHTML = '<a class="btn btn-danger btn-xs" href="javascript:quitar_decos('+id_deco +');">Eliminar</a>';
    fila.appendChild(col1);
    fila.appendChild(col2);
    fila.appendChild(col3);
    tabla.appendChild(fila);

    array_decos.push(id_deco);
    document.getElementById('ids_dcos').value = array_decos;

}
function quitar_decos(id_tr){
// remove an item by value:
    //myArray.splice(myArray.indexOf('MenuB'),1);
    $('#deco_'+id_tr).remove();
    array_decos.splice(array_decos.indexOf(id_tr),1);
    document.getElementById('ids_dcos').value = array_decos;
// push a new one on
    //myArray.push('MenuZ');
}

function agregar_material(){
    var id_mat = document.getElementById('select_material').value;
    var matSelect = document.getElementById("select_material");
    var selectedTextMat = matSelect.options[matSelect.selectedIndex].text;
    var cantidad = document.getElementById('cantidad_select').value;

    var tabla = document.getElementById("tabla_materiales").getElementsByTagName('tbody')[0];
    var fila = document.createElement("tr");
    fila.id = 'mat_' + id_mat;

    var col1 = document.createElement("td");
    col1.align = "center";
    var col2 = document.createElement("td");
    col2.align = "center";
    var col3 = document.createElement("td");
    col3.align = "center";
    var col4 = document.createElement("td");
    col4.align = "center";

    col1.innerHTML = cont_decos++;

    col2.innerHTML = selectedTextMat;
    col3.innerHTML = '<input type="number" name="txt_cantidad_'+id_mat+'" id="txt_cantidad_'+ id_mat +'" value="' + cantidad +'"/>';
    col4.innerHTML = '<a class="btn btn-danger btn-xs" href="javascript:quitar_material('+id_mat +');">Eliminar</a>';

    fila.appendChild(col1);
    fila.appendChild(col2);
    fila.appendChild(col3);
    fila.appendChild(col4);

    tabla.appendChild(fila);

    array_materiales.push(id_mat);
    document.getElementById('ids_mate').value = array_materiales;
}

function quitar_material(id_tr){

    var index = array_materiales.indexOf(id_tr+'');
    if (index > -1) {
        array_materiales.splice(index, 1);
        $('#mat_'+id_tr).remove();
        document.getElementById('ids_mate').value = array_materiales;
    }
}

function ver_modal_decos(id){
    $.ajax({
        url: 'get_modal_decos',
        type: 'GET',
        data: {
            id_asignacion: id
        },
        success: function (data) {
            $('#myModalDecos').modal('show');
            $('#myModalDecos').show().html(data);
        },
        error: function (data) {
            $('#myModalDecos').modal('hide');
        }
    });
}

function ver_modal_materiales(id){
    $.ajax({
        url: 'get_modal_materiales',
        type: 'GET',
        data: {
            id_asignacion: id
        },
        success: function (data) {
            $('#myModalMateriales').modal('show');
            $('#myModalMateriales').show().html(data);
        },
        error: function (data) {
            $('#myModalMateriales').modal('hide');
        }
    });
}

function ver_modal_validar(id){
    $.ajax({
        url: 'get_modal_validar',
        type: 'GET',
        data: {
            id_asignacion: id
        },
        success: function (data) {
            $('#myModalValidar').modal('show');
            $('#myModalValidar').show().html(data);
        },
        error: function (data) {
            $('#myModalValidar').modal('hide');
        }
    });
}

function validar_decos(e,id){


    if(e.checked){
        array_validar_decos.push(id);
        document.getElementById('deco_'+ id).value = '1';
    }
    else{
        array_validar_decos.splice(array_validar_decos.indexOf(id),1);
        document.getElementById('deco_'+ id).value = '0';
    }

}


function ver_deco(e){
    if (e.keyCode == 13) {

        $.ajax({
            url: 'get_deco_x_serie',
            type: 'GET',
            data: {
                serie: $('#input_deco').val()
            },
            success: function (data) {
               //alert(data[0]['id_deco']);

                var fila = document.createElement("tr");
                fila.id = 'deco_' + data[0]['id_deco'];
                var tabla = document.getElementById("tabla_decos").getElementsByTagName('tbody')[0];
                //var tableRef = document.getElementById('myTable').getElementsByTagName('tbody')[0];
                var col1 = document.createElement("td");
                col1.align = "center";
                var col2 = document.createElement("td");
                col2.align = "center";
                var col3 = document.createElement("td");
                col3.align = "center";
                col1.innerHTML = cont_decos++;
                col2.innerHTML = data[0]['serie'];
                col3.innerHTML = '<a class="btn btn-danger btn-xs" href="javascript:quitar_decos('+data[0]['id_deco'] +');">Eliminar</a>';
                fila.appendChild(col1);
                fila.appendChild(col2);
                fila.appendChild(col3);
                tabla.appendChild(fila);

                array_decos.push(data[0]['id_deco']);
                document.getElementById('ids_dcos').value = array_decos;

            },
            error: function (data) {

            }
        });

    }
}

function validar_serv_inst(tipo){
    //alert(tipo);
    if(tipo == 'Instalacion'){
        $('#select_tipo_serv').val('');
        $('#select_tipo_serv').attr('disabled', 'disabled');
    }
    if(tipo == 'Servicio'){
        $('#select_tipo_serv').removeAttr('disabled');
    }

}

function add_validation(){
 /*   $("#txt_cantidad_2").rules('add', {
        required: true,
        min:0,
        messages: {
            required: "Enter something else",
            min:"Prueba"
        }
    });*/

    $.ajax({
        url: 'get_stock_materiales',
        type: 'GET',
        success: function (data) {
            //alert(data);
            for(var i=0; i<data.length;i++){
                console.log('id=' + data[i].id_material);
                $("#txt_cantidad_"+ data[i].id_material).rules('add', {
                    required: true,
                    min:0,
                    max: data[i].total_material,
                    messages: {
                        required: "Enter something else",
                        min:"No se permiten negativos",
                        max: "Máximo permitido " + data[i].total_material
                    }
                });
            }
        },
        error: function (data) {

        }
    });

  /*  $("#nueva_asignacion").validate(); //sets up the validator
    $("#txt_cantidad_1").rules("add", "required");
    $("#txt_cantidad_1").rules("add", "min");
    $("#txt_cantidad_1").rules("add", "required");*/
}