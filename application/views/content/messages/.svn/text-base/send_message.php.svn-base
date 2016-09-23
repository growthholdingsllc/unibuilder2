<?php
	$msg_content = array();
	$msg_content = isset($msg_data['msg_content'])?$msg_data['msg_content']:'';
	// echo "<pre>";print_r($msg_content);exit;
	$atachment_data = isset($msg_data['atachment_data'])?$msg_data['atachment_data']:array();
?>
<div class="mailbox row">
  <div class="col-xs-12">
	 <div class="box-solid">
		<div class="box-body">
		   <div class="row">
			  <div class="col-xs-2" id="message_folder_list">
				 <?php $this->load->view('content/messages/message_folder'); ?>
			  </div>
			  <!-- /.col (LEFT) -->
			  <div class="col-xs-10">
				<div class="mail-con-div">
					<div class="message_inbox_con">
						<!-- Back -->
						<div class="row">
						   <div class="col-xs-12 mailbox-header">
							  <!-- Action button -->
							  <div class="btn-group checkbox_label">
								 <div class="mail_revert_back">								
									<a href="javascript:void(0);">
									<img alt="back" src="<?php echo IMAGESRC.'mail_back.png'; ?>" border="0"/>
									</a>
								 </div>
							  </div>
						   </div>
						</div>
						<div class="row">
								<div class="col-xs-12 compose_mail_con">
							  <div class="row col-xs-12">
								 <div class="col-xs-12">
									<div class="pull-right mail-action-btn">
									   <div class="action-btn"> 										  
										  <button id="mail_send" class="btn btn-blue" type="button"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_send_new"/> Send</button>
										  <button id="mail_cancel" class="btn btn-gray" type="button"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button>										   
									   </div>
									</div>
								 </div>
							  </div>
							  <div class="row col-xs-12">
								 <div class="col-xs-3">
									<label>To</label>
									<?php
									$user_dropdown = isset($msg_data['user_dropdown'])?$msg_data['user_dropdown']:'';
									$to_selected = '';
									if(isset($msg_content['from_user_id']) && $msg_content['from_user_id']!='')
									{
										$to_selected = $msg_content['from_user_id'].",".$msg_content['to_user_ids'];
										$to_selected = explode(",",$to_selected);
									}
								 echo form_dropdown('to_ids[]', $user_dropdown,$to_selected, "class='selectpicker form-control' id='to_ids' data-live-search='true' multiple"); 
									?>
								 </div>
								<!--checking role access  // by satheesh -->
								<?php 
								if(isset($this->user_role_access[strtolower('messages')][strtolower('send outside')]) && $this->user_role_access[strtolower('messages')][strtolower('send outside')] == 1)
								{ 
								?>
								 <div class="col-xs-3">
									<p>&nbsp;</p>
									<input type="checkbox" name="name" value="" id="toemailinput"/>
									<label>Enter Email Address</label> 
								 </div>
								 <div class="col-xs-6 alt-email-to">
									<p>&nbsp;</p>
									<input type="text" id="alt-email-to" class="form-control" name="other_to" value="<?php
									$to_other_emails = isset($msg_content['to_other_emails'])?$msg_content['to_other_emails']:'';
									echo $to_other_emails;
									?>"/>
								 </div>
								 <?php 
								 }
								 ?>
							  </div>
							  <div class="row col-xs-12 m-top">
								 <div class="col-xs-3">
									<label>Cc</label>
									<?php
									$user_dropdown = isset($msg_data['user_dropdown'])?$msg_data['user_dropdown']:'';
									$cc_selected = '';
									if(isset($msg_content['cc_user_ids']) && $msg_content['cc_user_ids']!='')
									{
										$cc_selected = explode(",",$msg_content['cc_user_ids']);
									}
								 echo form_dropdown('cc_ids[]', $user_dropdown,$cc_selected, "class='selectpicker form-control' id='cc_ids' data-live-search='true' multiple"); 
									?>
								 </div>
								 <!--checking role access  // by satheesh -->
								<?php 
								if(isset($this->user_role_access[strtolower('messages')][strtolower('send outside')]) && $this->user_role_access[strtolower('messages')][strtolower('send outside')] == 1)
								{ 
								?>
								 <div class="col-xs-3">
									<p>&nbsp;</p>
									<input type="checkbox" name="name"  value="" id="ccemailinput"/>
									<label>Enter Email Address</label> 
								 </div>
								 <div class="col-xs-6 alt-email-cc">
									<p>&nbsp;</p>
									<input type="text" id="alt-email-cc" name="other_cc" value="<?php
									$cc_other_emails = isset($msg_content['cc_other_emails'])?$msg_content['cc_other_emails']:'';
									echo $cc_other_emails;
									?>" class="form-control" name="email_to"/>
								 </div>
								 <?php 
								 }
								 ?>
							  </div>
							  <div class="row col-xs-12 m-top">
								 <div class="col-xs-3">
									<label>Bcc</label>
									<?php
									$user_dropdown = isset($msg_data['user_dropdown'])?$msg_data['user_dropdown']:'';
									$bcc_selected = '';
									if(isset($msg_content['bcc_user_ids']) && $msg_content['bcc_user_ids']!='')
									{
										$bcc_selected = explode(",",$msg_content['bcc_user_ids']);
									}
								 echo form_dropdown('bcc_ids[]', $user_dropdown,$bcc_selected, "class='selectpicker form-control' id='bcc_ids' data-live-search='true' multiple");
									?>
								 </div>
								 <!--checking role access  // by satheesh -->
								<?php 
								if(isset($this->user_role_access[strtolower('messages')][strtolower('send outside')]) && $this->user_role_access[strtolower('messages')][strtolower('send outside')] == 1)
								{
								?>
								 <div class="col-xs-3">
									<p>&nbsp;</p>
									<input type="checkbox" name="name"  value="" id="bccemailinput"/>
									<label>Enter Email Address</label> 
								 </div>
								 <div class="col-xs-6 alt-email-bcc">
									<p>&nbsp;</p>
									<input type="text" id="alt-email-bcc" name="other_bcc" value="<?php
									$bcc_other_emails = isset($msg_content['bcc_other_emails'])?$msg_content['bcc_other_emails']:'';
									echo $bcc_other_emails;
									?>" class="form-control" name="email_to"/>
								 </div>
								 <?php 
								 }
								 ?>
							  </div>
							  <div class="row col-xs-12 m-top">
							 <div class="col-xs-8">
								<label>Subject</label>
								<input type="text" id="subject" name="subject" class="form-control" value="<?php
								$subject = isset($msg_content['subject'])?$msg_content['subject']:'';
								echo $subject;
								?>"/>
								<input type="hidden" id="originated_id" name="originated_id" class="form-control" value="<?php
								echo isset($msg_content['originated_id'])?$msg_content['originated_id']:0;
								?>"/>
								<input type="hidden" id="parent_message_id" name="parent_message_id" class="form-control" value="<?php
								echo isset($msg_content['ub_message_id'])?$msg_content['ub_message_id']:0;
								?>"/>
								<div class="m-top">
								<textarea class="ckeditor" name="editor" id="editor">
								<?php
								if(isset($msg_content['primary_email']) && $msg_content['primary_email'] != '')
								{ ?>
								<blockquote>
								<label>From: </label>
								<?php
								$sent_by = isset($msg_content['first_name'])?$msg_content['first_name']:'';
								echo $sent_by."[mailto: ".$msg_content['primary_email']."]";
								?><br>
								<label>Sent: </label>
								<?php
								$message_date = isset($msg_content['message_date'])?$msg_content['message_date']:'';
								echo $message_date;
								?><br>
								<label>To: </label>
								<?php
								$message_to = isset($msg_content['to_mails'])?$msg_content['to_mails']:'';
								echo $message_to;
								?><br>
								<label>CC: </label>
								<?php
								$message_cc = isset($msg_content['cc_mails'])?$msg_content['cc_mails']:'';
								echo $message_cc;
								?><br>
								<label>Bcc: </label>
								 <?php
								$message_bcc = isset($msg_content['bcc_mails'])?$msg_content['bcc_mails']:'';
								echo $message_bcc;
								?><br>
								<label>Subject: </label>
								<?php
								$message_subject = isset($msg_content['subject'])?$msg_content['subject']:'';
								echo $message_subject;
								?><br>
								 <hr>
									<?php
									//Below is the message content displayed in txt editor
									$message_body = isset($msg_content['message_body'])?$msg_content['message_body']:'';
									echo $message_body;
									?>
								</blockquote>
								<?php
								} 
								//Below code will display signature
								echo $this->user_session['signature_text'];
								if(isset($msg_data['signature_file_path']) && $msg_data['signature_file_path']!='')
								{ ?>
									<img src="<?php echo DOC_URL.$msg_data['signature_file_path']; ?>">
								<?php }
								?>
								</textarea>
								</div>
								 </div>
								<div class="col-xs-4">
								   <div class="row">
									  <div class="col-xs-12">
										 <p class="text-primary"><a href="javascript:void(0);" class="text-primary" data-toggle="modal" data-target="#docs_upload_Modal"><u>Click Here</u></a>  to Choose from Unibuilder docs</p>
										 <div id="actions">
										 <?php 
										 $this->load->view('common/upload.php');//$this->load->view('common/uploaded_content.php');
										 ?>
										 </div>
									  </div>
								   </div>
								</div>
							  </div>      
						   </div>
						   </div>
							<div class="row col-xs-12">
							   <div class="col-xs-12 mail-thread">
							   <!-- Message body content will come here -->
								<div class="mail-thread-con">
								<p>
								<label>From: </label>
								<?php
								$sent_by = isset($msg_content['first_name'])?$msg_content['first_name']:'';
								echo $sent_by."[mailto: ".$msg_content['primary_email']."]";
								?>
								 </p>
								 <p>
								<label>Sent: </label>
								<?php
								$message_date = isset($msg_content['message_date'])?$msg_content['message_date']:'';
								echo $message_date;
								?> 
								 </p>
								 <p>
								<label>To: </label>
								<?php
								$message_to = isset($msg_content['to_mails'])?$msg_content['to_mails']:'';
								echo $message_to;
								?> 
								 </p>
								 <p>
								<label>CC: </label>
								<?php
								$message_cc = isset($msg_content['cc_mails'])?$msg_content['cc_mails']:'';
								echo $message_cc;
								?> 
								 </p>
								 <p>
								<label>Bcc: </label>
								 <?php
								$message_bcc = isset($msg_content['bcc_mails'])?$msg_content['bcc_mails']:'';
								echo $message_bcc;
								?> 
								 </p>
								 <p>
								<label>Subject: </label>
								<?php
								$message_subject = isset($msg_content['subject'])?$msg_content['subject']:'';
								echo $message_subject;
								?> 
								 </p>
								 <hr>
								<?php
								$message_body = isset($msg_content['message_body'])?$msg_content['message_body']:'';
								echo $message_body;
								?>
								</div>
								<!-- Message body content End -->
								<?php
									if (!empty($atachment_data)) 
									{
										?>
										<br><br><br>
										<p>
										  <label><span class="glyphicon glyphicon-paperclip"></span> <u>Attachments</u></label>
										</p>
										<?php   
											 for ($i=0; $i < count($atachment_data) ; $i++) 
											 { 
											 $ext = pathinfo($atachment_data[$i]['sys_file_name'], PATHINFO_EXTENSION);
											 $actualdata = json_decode(DEFAULT_THUMB_IMAGE_ARRAY, true);
												$download_url = 'messages'.'/download_file';
												$file_download_url = $download_url.'/'.$msg_data['msg_folder_id'].'/'.$atachment_data[$i]['sys_file_name'];
												$encoded_download_url = $this->crypt->encrypt($file_download_url);
										?> 
												<p><a href="<?php echo $encoded_download_url;?>" class="attachment-image"><img src="<?php echo $actualdata[$ext]['16']; ?>" /> <?php echo $atachment_data[$i]['file_name']; ?></a></p>
										<?php 
											 }
									}
									?>
								  <hr />
								  <div class="col-xs-12 text-right">
									 <div class="action-btn">
										<button class="btn btn-blue replay_email" id="reply" type="button">
											<img class="uni_reply" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Reply
										</button>
										<button class="btn btn-blue" id="reply_all" type="button"><img class="uni_replyall" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Reply All</button>
										<button class="btn btn-blue" id="forward" type="button"><img class="uni_forward" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Forward</button>
									 </div>
								  </div>
							   </div>
							</div>
							</div><!-- Inbox -->
				</div>
				 <!-- /.col (RIGHT) --> 
			  </div>
			  <!-- /.row --> 
		   </div>
		   <!-- /.box-body -->                        
		</div>
		<!-- /.box --> 
	 </div>
	 <!-- /.col (MAIN) --> 
  </div>
