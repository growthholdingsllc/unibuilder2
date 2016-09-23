/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {

    'use strict';
    var encoded_string = Base64.encode('docs/default_temp_dir/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
		url: encoded_val,
		dataType: "json",
		success: function(response) {
			if(response.status == true)
            {	
            	sessionStorage.removeItem('key');
				$("#temp_directory_id").val(response.temp_directory_id);
				var temp_directory_id = $("#temp_directory_id").val();
				sessionStorage.setItem('key', temp_directory_id);
			}
			else
            {               
                if(response.message)
                {
                    failure_msg = response.message;
                }           
            }
		}
	});	
    
    // Initialize the jQuery File Upload widget:
    var encoded_string = Base64.encode('docs/upload/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
    $('#fileupload').fileupload({
         add: function(e, data) {
            var name = data.originalFiles[data.index].name;
            var size = data.originalFiles[data.index].size;
            // code to validate the directory name start.
            var values = new Object() // creates a new instance of an object
            $('.doc_name').each(function() {
                values[$(this).attr('title')] = $(this).val()
            })
            var output = "";
            var property = "";
            for (property in values) {
              output += property + ',' + values[property];
            }
            var output_data = output.substring(0, output.length - 1);
            var array = output_data.split(',');
            if ($.inArray(name, array) > -1)
            {
                alert(name + ' - Already exixt.' );
                return false;
            }
            // code to validate the directory name end.

            var encoded_string = Base64.encode('photos/allowed_extension_photoes/');
            var encoded_val = encoded_string.strtr(encode_chars_obj);
            var uploadErrors = [];
            var ext = name.split('.').pop().toLowerCase();
            $.ajax({
                url: base_url + encoded_val,
                dataType: "json",
                type: "post",
                data: "ext="+ext,
				beforeSend: function() {
					  $('.uni_wrapper').addClass('loadingDiv');
				},				
                success: function(response) {   
					$('.uni_wrapper').removeClass('loadingDiv');
                    if(response.status == false)
                    {   
                        // alert("");
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text(ext +' is not an accepted file type.');
                        return false;
                    }
                    if(size > (ALLOWED_FILE_SIZE)) {//2 MB
                        // alert(name + ' - Filesize is too big.' );
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text(name + ' - Filesize is too big.');
                        return false;
                    }
                    if(uploadErrors.length > 0) {
                        // alert(uploadErrors.join("\n"));
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text(uploadErrors.join("\n"));
						
                        return false;
                    }
                    else
                    {              
                        data.submit();          
                    }
                }
            });
        },
        url: encoded_val,
        dataType: 'json',
        autoUpload: false,
        // acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        // maxFileSize: 5000000,
		beforeSend: function() {
		  $('.uni_wrapper').addClass('loadingDiv');
		},	
        success: function (data) {			
			setTimeout(checkbox, 1*200);			
			//alert(JSON.stringify(response));
			$("#temp_directory_id").val(data.files[0]['temp_dir_id']);
			$('.uni_wrapper').removeClass('loadingDiv');
		}
    });
	// Load existing files:
	$.ajax({
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true},
		url: $('#fileupload').fileupload('option', 'url'),
		dataType: 'json',
        data: 'temp_directory_id=' + sessionStorage.getItem('key'),
		context: $('#fileupload')[0]
	}).always(function () {
		$(this).removeClass('fileupload-processing');
	}).done(function (result) {
		// alert(result.toSource());
		$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});
	});
});


