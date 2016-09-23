<?php 
$button_name = '';
$button_text = '';
if(isset($result_data['status']) && $result_data['status'] == 'Draft'){
	$button_name = 'Release';
	$button_text = 'Release';
}
else if(isset($result_data['status']) && $result_data['status'] == 'Released')
{
	$button_name = 'Pay';
	$button_text = 'Funded';
}
if($button_name!='')
{
	if(isset($this->user_account_type) && $this->user_account_type != OWNER) 
	{
	if(isset($this->project_status) && $this->project_status != 'Closed' && $this->project_status != 'Disabled')
	{
?>
	<button class="sprite" id="btn_payapp_status" value="<?php echo $button_name;?>"><?php echo $button_text;?></button>
<?php 
	}
	}
} 

?>	
<span class="status_payapp"><strong>Status:</strong><?php echo (isset($result_data['status']) && $result_data['status'] !='')?$result_data['status']:'No Status';?> 
</span>
<input type="hidden" name="hide_payapp_status" id="hide_payapp_status" value="<?php echo (isset($result_data['status']) && $result_data['status'] !='')?$result_data['status']:'No Status';?>"/>

