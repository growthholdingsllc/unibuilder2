<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="UniBuilder Admin Panel" />
	<title><?php echo $title ?></title>	
	<link href="<?php echo IMAGESRC.'fav.ico'; ?>" rel="shortcut icon" />
	<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap.min.css';?>">
	<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-select.min.css';?>">	
	<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrapvalidator.min.css';?>">     
	<link rel="stylesheet" href="<?php echo CSSSRC.'style.css';?>">																	
	<link rel="stylesheet" href="<?php echo CSSSRC.'slider.css';?>">
	<link rel="stylesheet" href="<?php echo CSSSRC.'red.min.css'; ?>">
	<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.mCustomScrollbar.css';?>">
	<script type="text/javascript" src="<?php echo JSSRC.'ubsrc.js';?>"></script>
	<script type="text/javascript" src="<?php echo JSSRC.'jquery.min.js';?>"></script>
	<script type="text/javascript">
		var base_url = '<?php echo site_url(); ?>';		
		var image_url = '<?php echo IMAGESRC; ?>';		
		var ALLOWED_FILE_SIZE = '<?php echo ALLOWED_FILE_SIZE; ?>';
		var DEFAULT_THUMB_IMAGE_ARRAY = JSON.parse('<?php echo DEFAULT_THUMB_IMAGE_ARRAY; ?>');
		var BUILDERADMIN = '<?php echo BUILDERADMIN; ?>';	
		var OWNER = '<?php echo OWNER; ?>';	
		var SUBCONTRACTOR = '<?php echo SUBCONTRACTOR; ?>';	
		var project_status_check = '<?php echo $this->project_status_check; ?>';	
		var project_status = '<?php echo $this->project_status; ?>';	
	</script>	
	<script type="text/javascript" src="<?php echo JSSRC.'moment.js';?>"></script> 
</head>
<body class="template uni_wrapper loadingDiv">
<div class="uni_child_wrapper">
<!-- HEADER CONTENT -->
<header>            	
    <?php  $this->load->view($header); ?>	
</header>
<!-- HEADER CONTENT -->
<section>

<!-- MIDDLE CONTENT -->
<div class="container-fluid pad-all">	
	<?php $this->load->view($content); ?>	
</div>
<!-- MIDDLE CONTENT -->
</section>
<!-- FOOTER CONTENT -->
<footer>
	<?php $this->load->view($footer); ?>
</footer>
<!-- FOOTER CONTENT -->
<script src="<?php echo JSSRC.'jquery-ui.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'icheck.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'formValidation.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'formvalidation-bootstrap.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-select.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-slider.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.mCustomScrollbar.concat.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'custom.js';?>"></script>
<!--<script type="text/javascript">
	var base_url = '<?php echo site_url(); ?>';		
</script>
<div class="script"></div>-->
<!--<script type="text/javascript" src="<?php echo JSSRC.'ajax.js';?>"></script>-->
<?php
if(ENVIRONMENT!='production')
{
	if($this->session->userdata('benchmarkon'))
	{
		echo '<br><br>'.$this->benchmark->elapsed_time('code_start', 'code_end'); 
	}
}
?>
<div class="script"></div>
<div class="project_title_select">
<?php 
if($this->module != 'preferences' && $this->module != 'my404' && $this->module != 'user' && $this->module != 'projects')
{
	if(!empty($this->template_name))
	{
	?>
	<div class="pro_name"><span>Template Name :</span>
	<?php if(isset($this->template_name) && $this->template_name!='')
	{
	echo $this->template_name;
	}
	?>
	</div>
	<?php 
	}
}
?>
</div>
</div>
<!-- LEFT COLLAPSE CONTENT -->
<?php 
	if($this->module != 'leads' && $this->module != 'setup' && $this->module != 'subcontractor' && $this->module != 'BUILDERUSER' && $this->module != 'SUBUSERS' && $this->module != 'USERROLES' && $this->module != 'preferences' && $this->module != 'my404' && $this->module != 'user' && $this->module != 'docs' && $this->module != 'photos' && $this->user_account_type != OWNER)
	{
		if($left_collapse != '')
		{
			// echo '<pre>';print_r($this->parameters);exit;
			if(0 === $this->first_argument)
			{
				$this->load->view($left_collapse);
			}
		}
	}
?>	
<!-- LEFT COLLAPSE CONTENT -->
<div class="create_project_con">
	<div class="create_pro"><img alt="Logo" src="<?php echo IMAGESRC.'select_project.png'; ?>" border="0"/></div>
	<div class="create_project_text text-right">Please Select a Template<div class="text-center">(or)</div><div class="text-center"><a href="<?php echo base_url().$this->crypt->encrypt('template/projects/index/') ?>">Go To Template List</a></div></div>
</div>
<div class="modal fade confirmModal" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4 class="alert_modal_txt"></h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">              
              <div class="col-xs-12 text-center">                								 
				<button class="btn btn-blue" type="button" data-dismiss="modal" id="alert_ok"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_dick"/> OK</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
</body>
</html>