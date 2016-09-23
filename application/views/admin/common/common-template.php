<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="signin no-js" lang="">
<head>
<!-- meta -->
<meta charset="utf-8">
<meta name="description" content="Flat, Clean, Responsive, application admin template built with bootstrap 3">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<!-- /meta -->

<title>Unibuilder - Web Application Admin</title>

<!-- core styles -->
<link rel="stylesheet" href="<?php echo ACJI.'styles/bootstrap/css/bootstrap.min.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrapvalidator.min.css';?>"> 
<link rel="stylesheet" href="<?php echo ACJI.'styles/css/font-awesome.css';?>">
<link rel="stylesheet" href="<?php echo ACJI.'styles/css/themify-icons.css';?>">
<link rel="stylesheet" href="<?php echo ACJI.'styles/css/animate.min.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'red.min.css'; ?>">
<!-- /core styles -->

<!-- template styles -->
<link rel="stylesheet" href="<?php echo ACJI.'styles/css/skins/palette.css';?>">
<link rel="stylesheet" href="<?php echo ACJI.'styles/css/fonts/font.css';?>">
<link rel="stylesheet" href="<?php echo ACJI.'styles/css/main.css';?>">
<!-- template styles -->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- load modernizer -->
<script src="<?php echo ACJI.'scripts/plugins/modernizr.js';?>"></script>
<!-- core scripts -->
<script src="<?php echo ACJI.'scripts/plugins/jquery-1.11.1.min.js';?>"></script>
<script src="<?php echo ACJI.'styles/bootstrap/js/bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ubsrc.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'icheck.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'formValidation.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'formvalidation-bootstrap.min.js';?>"></script>
<!-- /core scripts -->
<script type="text/javascript">
		var base_url = '<?php echo site_url(); ?>';		
		var image_url = '<?php echo IMAGESRC; ?>';		
	</script>
</head>
<body class="uni_wrapper loadingDiv">
<div class="app horizontal-layout">
  <?php $this->load->view('admin/common/header'); ?>
  <section class="layout"> 
    <!-- main content -->
    <section class="main-content"> 
      <!-- content wrapper -->
      <div class="content-wrap">
        <?php $this->load->view($content); ?>
      </div>
      <!-- /content wrapper --> 
    </section>
    <!-- /main content --> 
  </section>
</div>
<!-- core scripts --> 
<script src="<?php echo ACJI.'scripts/plugins/jquery.slimscroll.min.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/plugins/jquery.easing.min.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/plugins/appear/jquery.appear.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/plugins/jquery.placeholder.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/plugins/fastclick.js';?>"></script> 
<!-- /core scripts --> 

<!-- template scripts --> 
<script src="<?php echo ACJI.'scripts/js/offscreen.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/js/main.js';?>"></script> 
<!-- /template scripts -->

</body>
</html>