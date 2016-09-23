imgLink = base_url + 'assets/images/'; 
$(function() {
	docs_inner_list();
});
function docs_inner_list() {
	$('#docs_inner_list').dataTable({
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5,            
		sAjaxSource: base_url + '/assets/js/jsondocsinnerlist.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [-1] // <-- gets last column and turns off sorting
		}],
		 "fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {									
			var name = '<div class="text-left"><img src="' + imgLink +'project_doc.png"/><a href="'+ base_url +'Zgxf19jcy9kb2NzX2lubmVyX2Zpbgxf1Vz" class="doc_name"> '+ data['Name']+ '</a></div>';												
			$('td:eq(1)', nRow).html(name);                                
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
			"sTitle": "Last Updated",
			"className": 'text-center',
			"data": "LastUpdated"
		}
		],
		"order": [
			[1, 'asc']
		]

	});
}
