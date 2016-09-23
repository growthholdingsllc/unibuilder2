<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="description" content="UniBuilder Admin Panel" />
      <title>Unibuilder | Registration</title>
      <link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap.min.css';?>">      
      <link rel="stylesheet" href="<?php echo CSSSRC.'register_success.css';?>">  
      <link rel="stylesheet" href="http://cdn.jsdelivr.net/fontawesome/4.2.0/css/font-awesome.min.css">    
           
   </head>
   <body class="uni_wrapper">
	  <div class="container-fluid">	
      	 <div class="row">
			<div class="col-xs-12">
				<a href="http://www.unibuilder.com/"> <img class="logo" src="<?php echo IMAGESRC.'register_uni-logo-new.jpg'; ?>" /></a>
			</div>
			<div class="divider">&nbsp;</div>
		 </div>
		  <div class="row">
		  <div class="form-register">
		<div class="row m-top">
			<div class="col-xs-12 error-message uni_message">
				<div class="alerts alert-danger"></div>
			</div>
		</div>
		 <div class="col-xs-12 m-top">
			<form class="form-horizontal" id="form_registration1" name="form_registration1" method="post">
			   <div class="form-group" >
				 Congratulations and Welcome Aboard! You have successfully created your UniBuilder account. We have sent you a URL and you can create your secure password by clicking it. Our Support team would love to help you if you have any queries or require guidance.
				 <div class="col-xs-12 text-center m-top">
					<a href="http://www.unibuilder.com/"><button type="button" class="btn btn-blue">Back to Home</button></a>
					<button type="button" value= "<?php if(isset($user_id)) echo $user_id;?>" onclick="resend_activation_link(this.value)" class="btn btn-blue">Resend activation link</button>
				</div>
			   </div>                  
			</form>
		 </div>
		</div>
		</div>
	   <div class="row">
	  <footer class="footer">
         <p class="text-center"><a href="#">www.unibuilder.com</a></p>
      </footer>
	  </div>
	  </div>
	  <script type="text/javascript" src="<?php echo JSSRC.'ubsrc.js';?>"></script>      
	  <script type="text/javascript" src="<?php echo JSSRC.'jquery.min.js';?>"></script>	  
	  <script type="text/javascript">
    var base_url = '<?php echo site_url(); ?>'; 
	function resend_activation_link(userid)
	{
		var userid = userid;
		var encoded_string = Base64.encode('register/resend_email_invitation/');
		var encoded_val = encoded_string.strtr(encode_chars_obj);
		$.ajax({
			url: base_url + encoded_val,
			dataType: "json",
			type: "post",
			data:'userid='+userid,
			beforeSend: function() {
			  $('.uni_wrapper').addClass('loadingDiv');			  
			},			
			success: function(response) { 
				$('.uni_wrapper').removeClass('loadingDiv');
				if(response.status == true)
				{					
					$('.error-message').show();
					$('.error-message .alerts').removeClass('alert-danger');
					$('.error-message .alerts').addClass('alert-success');
					$('.error-message .alerts').text('Activation link sent successfully');
				}
				
			}
		 }); 
			
	}
</script>
   </body>
</html>
