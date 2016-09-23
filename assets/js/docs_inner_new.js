imgLink = base_url + 'assets/images/'; 
$(function() {
	docs_inner_new_list();
});
function docs_inner_new_list() {
	$('#docs_inner_new_list').dataTable({
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5,            
		sAjaxSource: base_url + 'assets/js/jsondocsinnernewlist.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [-1] // <-- gets last column and turns off sorting
		}],
		 "fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {									
			var file_name = '<div class="text-left"><img src="' + imgLink + data.Name[0].icon + '"/><span class="doc_name"> '+ data.Name[0].title + '</span></div>';
			var folder_name = '<div class="text-left"><img src="' + imgLink + 'new_doc.png"/><a href="'+ base_url +'Zgxf19jcy9kb2NzX2lubmVyX25ld19maWxl" class="doc_name"> '+ data.Name[0].title + '</a></div>';
			
			var view_by = '<div class="text-center"><a href="javascript:void(0);"><img src="' + imgLink +'icon_home_global1_2.png"/></a>&nbsp;&nbsp;<a href="javascript:void(0);"><img src="' + imgLink + 'hammer.png"/></a></div>';				
			var actions = '<div class="text-center"><a href="javascript:void(0);" data-target="#Edit_Move_Docs" data-toggle="modal"><img src="' + imgLink +'icon_edit_small1_1.png"/></a>&nbsp;&nbsp;<a href="javascript:void(0);"><img src="' + imgLink +'icon_trash_small1_1.png"/></a></div>';	
			var actions_download = '<div class="text-center"><a href="javascript:void(0);"><img src="' + imgLink +'download_small.png"/></a>&nbsp;&nbsp;<a href="javascript:void(0);"><img src="' + imgLink +'icon_trash_small1_1.png"/></a></div>';					
			var doc_folder_contain = '<div class="text-center"><a href="javascript:void(0);"><img src="' + imgLink +'new_doc_small.png"/></a> ('+ data.Contains[0].doc_dir_con +')&nbsp;&nbsp;<a href="javascript:void(0);"><img src="' + imgLink +'document.png"/></a> ('+ data.Contains[0].doc_fol_con +')</div>';
			
			var doc_folder_contain_none = '<div class="text-center"><img src="' + imgLink +'hyphen.png"/></div>';				
			
			$('td:eq(1)', nRow).html(file_name);                                
			$('td:eq(2)', nRow).html(view_by);                                
			$('td:eq(3)', nRow).html(doc_folder_contain_none);                                
			$('td:eq(5)', nRow).html(actions_download);
			if(data.Name[0].folder === "1"){
				$('td:eq(1)', nRow).html(folder_name);
				$('td:eq(3)', nRow).html(doc_folder_contain); 					
				$('td:eq(5)', nRow).html(actions);
			}					
			return nRow;
		},
		"columns": [{
			"sTitle":'<input type="checkbox" />',
			"className": 'details da-tab-checkbox',
			"orderable": false,
			"data": null,
			"defaultContent": '<input type="checkbox" />'
		},{
			"sTitle": "Name",
			"data": "Name"
		}
		,{
			"sTitle": "Viewable By",
			"data": null
		},			
		{
			"sTitle": "Contains",
			"className": "text-center",
			"data": "Contains"
		}, 
		{
			"sTitle": "Total Size",
			"className": "text-center",
			"data": "TotalSize"
		},
		{
			"sTitle": "Actions",
			"className": "text-center",
			"data": null
		},			
		{
			"sTitle": "Last Updated",
			"className": 'text-center',
			"data": "LastUpdated"
		},			
		{
			"sTitle": "Modified Date",
			"className": 'text-center',
			"data": "ModifiedDate"
		}
		],
		"order": [
			[1, 'asc']
		]

	});
}
