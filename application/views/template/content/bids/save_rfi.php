<h5>REQUEST FOR INFORMATION</h5>
<div class="box-content panel-content">
<div class="row">
	<!--checking role access // by satheesh kumar -->
	<?php
	if(isset($this->user_role_access[strtolower('bids')][strtolower('add')]) && $this->user_role_access[strtolower('bids')][strtolower('add')] == 1)
	{ 
	?>
  <div class="col-xs-12">
	<p><a href="#" data-target="#addrfi" data-toggle="modal" class="sprite" id="add_rfi_modal"> <img border="0" src="<?php echo IMAGESRC . 'strip.gif'; ?>" class="uni_new">&nbsp;Add RFI</a></p>
  </div>
  <?php 
  }
  ?>
</div>
<div class="row">
 
  <div class="col-xs-12 text-left" id="search_counter">
	
  </div>
  <div class="col-xs-12 text-left" id="rfi_comment_area">
    
	<div class="jumbotron scroll-pane-bids" id="innear_rfi_div">
	  <div class="inner-jumbotron" id="search">
     
	  </div>
	</div>

  </div>
  
</div>
</div>

