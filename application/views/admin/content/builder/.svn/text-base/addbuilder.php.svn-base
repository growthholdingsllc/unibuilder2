<!-- inner content wrapper -->

<div class="wrapper">
  <form role="form" class="parsley-form" id="add_new_builder" method="post" name="add_new_builder">
    <div class="row">
      <ol class="breadcrumb">
        <li> <a href="javascript:;">Home</a> </li>
        <li class="active">Add Builder</li>
      </ol>
    </div>
    
    <!-- Top Button -->
    <div class="row mb20 text-right form-group">
      <button class="btn btn-primary" type="submit" id="save_new_builder" name="save_new_builder">Save</button>
      <button class="btn btn-default" type="submit" id="cancel">Cancel</button>
    </div>
    <!-- /Top Button --> 
    <div class="row mb10">
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
            <!--<div class="form-group col-lg-3">
              <label>Membership Id</label>
              <p>UNI-2015-123456790</p>
            </div>-->
            <div class="form-group col-lg-3">
              <label>Company Name</label>
              <input type="text" placeholder="Enter company name" id="company_name" name="company_name" class="form-control" />
            </div>
            <div class="form-group col-lg-3">
              <label>First Name</label>
              <input type="text" placeholder="Enter first name" id="first_name" name="first_name" class="form-control" />
            </div>
            <div class="form-group col-lg-3">
              <label>Last Name</label>
              <input type="text" placeholder="Enter last name" id="last_name" name="last_name" class="form-control" />
            </div>
			<div class="col-xs-3">
              <label>Mobile number</label>
              <input type="text" placeholder="Enter mobile number" id="mobile_number" name="mobile_number" class="form-control" />
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-3">
              <label>Email Address</label>
              <input type="text" placeholder="Enter Email Address" id="email_address" name="email_address" class="form-control" />
            </div>
            <div class="form-group col-lg-3">
              <label>Address</label>
              <input type="text" placeholder="Enter Address" id="address" name="address" class="form-control" />
            </div>
            <div class="form-group col-lg-3">
              <label>City</label>
              <input type="text" placeholder="Enter City" id="city" name="city" class="form-control" />
            </div>
            <div class="form-group col-lg-3">
              <label>ZIP</label>
              <input type="text" placeholder="Enter ZIP" id="zip" name="zip" class="form-control" />
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-3">
              <label>State</label>
              <input type="text" placeholder="Enter State" id="state" name="state" class="form-control" />
            </div>
            <div class="form-group col-lg-3">
              <label for="exampleInputPassword1">Country</label>
              <input type="text" placeholder="USA" id="country" name="country" class="form-control" readonly />
            </div>
            <div class="form-group col-lg-3">
              <label for="exampleInputPassword1">Currency</label>
              <input type="text" placeholder="$" id="currency" name="currency" class="form-control" readonly />
            </div>
            <div class="form-group col-lg-3">
              <label for="exampleInputPassword1">Account</label>
              <select class="form-control" id="account_info" name="account_info">
                <option value="">Nothing selected</option>
                <option value="Active">Active</option>
                <option value="Inactive">In-Active</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-3 box">
              <label>Username</label>
              <input type="text" placeholder="Enter username" id="username" name="username" class="form-control" />
			  <input type="hidden" id="ub_user_id" name="ub_user_id" value="" />
			  
            </div>
            <!--<div class="form-group col-lg-3 box">
              <label>Password</label>
              <input type="password" placeholder="Enter password" id="password" name="password" class="form-control" />
            </div>-->
            <div class="form-group col-lg-3 box">
              <button class="btn btn-info btn-sm mt25" type="button" id="send_activation_link" name="send_activation_link">Send activation link</button>
            </div> 
          </div>
        </div>
      </section>
    </div>
    <!-- /Field Search --> 
    
    <!-- main content -->
    <div class="row">
      <section class="panel panel-default  post-comments">
        <div class="panel-heading"> Plan Information </div>
        <div class="panel-body">
          <div class="row">
            <div class="form-group col-lg-3">
              <label>Select Plan</label>
              <?php 
                              $plan_selected = '';
                              if(isset($result_data['plan_id']))
                              {
                                 $plan_selected = explode(",",$result_data['plan_id']);
                              }
                              echo form_dropdown('plan_id', $plan,$plan_selected, "class='selectpicker form-control' id='plan_id' data-live-search='true'"); 
                              ?>
            </div>
           
          </div>
        </div>
      </section>
    </div>
    <!-- /main content -->
  </form>
  <input type="hidden" id="select_change" value="" /> 
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
<script src="<?php echo ACJI.'scripts/js/add_builder.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/plugins/parsley.min.js';?>"></script> 
<!-- /page script --> 
