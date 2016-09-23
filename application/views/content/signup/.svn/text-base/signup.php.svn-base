<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="UniBuilder Admin Panel" />
<title>Unibuilder | Signup</title>
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap.min.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'login.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'ubsrc.js';?>"></script>      
<script type="text/javascript" src="<?php echo JSSRC.'jquery.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'signup.js';?>"></script>
<script type="text/javascript">
    var base_url = '<?php echo site_url(); ?>'; 
</script>
</head>
<body>
<header></header>
<section>
  <div class="login-container">
    <div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo IMAGESRC.'login-logo.png';?>"/></a></div>
    <form id="signup" class="form-horizontal" method="post" name="signup">
    <div class="login-form">
      <div class="row text-center forgot-con">
        <div class="col-sm-12">
          <div class="form-group">
            <h4 class="text-center">You're Invited!</h4>
            <p class="text-center"><strong><?php if(isset($builder_name)) echo $builder_name;?> Constructions have invited you to join UNIBUILDER.</strong></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 text-center">
          <input class="form-control" type="hidden" name="ub_user_id" value="<?php if(isset($ub_user_id)) echo $ub_user_id;?>" id="ub_user_id">
          <button class="btn btn-blue" type="submit" id="accept">Accept</button>
          <button class="btn btn-gray" type="submit" id="decline">Decline</button>
        </div>
        <!-- <div class="col-sm-12 text-center"> <a href="<?php echo base_url(); ?>c2lnbnVwL2FjY2VwdF9pbnZpdgxf1Uv" class="btn btn-md btn-secondary">Accept</a> <a href="<?php echo base_url(); ?>c2lnbnVwL3JlamVjdF9pbnZpdgxf1Uv" class="btn btn-md btn-secondary">Decline</a> </div> -->
      </div>
    </div>
  </form>
  </div>
</section>
<footer>
  <?php $this->load->view('common/footer'); ?>
</footer>
</body>
</html>