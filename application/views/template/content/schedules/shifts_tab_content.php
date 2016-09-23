<div class="row">
 <div class="col-xs-12">
	<h5><label>Baseline</label></h5>
 </div>
 <div class="col-xs-12">
	<p>Not Set (see button on calandar page)</p>
 </div>
</div>
<div class="row m-top">
 <div class="col-xs-12">
	<table class="table table-bordered">
		<thead>
			<tr>
				<td></td>
				<td>Start Date</td>
				<td>End Date</td>
				<td>Duration</td>
				<td>Total Variance</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Baseline</td>
				<td><?php echo isset($schedule_details['base_start_date'])?$schedule_details['base_start_date']:'';?></td>
				<td><?php echo isset($schedule_details['base_end_date']) ?$schedule_details['base_end_date']:'';?></td>
				<td><?php echo isset($schedule_details['base_no_of_days']) ?$schedule_details['base_no_of_days']:'';?> days</td>
				<?php 
				$total_variance = '';
				$base_no_of_days = (isset($schedule_details['base_no_of_days']) && $schedule_details['base_no_of_days'] != '')?$schedule_details['base_no_of_days']:'not_set';
				$no_of_days = (isset($schedule_details['no_of_days']) && $schedule_details['no_of_days'] != '')?$schedule_details['no_of_days']:'not_set';
				if($base_no_of_days != '' && $no_of_days != '')
				{
					$total_variance = $no_of_days - $base_no_of_days;
				}
				
				?>
				<td rowspan="2"><?php echo $total_variance;?> days</td>
			</tr>
			<tr>
				<td>Current</td>
				<td><?php echo isset($schedule_details['start_date'])?$schedule_details['start_date']:'';?></td>
				<td><?php echo isset($schedule_details['end_date']) ?$schedule_details['end_date']:'';?></td>
				<td><?php echo isset($schedule_details['no_of_days']) ?$schedule_details['no_of_days']:'';?> days</td>				
			</tr>
		</tbody>
	</table>
 </div>
</div>
<div class="row m-top">
 <div class="col-xs-12">
	<h5><label>Shift History</label></h5>
 </div>
 <div class="row col-xs-12">                        
	 <div class="col-xs-3">                        
		<select class="form-control selectpicker" name="shift_type" id="shift_type">
			<option selected value="all">All</option>
			<option value="direct">Direct</option>
			<option value="indirect">Indirect</option>
		</select>
	 </div>
 </div>
 <div class="col-xs-12">
	<table class="table table-bordered datatable" id="shifts_list">
	</table>
 </div>
</div>
