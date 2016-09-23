<div class="row m-top">
	<div class="col-xs-12">
	   <table class="table table-bordered" id="po_vocher_payment_lists">
						 <thead>
		<tr>
		  <th>Cost Code</th>
		  <th>Original</th>
		  <th>Paid</th>
		  <th>Out Standing</th>
		  <th class="request_amount_header">Request Amount</th>
		  <?php if($this->user_account_type == BUILDERADMIN){ ?>
		  <th>Enter Amount</th>
		  <?php } ?>
		</tr>
	   </thead>
	   <tbody>
		<?php if(isset($payment_data) && !empty($payment_data)){?>
		<?php foreach ($payment_data as $key => $value) {?>
		  <tr>
			<td>
			  <input type="hidden" name="po_co_cost_code_id[]" value="<?php echo $value['ub_po_co_cost_code_id'] ?>">
			  <input type="hidden" class="form-control" value="<?php echo $value['cost_code_id'] ?>" name="po_co_item_id[]" /><?php echo $value['cost_code'] ?></td>
			<td><input type="hidden" class="form-control" value="<?php echo $value['original'] ?>" name="original[]" /><?php echo $value['original'] ?></td>
			<td><input type="hidden" class="form-control pay" value="<?php echo $value['paid_amount'] ?>" name="total_paid_amount[]" />

				<input type="hidden" class="form-control payment_paid" value="<?php echo isset($value['total_paid_amount'])?$value['total_paid_amount']:$value['paid_amount'] ?>" name="payment_paid_amount[]" />

				<?php if(isset($value['total_paid_amount'])){$total_paid_amount = $value['total_paid_amount'];}else{$total_paid_amount = $value['paid_amount'];} echo $total_paid_amount ?></td>
			<td><input type="hidden" class="form-control out" value="<?php echo $value['out_standing'] ?>" name="out_standing[]" />

				<input type="hidden" class="form-control total_outstading" value="<?php echo isset($value['total_out_standing'])?$value['total_out_standing']:$value['out_standing'] ?>" name="total_out_standing[]" />

				<?php  if(isset($value['total_out_standing'])){$total_out_standing = $value['total_out_standing'];}else{$total_out_standing = $value['out_standing'];} echo $total_out_standing?></td>
			
			 <td class='request_amount'>
				<div class="col-xs-12">
					<div class="form-group">

						<input type="hidden" class="form-control" name="ub_po_co_payment_request_details_id[]" id="ub_po_co_payment_request_details_id" value="<?php echo (isset($value['ub_po_co_payment_request_details_id'])?$value['ub_po_co_payment_request_details_id']:'')?>" />

						<?php if(!isset($value['requested_amount'])){ 
							if($value['out_standing'] > 0.00) {?>
						<input type="text" class="form-control requested_amount" name="requested_amount[]" id="requested_amount" /><?php }else{ ?>
						<input type="hidden" class="form-control requested_amount" name="requested_amount[]" id="requested_amount" value="0.00" /><?php } ?>
						<?php } else{ if($this->user_account_type == BUILDERADMIN) { echo $value['requested_amount'];?> <input type="hidden" class="form-control requested_amount" name="requested_amount[]" id="requested_amount" value="<?php echo $value['requested_amount'] ?>" <?php } else{?><input type="text" class="form-control requested_amount" name="requested_amount[]" id="requested_amount" value="<?php echo $value['requested_amount'] ?>" /><?php }} ?>

						

						<div class="mes"></div>
					</div>
				</div>
			</td> 
			
			<?php if($this->user_account_type == BUILDERADMIN){ ?>
			<td>
				<div class="col-xs-12">
					<div class="form-group">
						<?php if(isset($value['total_out_standing']) && $value['total_out_standing'] > 0.00 && $value['out_standing'] > 0.00) { ?>
						<input type="text" class="form-control amount" name="amount[]" id="amount" />
						<?php }
						else{ ?>
						<input type="hidden" class="form-control amount" name="amount[]" id="amount" value="0.00" />
						<?php } ?>
						<div class="mes"></div>
					</div>
				</div>
			</td>
			
			 
		   </tr>
		 <?php  } } } ?>

	   </tbody>     				   
	   </table>
	   <?php if($this->user_account_type == SUBCONTRACTOR ){?>
		   <button class="btn  btn-blue make-payment" type="submit" id="make_payment">Create / Update payment request</button>
		<?php }  ?>
		<?php if($this->user_account_type == BUILDERADMIN ){ ?>

		  <button class="btn  btn-blue make-payments" type="button" onclick="make_payment()">Create / Update payment request</button>

		  <div id="payment_btn">
		  <?php 
			if(isset($this->project_status) && $this->project_status != 'Closed' && $this->project_status != 'Disabled')
							{
		  ?>
		   <button class="btn  btn-blue make-payment" type="button" onclick="make_payment()">make a payment</button>
		  
		   
		   <button class="btn  btn-blue void-payment" type="button" onclick="void_payment()">void payment</button>
		   <?php 
		   }
		   ?>
		</div>
		 <?php }  ?>
			   
	</div>
</div>