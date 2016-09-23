    $(function() {     
        budget_summary_list_view();
        $('#export_file_project_summary').hide();
    });

    function budget_summary_list_view() {
		var encoded_url = Base64.encode('budget/get_budget_summary/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(123);
		var dbobject = {
							'tableName': $('#budget_summary_list'),
							'this_table' : {'table_name':'budget_summary_list'},
							'ajax_encoded_url':ajax_encoded_url,
							'id':'project_name',
							'name' : 'project_name',
							'post_data':'{}',
							'delete_data':{},  
							'edit_data':{},
							'display_columns' : [{"data": "project_name"},{"data": "total_amount"},{"data": "total_contract_price"},{"data": "total_revised_contract"},{"data": "total_overhead_cost"},{"data": "total_estimated_profit_amount"},{"data": "total_bill_to_client_to_date"},{"data": "total_paid_by_client_to_date"},{"data": "total_unpaid_client_billing"},{"data": "total_balance_to_bill_client"},{"data": "total_invoiced_by_sub_to_date"},{"data": "total_amount_paid_to_sub"},{"data": "total_balance_to_be_invoiced_by_sub"},{"data": "balance_owed_to_sub"},{"data": "cost"},{"data": "total_profit_to_date"},{"data": "total_overall_profit"},{"data": "profit"}],
							'default_order_by': [[0, 'asc']]
						};
		// Populate data table
		ubdatatable(dbobject);
	}
