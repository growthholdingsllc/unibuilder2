    $(function() {     
        budget_projects_view();
    });

    function budget_projects_view() {
        $('#budget_projects_view').dataTable({
			"scrollX": true,
            "aLengthMenu": [
                [5, 15, 50, 100],
                [5, 15, 50, "l00"]
            ],
            "iDisplayLength": 5,           
            sAjaxSource: base_url + 'assets/js/json_budget_projects_view.json',
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [0] // <-- gets last column and turns off sorting
            }],
			"columns":[            
            { "sTitle":"Project Name", "data": "project_name","width":"80px"},
            { "sTitle":"Budgeted Amount", "data": "budgeted_amount","width":"100px" },
            { "sTitle":"Estimated Revenue", "data": "est_revenue","width":"100px" },
            { "sTitle":"Total Vendor Cost", "data": "total_vendor_cost","width":"100px" },
            { "sTitle":"Estimated General Condition/Overhead", "data": "estimated_overhead","width":"100px" },
            { "sTitle":"Estimated Profit", "data": "estimated_profit","width":"100px" },
            { "sTitle":"Billed To Client to Date", "data": "billed_client_date","width":"100px" },
            { "sTitle":"Paid By Client to Date", "data": "paid_client_date","width":"100px" },
            { "sTitle":"Unpaid Client Billings", "data": "unpaid_client_billings","width":"100px" },
            { "sTitle":"Balance To Bill Client(D - H)", "data": "balance_bill_client","width":"100px" },
            { "sTitle":"Invoiced to Date by sub", "data": "invoice_date_sub","width":"100px" },
            { "sTitle":"Amount Paid to sub", "data": "amount_paid_sub","width":"100px" },
            { "sTitle":"Balance To be Invoiced by sub", "data": "balance_to_invoiced_sub","width":"100px" },
            { "sTitle":"Total Balance Owned to sub", "data": "total_balance_owned_sub","width":"100px" },
            { "sTitle":"Overhead/In house", "data": "overhead_inhouse","width":"100px" },
            { "sTitle":"Total Cost", "data": "total_cost","width":"100px" },
            { "sTitle":"Profit to Date", "data": "profit_to_date","width":"100px" },
            { "sTitle":"Profit", "data": "profit","width":"100px" },
            { "sTitle":"Profit %", "data": "profit_percentage","width":"100px" }
            
        ],
        "order": [[1, 'asc']]

        });
    }
