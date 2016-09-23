<a href="javascript:void(0);" data-target="<?php if(!empty($this->project_id)) echo '#Import_modal'; else echo '';?>" data-toggle="modal" ><button type="button" class="btn btn-blue  pull-right m-left-1" id="import_button" > <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="import" class="uni_import_template" /> Import</button></a>
 <form id="import_from_template" class="form-horizontal" method="post" name="import_from_template">
<div class="modal fade" id="Import_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Choose a template with this project information</h4>
      <div class="modal-body">
        <div class="row ">
          <div class="col-xs-12">
			<?php 
			if(isset($template_list))
			{
			?>
            <div class="modal-con col-xs-12">              
			  <div class="col-xs-3 m-top"><label>Select Template</label></div>
				<div class="col-xs-9">
					 <?php 
					 if(isset($template_list))
					 {
					   echo form_dropdown('template_id', $template_list, '', "class='selectpicker form-control' id='template_id' data-live-search='true'");
					 }
					 else					 
					 {
					 ?>
						<select class="selectpicker form-control">
						<option value="">Nothing selected</option>
						</select>
					 <?php	
					 }
					 ?>
				</div>
              <div class="row col-xs-12 m-top">                				
				<button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> CANCEL</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="button" id="import_template"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_import_template"/> Import</button>				
              </div>
            </div>
			<?php 
			}
			else
			{
			?>
			<div class="modal-con col-xs-12">              
				<div class="col-xs-9">
				 <h5>No template found for this Builder</h5>
				</div>
              <div class="row col-xs-12 m-top">                				
				<button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> CANCEL</button>  			
              </div>
            </div>
			<?php 
			}
			?>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
</form>
<script type="text/javascript">
this.project_id  = '<?php echo $this->project_id; ?>'; 
</script> 