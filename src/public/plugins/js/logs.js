$(document).ready(function(){

    let table=$('table#logs'),
        type_filter=$('#log-type'),
        search_filter=$('#search-table');

    type_filter.select2();

    var settings = {
        sDom: "<'table-responsive't><'row'<p i>>",
        sPaginationType: "bootstrap",
        destroy: true,
        scrollCollapse: true,
        oLanguage: {
            sLengthMenu: "_MENU_ ",
            sInfo: "Stai visualizzando da <b>_START_ a _END_</b> su _TOTAL_ risultati",
            sEmptyTable: "Nessun dato disponibile."

        },
        iDisplayLength: 20,
        columnDefs: [
            {sortable: true, searchable: true, visible: false, targets: [3]}
        ],
    };

    table.dataTable(settings);

    search_filter.keyup(function () {
        table.fnFilter($(this).val());
    });

    type_filter.on('change',function(){
        var value=$(this).val();

        if(value==='ALL'){
            table.DataTable().column(3).search('').draw();
        }
        else{
            table.DataTable().column(3).search(value).draw();
        }
    });
});