<!-- inner content wrapper -->
<div class="wrapper">
   <form role="form" class="parsley-form" id="add_new_plan" method="post" name="add_new_plan">
      <div class="row">
         <ol class="breadcrumb">
            <li> <a href="javascript:;">Home</a> </li>
            <li class="active">View Plan</li>
         </ol>
      </div>
      <!-- Top Button -->
      <div class="row mb20 text-right">
         <button class="btn btn-primary" id="save_plan" type="submit">Save</button>
		 <button class="btn btn-primary" type="button" id="<?php if(isset($plan_data['ub_plan_id'])) echo $plan_data['ub_plan_id']; ?>" onclick="delete_plan(this.id)" name="delete_user">Delete</button>
         <button class="btn btn-default" type="submit" id="cancel">Cancel</button>
      </div>
      <!-- /Top Button --> 
	 <div class="row mb10">
	  <div class="col-xs-12 error-message uni_message">
		 <div class="alerts alert-danger"></div>
	   </div>
	 </div>
      <!-- main content -->
      <div class="row">
         <section class="panel panel-default  post-comments">
            <div class="panel-heading">Plan Details</div>
            <div class="panel-body">
               <div class="row">
                  <div class="form-group col-lg-3">
                     <label>Plan Name</label>
                     <input type="hidden" name="ub_plan_id" id="ub_plan_id" value="<?php echo (isset($plan_data['ub_plan_id']) && $plan_data['ub_plan_id'] > 0)? $plan_data['ub_plan_id']:0 ?>" />
                     <input type="text" placeholder="Enter plan name" id="plan-name" class="form-control" name="plan_name" value="<?php if(isset($plan_data['plan_name'])) echo $plan_data['plan_name'];?>">
                  </div>
                  <div class="form-group col-lg-3">
                     <label>Cost <span class="text-muted">/ Month</span></label>
                     <input type="text" placeholder="$" id="cost" class="form-control" name="plan_amount" value="<?php if(isset($plan_data['plan_amount'])) echo $plan_data['plan_amount'];?>"/>
                  </div>
               </div>
            </div>
         </section>
      </div>
      <div class="row">
         <section class="panel panel-default  post-comments">
            <div class="panel-heading">Features Information</div>
            <div class="panel-body">
               <div class="row">
                  <div class="panel-body">
                     <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped no-m">
                        <tr>
                           <td width="100%">
						   <div class="col-xs-12">
							<div class="form-group">
                              <group>
                                 <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                    <tr>
                                       <td width="50" align="center"><input type="radio" name="group1" id="radio8" <?php if(isset($plan_data['no_of_projects']) && $plan_data['no_of_projects'] > -1) {echo "checked='checked'";}?>></td>
                                       <td width="130" height="30" align="center">
                                          <div class="input-group spinner"> <span class="input-group-btn">
                                             <button type="button" class="btn btn-default btn-outline btn-sm spinner-down"> <i class="ti-minus"></i> </button>
                                             </span>
                                             <input type="text" class="form-control1 input-sm spinner-input" name="no_of_projects" value="<?php if(isset($plan_data['no_of_projects']) && $plan_data['no_of_projects'] > -1) echo $plan_data['no_of_projects'];?>"/>
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-default btn-outline btn-sm spinner-up"> <i class="ti-plus"></i> </button>
                                             </span> 
                                          </div>
                                       </td>
                                       <td class="p10">
                                          <table border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                <td width="110">Projects/Year (or)</td>
                                                <td width="30" align="center"><input type="radio" name="group1" id="radio1" value="-1" <?php if(isset($plan_data['no_of_projects']) && $plan_data['no_of_projects'] == -1) {echo "checked='checked'";}?>></td>
                                                <td width="100">Unlimited </td>
                                             </tr>
                                          </table>
                                       </td>
                                    </tr>
                                 </table>
                              </group>
							  </div>
							  </div>
                           </td>
                        </tr>
                        <tr>
                           <td width="100%">
						   <div class="col-xs-12">
							<div class="form-group">
                              <group>
                                 <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                    <tr>
                                       <td width="50" align="center"><input type="radio" name="group2" id="radio2" <?php if(isset($plan_data['no_of_users']) && $plan_data['no_of_users']>-1) {echo "checked='checked'";}?> ></td>
                                       <td width="130" height="30" align="center">
                                          <div class="input-group spinner"> <span class="input-group-btn">
                                             <button type="button" class="btn btn-default btn-outline btn-sm spinner-down"> <i class="ti-minus"></i> </button>
                                             </span>
                                             <input type="text" class="form-control1 input-sm spinner-input" name="no_of_users" value="<?php if(isset($plan_data['no_of_users']) && $plan_data['no_of_users'] > -1) echo $plan_data['no_of_users'];?>"/>
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-default btn-outline btn-sm spinner-up"> <i class="ti-plus"></i> </button>
                                             </span> 
                                          </div>
                                       </td>
                                       <td class="p10">
                                          <table border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                <td width="110">User/Year (or)</td>
                                                <td width="30" align="center"><input type="radio" name="group2" id="radio3" value="-1" <?php if(isset($plan_data['no_of_users']) && $plan_data['no_of_users'] == -1) {echo "checked='checked'";}?> ></td>
                                                <td width="100">Unlimited </td>
                                             </tr>
                                          </table>
                                       </td>
                                    </tr>
                                 </table>
                              </group>
							  </div>
							  </div>
                           </td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
         </section>
      </div>
      <!-- /main content -->
   </form>
</div>
<!-- /inner content wrapper --> 
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
<script src="<?php echo ACJI.'scripts/js/datatables.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/js/pickers.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/plugins/fuelux/spinner.js';?>"></script>
<script src="<?php echo ACJI.'scripts/js/save_plan.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/plugins/parsley.min.js';?>"></script> 
<!-- /page script -->