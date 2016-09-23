<div class="col-xs-12">
<?php if(isset($this->user_account_type) && $this->user_account_type == OWNER) { ?>

<?php } else { ?>
<div class="row datatable-bor">
   <div class="add-function">
		<?php 
		if(isset($this->user_role_access[strtolower('budget')][strtolower('export excel')]) && $this->user_role_access[strtolower('budget')][strtolower('export excel')] == 1)
		{
		?>
		<div class="col-xs-3 pull-right"><a href="javascript:void(0);"><img id="export_file_payapp" class="uni_excel" name="export_file" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a></div>
		<?php 
		}
		?>
   </div>
</div>
	<?php } ?>
	
<table class="table table-bordered datatable" id="budget_pay_app_list">		
<thead>
	<tr>
	   <th>Pay App#</th>
	   <th>Pay App Name</th>
	   <th>Period To</th>
	   <th>Status</th>
	   <th>Certificate</th>
	</tr>
</thead>	
</table>
</div>
