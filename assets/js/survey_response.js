$(function() {
	survey_response_table();
	$(document).on('click', '#close_survey', function(){
		$('#confirmModal').modal('show');
	});
});
$(document).on('click', '#delete_confirm', function(){
	var encoded_url = Base64.encode('survey/close_survey/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var survey_id = $('#ub_survey_id').val();
	var ajaxData  = 'survey_id='+survey_id;
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: ajaxData,
		success: function(response) { 
			$('#confirmModal').modal('hide');
			if(response.status == true)
			{   
				success_box();
				$(".alerts").html(response.message);
				location.reload(true);
			}
			else
			{               
				error_box();
				$(".alerts").html(response.message);         
			}
			return false; 
		}
	});
});
function survey_response_table() {
var encoded_string = Base64.encode('survey/survey_result/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	 
		var returnData;
		$.ajax({
			url: base_url + encoded_val,
			async: false,
			dataType: 'json',
			type: "post",
			data: {'survey_id': $("#ub_survey_id").val()},	
			success: function (data) {
				returnData = data;
			}
		});
		// alert(returnData.toSource());
		
        $('#survey_response_table').dataTable({
			"sScrollX": "100%",
			"sScrollXInner": "110%",
			"bScrollCollapse": true,
            "aLengthMenu": [
                [5, 15, 50, 100],
                [5, 15, 50, "l00"]
            ],
            "iDisplayLength": 5,                        
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [0] 
            }],
        "data": returnData[0].DATA,
        "columns": returnData[0].COLUMNS,
        "order": [[1, 'asc']]
        }); 
}