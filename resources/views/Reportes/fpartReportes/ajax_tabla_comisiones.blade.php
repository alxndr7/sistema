<input type="button" onclick="tableToExcel('tabla_to_excel', 'W3C Example Table')" value="Exportar a Excel">

<table class="table table-hover" id="tabla_to_excel">

    <thead>
    <tr>
        <th width="5%">#</th>
        <th width="15%">Nombre</th>
        <th width="15%">IBS</th>
        <th width="15%">OT</th>
        <th width="15%">Tipo</th>
        <th width="15%">Fecha</th>
        <th width="15%">Monto</th>
    </tr>
    </thead>
    <tbody>
    @foreach($comisiones as $comi)
        <tr>
            <td>{{$comi->id_asignacion}}</td>
            <td>{{$comi->nombre_trabajador}} {{$comi->apellido_trabajador}}</td>
            <td>{{$comi->ibs}}</td>
            <td>{{$comi->orden_trabajo}}</td>
            <td>{{$comi->tipo_servicio}} {{$comi->detalle_servicio}}</td>
            <td>{{$comi->fecha_asignacion}}</td>
            <td>{{$comi->monto_comision}}</td>
        </tr>
    @endforeach
    </tbody>
</table>


<script type="text/javascript">
    var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
            , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
            window.location.href = uri + base64(format(template, ctx))
        }
    })()
</script>