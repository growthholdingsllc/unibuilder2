<?php
/*echo $ub_user_id;
echo $username;*/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="UniBuilder Admin Panel" />
<title>Unibuilder | Signup</title>
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap.min.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrapvalidator.min.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'login.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'jquery.min.js'?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap.min.js'?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'formValidation.min.js'?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'formvalidation-bootstrap.min.js'?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ubsrc.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'signup_validator.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'signup.js';?>"></script>
<script type="text/javascript">
    var base_url = '<?php echo site_url(); ?>'; 
</script>
<style>
.alert-danger {    
    padding: 8px 5px !important;
}
.alert-success {    
    padding: 8px 5px !important;
}
</style>
</head>
<body class="uni_wrapper">
<header></header>
<section>
  <div class="login-container">
    <div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo IMAGESRC.'login-logo.png';?>"/></a></div>
    <div class="login-form accept-signup">
      <form id="signup_form" class="form-horizontal" method="post" name="signup_form">
        <div class="row text-center">
          <div class="col-sm-12">
            <p class="text-center sign-up"><strong>Please input password</strong></p>
          </div>
        </div>
		<div class="row">
			<div class="col-xs-12">
				<div class="col-xs-8 error-message">
				<div class="alerts alert-danger" role="alert"></div>
			</div>
			</div>
		</div>
			   <br>
             
        <input class="form-control" type="hidden" name="ub_user_id" value="<?php if(isset($ub_user_id)) echo $ub_user_id;?>" id="ub_user_id">
        <input class="form-control" type="hidden" name="system_provided_user_name" value="<?php if(isset($username)) echo $username;?>" id="system_provided_user_name">

        <div class="row text-center login-con signup-con">
          <div class="col-sm-12">
            <div class="form-group">
              <div class="input-group"> <span class="input-group-addon"> <i class="glyphicon glyphicon-user1"></i> </span>
                <input class="form-control" placeholder="Username" name="userName" type="text" autofocus autocomplete="off" id="username" <?php if(isset($username) && !empty($username))  {echo'value="'.$username.'"'; echo 'readonly';}?>>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group"> <span class="input-group-addon"> <i class="glyphicon glyphicon-lock1"></i> </span>
                <input class="form-control" placeholder="Password" name="password" type="password" id="password" value="">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group"> <span class="input-group-addon"> <i class="glyphicon glyphicon-lock1"></i> </span>
                <input class="form-control" placeholder="Confirm Password" name="confirm_password" type="password" id="cpassword" value="">
              </div>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <button type="submit" id="loginForm" class="btn btn-blue">Signup</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<footer>
  <?php $this->load->view('common/footer'); ?>
</footer>
</body>
</html>