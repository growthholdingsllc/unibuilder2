imgLink = base_url + 'assets/images/'; 
$(function() {
	edit_album();
});

function edit_album() {
	$('#editalbum').dataTable({
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5,            
		sAjaxSource: base_url + 'assets/js/jsoneditalbum.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0,2,-1] // <-- gets last column and turns off sorting
		}],
		"fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {
			var album = '<a href="javascript:void(0);" data-toggle="modal" data-target="#albumModal"><img src="' + imgLink + data.Name[0].albumimg +'" /></a>&nbsp;&nbsp;'+ data.Name[0].albumname +'';
			
			var viewby = '<a href="javascript:void(0);"><img src="' + imgLink + 'icon_home_global1_2.png" /></a>'+'&nbsp;&nbsp;'+'<a href="javascript:void(0);"><img src="' + imgLink +'hammer.png" /></a>';
			var action = '<a href="javascript:void(0);" data-target="#Edit_Album_Modal" data-toggle="modal"><img src="' + imgLink +'icon_edit_small1_1.png" /></a>'+'&nbsp;&nbsp;&nbsp;'+'<a href="javascript:void(0);"><img src="' + imgLink +'download_small.png" /></a>'+'&nbsp;&nbsp;&nbsp;'+'<a href="javascript:void(0);"><img src="' + imgLink +'icon_trash_small1_1.png" /></a>';
			$('td:eq(1)', nRow).html(album); 
			$('td:eq(2)', nRow).html(viewby); 
			$('td:eq(4)', nRow).html(action);
			return nRow;				
		},
		"columns":[			
		{"sTitle":"<input type='checkbox'/>", "data":null, "className":"da-tab-checkbox", "defaultContent":"<input type='checkbox'/>"},
		{"sTitle":"Name", "data":"Name"},
		{"sTitle":"Viewable By", "data":null,"className":'text-center'},
		{"sTitle":"Total Size", "data":"size","className":'text-center'},						
		{"sTitle":"Actions", "data":null,"className":'text-center'},			
		{"sTitle":"Last Updated", "data":"LastUpdated","className":'text-center'},
		
		],
		"order": [[1, 'asc']]
	});
}
