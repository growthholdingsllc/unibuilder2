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
										  <a href="javascript:void(0);" id="mail_send">
										  <button class="btn btn-blue" type="button">
											<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_send_new"/> Send
										  </button>
										  </a> 
										  <a href="javascript:void(0);" id="mail_cancel">
										   <button class="btn btn-gray" type="button">
											<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel
										  </button>
										  </a> 
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
								 echo form_dropdown('to_ids[]', $user_dropdown,$to_selected, "class='selectpicker form-control' id='to_ids' data-live-search='true' multiple"); 
									?>
								 </div>
								 <div class="col-xs-3">
									<p>&nbsp;</p>
									<input type="checkbox" name="name" value="" id="toemailinput"/>
									<label>Enter Email Address</label> 
								 </div>
								 <div class="col-xs-6 alt-email-to">
									<p>&nbsp;</p>
									<input type="text" id="alt-email-to" class="form-control" name="other_to" value=""/>
								 </div>
							  </div>
							  <div class="row col-xs-12 m-top">
								 <div class="col-xs-3">
									<label>Cc</label>
									<?php
									$user_dropdown = isset($msg_data['user_dropdown'])?$msg_data['user_dropdown']:'';
									$cc_selected = '';
								 echo form_dropdown('cc_ids[]', $user_dropdown,$cc_selected, "class='selectpicker form-control' id='cc_ids' data-live-search='true' multiple"); 
									?>
								 </div>
								 <div class="col-xs-3">
									<p>&nbsp;</p>
									<input type="checkbox" name="name"  value="" id="ccemailinput"/>
									<label>Enter Email Address</label> 
								 </div>
								 <div class="col-xs-6 alt-email-cc">
									<p>&nbsp;</p>
									<input type="text" id="alt-email-cc" name="other_cc" value="" class="form-control" name="email_to"/>
								 </div>
							  </div>
							  <div class="row col-xs-12 m-top">
								 <div class="col-xs-3">
									<label>Bcc</label>
									<?php
									$user_dropdown = isset($msg_data['user_dropdown'])?$msg_data['user_dropdown']:'';
									$bcc_selected = '';
								 echo form_dropdown('bcc_ids[]', $user_dropdown,$bcc_selected, "class='selectpicker form-control' id='bcc_ids' data-live-search='true' multiple");
									?>
								 </div>
								 <div class="col-xs-3">
									<p>&nbsp;</p>
									<input type="checkbox" name="name"  value="" id="bccemailinput"/>
									<label>Enter Email Address</label> 
								 </div>
								 <div class="col-xs-6 alt-email-bcc">
									<p>&nbsp;</p>
									<input type="text" id="alt-email-bcc" name="other_bcc" value="" class="form-control" name="email_to"/>
								 </div>
							  </div>
							  <div class="row col-xs-12 m-top">
								 <div class="col-xs-8">
									<label>Subject</label>
									<input type="text" id="subject" name="subject" class="form-control" value=""/>
									<div class="m-top">
									<textarea class="ckeditor" name="editor" >
									</textarea>
									</div>
								 </div>
								<div class="col-xs-4">
								   <div class="row">
									  <div class="col-xs-12">
										 <p class="text-primary"><a href="javascript:void(0);" class="text-primary" data-toggle="modal" data-target="#docs_upload_Modal"><u>Click Here</u></a>  to Choose from Unibuilder docs</p>
										 <div id="actions"> <span class="fileinput-button"></span> </div>
									  </div>
								   </div>
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