<?php foreach($custom_field_array as $key=>$module_name) { ?>
<div class="row">
 <div class="col-xs-12">                     
	<div class="box-content panel-content">
		<div class="row">
			<div class="col-xs-12">
				<!-- <input type="text" name="type" id="type" value="">
				<input type="text" name="value" id="value" value=""> -->
				<div><label><?php echo $module_name['type'] ?></label></div>
				<a href="javascript:void(0);" id="<?php echo $module_name['value'].','.$module_name['type'] ?>" onclick="open_field_modal(this.id)"><button class="btn btn-blue" type="button"><img class="uni_new" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New" /> New</button></a>
			</div>
		</div>
		 <table width="100%" class="table table-bordered">
			<thead>
				<tr>
					<th>Field Label</th>
					<th>Field Type</th>
					<th>Display Order</th>
					<th>Is Required</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			  <?php 
			  	if (is_array($custom_list) || is_object($custom_list))
				{
			  foreach($custom_list as $key=>$custom_list_details) { 
			  	if($custom_list_details['module_name'] == $module_name['type']){
			  	?>
			  	<tr>
					<td><a href="javascript:void(0);" id="<?php echo $custom_list_details['ub_custom_field_id'] ?>" onclick="edit_custom_field(id)"><?php echo $custom_list_details['label_name'] ?></a></td>
					<td><?php echo $custom_list_details['data_type'] ?></td>
					<td><?php echo $custom_list_details['display_order'] ?></td>
					<td><?php echo $custom_list_details['mandatory'] ?></td>
					<td><a href="javascript:void(0);" id="<?php echo $custom_list_details['ub_custom_field_id'] ?>" onclick="delete_custom_field(id)"><img class="uni_delete" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Delete" /></a></td>
				</tr>

			  <?php } }}else{?>
			    <tr>
			    	
			    	<td colspan="5" class="text-center">No Records Found</td>
			    	
					
				</tr>
			  <?php } ?>	                        
				<!-- <tr>
					<td>Custom Field 1</td>
					<td>Dropdown</td>
					<td>0</td>
					<td>Yes</td>
					<td><a href="javascript:void(0);"><img class="uni_delete" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Delete" /></a></td>
				</tr>
				<tr>
					<td>Custom Field 2</td>
					<td>Dropdown</td>
					<td>1</td>
					<td>No</td>
					<td><a href="javascript:void(0);"><img class="uni_delete" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Delete" /></a></td>
				</tr> -->							
			</tbody>
		 </table>
	 </div>
   </div>
 </div>
 <?php } ?>