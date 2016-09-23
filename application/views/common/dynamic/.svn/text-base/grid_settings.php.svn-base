<?php
$grid_saved_view_selected = (isset($grid_settings_popup['grid_saved_view_selected']))?$grid_settings_popup['grid_saved_view_selected']:'';
$grid_saved_view_default = (isset($grid_settings_popup['grid_saved_view_default']))?$grid_settings_popup['grid_saved_view_default']:'';
$grid_saved_views_dropdown = (isset($grid_settings_popup['grid_saved_views_dropdown']))?$grid_settings_popup['grid_saved_views_dropdown']:array();
$grid_settings_column_selected = (isset($grid_settings_popup['grid_current_view_dropdown_selected']))?$grid_settings_popup['grid_current_view_dropdown_selected']:'';
$grid_current_view_dropdown = (isset($grid_settings_popup['grid_current_view_dropdown']))?$grid_settings_popup['grid_current_view_dropdown']:'';
$grid_current_view_name = (isset($grid_settings_popup['grid_current_view_name']))?$grid_settings_popup['grid_current_view_name']:'';
$system_grid_setting_fields = (isset($grid_settings_popup['system_grid_setting_fields']))?$grid_settings_popup['system_grid_setting_fields']:'';
$current_view_data =  (isset($grid_settings_popup['grid_current_view_data']))?$grid_settings_popup['grid_current_view_data']:'';
$grid_view_is_default = (isset($grid_settings_popup['is_default']))?$grid_settings_popup['is_default']:'';
?>
<h4>Grid Settings <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
<div class="modal-body" >
<div class="row grid_settings">
   <div class="col-xs-12">
	  <div class="modal-con">
		 <div class="row">
			<div class="col-xs-12">
			   <table width="100%" class="border-none">
				  <tr>
					<td height="30" colspan="2">
					<div class="col-xs-12 error-message uni_message">
						<div class="alerts alert-danger"></div>
					</div>
					</td>
				  </tr>
			   </table>
			</div>
		 </div>
	  </div>
   </div>
</div>
<div class="row">
   <div class="col-xs-12">
	  <div class="modal-con">
		 <div class="row">
			<div class="col-xs-12">
			   <table width="100%" class="border-none">
				  <tr>
					 <td height="30">Saved Views</td>
					 <td>
					 <?php
						$grid_saved_view_selected ='';
						if(isset($grid_saved_view_default) && '' != $grid_saved_view_default)
						{
							$grid_saved_view_selected = $grid_saved_view_default;
						}
						echo form_dropdown('grid_saved_view', $grid_saved_views_dropdown, $grid_saved_view_selected, "class='selectpicker form-control' id='grid_saved_view'"); 
					   ?>								   
					 </td>
				  </tr>
			   </table>
			</div>
		 </div>
	  </div>
   </div>
</div>
<div class="row m-top">
   <div class="col-xs-12">
	  <div class="modal-con">
		 <div class="row">
			<div class="col-xs-12">
			   <h4>Current View</h4>
			   <table width="100%" class="table border-none">
				  <tr>
					 <td height="30" width="100">Column</td>
					 <td width="400">
					   <?php
							echo form_dropdown('grid_settings_columns', $grid_current_view_dropdown, $grid_settings_column_selected, "class='selectpicker form-control grid_settings_columns' id='grid_settings_columns' multiple"); 
					   ?>
					 </td>
				  </tr>
				  <tr>
					 <td height="30">View Name</td>
					 <td>
						<input name="list_view_name" id="list_view_name" maxlength="128" type='text' class="form-control" value="<?php if(isset($grid_current_view_name) && '' != $grid_current_view_name){echo $grid_current_view_name;}?>" />
					 </td>
				  </tr>
				  <tr>
					 <td>Is Default</td>
					 <td><input <?php if(isset($grid_view_is_default) && 'Yes' == $grid_view_is_default){ echo 'CHECKED';}?> id="is_default" name="is_default" type="checkbox" /> </td>
				  </tr>
				  <tr>
					 <td class="text-center" colspan="2">
					 <button id="apply_grid_view" class="btn btn-gray" type="button">APPLY VIEW</button> 
					 <button id="save_grid_view" class="btn btn-gray" type="button">SAVE AS VIEW</button> 
					 <button id="update_grid_view" class="btn btn-gray" type="button">UPDATE SELECTED</button></td>
				  </tr>
			   </table>
			   <input type="hidden" name="current_view_grid_settings_id" id="current_view_grid_settings_id" value="<?php if(isset($grid_saved_view_default) && '' != $grid_saved_view_default){echo $grid_saved_view_default;}?>"/>
			  

			</div>
		 </div>
	  </div>
   </div>
</div>
</div>

<script type="text/javascript"> 
var disable_column = <?php if(isset($system_grid_setting_fields)){ echo json_encode($system_grid_setting_fields);} ?>; 

for (var key in disable_column) {
  if (disable_column.hasOwnProperty(key)) {
    var val = disable_column[key];
    //console.log(val);
	$("#grid_settings_columns option[value='" + key + "']").prop('disabled', true); 
  }
}
this.current_view_data = <?php if(isset($current_view_data)){ echo json_encode($current_view_data);} ?>; 

$(function() {
    //$('.selectpicker').selectpicker('refresh');
	var is_selected_saved_view = $('#grid_saved_view').find(":selected").text();
	if(is_selected_saved_view == 'Nothing selected'){
		$('.selectpicker').selectpicker('refresh');
		$('#grid_settings_columns option:selected').each(function(){
			$("#grid_settings_columns option[value='" + this.value + "']").prop("selected", false);
		});	
		$('.selectpicker').selectpicker('refresh');
		$('#current_view_grid_settings_id').val('');
		$('#is_default').parent('.icheckbox_square-red').removeClass('checked'); // Unchecks it
		$('#is_default').attr('checked', false); // Unchecks it
		$('#list_view_name').val('');
	} 
}); 

</script>