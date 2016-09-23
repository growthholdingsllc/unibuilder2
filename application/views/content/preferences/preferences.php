<script>
this.signature_img   = '<?php echo $signature_img; ?>'; 
</script>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li class="active">Preferences</li>-->
   </ol>
</div>
<form id="user_profile" class="form-horizontal" method="POST" enctype="multipart/form-data" name="user_profile">
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right"> <a href="#">
            
            <button type="submit" class="btn btn-blue pull-right m-left-1" id="update_user_profile" name="update_user_profile" > <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_new"/> Save</button>
            </a> 
         </div>
      </div>
   </div>
</div>
<div class="row m-top">
  <div class="col-xs-12 error-message uni_message">
     <div class="alerts alert-danger"></div>
   </div>
</div>
<div class="row">
   <div class="col-xs-12">
      <h4>LOGIN INFORMATION</h4>
      <div class="box-content panel-content">
         <div class="row five-col">
            <div class="col-xs-3">
               <label>First Name</label>
			   <div class="col-xs-12">
				   <div class="form-group">
						<input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $this->user_session['first_name']; ?>">
				   </div>
			   </div>
            </div>
            <div class="col-xs-3">
               <label>Sur Name</label>
               <input type="text" class="form-control" name="last_name" value="<?php echo $this->user_session['last_name']; ?>">
            </div>
            <div class="col-xs-3">
               <label>Primary Email</label>
               <input type="text" class="form-control" name="primary_email" value="<?php echo $this->user_session['primary_email']; ?>" readonly>
            </div>
            <div class="col-xs-3">
               <label>Alternate Email</label>
               <input type="text" id="alt-email-to" name="alternative_email" class="form-control" name="email_to" value="<?php echo $this->user_session['alternative_email']; ?>"/>
            </div>
            <div class="col-xs-3">
               <label>Phone</label>
               <input type="text" class="form-control" name="desk_phone" id="desk_phone" value="<?php echo $this->user_session['desk_phone']; ?>">
            </div>
         </div>
         <div class="row five-col">
            <div class="col-xs-3">
               <label>Mobile</label>
			   <div class="col-xs-12">
				   <div class="form-group">
			   <div class="input-group">
						<span class="input-group-addon">
							<select class="form-control selectpicker" name="mobile_isd_code" id="mobile_isd_code">
							<option value="+1">US</option>
							</select>
						</span>
               <input type="text" class="form-control" name="mobile_phone" id="mobile_phone" value="<?php echo $this->user_session['mobile_phone']; ?>">
			   </div>
			   </div>
			   </div>
            </div>
            <div class="col-xs-3">
               <label>FAX</label>
               <input type="text" class="form-control" name="fax" value="<?php echo $this->user_session['fax']; ?>">
            </div>
            <div class="col-xs-3">
               <label>Date Format</label>
               <?php
               
               echo form_dropdown('date_format', $user_date_format_array, $this->user_session['date_format'], "class='selectpicker form-control' id='date_format' data-live-search='true'");
               
               ?>
            </div>
            <div class="col-xs-3">
               <label>Time Zone</label>
              <div class="col-xs-12">
					  <div class="form-group time-zone">
					  <?php					   
					   echo form_dropdown('time_zone', $time_zone, $this->user_session['time_zone'], "class='selectpicker form-control' id='time_zone' data-live-search='true'"); 					   
					   ?>
					</div>
				</div>
            </div>
         </div>
         <!-- <div class="row five-col">
            <div class="col-xs-3">
               <p>&nbsp;</p>
               <input type="checkbox" id="login-enabled"  />
               Login Enabled 
            </div>
            <div class="log-disable access-log">
               <div class="col-xs-3">
                  <label>User Name</label>
                  <input type="text" class="form-control"/>
               </div>
               <div class="col-xs-3">
                  <label>New Password</label>
                  <input type="password" class="form-control"/>
               </div>
            </div>
         </div> -->
      </div>
   </div>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="tab-con pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active"> <a href="#Detailed_Permissions" aria-controls="Detailed_Permissions" data-toggle="tab">Notfications</a> </li>               
               <li role="presentation"> <a href="#User_Preferences" aria-controls="User_Preferences" data-toggle="tab">User Preferences</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="Detailed_Permissions">                 
                  <table   class="table table-striped" id="detailed_table" border="0">
                     <tr>
                        <td width="150"  align="right" valign="middle" >Module Name</td>
                        <td height="40"  width="150"  align="left" border="1" class="pad-left-50"><input type="checkbox" id="email_check"/> <strong>Email</strong></td>
                        <td align="left" width="150" class="pad-left-50"><input type="checkbox" id="text_check" /> <strong>Text</strong></td>
                        <td align="right"  >&nbsp;</td>
                     </tr>
                     <input type="hidden" id="total_modules" value="<?php echo count($this->main_modules); ?>">
                     <?php foreach($this->main_modules as $key=>$module_name) { ?>
                       <tr>
                        <td width="150"  height="40" align="right"><?php echo $module_name ?></td>
                        
                        <td height="40"  width="150"  align="left" class="pad-left-50"><input type="checkbox" name="email_checkbox[<?php echo $module_name?>]" id="checkbox6" <?php if(isset($this->user_notification_preferences['mail_preferences'][$module_name]) && $this->user_notification_preferences['mail_preferences'][$module_name]==='Yes') echo  "checked='checked'";?> class="mail_chk" />
                           <label for="checkbox6"></label>
                        </td>
                        <td align="left" width="150" class="pad-left-50"><input type="checkbox" name="sms_checkbox[<?php echo $module_name?>]" id="checkbox7" <?php if(isset($this->user_notification_preferences['sms_preferences'][$module_name]) && $this->user_notification_preferences['sms_preferences'][$module_name]==='Yes') echo  "checked='checked'";?> class="txt_chk" /></td>
                        <td align="left" >&nbsp;</td>
                     </tr>
                <?php } ?>
                  </table>
               </div>
               <div class="tab-pane" id="User_Preferences">
                  <div class="row">
                     <div class="col-xs-12">
                        <div class="col-xs-6">
                           <h4>Messages Preferences</h4>
                           <textarea class="ckeditor" name="editor1" id="editor1"><?php if(isset($this->user_session['signature_text'])) echo $this->user_session['signature_text']; ?></textarea>
                        </div>
                        <div class="col-xs-6">
                           <h4>Signature Image <small>(Displays below any text)</small></h4>
                           <?php $this->load->view('common/thumbnail_upload.php');?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Import Permissions -->
<div class="modal fade" id="importpremissions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">IMPORT PERMISSIONS FROM USER</h4>
         </div>
         <div class="modal-body">
            <label>Import Permissions</label>
            <p>
               <select class="selectpicker  form-control">
                  <option>No Item Selected</option>
                  <option>Option 1</option>
                  <option>Option 2</option>
               </select>
            </p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Apply</button>
         </div>
      </div>
   </div>
</div>
</form>
<link rel="stylesheet" href="http://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-tagsinput.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'icheck.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/ckeditor.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'preferences.js';?>"></script> 
<script type="text/javascript">      
   $(function(){      
      CKEDITOR.replace( 'editor1', {
      toolbar : [
         [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat']
      ]
      });      
   });
</script>