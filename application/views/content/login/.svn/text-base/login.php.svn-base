<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="description" content="UniBuilder Admin Panel" />
      <title>Unibuilder | Login</title>	  
	  <link href="<?php echo IMAGESRC.'fav.ico'; ?>" rel="shortcut icon" />
      <link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap.min.css';?>">
      <link rel="stylesheet" href="<?php echo CSSSRC.'bootstrapvalidator.min.css';?>">  
	  <link rel="stylesheet" href="<?php echo CSSSRC.'login.css';?>">	  
      <script type="text/javascript" src="<?php echo JSSRC.'jquery.min.js';?>"></script>
      <script type="text/javascript" src="<?php echo JSSRC.'bootstrap.min.js';?>"></script>
      <script type="text/javascript" src="<?php echo JSSRC.'formValidation.min.js';?>"></script>
      <script type="text/javascript" src="<?php echo JSSRC.'formvalidation-bootstrap.min.js';?>"></script>	  
	  <script type="text/javascript" src="<?php echo JSSRC.'ubsrc.js';?>"></script>      
	  <script type="text/javascript" src="<?php echo JSSRC.'app_validator.js';?>"></script>
	  <script type="text/javascript" src="<?php echo JSSRC.'app_login.js';?>"></script>
   </head>
   <body class="uni_wrapper loadingDiv">
      <header></header>
      <section>
         <div class="login-container">
            <div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo IMAGESRC.'login-logo.png';?>"/></a></div>
			<div class="error-form">
				<div class="row text-center reset-con">
					<div class="error-message">
					  <div class="alert alert-danger" role="alert">Connection Error</div>
					  <div class="col-xs-6">
							<div class="form-group pull-left">
							   <p class="pull-left"> &lt; <a class="back-login" href="javascript:void(0);">Back to Login</a></p>
							</div>
					   </div>
				   </div>
				</div>
			</div>
            <div class="login-form">
               <div class="error-message">
                  <div class="alert alert-danger" role="alert">Connection Error</div>
               </div>
			   <?php 
			   if(isset($resetForm))
			   { 
				if($resetForm == 'resetForm')
				{
			   ?>
               <form id="resetForm" class="form-horizontal" method="post" style="display:block;">
                  <div class="row text-center reset-con">
                     <h4 class="text-left">Reset Password</h4>
                     <div class="col-sm-12">
                        <div class="form-group">             
                           <input class="form-control" type="password" name="newpassword" placeholder="Password">        
                        </div>
                        <div class="form-group">             
                     <input class="form-control" type="password" name="confirmpassword" placeholder="Confirm Password">
					 <input class="form-control" type="hidden" name="username" value="<?php echo $username;?>">     
                        </div>
                     </div>
					 <div class="col-xs-6">
						<div class="form-group pull-left">
							  <p class="pull-left"> &lt; <a class="back-login" href="<?php echo base_url();?>">Back to Login</a></p>
						</div>
                     </div>
						<div class="col-xs-6">
                        <div class="form-group">
                           <button type="submit" id="reset-form" class="btn btn-md btn-secondary pull-right">Change Password</button>
                        </div>
                        </div>
						
                  </div>
               </form>
			  <?php }} ?>
			   <?php 
			   if(isset($resetstatus))
			   { 
				if($resetstatus == 'resetstatus')
				{
			   ?>
               <form id="forgotForm"  method="post" >
                  <div class="row text-center forgot-con-lapsed">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <h4 class="text-left">Forgot Your Password?</h4>
                           <p class="text-left">Reset password time has been lapsed, Please enter your username to receive new link</p>
                        </div>
                        <div class="form-group">
                           <input class="form-control" placeholder="Enter Your Username" name="user[username]" type="text" autofocus autocomplete="off" value="">
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="form-group pull-left">
                           <p class="pull-left"> < <a href="javascript:void(0);" class="back-login">Back to Login</a></p>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="form-group">
                           <button type="submit" id="forgot-form" class="btn btn-md btn-secondary pull-right">Send</button>
                        </div>
                     </div>
                  </div>
               </form>
			   <?php } }?>
			  <?php 
			   if(!isset($resetstatus) && !isset($resetForm))
			   { 
			   ?>
               <form id="loginForm" class="form-horizontal" method="post" name="loginForm">
                  <div class="row text-center login-con">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <div class="input-group"> <span class="input-group-addon"> <i class="glyphicon glyphicon-user1"></i> </span>
                              <input class="form-control" maxlength="40" placeholder="Username" name="username" type="text" autofocus autocomplete="off" > 
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="input-group"> <span class="input-group-addon"> <i class="glyphicon glyphicon-lock1"></i> </span>
                              <input class="form-control" maxlength="25" placeholder="Password" name="password" type="password" value="">
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="form-group pull-left">
                           <p class="pull-left">Forgot Password? <a href="javascript:void(0);" class="forgot-pass">CLICK HERE</a></p>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="form-group">                           						   
							<button class="btn btn-blue pull-right" type="submit" id="login-form">
								<img border="0" class="uni_login" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Login
							</button>
                        </div>
                     </div>
                  </div>
               </form>
			    <?php } ?>
				
			   <form id="forgotForm"  method="post">
                  <div class="row text-center forgot-con">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <h4 class="text-left">Forgot Your Password?</h4>
                           <p class="text-left">In order to receive your password by email, please enter the username you provided during the registration process.</p>
                        </div>
                        <div class="form-group">
                           <input class="form-control" placeholder="Enter Your Username" name="user[username]" type="text" value="">
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="form-group pull-left">
                           <p class="pull-left"> < <a href="javascript:void(0);" class="back-login">Back to Login</a></p>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="form-group">                           
							<button class="btn btn-blue pull-right" type="submit" id="forgot-form">
								<img border="0" class="uni_send_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Send
							</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </section>
	  <?php
	  if(ENVIRONMENT!='production')
	  {
		if($this->session->userdata('benchmarkon'))
		echo $this->benchmark->elapsed_time('code_start', 'code_end'); 
	  }
	  ?>
      <footer>
        <?php $this->load->view('common/footer'); ?>
      </footer>
	  <script type="text/javascript">
		var base_url = '<?php echo site_url(); ?>';				
	  </script>	 
   </body>
</html>