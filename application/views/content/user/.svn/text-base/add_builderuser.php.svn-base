<script>
this.signature_img   = '<?php echo $signature_img; ?>'; 
</script>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?> 
      <!--<li class="active">Users</li>-->
   </ol>
</div>
<form id="add_new_builderuser" class="form-horizontal" method="POST" enctype="multipart/form-data" name="add_new_builderuser">
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right ">            
            <button class="btn btn-gray pull-right m-left-1" type="button" id="btncancel"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button>
            <?php
			if(isset($this->user_role_access[strtolower('builderusers')][strtolower('delete')]) && $this->user_role_access[strtolower('builderusers')][strtolower('delete')] == 1)
			{ 
				if(isset($builderuser_data['ub_user_id']) && $builderuser_data['role_id'] != 1)
				{
            ?>
             <button class="btn btn-blue pull-right m-left-1" type="button" id="<?php if(isset($builderuser_data['ub_user_id'])) echo $builderuser_data['ub_user_id']; ?>" onclick="delete_user(this.id)"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_delete"/> Delete</button>
            <?php
				}
			}
			if(isset($this->user_role_access[strtolower('builderusers')][strtolower('edit')]) && $this->user_role_access[strtolower('builderusers')][strtolower('edit')] == 1 && $this->first_argument > 0)
			{ 
            ?>           
            <button class="btn btn-blue pull-right m-left-1" type="submit" id="add_builderuser_back"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back</button>   
            <button class="btn btn-blue pull-right m-left-1" type="submit" id="add_builderuser_new"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>   
            <button class="btn btn-blue pull-right m-left-1" type="submit" id="add_builderuser"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
			<?php
			}
			else if((isset($this->user_role_access[strtolower('builderusers')][strtolower('add')]) && $this->user_role_access[strtolower('builderusers')][strtolower('add')] == 1) && $this->first_argument == 0)
			{ 
			?>
			 <button class="btn btn-blue pull-right m-left-1" type="submit" id="add_builderuser_back"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back</button>   
            <button class="btn btn-blue pull-right m-left-1" type="submit" id="add_builderuser_new"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>   
            <button class="btn btn-blue pull-right m-left-1" type="submit" id="add_builderuser"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
			<?php 
			}
			?>
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
      <input type="hidden" name="ub_user_id" id="ub_user_id" value="<?php echo (isset($builderuser_data['ub_user_id']) && $builderuser_data['ub_user_id'] > 0)?$this->ci_object->ci_encrypt($builderuser_data['ub_user_id'], $this->encrypt_key):0 ?>" />
      <div class="box-content panel-content">
         <div class="row five-col">
            <div class="col-xs-3">
               <label>First Name</label>
			   <div class="col-xs-12">
				   <div class="form-group">
				   <input type="text" class="form-control" name="first_name" id="first_name" value="<?php if(isset($builderuser_data['first_name'])) echo $builderuser_data['first_name'];?>">
				   </div>
			   </div>
            </div>
            <div class="col-xs-3">
               <label>Last Name</label>
               <input type="text" class="form-control" name="last_name" id="last_name" value="<?php if(isset($builderuser_data['last_name'])) echo $builderuser_data['last_name'];?>">
            </div>
            <div class="col-xs-3">
               <label>Primary Email</label>
			   <div class="col-xs-12">
				   <div class="form-group">
               <input type="text" class="form-control mail" name="primary_email" id="primary_email" value="<?php if(isset($builderuser_data['primary_email'])) echo $builderuser_data['primary_email'];?>">
					</div>
				</div>
            </div>
            <div class="col-xs-3">
               <label>Alternate Email</label>
               <input type="text" class="form-control mail" name="alternative_email" id="alter_email" value="<?php if(isset($builderuser_data['alternative_email'])) echo $builderuser_data['alternative_email'];?>" data-role="tagsinput">
            </div>
            <div class="col-xs-3">
               <label>Phone</label>
               <input type="text" class="form-control" name="desk_phone" id="desk_phone" value="<?php if(isset($builderuser_data['desk_phone'])) echo $builderuser_data['desk_phone'];?>">
            </div>
         </div>
         <div class="row five-col">
            <div class="col-xs-3">
               <label>Cell</label>
			   <div class="col-xs-12">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<select class="form-control selectpicker" name="mobile_isd_code" id="mobile_isd_code" >
								<option value="+1">US</option>
								</select>
							</span>
							<input type="text" class="form-control" name="mobile_phone" id="mobile_phone" value="<?php if(isset($builderuser_data['mobile_phone'])) echo $builderuser_data['mobile_phone'];?>">
						</div>
					</div>
			   </div>
            </div>
            <div class="col-xs-3">
               <label>FAX</label>
               <input type="text" class="form-control" name="fax" value="<?php if(isset($builderuser_data['fax'])) echo $builderuser_data['fax'];?>">
            </div>
         
         <div class="col-xs-3">
               <label>User Role</label>
			   <div class="col-xs-12">
					<div class="form-group">
               <?php 
               if(!isset($builderuser_data['role_id']) || $builderuser_data['role_id'] != 1)
               {
               $role_selected = '';
               if(isset($builderuser_data['role_id']))
               {
                $selected_role = $builderuser_data['role_id'];  
                $role_name = explode(',' ,$builderuser_data['role_name']);
                echo form_dropdown('role_id', $role_list, $selected_role, "class='selectpicker form-control' id='role_id' data-live-search='true'"); 
               }else
               {
                echo form_dropdown('role_id', $role_list, $role_selected, "class='selectpicker form-control' id='role_id' data-live-search='true'"); 
               }}
               else
               {
              ?>
              <input type="hidden" value="<?php echo $builderuser_data['role_id'];?>" name="role_id" id="role_id">
              <label>Builder Admin</label>
              <?php
               }
              ?>
					</div>
				</div>
            </div>
             <div class="col-xs-3">
               <label>Date Format</label>
			   <div class="col-xs-12">
					<div class="form-group">
               <?php
               if(isset($builderuser_data['date_format']))
               {
                $selected_date_format = $builderuser_data['date_format'];  
                echo form_dropdown('date_format', $user_date_format_array, $selected_date_format, "class='selectpicker form-control' id='date_format' data-live-search='true'");
               }else
               {
               echo form_dropdown('date_format', $user_date_format_array, '', "class='selectpicker form-control' id='date_format' data-live-search='true'");
               }
               ?>
					</div>
				</div>
            </div>
            <div class="col-xs-3">
               <label>Time Zone</label>
               <div class="col-xs-12">
					<div class="form-group time-zone">
               <?php
               $time_zone_selected = '';
               if(isset($builderuser_data['time_zone']))
               {
                $selected_time_zone = $builderuser_data['time_zone'];  
                echo form_dropdown('time_zone', $time_zone, $selected_time_zone, "class='selectpicker form-control' id='time_zone' data-live-search='true'");
               }else{
               echo form_dropdown('time_zone', $time_zone, $time_zone_selected, "class='selectpicker form-control' id='time_zone' data-live-search='true'"); 
               }
               ?>

					</div>
				</div>
            </div>
         </div>
          <!-- Start section for login enabled -->
           <?php $this->load->view('common/dynamic/login_enabled'); ?>
          <!-- End section for login enabled -->
      </div>
   </div>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="tab-con pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" id="tablist">
               <li role="presentation" class="active"> <a href="#Detailed_Permissions" aria-controls="Detailed_Permissions" data-toggle="tab">Notfications</a> </li>
               <?php if(isset($builderuser_data['ub_user_id']))
                { ?>
               <li role="presentation"> <a href="#Jobsite_Access" aria-controls="Jobsite_Access" data-toggle="tab">Project Access</a> </li>
               <?php } ?>
               <li role="presentation"> <a href="#User_Preferences" aria-controls="User_Preferences" data-toggle="tab">User Preferences</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="Detailed_Permissions">
                   <table   class="table table-striped m-top" id="detailed_table" border="0">
                    
					  <tr>
                        <td width="150"  align="right" valign="middle" ><strong>Module Name</strong></td>
                        <td height="40"  width="150"  align="left" border="1" class="pad-left-50"><input type="checkbox" id="email_check"/> <strong>Email</strong></td>
                        <td align="left" width="150" class="pad-left-50"><input type="checkbox" id="text_check" /> <strong>Text</strong></td>
                        <td align="right"  >&nbsp;</td>
                     </tr>
                     <input type="hidden" id="total_modules" value="<?php echo count($this->main_modules); ?>">
					 <?php foreach($this->main_modules as $key=>$module_name) { ?>
                       <tr>
                        <td width="150"  height="40" align="right"><?php echo $module_name ?></td>
                        <td height="40"  width="150"  align="left" class="pad-left-50"><input type="checkbox" name="email_checkbox[<?php echo $module_name?>]" id="checkbox6" <?php if(isset($builderuser_data['mail_preferences'][$module_name]) && $builderuser_data['mail_preferences'][$module_name]==='Yes') echo  "checked='checked'";?> class="mail_chk" />
                           <label for="checkbox6"></label>
                        </td>
                        <td align="left" width="150" class="pad-left-50"><input type="checkbox" name="sms_checkbox[<?php echo $module_name?>]" id="checkbox7" <?php if(isset($builderuser_data['sms_preferences'][$module_name]) && $builderuser_data['sms_preferences'][$module_name]==='Yes') echo  "checked='checked'";?> class="txt_chk" /></td>
                        <td align="left" >&nbsp;</td>
                     </tr>
					 <?php } ?>
					   
                  </table>
               </div>
               <div class="tab-pane" id="Jobsite_Access">
                  <div class="row">
                     <div class="col-xs-12">
                  <?php
                  if(isset($builderuser_data['ub_user_id']))  
                  { 
                  ?>                                                         
                  <table class="table table-bordered datatable" id="user_jobs_site_view">
                     <thead>
                       <tr>
                        <th>Project Name</th>
                        <th>Role</th>
                        <th>Project Status</th>
                        <th>Project Group</th>
                        <th>Project Opened</th>
                      </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
                  <?php
                  }
                  ?>                
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="User_Preferences">
                  <div class="row">
                     <div class="col-xs-12">
                        <div class="col-xs-6">
                           <h4>Messages Preferences</h4>
                           <textarea class="ckeditor" name="editor1" id="editor1"><?php echo isset($builderuser_data['signature_text'])?$builderuser_data['signature_text']:'' ?></textarea>
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
<input type="hidden" name="save_type" id="save_type" value="" />
</form>
<div class="modal fade confirmModal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Are you sure you want to delete?       
      </h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">              
              <div class="row col-xs-12">                				
				<button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> CANCEL</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> OK</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>

<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>';  
   this.displayStart   = '<?php echo 0 ?>';   
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';      
</script>

<link rel="stylesheet" href="http://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-tagsinput.js';?>"></script>

<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/ckeditor.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/adapters/jquery.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'add_builder_users.js';?>"></script>

<script type="text/javascript">      
   $(function(){      
      CKEDITOR.replace( 'editor1', {
      toolbar : [
         [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat']
      ]
      });      
   });
</script>