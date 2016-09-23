<div class="row m-top">
   <div class="col-xs-12">
      <div class="top-search pull-right newmessage">
         <div class="pull-right ">
            <button class="btn btn-default btn-primary pull-right m-left-1" type="button">Cancel</button>
            <button class="btn btn-default btn-primary pull-right m-left-1" type="button">Save as Draft</button>
            <button class="btn btn-default btn-success pull-right m-left-1" type="button">Send</button>        
         </div>
      </div>
   </div>
</div>
<div class="row m-top">
   <div class="col-xs-12">
      <h4>New Task Details</h4>
      <div class="box-content panel-content">
         <div class="row">
			<div class="col-xs-3">
				<label>To</label>
				 <select class="selectpicker form-control" title="" multiple data-live-search="true">
                     <option value="">123@gf.com</option>
                     <option value="">gfc@123.com</option>
                     <option value="">123@gf.com</option>
                     <option value="">gfc@123.com</option>
                  </select>
			</div>
			<div class="col-xs-3">
				<p>&nbsp;</p>
				<input type="checkbox" name="name"  value="" id="toemailinput"/>
                <label>Enter Email Address</label> 
			</div>
			<div class="col-xs-6 alt-email-to">
				<p>&nbsp;</p>
				<input type="text" id="alt-email-to" class="form-control" name="email_to"/>
			</div>
		 </div>
		 <div class="row m-top">
			<div class="col-xs-3">
				<label>Cc</label>
				 <select class="selectpicker form-control" title="" multiple data-live-search="true">
                     <option value="">123@gf.com</option>
                     <option value="">gfc@123.com</option>
                     <option value="">123@gf.com</option>
                     <option value="">gfc@123.com</option>
                  </select>
			</div>
			<div class="col-xs-3">
				<p>&nbsp;</p>
				<input type="checkbox" name="name"  value="" id="ccemailinput"/>
                <label>Enter Email Address</label> 
			</div>
			<div class="col-xs-6 alt-email-cc">
				<p>&nbsp;</p>
				<input type="text" id="alt-email-cc" class="form-control" name="email_to"/>
			</div>
		 </div>
		 <div class="row m-top">
			<div class="col-xs-3">
				<label>Bcc</label>
				 <select class="selectpicker form-control" title="" multiple data-live-search="true">
                     <option value="">123@gf.com</option>
                     <option value="">gfc@123.com</option>
                     <option value="">123@gf.com</option>
                     <option value="">gfc@123.com</option>
                  </select>
			</div>
			<div class="col-xs-3">
				<p>&nbsp;</p>
				<input type="checkbox" name="name"  value="" id="bccemailinput"/>
                <label>Enter Email Address</label> 
			</div>
			<div class="col-xs-6 alt-email-bcc">
				<p>&nbsp;</p>
				<input type="text" id="alt-email-bcc" class="form-control" name="email_to"/>
			</div>
		 </div>
		 <div class="row m-top">
			<div class="col-xs-12">
				<label>Subject</label>				 
				<input type="text" class="form-control" />
			</div>			
		 </div>
		 <div class="row m-top">
			<div class="col-xs-12">
				<div class="form-group">
				<div class="btn btn-success btn-file">
				<i class="glyphicon glyphicon-paperclip"></i> Attachment
				<form action='#' method='post' enctype='multipart/form-data'>
				<input name='uploads[]' type=file multiple>
				</form>
				</div>
				<div class="btn btn-success btn-file"> <span class="glyphicon glyphicon-remove-sign"> </span> Remove </div>
				<span class="help-block">Max. 32MB</span> 
				</div>
			</div>			
		 </div>
		  <div class="row m-top">
			<div class="col-xs-12">
				<textarea class="ckeditor" name="newmail"></textarea>
			</div>			
		 </div>
      </div>
   </div>
</div>
<!-- /Check List Modal -->
<link rel="stylesheet" href="http://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-tagsinput.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/ckeditor.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/adapters/jquery.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'new_message.js';?>"></script> 
<script>
  
</script> 
