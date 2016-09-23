<!-- inner content wrapper -->

<div class="wrapper">
  <form role="form" class="parsley-form" method="post" name="edit_new_user" id="edit_new_user">
    <div class="row">
      <ol class="breadcrumb">
        <li> <a href="javascript:;">Home</a> </li>
        <li class="active">View User</li>
      </ol>
    </div>
    
    <!-- Top Button -->
    <div class="row mb20 text-right">
      <button class="btn btn-primary" type="submit" id="update_user" name="update_user">Save</button>
	  <button class="btn btn-primary" type="button" id="delete_user" name="delete_user">Delete</button>
      <button class="btn btn-default" type="button" id="cancel_user" name="cancel_user">Cancel</button>
    </div>
    <!-- /Top Button -->
    <div class="row mb20">
	  <div class="col-xs-12 error-message uni_message">
		 <div class="alerts alert-danger"></div>
	   </div>
	</div>
    <div class="row">
      <section class="panel panel-default  post-comments">
        <div class="panel-heading"> General Information </div>		
        <div class="panel-body">
          <div class="row">
            <div class="form-group col-lg-3">
              <label>First Name</label>
              <input type="text" placeholder="Enter first name" name="first_name" id="first-name" class="form-control" value="<?php  if(isset($user_data['first_name'])) echo $user_data['first_name'] ; ?> ">
            </div>
            <div class="form-group col-lg-3">
              <label>Sur Name</label>
              <input type="text" placeholder="Enter sur name" name="last_name" id="sur-name" class="form-control" value="<?php  if(isset($user_data['last_name'])) echo $user_data['last_name'] ; ?> " >
            </div>
            <div class="form-group col-lg-3">
              <label>Email address</label>
              <input type="text" placeholder="Enter Email id" name="primary_email" id="primary_email" class="form-control" value="<?php  if(isset($user_data['primary_email'])) echo $user_data['primary_email'] ; ?> "  <?php if(isset($user_data['primary_email']))  { echo 'readonly';}?>>
            </div>
            <div class="form-group col-lg-3">
              <label for="exampleInputPassword1">Account</label>
             <!-- <select class="form-control" data-parsley-required="true" data-parsley-trigger="change" name="user_status">
                <option value="">Nothing selected</option>
                <option>Active</option>
                <option>In-Active</option>
              </select> -->
			               <?php 
                              $status_selected = '';
                              if(isset($user_data['user_status']))
                              {
                                 $status_selected = explode(",",$user_data['user_status']);
                              }
                              echo form_dropdown('status_id', $status_dropdown_list,$status_selected, "class='selectpicker form-control' id='status_id' data-live-search='true'"); 
                              ?>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-3">
              <label>Username</label>
              <input type="text" placeholder="Enter username" id="username" name="username" class="form-control" value="<?php  if(isset($user_data['username'])) echo $user_data['username'] ; ?> " <?php if(isset($user_data['username']))  { echo 'readonly';}?> >
			  <input type="hidden" id="ub_user_id" name="ub_user_id" value="<?php echo $ub_user_id ; ?>" />
			    <input type="hidden" id="edit_page" name="edit_page" value="edit" />
            </div>
           <!-- <div class="form-group col-lg-3">
              <label>Password</label>
              <input type="password" placeholder="Enter password" id="password" name="password" class="form-control" data-parsley-required="true" data-parsley-trigger="change">
			 </div> -->
			
            <div class="form-group col-lg-3 box">
            <button class="btn btn-info btn-sm mt25" type="submit" id="send_activation_link" name="send_activation_link">Send activation link</button>
            </div>
          </div>
        </div>
      </section>
    </div>
  </form>
</div>
<input type="hidden" id="select_change" name="select_change" value="" />
<!-- page script --> 
<!-- <script src="<?php echo ACJI.'scripts/plugins/parsley.min.js';?>"></script> -->
<script src="<?php echo ACJI.'scripts/js/save_user.js'; ?>" > </script>
<!-- /page script --> 
