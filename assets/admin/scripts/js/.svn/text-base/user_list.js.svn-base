$(function() {

        users_list();

});
function users_list()
{
        var encoded_url = Base64.encode('admin/user/get_users_list/');
        var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
        var dbobject = {
                            'tableName': $('#user_list'),
                            'ajax_encoded_url':ajax_encoded_url,
                            'id':'ub_user_id',
                            'name':'full_name',
                            'delete_data':{},
                            'edit_data':{'index':0, 'url':'admin/user/edit_user/'},
							'post_data':'{}',
                            'display_columns' : [{"data": "full_name"},{"data": "primary_email"},{"data": "mobile_phone"},
							{"data": "user_status"}],
                            // 'default_order_by': [[0, 'asc']]
                        };
                       
        ubdatatable(dbobject);
}	
	
  