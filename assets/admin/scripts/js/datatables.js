var demoDataTables = function () {
    return {
        init: function () {
            $('.datatable').dataTable({
                "ajax": "assets/admin/scripts/data/datatables-arrays.txt",
                "sPaginationType": "bootstrap",
				 "bLengthChange": false,
				 "bFilter": false,
            });
        }
    };
}();

$(function () {
    "use strict";
    demoDataTables.init();
});