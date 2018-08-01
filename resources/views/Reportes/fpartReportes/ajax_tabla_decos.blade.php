<input type="button" onclick="tableToExcel('tabla_to_excel', 'W3C Example Table')" value="Exportar a Excel">

<table class="table table-hover" id="tabla_to_excel">

    <thead>
    <tr>
        <th width="5%">Id</th>
        <th width="15%">Smart Card</th>
        <th width="15%">Serie</th>
        <th width="15%">Estado</th>
    </tr>
    </thead>
    <tbody>

    @foreach($decos as $deco)
        <tr>
            <td>{{$deco->id_deco}}</td>
            <td>{{$deco->smart_card}}</td>
            <td>{{$deco->serie}}</td>
            <td>
               @if($deco->estado_deco == '0')
                    Eliminado
                @endif
                   @if($deco->estado_deco == '1')
                       Disponible
                   @endif
                   @if($deco->estado_deco == '2')
                       Asignado
                   @endif
                   @if($deco->estado_deco == '3')
                       Malogrado
                   @endif

            </td>

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