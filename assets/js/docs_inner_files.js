imgLink = base_url + 'assets/images/'; 
    $(function() {
        docs_inner_files_list();
    });
    function docs_inner_files_list() {
        $('#docs_inner_files_list').dataTable({
            "aLengthMenu": [
                [5, 15, 50, 100],
                [5, 15, 50, "l00"]
            ],
            "iDisplayLength": 5,            
            sAjaxSource: base_url + 'assets/js/jsondocsinnerfileslist.json',
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [-1] // <-- gets last column and turns off sorting
            }],
			 "fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {									
				var name = '<div class="text-left"><img src="' + imgLink + data.Name[0].icon + '"/><span class="doc_name"> '+ data.Name[0].title + '</span></div>';												
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
