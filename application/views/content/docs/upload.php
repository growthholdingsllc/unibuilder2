<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?php echo CSSSRC.'fileupload/jquery.fileupload.css' ?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'fileupload/jquery.fileupload-ui.css' ?>">
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
		<p>Allowed Extensions (<?php $add_extra_space = str_replace(",", ", ", ALLOWED_EXTENSION);  echo $add_extra_space; ?>).</p>
			<p>Maximum Allowed Size Per File : <?php echo ALLOWED_FILE_SIZE/(1024*1024).'MB';?></p>
        <div class="row fileupload-buttonbar">
			
            <div class="col-xs-4">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="fileinput-button">
                    <input type="file" name="files[]" multiple>
                </span>
				<div class="file-button col-xs-12 m-top">
                <button type="submit" class="btn btn-secondary start" id="upload_data">                   
                    <span>Upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            </div>
         </div>
        <!-- The table listing the files available for upload/download -->
		<div class="row">
			<div class="col-xs-12">
				<!--<table role="presentation" class="file-upload-table">
					<tbody class="files">					
					</tbody>
				</table>-->
				<div class="file_uploaded_div files">
					
				</div>
			</div>
		</div>
        <input type="hidden" name="temp_directory_id" id="temp_directory_id" value="<?php echo isset($temprory_dir_id)?$temprory_dir_id:'' ?>" />
    </form>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
<ul class="upload_div">
    <li class="template-upload">
        <div class="col-xs-3">
            <span class="preview"></span>
        </div>
        <div class="col-xs-6">
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
			<p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </div>        
        <div class="fade col-xs-3">
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </div>
    </li>
	</ul>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { 
    var ext = file.name.split('.').pop().toLowerCase();
%}
<ul class="upload_div">
    <li class="template-download ">
        <div class="col-xs-3">
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}"  target="_blank" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% }else{ 
                            if (typeof DEFAULT_THUMB_IMAGE_ARRAY[ext]['80'] !='undefined') 
                                { %}
                                    <img src="{%=DEFAULT_THUMB_IMAGE_ARRAY[ext]['80']%}">
                               {% }
                            else 
                            { %}
                                <img src="{%=DEFAULT_THUMB_IMAGE_ARRAY.common['80']%}">
                           {% }
                    %}
                {% } %}
            </span>
        </div>
        <div class="col-xs-6">
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}"  target="_blank" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
			<span class="size">{%=o.formatFileSize(file.size)%}</span>
        </div>        
        <div class="col-xs-3">
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete delete_btn" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </div>
    </li>
	</ul>
{% } %}
</script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo JSSRC.'fileupload/vendor/jquery.ui.widget.js' ?>"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<!--<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>-->
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
<!-- blueimp Gallery script -->
<!--<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>-->
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo JSSRC.'fileupload/jquery.iframe-transport.js' ?>"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo JSSRC.'fileupload/jquery.fileupload.js' ?>"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo JSSRC.'fileupload/jquery.fileupload-process.js' ?>"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo JSSRC.'fileupload/jquery.fileupload-image.js' ?>"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo JSSRC.'fileupload/jquery.fileupload-audio.js' ?>"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo JSSRC.'fileupload/jquery.fileupload-video.js' ?>"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo JSSRC.'fileupload/jquery.fileupload-validate.js' ?>"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo JSSRC.'fileupload/jquery.fileupload-ui.js' ?>"></script>
<!-- The main application script -->

<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
<script>
$(function(){
	$(document).on('ifChecked','.fileupload-buttonbar .toggle', function(event){
		$('.template-download .toggle').attr('checked', true);
		$('.template-download .toggle').parent('.icheckbox_square-red').addClass('checked');
	});
	$(document).on('ifUnchecked','.fileupload-buttonbar .toggle', function(event){
		$('.template-download .toggle').attr('checked', false);
		$('.template-download .toggle').parent('.icheckbox_square-red').removeClass('checked');
	});
	
	$(document).on('ifChecked','.template-download .toggle', function(event){
		$(this).attr('checked', true);
		$(this).parent('.icheckbox_square-red').addClass('checked');
	});
	
	$(document).on('ifUnchecked','.template-download .toggle', function(event){
		$(this).attr('checked', false);
		$(this).parent('.icheckbox_square-red').removeClass('checked');
	});
});
</script>