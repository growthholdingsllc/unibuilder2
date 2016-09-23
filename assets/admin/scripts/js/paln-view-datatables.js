$(function() {
if (typeof list_page != 'undefined') {
        plan_list();
		// alert("hi");
    }
});
function plan_list()
{
        var encoded_url = Base64.encode('admin/plans/get_admin_plan/');
        var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
        var dbobject = {
                            'tableName': $('#plan_list'),
                            'ajax_encoded_url':ajax_encoded_url,
                            'id':'ub_plan_id',
                            'name':'plan_name',
                            'delete_data':{},
                            'edit_data':{'index':0, 'url':'admin/plans/save_plan/'},
							'post_data':'{}',
                            'display_columns' : [{"data": "plan_name"},{"data":"plan_amount"}],
                            // 'default_order_by': [[0, 'asc']]
                        };
                       // alert(1234);
        
        ubdatatable(dbobject);
}











