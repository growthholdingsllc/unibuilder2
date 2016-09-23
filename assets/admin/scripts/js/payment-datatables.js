
var paymentDataTables = function () {
    return {
        init: function () {
            $('.datatable').dataTable({
                "ajax": "assets/admin/scripts/data/payment-arrays.txt",
                "sPaginationType": "bootstrap",
				 "bLengthChange": false,
				 "bFilter": false,
            });
        }
    };
}();

$(function () {
    "use strict";
    paymentDataTables.init();
});