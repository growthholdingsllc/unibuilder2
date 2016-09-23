<?php 
$count_cn = 0;
$reminder_type[] = "";
if(!empty($result_data['reminder_start_date']))
{
	$reminder_start_date = explode(",",$result_data['reminder_start_date']);
	// echo '<pre>';print_r($reminder_start_date);exit;
}
if(!empty($result_data['doc_file_id']))
{
	$doc_file_id = explode(",",$result_data['doc_file_id']);
}else{
	if(isset($result_data['doc_file_id']))
	{
		$doc_file_id = $result_data['doc_file_id'];
	}
}
if(!empty($result_array))
{
	$count_id = count($result_array);
}
if(!empty($result_data['reminder_type']))
{
	$reminder_type = explode(",",$result_data['reminder_type']);
}
if(!empty($result_data['certificate_id']))
{
	$certificate_id = explode(",",$result_data['certificate_id']);
}
if(!empty($result_data['reminds_in_days']))
{
	$reminds_in_days = explode(",",$result_data['reminds_in_days']);
}
if(!empty($result_data['certificate_name']))
{
	$certificate_name = explode(",",$result_data['certificate_name']);
	$count_cn = count($certificate_name);
}
 ?>
<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?> 
    <!--<li class="active">Users</li>
    <li class="active">Subcontractor</li>-->
  </ol>