</div>
<script>
$(function () {    
	'use strict';
    var temp_id = $("#temp_directory_id").val(); 
	// alert(123); return false;
    // Initialize the jQuery File Upload widget:
    var encoded_string = Base64.encode('messages/upload/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	$('#ub_messages').fileupload({
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

            var encoded_string = Base64.encode('messages/allowed_extension/');
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
                        alert(ext +" is not an accepted file type.");
                        return false;
                    }
                    if(size > (ALLOWED_FILE_SIZE)) {//2 MB
                        alert(name + ' - Filesize is too big.' );
                        return false;
                    }
                    if(uploadErrors.length > 0) {
                        alert(uploadErrors.join("\n"));
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
			setTimeout(checkbox, 1*900);						
			$("#temp_directory_id").val(data.files[0]['temp_dir_id']); 
			$('.uni_wrapper').removeClass('loadingDiv');			
			// console.log(123);
		}		
    });
	// Load existing files:
	$.ajax({
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true},
		
		url: $('#ub_messages').fileupload('option', 'url'),
		dataType: 'json',
        data: 'temp_directory_id=' + temp_id,		
		context: $('#ub_messages')[0]
	}).always(function () {
		$(this).removeClass('fileupload-processing');		
	}).done(function (result) {		
		// alert(result.toSource());		
		$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});	
			//$('.file_uploaded_div').append(result+'ss');			
	});
});
</script>