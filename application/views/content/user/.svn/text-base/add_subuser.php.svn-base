<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?> 
    <!--<li class="active">Subusers</li>-->
  </ol>
</div>
<form id="add_new_sub_user" class="form-horizontal" method="post" name="add_new_sub_user">
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
      <div class="pull-right ">
	    <a href="<?php echo base_url();?>dXNlci91c2VyX3N1YnVzZXIv"><button type="button" class="btn btn-gray pull-right m-left-1"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="cancel_icon"/> Cancel</button></a>
		<!--checking role access  // by satheesh -->
		<?php
		if(isset($this->user_role_access[strtolower('subusers')][strtolower('delete')]) && $this->user_role_access[strtolower('subusers')][strtolower('delete')] == 1)
		{ 
			if(!empty($result_data['ub_user_id'])) 
			{ 
		?>
        <button type="button" class="btn btn-blue pull-right m-left-1" id="<?php if(isset($result_data['ub_user_id'])) echo $result_data['ub_user_id']; ?>" onclick="delete_sub_users(this.id)" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="delete_icon"/> Delete</button>
		<!--checking role access  // by satheesh -->
		<?php 
			}
		}
		if(isset($this->user_role_access[strtolower('subusers')][strtolower('edit')]) && $this->user_role_access[strtolower('subusers')][strtolower('edit')] == 1 && $this->first_argument > 0)
		{ 
		?>
        <button type="submit" class="btn btn-blue pull-right m-left-1" id="sub_user_save_and_back" name="sub_user_save_and_back"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="go_back"/> Save &amp; Back</button>
        <button type="submit" class="btn btn-blue pull-right m-left-1" id="sub_user_save_and_new" name="sub_user_save_and_new"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="savenew"/> Save &amp; New</button>
        <button type="submit" class="btn btn-blue pull-right m-left-1" id="sub_user_save_and_stay" name="sub_user_save_and_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="savestay"/> Save &amp; Stay</button>
		<?php 
		}
		else if((isset($this->user_role_access[strtolower('subusers')][strtolower('add')]) && $this->user_role_access[strtolower('subusers')][strtolower('add')] == 1) && $this->first_argument == 0)
		{ 
		?>
		<button type="submit" class="btn btn-blue pull-right m-left-1" id="sub_user_save_and_back" name="sub_user_save_and_back"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="go_back"/> Save &amp; Back</button>
        <button type="submit" class="btn btn-blue pull-right m-left-1" id="sub_user_save_and_new" name="sub_user_save_and_new"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="savenew"/> Save &amp; New</button>
        <button type="submit" class="btn btn-blue pull-right m-left-1" id="sub_user_save_and_stay" name="sub_user_save_and_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="savestay"/> Save &amp; Stay</button>
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
    <h4>NEW SUBUSER DETAILS</h4>
    <div class="box-content panel-content">
	<div class="row five-col">
	<div class="col-xs-3">
          <label>Select Company</label>
          <?php
          $company_selected = '';
		  if(isset($result_data['subcontractor_id']))
				   {
						$company_selected = explode(",",$result_data['subcontractor_id']);
				   }
          echo form_dropdown('company_id', $company_list, $company_selected, "class='selectpicker form-control' id='company_id' data-live-search='true'");
          ?> 
	</div></div>
	<hr/>
      <div class="row five-col">
	  <input type="hidden" name="ub_user_id" id="ub_user_id" value="<?php if(isset($result_data['ub_user_id'])) echo $result_data['ub_user_id'];?>">
        <div class="col-xs-3">
          <label>First Name</label>
			<div class="col-xs-12">
				<div class="form-group">
					<input type="text" class="form-control" name="first_name" id="first_name" maxlength="128" value="<?php if(isset($result_data['first_name'])) echo $result_data['first_name'];?>">
				</div>
			</div>
        </div>
        <div class="col-xs-3">
          <label>Last Name</label>
          <input type="text" class="form-control" name="last_name" id="last_name" maxlength="128" value="<?php if(isset($result_data['last_name'])) echo $result_data['last_name'];?>">
        </div>
        <div class="col-xs-3">
          <label>Primary Email</label>
		  <div class="col-xs-12">
				<div class="form-group">
					<input type="text" class="form-control" id="primary_email" name="primary_email" maxlength="72" value="<?php if(isset($result_data['primary_email'])) echo $result_data['primary_email'];?>" />
				</div>
		  </div>
        </div>
        <div class="col-xs-3">
          <label>Secondary Email</label>
          <input type="text" class="form-control" id="alter_email" name="alter_email" maxlength="200" value="<?php if(isset($result_data['alternative_email'])) echo $result_data['alternative_email'];?>" />
        </div>
        <div class="col-xs-3">
          <label>Phone</label>
          <input type="text" class="form-control" id="desk_phone" name="desk_phone" maxlength="12" value="<?php if(isset($result_data['desk_phone'])) echo $result_data['desk_phone'];?>" >
        </div>
      </div>
      <div class="row five-col m-top">
        <div class="col-xs-3">
          <label>Cell</label>
          <input type="text" class="form-control" id="mobile_phone" name="mobile_phone" maxlength="12" value="<?php if(isset($result_data['mobile_phone'])) echo $result_data['mobile_phone'];?>" >
        </div>
        <div class="col-xs-3">
          <label>FAX</label>
          <input type="text" class="form-control" id="fax" name="fax" maxlength="12" value="<?php if(isset($result_data['fax'])) echo $result_data['fax'];?>">
        </div>
		 <div class="col-xs-3">
          <label>Country</label>
		  <input type="text" class="form-control" id="country" name="country" maxlength="50" value="<?php if(isset($result_data['country'])) echo $result_data['country'];?>">
        </div>
		<div class="col-xs-3">
          <label>Time Zone</label>
			<div class="col-xs-12">
				<div class="form-group">
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
		<div class="col-xs-3">
          <label>Date time Formate</label>
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
      </div>
      <!-- Start section for login enabled -->
           <?php $this->load->view('common/dynamic/login_enabled'); ?>
          <!-- End section for login enabled -->
    </div>
  </div>
</div>
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
<input type="hidden" name="save_type" id="save_type" value="" />
</form>
<link rel="stylesheet" href="http://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-tagsinput.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery-ui.css';?>">	
<script type="text/javascript" src="<?php echo JSSRC.'login_enabled.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'add_sub_users.js';?>"></script>