</div>
<form id="add_new_sub_contractor_user" class="form-horizontal" method="post" name="add_new_sub_contractor_user">
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
      <div class="pull-right ">
		<a href="<?php echo base_url();?>c3ViY29udHJhY3Rvci91c2VyX3N1YmNvbnRyYWN0b3Iv"><button type="button" class="btn btn-gray pull-right m-left-1"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button></a>
		<?php  
		if(isset($this->user_role_access[strtolower('subcontractor')][strtolower('delete')]) && $this->user_role_access[strtolower('subcontractor')][strtolower('delete')] == 1)
		{ 
			if(!empty($result_data['ub_subcontractor_id'])) 
			{ 
		?>
        <button class="btn btn-blue pull-right m-left-1" type="button" id="<?php if(isset($result_data['ub_subcontractor_id'])) echo $result_data['ub_subcontractor_id']; ?>" onclick="delete_sub_contractors(this.id)"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_delete"/> Delete</button>
		<?php 
			}
		}
		if(isset($this->user_role_access[strtolower('subcontractor')][strtolower('edit')]) && $this->user_role_access[strtolower('subcontractor')][strtolower('edit')] == 1 && $this->first_argument > 0)
		{ 
		?>
        <button class="btn btn-blue pull-right m-left-1" type="submit" id="add_sub_contractor_user_list_save_and_back" name="add_sub_contractor_user_list_save_and_back" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back</button>
		<button class="btn btn-blue pull-right m-left-1" type="submit" id="add_sub_contractor_user_list_save_and_new" name="add_sub_contractor_user_list_save_and_new" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
        <button class="btn btn-blue pull-right m-left-1" type="submit" id="add_sub_contractor_user_list_save_and_stay" name="add_sub_contractor_user_list_save_and_stay" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
		<?php 
		}
		else if((isset($this->user_role_access[strtolower('subcontractor')][strtolower('add')]) && $this->user_role_access[strtolower('subcontractor')][strtolower('add')] == 1) && $this->first_argument == 0)
		{ 
		?>
		<button class="btn btn-blue pull-right m-left-1" type="submit" id="add_sub_contractor_user_list_save_and_back" name="add_sub_contractor_user_list_save_and_back" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back</button>
		<button class="btn btn-blue pull-right m-left-1" type="submit" id="add_sub_contractor_user_list_save_and_new" name="add_sub_contractor_user_list_save_and_new" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
        <button class="btn btn-blue pull-right m-left-1" type="submit" id="add_sub_contractor_user_list_save_and_stay" name="add_sub_contractor_user_list_save_and_stay" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
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
<div class="row m-top">
  <div class="col-xs-12">
    <h4>SUBCONTRACTOR DETAILS</h4>
	<input type="hidden" name="ub_subcontractor_id" id="ub_subcontractor_id" value="<?php if(isset($result_data['ub_subcontractor_id'])) echo $result_data['ub_subcontractor_id'];?>">
    <div class="box-content panel-content">
      <div class="row">
        <div class="col-xs-4">
          <label>Company</label>
		  <div class="col-xs-12">
			  <div class="form-group">
				<input type="text" class="form-control" maxlength = "128" name="company" id="company" value="<?php if(isset($result_data['company'])) echo $result_data['company'];?>" >
			  </div>
		  </div>
        </div>
        <div class="col-xs-4">
          <label>Primary Contact Person</label>
		  <div class="col-xs-12">
			 <div class="form-group">
				<input type="text" class="form-control" maxlength = "128" id="first_name" name="first_name" value="<?php if(isset($result_data['first_name'])) echo $result_data['first_name'];?>">
			 </div>
		  </div>
        </div>
        <div class="col-xs-4">
          <label>Division</label>
          <?php 
				   $subcontractor_department_selected = '';
				   if(isset($result_data['division']))
				   {
						$subcontractor_department_selected = explode(",",$result_data['division']);
				   }
				   echo form_dropdown('subcontractor_department[]', $cost_code_options, $subcontractor_department_selected, "class='selectpicker form-control' id='tagType' data-live-search='true' multiple"); 
				   ?>
        </div>
      </div>
	  <div class="row">
        <div class="col-xs-4">
          <label>Primary Email</label>
		  <div class="col-xs-12">
			  <div class="form-group">
				<input type="text" class="form-control" maxlength = "72" id="primary_email" name="primary_email" value="<?php if(isset($result_data['primary_email'])) echo $result_data['primary_email'];?>" >
			</div>
		  </div>
        </div>
        <div class="col-xs-4">
          <label>Alternate Email</label>
          <input type="text" class="form-control" maxlength = "200" id="alternative_email" name="alternative_email" value="<?php if(isset($result_data['alternative_email'])) echo $result_data['alternative_email'];?>" >
        </div>
        <div class="col-xs-4">
          <label>Country</label>
          <input type="text" class="form-control" maxlength = "50" id="country" name="country" value="<?php if(isset($result_data['country'])) echo $result_data['country'];?>" >
        </div>
      </div>
	  
	  <div class="row">        
        <div class="col-xs-4">
               <label>Date Format</label>
				<div class="col-xs-12">
					<div class="form-group">
						<?php
						if(isset($result_data['date_format']))
						{
						$selected_date_format = $result_data['date_format'];  
						echo form_dropdown('date_format', $user_date_format_array, $selected_date_format, "class='selectpicker form-control' id='date_format' data-live-search='true'");
						}else
						{
						echo form_dropdown('date_format', $user_date_format_array, '', "class='selectpicker form-control' id='date_format' data-live-search='true'");
						}
						?>
					</div>
				</div>
            </div>
        <div class="col-xs-4">
               <label>Time Zone</label>
				<div class="col-xs-12">
					<div class="form-group time-zone">
						<?php
						$time_zone_selected = '';
						if(isset($result_data['time_zone']))
						{
						$selected_time_zone = $result_data['time_zone'];  
						echo form_dropdown('time_zone', $time_zone, $selected_time_zone, "class='selectpicker form-control' id='time_zone' data-live-search='true'");
						}else{
						echo form_dropdown('time_zone', $time_zone, $time_zone_selected, "class='selectpicker form-control' id='time_zone' data-live-search='true'"); 
						}
						?>
					</div>
				</div>
            </div>
      </div>
	  
      <div class="row">
        <div class="col-xs-4">
          <label>Address</label>
          <input type="text" class="form-control" maxlength = "255" name="address" id="address" value="<?php if(isset($result_data['address'])) echo $result_data['address'];?>"  >
        </div>
        <div class="col-xs-4">
          <label>City</label>
          <input type='text' class="form-control" maxlength = "50" name="city" id="city" value="<?php if(isset($result_data['city'])) echo $result_data['city'];?>"  />
        </div>
        <div class="col-xs-4">
          <div class="col-xs-6">
            <label>State</label>
            <input type='text' class="form-control" maxlength = "50" name="province" id="province" value="<?php if(isset($result_data['province'])) echo $result_data['province'];?>" />
          </div>
          <div class="col-xs-6">
            <label>Zip/Postal</label>
            <input type='text' class="form-control" maxlength = "50" name="postal" id="postal" value="<?php if(isset($result_data['postal'])) echo $result_data['postal'];?>" />
          </div>
        </div>
      </div>
      <hr />
      <div class="row">
        <div class="col-xs-4">
          <label>Bussiness phone</label>
          <input type="text" class="form-control" name="desk_phone" id="desk_phone" maxlength = "12" value="<?php if(isset($result_data['desk_phone'])) echo $result_data['desk_phone'];?>" >
        </div>
        <div class="col-xs-4">
          <label>Cell Phone</label>
		   <div class="col-xs-12">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<select class="form-control selectpicker" name="mobile_isd_code" id="mobile_isd_code" >
								<option value="+1">US</option>
								</select>
							</span>
								<input type='text' class="form-control" name="mobile_phone" id="mobile_phone" maxlength = "12" value="<?php if(isset($result_data['mobile_phone'])) echo $result_data['mobile_phone'];?>" />
						</div>
					</div>
			</div>
        </div>
        <div class="col-xs-4">
          <label>Fax</label>
          <input type='text' class="form-control" name="fax" id="fax" maxlength = "20" value="<?php if(isset($result_data['fax'])) echo $result_data['fax'];?>" />
        </div>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <p>&nbsp;</p>
          <input name="access_to_all_projects" id="access_to_all_projects" type="checkbox" <?php if(isset($result_data['access_to_all_projects']) && $result_data['access_to_all_projects']==='Yes') echo  "checked='checked'"; ?> />
          Automatically Permit access to New Project I added <a href="#" class="glyphicon glyphicon-question-sign"></a> </div>
        <div class="col-xs-4">
          <p>&nbsp;</p>
          <input name="access_to_all_owners" id="access_to_all_owners" type="checkbox" <?php if(isset($result_data['access_to_all_owners']) && $result_data['access_to_all_owners']==='Yes') echo  "checked='checked'"; ?> />
          Allow Sub to View Owner Information <a href="#" class="glyphicon glyphicon-question-sign"></a></div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="tab-con pull-left">
      <div role="tabpanel"> 
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"> <a href="#General_info" aria-controls="General_info" data-toggle="tab">General Info</a> </li>
          <li role="presentation"> <a href="#Project_Access" aria-controls="Project_Access" data-toggle="tab">Project Access</a> </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="General_info">
            <div class="row">
              <div class="col-xs-12">
                <h4>COMMUNICATION PREFFERENCES</h4>
                <div class="box-content panel-content">
                  <div class="row ">
                    <div class="col-xs-3">
                      <p>&nbsp;</p>
                      <input type="checkbox" id="login_enabled" name="login_enabled" <?php if(isset($result_data['login_enabled']) && $result_data['login_enabled']==='Yes') echo  "checked='checked'"; ?> />
                      Login Enabled </div>
                    <div class="col-xs-3 log-disable access-log">
                      <label>Access Method</label>
                      <div class="input-group right-group">
                        <select class="selectpicker form-control" id="accessmethod" name="accessmethod">
                          <option value="none">Nothing selected</option>
                          <option value="emailinvite">Email Invite</option>
                          <option value="configure" <?php if(!empty($result_data['username'])) echo "selected='select'";?>>Configure Manually</option>
                        </select>
                        <span class="input-group-addon"> <a href="javascript:void(0);" data-toggle="tooltip" title="Select the method in which you want the owner to access the site."><i class="glyphicon glyphicon-question-sign"></i></a> </span> </div>
                    </div>
                    <div class="col-xs-3 log-disable drop-down-show-hide configure">
                      <label>User Name</label>
                      <input type="text" class="form-control disabled_input" id="user_name" name="user_name" maxlength = "40" value="<?php if(isset($result_data['username'])) echo $result_data['username'];?>"/>
                    </div>
                    <div class="col-xs-3 log-disable drop-down-show-hide configure">
                      <label>New Password</label>
                      <input type="password" class="form-control disabled_input" id="password" name="password" maxlength ="30" value="<?php if(isset($result_data['password'])) echo $result_data['password'];?>"/>
                    </div>
                    <div class="col-xs-3 log-disable drop-down-show-hide drop emailinvite">
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-blue disabled_prop" id="sub_contractor_useremailinvitation">
					  <img border="0" class="uni_send_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Send
					  </button>
                    </div>                   
                  </div>
                </div>
                <!--<h4>SCHEDULING INFO</h4>
                <div class="box-content panel-content">
                  <div class="row">
                    <div class="col-xs-3">
                      <label>Sub Activity</label>
                    </div>
                    <div class="col-xs-3"> <a href="#" data-original-title="" title="">
                      <button class="btn btn-default btn-primary" type="button">Open Assigned Item Report</button>
                      </a> </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-5">
                      <label>Alert On Schedule Conflicts:
                        <input name="" type="checkbox" value="" />
                        # Of crew(s) <a href="#" class="glyphicon glyphicon-question-sign"></a></label>
                      <input type='text' class="form-control" />
                    </div>
                  </div>
                </div>-->
				
                <h4>ADDITIONAL INFO</h4>
                <div class="box-content panel-content">
				
				<input type="hidden" name="user_id" id="user_id" value="<?php if(isset($result_data['ub_user_id'])) echo $result_data['ub_user_id']; ?>" />
				<div class="input_fields_wrap">
				 <?php 
					 for($i=0; $i < $count_cn; $i++)
					 {?>

					<div class="wrapper">
						<div class="row">
						<div class="col-xs-4">
							<label>Name Of Certificate</label>
							<input type="hidden" name="certificate_id[]" id="certificate_id" value="<?php if(isset($certificate_id[$i])) echo $certificate_id[$i] ?>" />

							<input type="text" class="form-control" name="certificate_name[]" id="certificate_name" value="<?php if(isset($certificate_name[$i])) echo $certificate_name[$i] ?>" />
						</div>
						<div class="col-xs-4">
						  <label>Expires</label>
						  <div id="datetimepicker5" class="input-group date">
							<input type="text" class="form-control" name="reminder_start_date[]" id="reminder_start_date" value="<?php if(isset($reminder_start_date[$i]) && $reminder_start_date[$i] != '0000-00-00 00:00:00') echo $reminder_start_date[$i] ?>" >
							<span class="input-group-addon"> <span class="glyphicon-calendar glyphicon"></span> </span> </div>
						</div>
						<div class="col-xs-4">
						  <label>Reminder</label>
						  <div class="row">
							<div class="col-xs-4">
							  <input type="text" class="form-control" name="reminds_in_days[]" id="reminds_in_days" value="<?php if(isset($reminds_in_days[$i])) echo $reminds_in_days[$i] ?>"  />
							</div>
							<div class="col-xs-2">Day(s)</div>
							<div class="col-xs-4">
							  <select class="selectpicker form-control" name="reminder_type[]" id="reminder_type" >
								<option value="">Nothing selected</option>
								<option <?php if($reminder_type[$i] == 'Before') { echo "selected"; } ?> >Before</option>
								<option <?php if($reminder_type[$i] == 'After') { echo "selected"; } ?> >After</option>
							  </select>
							</div>
							<div class="col-xs-2">Expires</div>
						  </div>
						</div>
						</div>  
				  <?php 
					 for($j=0; $j < $count_id; $j++)
					 {
						if(isset($result_array[$j]['system_file_name']))
						{
						$ext = pathinfo($result_array[$j]['system_file_name'], PATHINFO_EXTENSION);
						$actualdata = json_decode(DEFAULT_THUMB_IMAGE_ARRAY, true);
						if ($ext == 'tif' || $ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'tiff') 
						{
							$thumb_icon = DOC_URL.$result_array[$j]['system_file_name'];
						}
						else
						{
							if (!empty($ext)) 
							{
							$thumb_icon = $actualdata[$ext]['40'];
							}
						}
						}
						 // if(isset($certificate_name[$i])  && $doc_file_id[$i] === $result_array[$j]['ub_doc_file_id'] || isset($certificate_name[$i]) && $doc_file_id[$i] == 0) 
						 if(isset($certificate_name[$i]) && isset($result_array[$j]['ub_doc_file_id']) && ($doc_file_id[$i] == $result_array[$j]['ub_doc_file_id']))
						 {
						 ?>        
                    <div class="col-xs-12">
                      <label>&nbsp;</label>
                      <!--<div class="form-group">
                        <div class="btn btn-success btn-file"> <i class="glyphicon glyphicon-paperclip"></i> Attachment
						
                          <input type="file" name="attachments[]">
                        </div>
						<?php //if(isset($doc_file_id[$i]) && $doc_file_id[$i] == $result_array[$j]['ub_doc_file_id']) { echo $result_array[$j]['ui_file_name']; } ?>
                      </div>-->		
				  
					  <div class="text-left">
					  
							<div class="preview_file <?php if(isset($doc_file_id[$i]) && isset($result_array[$j]['ub_doc_file_id']) && ($doc_file_id[$i] == $result_array[$j]['ub_doc_file_id']) && isset($result_array[$j]['ui_file_name']) && !empty($result_array[$j]['ui_file_name'])) { ?>show <?php } else{ ?>hide<?php }?>">
								<div class="imagePreview">
								<img src="<?php if(isset($doc_file_id[$i]) && $doc_file_id[$i] == $result_array[$j]['ub_doc_file_id'] && isset($result_array[$j]['ui_file_name']) && !empty($result_array[$j]['ui_file_name'])) { echo $thumb_icon; } ?>" /></div>
								<div class="close_file"><a href="javascript:void(0);" onclick="delete_pic(<?php echo $doc_file_id[$i]; ?>)" class="close-file"><img src="<?php echo IMAGESRC.'file_close.png'; ?>"/></a></div>
							</div>							
							<div class="file_name <?php if(isset($doc_file_id[$i]) && isset($result_array[$j]['ub_doc_file_id']) && ($doc_file_id[$i] == $result_array[$j]['ub_doc_file_id'])) { ?>show <?php } else{ ?>hide<?php } ?>"><?php if(isset($doc_file_id[$i]) && $doc_file_id[$i] == $result_array[$j]['ub_doc_file_id']) { echo $result_array[$j]['ui_file_name']; } ?></div>
							
							<div style="width:70px" class="btn btn-blue btn-file browse <?php if(isset($result_array[$j]['ui_file_name']) && !empty($result_array[$j]['ui_file_name'])) { ?>hide <?php } else { ?>show <?php } ?>"> 

                <img border="0" class="uni_attchment_second" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Browse
                <input type="file" name="attachments[]" class="file_up"/>
				
                </div>							
                       </div>
					 <!--<?php //if(isset($doc_file_id[$i]) && isset($result_array[$i]['ub_doc_file_id'])) { ?>
					  <input type="text" class="form-control" name="doc_file_id[]" id="doc_file_id" value="<?php //if(isset($doc_file_id[$i]) && $doc_file_id[$i] == $result_array[$i]['ub_doc_file_id']) echo $result_array[$i]['ui_file_name']; ?>"  />
					  <?php// } ?>-->
                    </div> 
					
					<?php } } ?>
					<?php if(isset($certificate_name[$i]) && $doc_file_id[$i] == 0){ ?>
					<div class="text-left">
					<div class="preview_file">
								<div class="imagePreview">
								<img src="" /></div>
								<div class="close_file"><a href="javascript:void(0);" onclick="delete_pic(<?php echo $doc_file_id[$i]; ?>)" class="close-file"><img src="<?php echo IMAGESRC.'file_close.png'; ?>"/></a></div>
							</div>							
							<div class="file_name"></div>
							
							<!--<div style="width:70px" class="btn btn-blue btn-file browse <?php if(isset($result_array[$j]['ui_file_name']) && !empty($result_array[$j]['ui_file_name'])) { ?>hide <?php } else { ?>show <?php } ?>"> -->
					
					<div style="width:70px" class="btn btn-blue btn-file browse show"> 
					<img border="0" class="uni_attchment_second" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Browse
                <input type="file" name="attachments[]" class="file_up"/>
				
                </div>	
					</div>
					<?php } ?>
          <div class="col-xs-12"><button class="btn btn-gray pull-right m-left-1 remove_field" type="button">
		  <input type="hidden" value="<?php echo $doc_file_id[$i]; ?>" class="remove_val" />	
          <img border="0" class="uni_cancel_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Remove</button><br/><hr/></div>
                    </div> 
                    <?php } ?>	
					</div> 	
							 
					<div class="col-xs-12">                      
						  <button class="btn btn-blue pull-right m-left-1 add_field_button" type="button">
						  <img border="0" class="uni_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Add
						  </button>
					</div> 

					
					
                  <div class="row">
                    <div class="col-xs-12">
                      <label>Notes</label>
                      <textarea class="form-control" rows="3" maxlength="2000" name="other_notes" id="other_notes" > <?php if(isset($result_data['other_notes'])) echo $result_data['other_notes'];?></textarea>
                    </div>
                  </div>
                  
                </div>
				<!--<h4>TRADE MANAGEMENT</h4>
                <div class="box-content panel-content">-->
                  <label>&nbsp;</label>				  
                 <!-- <div class="col-xs- form-group"> Trade agreement contract <!--<a href="#" class="glyphicon glyphicon-trash text-danger"></a>-->                    
                     <!-- <input type="file" name="attachments[]" value="<?php //if(isset($profile_pic)) echo $profile_pic; ?>"><?php //if(isset($profile_pic)) echo $profile_pic; ?>                          
                  </div>  -->
				 <!-- <div class="col-xs-3">
							<div class="preview_file">
							<div class="imagePreview"></div>
							<div class="close_file"><a href="javascript:void(0);" class="close-file"><img src="<?php echo IMAGESRC.'file_close.png'; ?>"/></a></div>
							</div>
							<div class="file_name"></div>
							<div class="btn btn-success btn-file browse"> <i class="glyphicon glyphicon-paperclip"></i> Browse
							<input type="file" name="attachments[]" class="file_up" />  
							</div><?php //if(isset($profile_pic)) echo $profile_pic; ?> 
                </div>-->
				
				<div class="row">
				<div class="col-xs-12">
				<div class="col-xs- text-left">
					<h4>Trade agreement contract</h4>
					<!--<div class="preview_file">
						<div class="imagePreview"></div>
						<div class="close_file"><a href="javascript:void(0);" class="close-file"><img src="<?php echo IMAGESRC.'file_close.png'; ?>"/></a></div>
					</div>-->
					<!--<div class="file_name"></div>-->

					<!--<div class="btn btn-blue btn-file browse"> <img border="0" class="uni_attchment_second" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Browse
						<input type="file" name="attachments[]" class="file_up"  />
					</div>-->
					<div class="preview_file <?php if(isset($single_file_name) && !empty($single_file_name)) { ?>show <?php } else{ ?>hide<?php }?>">
								<?php if(isset($single_file_name) && !empty($single_file_name)) {
								$ext = pathinfo($single_system_file_name, PATHINFO_EXTENSION);
								$actualdata = json_decode(DEFAULT_THUMB_IMAGE_ARRAY, true);
								if ($ext == 'tif' || $ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'tiff') 
								{
									$thumb_icons = DOC_URL.$single_system_file_name;
								}
								else
								{
									if (!empty($ext)) 
									{
									$thumb_icons = $actualdata[$ext]['40'];
									}
								}
								}
								?>
								<div class="imagePreview">
								<img src="<?php if(isset($single_file_name)) { echo $thumb_icons; } ?>" /></div>
								<div class="close_file"><a href="javascript:void(0);" onclick="delete_pic(<?php if(isset($profile_pic_id)) echo $profile_pic_id; ?>)" class="close-file"><img src="<?php echo IMAGESRC.'file_close.png'; ?>"/></a></div>
								<div class="file_name <?php if(isset($single_file_name)) { ?>show <?php } else{ ?>hide<?php } ?>"><?php if(isset($single_file_name)) { echo $single_file_name; } ?></div>
							</div>	
					<div class="btn btn-blue btn-file browse <?php if(isset($single_file_name) && !empty($single_file_name)) { ?>hide<?php } else { ?><?php } ?>"> <img border="0" class="uni_attchment_second" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Browse
						<input type="file" name="attachments[]" class="file_up"  />
					</div>
					<!--<?php //if(isset($single_file_name)) echo $single_file_name; ?> -->
				</div>               
				</div>               
				</div>               
				<!--<div class="row m-top">
				<div class="col-xs-12">
				<div class="panel panel-default m-top">
                     <div id="filter" role="tab" class="panel-heading">
                        <h4 class="panel-title">My Fields</h4>
                     </div>
                      <div class="panel-body">
                        <div class="panel-content">
                           <p>No My Fields. To create one, go to the My Fields tab in the setup area.</p>
                        </div>
                     </div> 
                  </div>
                  </div>
                  </div>-->
                <h4>PAYMENT INFO</h4>
                <div class="box-content panel-content">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="col-xs-3">
                        <label>Hold Payments
                          <input type="checkbox" id="hold_payments" name ="hold_payments" <?php if(isset($result_data['hold_payments']) && $result_data['hold_payments']==='Yes') echo  "checked='checked'"; ?> />
                        </label>
                      </div>
                      <div class="col-xs-4">
                        <label>Notes</label>
                        <textarea class="form-control" maxlength = "2000" rows="2" id="payment_notes" name ="payment_notes" ><?php if(isset($result_data['notes'])) echo $result_data['notes'];?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="Project_Access">
             <label>Select A Project</label>
            <div class="row">
				<div class="col-xs-3">
					<?php 
					$project_selected = '';
					if(isset($project_assigned_to))
					{
						$project_selected = explode(",",$project_assigned_to);
					}
					echo form_dropdown('project_list[]', $project_list, $project_selected, "class='selectpicker form-control' id='project_list' data-live-search='true' multiple"); 
					?>
				</div>
				<!--<div class="col-xs-3">
					<button type="button" class="btn btn-blue">Submit</button>
				</div>-->
			</div>
            <div class="row">
              <div class="col-xs-12">                
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
              </div>
            </div>
          </div>
        </div>
		<input type="hidden" name="save_type" id="save_type" value="" />
      </div>
    </div>
  </div>
</div>
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
				<button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="cancel_icon"/> CANCEL</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_dick"/> OK</button>				
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
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'add_sub_contractor.js';?>"></script>