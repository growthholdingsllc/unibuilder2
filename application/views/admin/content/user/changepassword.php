<!-- inner content wrapper -->

<div class="wrapper">
 <div class="row">
    <ol class="breadcrumb">
      <li> <a href="javascript:;">Home</a> </li>
      <li class="active">Change Password</li>
    </ol>
  </div>
  <form id="change_password" class="form-horizontal" method="post" name="change_password">
  <!-- Top Button -->
  <div class="row mb20 text-right">
    <button type="submit" class="btn btn-primary"  id="save_change_password" name="save_change_password">Update</button>
    <button class="btn btn-default" type="button">Cancel</button>
  </div>
  <!-- /Top Button --> 
  
  <!-- main content -->
  
  <div class="row">
    <section class="panel panel-default  post-comments">
      <div class="panel-heading">Change Password</div>
      <div class="panel-body">
     

<div class="row m-top">
  <div class="col-xs-12 error-message uni_message">
	 <div class="alerts alert-danger"></div>
   </div>
</div>
<div class="row">
   <div class="col-xs-12">
      <h4>Change Password</h4>
      <div class="box-content panel-content">       
            <div class="row five-col">
               <div class="col-xs-3">
                  <label>Old Password</label>
				  <div class="col-xs-12">
					  <div class="form-group">
						<input type="password" name="password" id="password" class="form-control">
					  </div>
				  </div>
               </div>
               <div class="col-xs-3">
                  <label>New Password</label>
				  <div class="col-xs-12">
					  <div class="form-group">
						<input type="password" name="new_password" id="new_password" class="form-control">
					 </div>
				  </div>
               </div>
               <div class="col-xs-3">
                  <label>Confirm Password</label>
				  <div class="col-xs-12">
					  <div class="form-group">
						<input type="password" name="confirm_password" id="confirm_password" class="form-control">
					  </div>
				  </div>
               </div>			
            </div>        
      </div>
   </div>
</div>

      </div>
    </section>
  </div>
</form>
  <!-- /main content --> 

</div>
<!-- page script --> 
<script src="<?php echo ACJI.'scripts/js/changepassword.js';?>"></script>
<!-- /page script --> 
