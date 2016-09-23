<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="description" content="UniBuilder Admin Panel" />
      <title>Unibuilder | Registration</title>
      <link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap.min.css';?>">
      <link rel="stylesheet" href="<?php echo CSSSRC.'bootstrapvalidator.min.css';?>">
      <link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-select.min.css';?>">
      <link rel="stylesheet" href="<?php echo CSSSRC.'register.css';?>">  
      <link rel="stylesheet" href="http://cdn.jsdelivr.net/fontawesome/4.2.0/css/font-awesome.min.css">  
      <script type="text/javascript" src="<?php echo JSSRC.'jquery.min.js';?>"></script>
      <!--<script type="text/javascript" src="<?php echo JSSRC.'jquery.creditCardValidator.js';?>"></script>-->
      <script type="text/javascript" src="<?php echo JSSRC.'ubsrc.js';?>"></script>   
           
   </head>
   <body class="uni_wrapper loadingDiv">
   <div class="container-fluid">	      
	  <div class="row">
			<div class="col-xs-12">
				<a href="http://www.unibuilder.com/"> <img class="logo" src="<?php echo IMAGESRC.'register_uni-logo-new.jpg'; ?>" /></a>
			</div>
			<div class="divider">&nbsp;</div>
		 </div>              
      <div class="row form-register">
         <div class="col-xs-12 ">
            <form class="form-horizontal" id="form_registration1" name="form_registration1" method="post">
               
               <div class="error-message">
                  <div class="alerts alert-danger" role="alert"></div>
               </div><br>
               <div id="personal_details">
                  <div class="form-group" >
                     <label for="personal" class="col-xs-4 control-label">
                        <h4>Personal Details</h4>
                     </label>
                  </div>
                  <div class="form-group">
                     <label for="cname" class="col-xs-4 control-label">Company Name<span class="mandatory-field">*</span></label>
                     <div class="col-xs-6">
                        <input type="text" class="form-control" id="builder_name" placeholder="Company Name" name="builder_name" maxlength="128">
                     </div>
                  </div>
   			      <div class="form-group">
                     <label for="cname" class="col-xs-4 control-label">Username<span class="mandatory-field">*</span></label>
                     <div class="col-xs-6">
                        <input type="text" class="form-control" id="user_name" placeholder="Username" name="user_name" maxlength="128">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="fname" class="col-xs-4 control-label">First Name<span class="mandatory-field">*</span></label>
                     <div class="col-xs-6">
                        <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="lname" class="col-xs-4 control-label">Last Name<span class="mandatory-field">*</span></label>
                     <div class="col-xs-6">
                        <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail" class="col-xs-4 control-label">Email Address<span class="mandatory-field">*</span></label>
                     <div class="col-xs-6">
                        <input type="email" class="form-control" id="primary_email" placeholder="Email Address" name="primary_email" value="<?php echo $retVal = (isset($builder_primary_email_id) && !empty($builder_primary_email_id)) ? $builder_primary_email_id : '' ;?>" >
                        <p class="small">(Note: This email address will be used for further communications and activation so ensure that you enter a valid emai address )</p>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="phone" class="col-xs-4 control-label">Phone<span class="mandatory-field">*</span></label>
                     <div class="col-xs-6">
					 <div class="input-group">
						<span class="input-group-addon">
							<select class="form-control selectpicker" name="mobile_isd_code" id="mobile_isd_code" >
							<option value="US">US</option>
							</select>
						</span>
                        <input type="text" class="form-control" id="desk_phone" placeholder="Phone" name="desk_phone">
                     </div>
                     </div>
                  </div>
               </div>
               <div id="billing_address">
                  <div class="form-group">
                     <label for="baddress" class="col-xs-4 control-label">
                        <h4>Billing  Address</h4>
                     </label>
                  </div>
                  <div class="form-group">
                     <label for="address1" class="col-xs-4 control-label">Address 1<span class="mandatory-field">*</span></label>
                     <div class="col-xs-6">
                        <input type="text" class="form-control" id="address1" name="address1" placeholder="Address 1">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="address2" class="col-xs-4 control-label">Address 2</label>
                     <div class="col-xs-6">
                        <input type="text" class="form-control" id="address2" name="address2" placeholder="Address 2">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="city" class="col-xs-4 control-label">City<span class="mandatory-field">*</span></label>
                     <div class="col-xs-6">
                        <input type="text" class="form-control" id="city" name="city" placeholder="City">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="state" class="col-xs-4 control-label">State<span class="mandatory-field">*</span></label>
                     <div class="col-xs-6">
                        <input type="text" class="form-control" id="province" name="province" placeholder="State">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="country" class="col-xs-4 control-label">Country<span class="mandatory-field">*</span></label>
                     <div class="col-xs-6">
                        <input type="text" class="form-control" id="country" name="country" placeholder="Country">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="zip" class="col-xs-4 control-label">ZIP<span class="mandatory-field">*</span></label>
                     <div class="col-xs-6">
                        <input type="text" class="form-control" id="postal" name="postal" placeholder="ZIP">
                     </div>
                  </div>
               </div>
               <div>
                  <div class="form-group">
                     <label for="baddress" class="col-xs-4 control-label">
                        <h4>Payment Details</h4>
                     </label>
                  </div>
                  <div class="form-group">
                     <label for="plan" class="col-xs-4 control-label">Select Your Plan<span class="mandatory-field">*</span></label>
                     <?php if (isset($user_plan_details) && !empty($user_plan_details)) 
                     { ?>
                        <div class="col-xs-6" id="plan_by_uniadmin">
                         <input type="text" class="form-control" id="plan_id" name="plan_id" value="<?php echo $user_plan_details = (isset($user_plan_details) && !empty($user_plan_details)) ? $user_plan_details : '' ;?>" readonly >
                        
                     </div>';
                     <?php }
                     else
                     { ?>
                        <div class="col-xs-6" id="default_plan_list">
                         <?php 
                                 $plan_selected = '';
                                 if(isset($result_data['plan_id']))
                                 {
                                    $plan_selected = explode(",",$result_data['plan_id']);
                                 }
                                 echo form_dropdown('plan_id', $plan,$selected_plan_id, "class='selectpicker form-control' id='plan_id' data-live-search='true'"); 
                                 ?>
                        </div>
                     <?php }
                     ?>
                  </div>
                  <div class="form-group">
                     <label for="cardno" class="col-xs-4 control-label">Credit Card Number<span class="mandatory-field">*</span></label>
                     <div class="col-xs-6">
                        <input type="text" class="form-control"  id="credit_card_number" name="credit_card_number" placeholder="Credit Card Number">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="expiry" class="col-xs-4 control-label">Expiry<span class="mandatory-field">*</span></label>
                     <div class="col-xs-6">                    
                           <div class="expiry col-xs-7">
   							<div class="col-xs-12">
   								<div class="form-group">
   									<?php
   									  $expiry_month_selected = '';
   									  echo form_dropdown('expiry_month', $expiry_month,$expiry_month_selected, "class='selectpicker form-control' id='expiry_month' data-live-search='true'");  
   								   ?>
   								</div>
   							</div>
                           </div>
   						<div class="years col-xs-5">
   							<div class="col-xs-12">
   								<div class="form-group">
   								<?php
   								 $expiry_year_selected = '';
   								  echo form_dropdown('expiry_year', $expiry_year,$expiry_year_selected, "class='selectpicker form-control' id='expiry_year' data-live-search='true'");  
   							   ?>
   								</div>
   							</div>
                           </div>                                           
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-xs-4 control-label">
                     CVV Number<span class="mandatory-field">*</span>
                     </label>
                     <div class="col-xs-6">
                        <input type="text" class="form-control" id="code" name="code" placeholder="Security Code">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="cardname" class="col-xs-4 control-label">
                     Name On Card<span class="mandatory-field">*</span>
                     </label>
                     <div class="col-xs-6 ">
                        <input type="text" class="form-control" id="cardname" name="cardname" placeholder=" Name On Card">
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <p class="col-xs-10 text-center">
                     If a payment is successful,you will be sent with an activation link through the registerd
                     email address to create account 
                  </p>
               </div>
               <div class="form-group">
                  <label for="inputEmail3" class="col-xs-4 control-label"></label>
                  <div class="col-xs-6 ">
					<!-- Below condition for differenciate downgrade and register -->				  
					<?php if($subscription_id > 0) { ?>
					<input type="hidden"id="subscription_id" name="subscription_id" value="<?php echo $subscription_id; ?>">
					<input type="hidden"id="selected_plan_id" name="selected_plan_id" value="<?php echo $selected_plan_id; ?>">
					<input type="hidden"id="payment_change_type" name="payment_change_type" value="<?php echo $payment_change_type; ?>">
					<button class="btn btn-blue" type="submit" id="registration_form1">New Payment</button>
					<?php } else { ?>
                     <button class="btn btn-blue" type="submit" id="registration_form1">Make Payment</button>
					<?php } ?>
                     <button type="reset" class="btn btn-gray">Cancel</button>	
                  </div>
               </div>
            </form>
         </div>
      </div>
		  <div class="row">
		  <footer class="footer">
			 <p class="text-center"><a href="#">www.unibuilder.com</a></p>
		  </footer>
		</div>
	</div>
	   <script type="text/javascript" src="<?php echo JSSRC.'bootstrap.min.js';?>"></script>
      <script type="text/javascript" src="<?php echo JSSRC.'bootstrap-select.js';?>"></script>
      <script type="text/javascript" src="<?php echo JSSRC.'formValidation.min.js';?>"></script>
      <script type="text/javascript" src="<?php echo JSSRC.'formvalidation-bootstrap.min.js';?>"></script>
      <script type="text/javascript" src="<?php echo JSSRC.'signup_validator.js';?>"></script>
      <script type="text/javascript" src="<?php echo JSSRC.'save_register.js';?>"></script>  
	  <script type="text/javascript">
         var base_url = '<?php echo site_url(); ?>';     
         var image_url = '<?php echo IMAGESRC; ?>';      
      </script> 	  
   </body>
</html>
