<!-- inner content wrapper -->
<?php //echo '<pre>';print_r($result_data);exit; ?>
<div class="wrapper">
   <form role="form" class="parsley-form" id="update_builder" name="update_builder">
      <input type="hidden" name="search_param" id="search_param" value="">
      <div class="row">
         <ol class="breadcrumb">
            <li> <a href="javascript:;">Home</a> </li>
            <li class="active">Edit Builder</li>
         </ol>
      </div>
      <!-- Top Button -->
      <div class="row mb20 text-right form-group">
         <button type="submit" id="update_save_new_builder" name="update_save_new_builder" class="btn btn-primary">Save</button>
         <button type="button" id="delete_builder" name="delete_builder" class="btn btn-primary">Delete</button>
         <button class="btn btn-default" type="submit" id="cancel">Cancel</button>
      </div>
      <!-- /Top Button --> 
      <div class="row mb20 ">
         <div class="col-xs-12 error-message uni_message">
            <div class="alerts alert-danger"></div>
         </div>
      </div>
      <!-- Field Search -->
      <div class="row">
         <section class="panel panel-default  post-comments">
            <div class="panel-heading"> General Information </div>
            <div class="panel-body">
               <div class="row">
                  <input type="hidden" name="user_builder_id" id="user_builder_id" value="<?php if(isset($result_data['builder_id'])) echo $result_data['builder_id'];?>">
                  <input type="hidden" name="user_user_id" id="user_user_id" value="<?php if(isset($result_data['ub_user_id'])) echo $result_data['ub_user_id'];?>">
                  <div class="form-group col-lg-3">
                     <label>Membership Id</label>
                     <input type="text" placeholder="Enter first name" id="membership_id" name="membership_id" class="form-control" value="<?php echo isset($result_data['membership_number'])?$result_data['membership_number']:''; ?>" readonly>
                  </div>
                  <div class="form-group col-lg-3">
                     <label>Company Name</label>
                     <input type="text" placeholder="Enter company name" id="company_name" name="company_name" class="form-control" value="<?php echo isset($result_data['builder_name'])?$result_data['builder_name']:''; ?>">
                  </div>
                  <div class="form-group col-lg-3">
                     <label>First Name</label>
                     <input type="text" placeholder="Enter first name" id="first_name" name="first_name" class="form-control" data-parsley-required="true" data-parsley-trigger="change" value="<?php echo isset($result_data['first_name'])?$result_data['first_name']:''; ?>">
                  </div>
                  <div class="form-group col-lg-3">
                     <label>Last Name</label>
                     <input type="text" placeholder="Enter last name" id="last_name" name="last_name" class="form-control" value="<?php echo isset($result_data['last_name'])?$result_data['last_name']:''; ?>">
                  </div>
				  <div class="form-group col-lg-3">
                     <label>Mobile number</label>
                     <input type="text" placeholder="Enter mobile number" id="mobile_number" name="mobile_number" class="form-control" value="<?php echo isset($result_data['desk_phone'])?$result_data['desk_phone']:''; ?>">
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-lg-3">
                     <label>Email Address</label>
                     <input type="text" placeholder="Enter Email Address" id="email_address" name="email_address" class="form-control" value="<?php echo isset($result_data['primary_email'])?$result_data['primary_email']:''; ?>" readonly>
                  </div>
                  <div class="form-group col-lg-3">
                     <label>Address</label>
                     <input type="text" placeholder="Enter Address" id="address" name="address" class="form-control" value="<?php echo isset($result_data['address'])?$result_data['address']:''; ?>">
                  </div>
                  <div class="form-group col-lg-3">
                     <label>City</label>
                     <input type="text" placeholder="Enter City" id="city" name="city" class="form-control" value="<?php echo isset($result_data['city'])?$result_data['city']:''; ?>">
                  </div>
                  <div class="form-group col-lg-3">
                     <label>ZIP</label>
                     <input type="text" placeholder="Enter ZIP" id="zip" name="zip" class="form-control" value="<?php echo isset($result_data['postal'])?$result_data['postal']:''; ?>">
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-lg-3">
                     <label>State</label>
                     <input type="text" placeholder="Enter State" id="state" name="state" class="form-control" value="<?php echo isset($result_data['province'])?$result_data['province']:''; ?>">
                  </div>
                  <div class="form-group col-lg-3">
                     <label for="exampleInputPassword1">Country</label>
                     <input type="text" placeholder="USA" id="country" name="country" class="form-control" value="<?php echo isset($result_data['country'])?$result_data['country']:''; ?>">
                  </div>
                  <div class="form-group col-lg-3">
                     <label for="exampleInputPassword1">Currency</label>
                     <input type="text" placeholder="$" id="currency" name="currency" class="form-control" value="<?php echo isset($result_data['builder_currency'])?$result_data['builder_currency']:''; ?>" readonly>
                  </div>
                  <div class="form-group col-lg-3">
                     <label for="exampleInputPassword1">Status</label>
                     <?php 
					 
                        $status_selected = '';
                        if(isset($result_data['user_status']))
                        {
                         $status_selected = $result_data['user_status'];
                        }
                        echo form_dropdown('status_id', $status_dropdown_list,strtolower($status_selected), "class='selectpicker form-control' id='status_id' data-live-search='true'"); 
                        ?>
                  </div>
               </div>
               <?php 
                  if($result_data['user_status'] == 'active'){ ?>
               <div class="row">
                  <div class="form-group col-lg-3 box">
                     <label>Username</label>
                     <input type="text" placeholder="Enter username" id="username" class="form-control" value="<?php echo $result_data['username'] ; ?>" <?php if($result_data['username']){ echo "readonly" ; } ?> name="username" >
                     <input type="hidden" id="ub_user_id" name="ub_user_id" value="<?php echo $result_data['ub_user_id'] ; ?>" />
                  </div>
                  <!-- <div class="form-group col-lg-3 box">
                     <label>Password</label>
                     <input type="password" placeholder="Enter password" id="password" name="password" class="form-control" />
                     </div> -->
                  <div class="form-group col-lg-3 box">
                     <button class="btn btn-info btn-sm mt25" id="send_activation_link" type="submit">Send activation link</button>
                  </div>
               </div>
               <?php } ?> 
            </div>
         </section>
      </div>
   </form>
   <!-- /Field Search --> 
   <!-- main content -->
   <div class="row">
      <section class="panel panel-default  post-comments">
         <div class="panel-heading"> Plan Information </div>
         <div class="panel-body">
            <div class="row">
               <p><strong>Current Plan:</strong> <span class="label label-success"><?php echo isset($result_data['plan_name'])?$result_data['plan_name']:''; ?></span> (Start Date - <?php echo isset($result_data['created_on'])?$result_data['created_on']:''; ?>)
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Change Plan</button>
               </p>
               <hr />
               <p><b>Plan History</b></p>
               <hr />
               <div class="col-sm-12">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped no-m">
                     <thead>
                        <tr>
                           <td height="30">Contract number</td>
                           <td>Plan Name</td>
                           <td>Cost Per Month</td>
                           <td>Start Date</td>
                           <td>End Date</td>
                        </tr>
                     </thead>
                     <?php foreach($plan_data as $key => $val){?>
                     <tr>
                        <td height="30"><?php echo $val['contract_number']; ?></td>
                        <td height="30"><?php echo $val['plan_name']; ?></td>
                        <td height="30"><?php echo $val['plan_amount']; ?></td>
                        <td><?php echo $val['start_date']; ?></td>
                        <td><?php if($val['end_date'] == '0000-00-00')
                           {
                           echo 'Till now';
                           }else{echo $val['end_date'];} ?></td>
                     </tr>
                     <?php } ?>
                  </table>
               </div>
			   <div class="col-xs-12">
				<label>Projects (<?php echo isset($result_data['no_of_projects'])?$result_data['no_of_projects']:''; ?> Projects Allowed as per current plan <?php echo isset($result_data['plan_name'])?$result_data['plan_name']:''; ?>)</label>
				<div>
				<group>
				<input type="radio" name="showactive" id="open" /> Show Open
				<input type="radio" name="showdisabled" id="disabled" /> Show Disabled
				<input type="radio" name="showall" id="all" /> Show All
				</group>
				</div>

            

				<table class="table table-bordered table-striped mg-t datatable mt20" id="uni_project_details">
					<thead>
						<tr>
							<th>Project Name</th>
							<th>Address</th>
							<th>Actual Start date</th>
							<th>Actual End date</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			   </div>
            </div>
         </div>
      </section>
   </div>
   <div class="row">
      <section class="panel panel-default  post-comments">
         <div class="panel-heading"> Last 5 Payments </div>
         <div class="panel-body">
            <table class="table table-bordered table-striped mg-t datatable" id="builder_payments">
               <thead>
                  <tr>
                     <th>Billing Period</th>
                     <th>Plan</th>
                     <th>Payment Type</th>
                     <th>Payment Status</th>
                     <th>Amount</th>
                     <th>Transaction Id</th>
                     <!--<th>Attempte</th>-->
                     <th>Remarks</th>
                     <th>Download Invoice</th>
                  </tr>
               </thead>
            </table>
         </div>
      </section>
   </div>
   <!-- /main content -->
