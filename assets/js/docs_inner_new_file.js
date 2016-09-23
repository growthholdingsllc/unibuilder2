imgLink = base_url + 'assets/images/'; 
$(function() {
	docs_inner_new_file_list();
});
function docs_inner_new_file_list() {
	$('#docs_inner_new_file_list').dataTable({
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5,            
		sAjaxSource: base_url + 'assets/js/jsondocsinnernewfilelist.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [-1] // <-- gets last column and turns off sorting
		}],
		 "fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {									
			var file_name = '<div class="text-left"><img src="' + imgLink + data.Name[0].icon + '"/><span class="doc_name"> '+ data.Name[0].title + '</span></div>';			
			
			var view_by = '<div class="text-center"><a href="javascript:void(0);"><img src="' + imgLink +'icon_home_global1_2.png"/></a>&nbsp;&nbsp;<a href="javascript:void(0);"><img src="' + imgLink + 'hammer.png"/></a></div>';			
			var actions_download = '<div class="text-center"><a href="javascript:void(0);"><img src="' + imgLink +'download_small.png"/></a>&nbsp;&nbsp;<a href="javascript:void(0);"><img src="' + imgLink +'icon_trash_small1_1.png"/></a></div>';	
							
			$('td:eq(1)', nRow).html(file_name);                                
			$('td:eq(2)', nRow).html(view_by);                                                                                
			$('td:eq(4)', nRow).html(actions_download);									
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
