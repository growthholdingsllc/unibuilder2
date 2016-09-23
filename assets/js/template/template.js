$(function() {	
	if (typeof list_page != 'undefined') {		
		template_list();
	}
	
	  function template_list(calltype) {
      
		var encoded_url = Base64.encode('template/projects/get_template/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);		
		var dbobject = {					
							'tableName': $('#Template_List'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_template_id',
							'name': "template_name",
							'this_table' : {'table_name':'Template_List'},
							'post_data':'{}',
							'delete_data':{}, 
							'edit_data':{'index':0, 'url':'template/projects/save_templates/'},
							'display_columns' : [{"data": "template_name"},{"data": "first_name"}
							],							
						};

		
		ubdatatable(dbobject);
		
	}
});



