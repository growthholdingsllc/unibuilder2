var userDataTables = function () {
    return {
        init: function () {
            $('.datatable').dataTable({
                "ajax": "assets/admin/scripts/data/user-view-arrays.txt",
                "sPaginationType": "bootstrap",
				 "bLengthChange": false,
				 "bFilter": false,
            });
        }
    };
}();

$(function () {
    "use strict";
    userDataTables.init();
});