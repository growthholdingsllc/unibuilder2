imgLink = base_url + 'assets/images/'; 
$(function() {
    uploaded_doc_content_form();
});

function uploaded_doc_content_form() {
	$('#uploaded_doc_content').dataTable({
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		'sDom':'<"clear">',
		"bSort": false,
		"iDisplayLength": 5,          
		sAjaxSource: base_url + 'assets/js/json_uploaded_doc_content.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"ordering": false,
			"aTargets": [0,1,2,3] // <-- gets last column and turns off sorting
		}],
		"fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {                                               
			 $('td:eq(3)', nRow).html('<a href="javascript:void(0);"><img src="'+imgLink+'download_small.png" /></a>');
			return nRow;				
		},
		"columns": [			 			 
		 {"data": "file_name"},
		 {"data": "size"},
		 {"data": "date"},
		 {"data": null, "className": 'text-center'}
		 ]
	});
}