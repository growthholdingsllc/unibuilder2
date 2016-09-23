<div class="row five-col">
<?php 	//echo "<pre>";print_r($custom_field_data); 
		//echo "<pre>";print_r($custom_field_value); 
		
	if (isset($custom_field_data) && !empty($custom_field_data)) 
	{ 
		if (isset($custom_field_value) && !empty($custom_field_value)) 
		{
			foreach ($custom_field_value as $key => $custom_value) 
			{
				$custom_value_data[$custom_value['custom_field_id']] = $custom_value['field_data'];
			}
		}
		//echo "<pre>";print_r($custom_value_data);exit;
	foreach ($custom_field_data as $custom_data) 
	{ 
		$name_id = isset($custom_data['ub_custom_field_id'])?$this->module."_".$custom_data['ub_custom_field_id']:'';
		switch ($custom_data['data_type']) 
		{
			case MULTI_SELECT_DROP_DOWN: 
				{ 
					$UB =& get_instance();	
    				$dropdown_data = $UB->format_drop_down_values($custom_data['field_values']) ;
					?>
					<div class="col-xs-3">
                    	<label><?php echo $custom_data['label_name']; ?></label>
                     	<?php 
	                        $multi_select_drop_down = '';
	                        if(isset($custom_value_data[$custom_data['ub_custom_field_id']]) && $custom_value_data[$custom_data['ub_custom_field_id']] != '')
	                        {
	                          $multi_select_drop_down = explode(",",$custom_value_data[$custom_data['ub_custom_field_id']]);
	                        }
	                        echo form_dropdown($name_id."[]", $dropdown_data,$multi_select_drop_down, "class='selectpicker form-control' id='".$name_id."' data-live-search='true'  multiple"); 
                        ?>
                  	</div>
				<?php	break;
				}
			case SINGLE_SELECT_DROP_DOWN:
				{ 
					$UB =& get_instance();	
    				$dropdown_data = $UB->format_drop_down_values($custom_data['field_values']) ;
					?>
					<div class="col-xs-3">
                    	<label><?php echo $custom_data['label_name']; ?></label>
                     	<?php 
	                        $single_select_drop_down = '';
	                        if(isset($custom_value_data[$custom_data['ub_custom_field_id']]) && $custom_value_data[$custom_data['ub_custom_field_id']] != '')
	                        {
	                          $single_select_drop_down = explode(",",$custom_value_data[$custom_data['ub_custom_field_id']]);
	                        }
	                        echo form_dropdown($name_id, $dropdown_data,$single_select_drop_down, "class='selectpicker form-control' id=".$name_id." data-live-search='true'"); 
                        ?>
                  	</div>
				<?php	break;
				}
			case CURRENY: 
				$from_to_userid = "from_user_id";
				$userid = "from_user_id";
				$message_date = "MESSAGE.sent_on AS message_date";
				$date_range_field = "MESSAGE.sent_on";
				break;
			case DATE_PICKER: 
				{ ?>
					<div class="col-xs-3">
					  <label><?php echo $custom_data['label_name']; ?></label>
				    	<div class='input-group date custom_datetimepicker'>
		                    <input type='text' name="<?php echo $name_id;?>" id="<?php echo $name_id;?>" class="form-control" value="<?php if(isset($custom_value_data[$custom_data['ub_custom_field_id']]) && $custom_value_data[$custom_data['ub_custom_field_id']]!='0000-00-00') echo date("m/d/Y", strtotime($custom_value_data[$custom_data['ub_custom_field_id']]));?>"/>
		                    <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                  		</div>
					</div>
				<?php 	break;	
				}
			case LIST_OF_BU_SUB_OWNER: 
				{ ?>
					<div class="col-xs-3">
						<label><?php echo $custom_data['label_name']; ?></label>
						<?php 
							if(!empty($get_all_users))
							{
							 $users_selected = '';
							 $single_select_drop_down = '';
	                        if(isset($custom_value_data[$custom_data['ub_custom_field_id']]) && $custom_value_data[$custom_data['ub_custom_field_id']] != '')
	                        {
	                          $users_selected = explode(",",$custom_value_data[$custom_data['ub_custom_field_id']]);
	                        }
							echo form_dropdown($name_id."[]", $get_all_users, $users_selected, "class='selectpicker form-control' id='".$name_id."' data-live-search='true' multiple"); 
							}else
							{
							echo form_dropdown($name_id."[]", array(), '', "class='selectpicker form-control' id='".$name_id."' data-live-search='true' multiple");
							}						   
						?>
					</div>
				
				<?php 	break;	
				}
			case LIST_OF_SUB: 
				{ ?>
					<div class="col-xs-3">
						<label><?php echo $custom_data['label_name']; ?></label>
						<?php 
							if(!empty($get_all_sub_users))
							{
							 $users_selected = '';
							 if(isset($custom_value_data[$custom_data['ub_custom_field_id']]) && $custom_value_data[$custom_data['ub_custom_field_id']] != '')
	                        {
	                          $users_selected = explode(",",$custom_value_data[$custom_data['ub_custom_field_id']]);
	                        }
							echo form_dropdown($name_id."[]", $get_all_sub_users, $users_selected, "class='selectpicker form-control' id='".$name_id."' data-live-search='true' multiple"); 
							}else
							{
							echo form_dropdown($name_id."[]", array(), '', "class='selectpicker form-control' id='".$name_id."' data-live-search='true' multiple");
							}						   
						?>
					</div>
				
				<?php 	break;	
				}
			case LIST_OF_BU: 
				{ ?>
					<div class="col-xs-3">
						<label><?php echo $custom_data['label_name']; ?></label>
						<?php 
							if(!empty($get_all_bu_users))
							{
							 $users_selected = '';
							 if(isset($custom_value_data[$custom_data['ub_custom_field_id']]) && $custom_value_data[$custom_data['ub_custom_field_id']] != '')
	                        {
	                          $users_selected = explode(",",$custom_value_data[$custom_data['ub_custom_field_id']]);
	                        }
							echo form_dropdown($name_id."[]", $get_all_bu_users, $users_selected, "class='selectpicker form-control' id='".$name_id."' data-live-search='true' multiple"); 
							}else
							{
							echo form_dropdown($name_id."[]", array(), '', "class='selectpicker form-control' id='".$name_id."' data-live-search='true' multiple");
							}						   
						?>
					</div>
				
				<?php 	break;	
				}
			case WHOLE_NUMBER: 
				{ ?>
					<div class="col-xs-3">
					  <label><?php echo $custom_data['label_name']; ?></label>
					  <div class="col-xs-12">
					     <div class="val-man col-xs-12">
					        <div class="form-group name-field">
					        	<input type="number" class="form-control" value="<?php echo isset($custom_value_data[$custom_data['ub_custom_field_id']])?$custom_value_data[$custom_data['ub_custom_field_id']]:'' ?>" id="<?php echo $name_id;?>" name="<?php echo $name_id;?>" onkeypress="return isNumber(event)" />
					        </div>
					     </div>
					  </div>
					</div>
				<?php	break;
				}
			case CHECKBOX:
				{ ?>
					<div class="col-xs-3">
					  <label><?php echo $custom_data['label_name']; ?></label>
					  <div class="col-xs-12">
					     <div class="val-man col-xs-12">
					        <div class="form-group name-field">
					        	 <input type="checkbox" name="<?php echo $name_id;?>" id="<?php echo $name_id;?>" value="<?php if(isset($custom_value_data[$custom_data['ub_custom_field_id']])){ echo $custom_value_data[$custom_data['ub_custom_field_id']]; } else { echo "No";} ?>"  class="checkbox_is_checked" /> 
					        </div>
					     </div>
					  </div>
					</div>
				<?php 	break;	
				}
			case TEXTAREA: 
				{ ?>
					<div class="col-xs-3">
					  <label><?php echo $custom_data['label_name']; ?></label>
					  <div class="col-xs-12">
					     <div class="val-man col-xs-12">
					        <div class="form-group name-field">
					          <textarea class="form-control" name="<?php echo $name_id;?>" id="<?php echo $name_id;?>"><?php echo isset($custom_value_data[$custom_data['ub_custom_field_id']])?$custom_value_data[$custom_data['ub_custom_field_id']]:'' ?></textarea>
					        </div>
					     </div>
					  </div>
					</div>
				<?php	break;
				}
			case TEXTBOX:
				{ ?>
					<div class="col-xs-3">
					  <label><?php echo $custom_data['label_name']; ?></label>
					  <div class="col-xs-12">
					     <div class="val-man col-xs-12">
					        <div class="form-group name-field">
					           <input type="text" name="<?php echo $name_id;?>" id="<?php echo $name_id;?>" class="form-control" value="<?php echo isset($custom_value_data[$custom_data['ub_custom_field_id']])?$custom_value_data[$custom_data['ub_custom_field_id']]:'' ?>">
					        </div>
					     </div>
					  </div>
					</div>
				<?php	break;
				}
		}
	}
	}
	else
	{
		echo '<p>No My Fields. To create one, go to the My Fields tab in the setup area.</p>';
	}
?>
</div>
<script type="text/javascript" src="<?php echo JSSRC.'save_custom.js';?>"></script>