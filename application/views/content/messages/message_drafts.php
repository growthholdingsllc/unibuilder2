<div class="message_drafts_con">
   <div class="row">
	  <div class="col-xs-12 mailbox-header">
		 <!-- Action button -->
		 <div class="btn-group checkbox_label">
			<div class="sorting_mail">
			   <div class="checkbox_con pull-left">
				  <label>
				  <input type="checkbox" id="sorting_mail" />
				  </label>
			   </div>
			   <button type="button" class="dropdown-toggle" data-toggle="dropdown">
			   <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
			   </button>
			   <ul class="dropdown-menu" role="menu">
				  <li><a href="javascript:void(0);" id="all_sorting">All</a></li>
				   <li><a href="javascript:void(0);" id="all_none">None</a></li>
				   <li><a href="javascript:void(0);">Read</a></li>
				   <li><a href="javascript:void(0);">Unread</a></li>
			   </ul>
			</div>			
		 </div>
	  </div>
   </div>
   <!-- /.row -->
   <div class="row">
	  <div class="col-xs-12">
		 <table class="table table-mailbox" id="message_drafts" width="100%"></table>
		 <div class="col-xs-12">
			<div class="col-xs-12 mail-pagination">
			   <div class="pull-right">
				  <ul class="pagination">
					 <li>
						<a href="#" aria-label="Previous">
						<span class="glyphicon-arrow-left1"></span>
						</a>
					 </li>
					 <li><a href="#">1</a></li>
					 <li><a href="#">2</a></li>
					 <li><a href="#">3</a></li>
					 <li><a href="#">4</a></li>
					 <li><a href="#">5</a></li>
					 <li>
						<a href="#" aria-label="Next">
						<span class="glyphicon-arrow-right1"></span>
						</a>
					 </li>
				  </ul>
			   </div>
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
                  <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_send"/>
                  </a> 
                  <a href="javascript:void(0);" id="mail_cancel">
                  <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel"/>
                  </a> 
               </div>
            </div>
         </div>
      </div>
      <div class="row col-xs-12">
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
      <div class="row col-xs-12 m-top">
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
      <div class="row col-xs-12 m-top">
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
      <div class="row col-xs-12 m-top">
         <div class="col-xs-8">
            <label>Subject</label>
            <input type="text" id="subject" class="form-control"/>
			<div class="m-top">
			<textarea class="ckeditor" name="editor" ></textarea>
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
</div>
<!-- Drafts -->