</div>
<!-- /inner content wrapper --> 
<input type="hidden" id="select_change" name="select_change" value="" />
<!-- page level plugin styles -->
<link rel="stylesheet" href="<?php echo ACJI.'scripts/plugins/chosen/chosen.min.css';?>">
<link rel="stylesheet" href="<?php echo ACJI.'scripts/plugins/datatables/jquery.dataTables.css';?>">
<!-- /page level plugin styles --> 
<!-- page level scripts --> 
<script src="<?php echo ACJI.'scripts/plugins/chosen/chosen.jquery.min.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/plugins/datatables/jquery.dataTables.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/plugins/datepicker/bootstrap-datepicker.js';?>"></script>
<link rel="stylesheet" href="<?php echo ACJI.'scripts/plugins/datepicker/datepicker.css';?>">
<!-- /page level scripts --> 
<!-- page script --> 
<script src="<?php echo ACJI.'scripts/js/bootstrap-datatables.js';?>"></script> 
<!--<script src="<?php echo ACJI.'scripts/js/payment-datatables.js';?>"></script>--> 
<script src="<?php echo ACJI.'scripts/js/pickers.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/plugins/parsley.min.js';?>"></script> 
<!-- /page script --> 
<!-- Modal -->
<form role="form" class="parsley-form" data-parsley-validate>
   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title" id="myModalLabel">Edit Plan</h4>
            </div>
            <div class="modal-body">
               <div class="panel-body">
                  <div class="row">
                     <input type="hidden" name="ub_user_plan_id" id="ub_user_plan_id" value="<?php if(isset($result_data['ub_user_plan_id'])) echo $result_data['ub_user_plan_id'];?>">
                     <input type="hidden" name="builder_id" id="builder_id" value="<?php if(isset($result_data['builder_id'])) echo $result_data['builder_id'];?>">
					 <input type="hidden" name="current_plan_id" id="current_plan_id" value="<?php if(isset($result_data['plan_id'])) echo $result_data['plan_id'];?>">
                     <div class="form-group col-lg-6">
                        <label>Select New Plan</label>
                        <?php 
                           $plan_selected = '';
                           if(isset($result_data['plan_id']))
                           {
                              $plan_selected = explode(",",$result_data['plan_id']);
                           }
                           echo form_dropdown('plan_id', $plan,'', "class='selectpicker form-control' id='plan_id' data-live-search='true'"); 
                           ?>
                     </div>
                  </div>
                  <div class="row" id="display_project_count_block">
                     <div class="col-xs-12">
                        <p>The projects allowed in the plan which you have selected is (<span class="no_of_pro"><?php echo $result_data['no_of_projects'] ?></span>) and you have (<span class="pro_count"><?php echo $current_plan_project_count; ?></span>) active projects. </span>Please disable any of the (<span class="disable_count"><?php echo $disable_project_count; ?></span>) projects to downgrade to this plan.</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button class="btn btn-primary" id="update_plan" name="update_plan">Update Changes</button>
            </div>
         </div>
      </div>
   </div>
</form>
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>';
   this.displayStart   = '<?php echo 0; ?>';     
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
</script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-admin-datatable.js';?>"></script>
<script src="<?php echo ACJI.'scripts/js/save_builder.js';?>"></script>
