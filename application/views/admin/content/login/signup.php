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
<link rel="stylesheet" href="<?php echo ACJI.'styles/css/font-awesome.css';?>">
<link rel="stylesheet" href="<?php echo ACJI.'styles/css/themify-icons.css';?>">
<link rel="stylesheet" href="<?php echo ACJI.'styles/css/animate.min.css';?>">
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
</head>
<body class="bg-info">
<div class="center-wrapper">
  <div class="center-content">
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <section class="panel bg-white no-b">
          <ul class="switcher-dash-action">
            <li><a href="<?php echo base_url(); ?>YWRtaW4vbgxf19naW4vaW5kZXgv" class="selected">Sign in</a></li>
            <li class="active"><a href="javascript:void(0);" class="">New account</a></li>
          </ul>
          <div class="p15">
            <form role="form" action="<?php echo base_url(); ?>YWRtaW4vbgxf19naW4vaW5kZXgv">
              <input type="text" class="form-control input-lg mb25" placeholder="Choose a username" autofocus>
              <input type="text" class="form-control input-lg mb25" placeholder="Email address">
              <input type="password" class="form-control input-lg mb25" placeholder="Password">
              <input type="password" class="form-control input-lg mb25" placeholder="Confirm password">
              <div class="show">
                <label class="checkbox">
                  <input type="checkbox" value="remember-me">
                  I accept <a href="javascript:;">Sublime's</a>terms and conditions </label>
              </div>
              <button class="btn btn-primary btn-lg btn-block" type="submit">Sign up</button>
            </form>
          </div>
        </section>
        <p class="text-center"> Copyright &copy; <span id="year" class="mr5"></span> <span>UNIBUILDER LLC</span> </p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	var el = document.getElementById("year"),
	year = (new Date().getFullYear());
	el.innerHTML = year;
</script>
</body>
</html>