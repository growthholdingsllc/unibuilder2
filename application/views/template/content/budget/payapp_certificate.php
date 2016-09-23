<div class="col-xs-12">
	<div class="row">
		<div class="col-xs-3">
			<a href="javascript:void(0);" id="pay_app_list" class="pull-left"><button class="sprite">Prev</button></a>
		</div>
	</div>
	<div class="row">
	   <div class="col-xs-6">
		  <h4>APPLICATION AND CERTIFICATE FOR PAYMENT </h4>
	   </div>
	   <div class="col-xs-6">		 
		  <p>&nbsp;</p>
	   </div>
	</div>
	<hr/>
	<div class="row">
	   <div class="col-xs-3">
		  <div class="row">
			 <div class="col-xs-6">
				<p>To Owner:</p>
			 </div>
			 <div class="col-xs-6">
				<?php echo ($certificate_info['owner_first_name'])?'<p>'.$certificate_info["owner_first_name"].' '.$certificate_info["owner_last_name"].'</p>':''; ?>
				<?php echo ($certificate_info['owner_address'])?'<p>'.$certificate_info["owner_address"].'</p>':''; ?>
				<?php echo ($certificate_info['owner_city'])?'<p>'.$certificate_info["owner_city"].'</p>':''; ?>
				<?php echo ($certificate_info['owner_province'])?'<p>'.$certificate_info["owner_province"].' '.$certificate_info["owner_postal"].'</p>':''; ?>
			 </div>
		  </div>
	   </div>
	   <div class="col-xs-3">
		  <div class="row">
			 <div class="col-xs-6">
				<p>Project:</p>
			 </div>
			 <div class="col-xs-6">
				<?php echo ($certificate_info['project_name'])?'<p>'.$certificate_info["project_name"].'</p>':''; ?>
				<?php echo ($certificate_info['project_address'])?'<p>'.$certificate_info["project_address"].'</p>':''; ?>
				<?php echo ($certificate_info['project_city'])?'<p>'.$certificate_info["project_city"].'</p>':''; ?>
				<?php echo ($certificate_info['project_province'])?'<p>'.$certificate_info["project_province"].' '.$certificate_info["project_postal"].'</p>':''; ?>
			 </div>
		  </div>
	   </div>
	   <div class="col-xs-3">
		  <div class="row">
			 <div class="col-xs-6">
				<p>Application No:</p>
				<p>PERIOD TO:</p>
			 </div>
			 <div class="col-xs-6">
				<?php echo ($certificate_info['payapp_number'])?'<p>'.$certificate_info["payapp_number"].'</p>':' --- '; ?>
				<?php echo ($certificate_info['payapp_period_to'])?'<p>'.$certificate_info["payapp_period_to"].'</p>':' --- '; ?>
			 </div>
		  </div>
	   </div>
	   <div class="col-xs-3">
		  <div class="row">
			 <div class="col-xs-6">
				<p>Distribution to:</p>
			 </div>
			 <div class="col-xs-6">
				<p>OWNER</p>
			 </div>
		  </div>
	   </div>
	</div>
	<div class="row">
	   <div class="col-xs-3">
		  <div class="row">
			 <div class="col-xs-6">
				<p>Construction Manager:</p>
			 </div>
			 <div class="col-xs-6">
				<?php echo ($certificate_info['builder_name'])?'<p>'.$certificate_info["builder_name"].'</p>':''; ?>
				<?php echo ($certificate_info['builder_address'])?'<p>'.$certificate_info["builder_address"].'</p>':''; ?>
				<?php echo ($certificate_info['builder_city'])?'<p>'.$certificate_info["builder_city"].'</p>':''; ?>
				<?php echo ($certificate_info['builder_province'])?'<p>'.$certificate_info["builder_province"].'</p>':''; ?>
			 </div>
		  </div>
	   </div>
	   <div class="col-xs-3">
		  &nbsp;
	   </div>
	   <div class="col-xs-3">
		  <div class="row">
			 <div class="col-xs-6">
				<p>PROJECT NO:</p>
			 </div>
			 <div class="col-xs-6">
				<?php echo ($certificate_info['project_no'])?'<p>'.$certificate_info["project_no"].'</p>':' --- '; ?>
			 </div>
		  </div>
	   </div>	   
	</div>
	<div class="row">
	   <div class="col-xs-6">
		  &nbsp;
	   </div>	  
	   <div class="col-xs-3">
		  <div class="row">
			 <div class="col-xs-6">
				<p>Contract Date:</p>
			 </div>
			 <div class="col-xs-6">
				<?php echo ($certificate_info['contract_date'])?'<p>'.$certificate_info["contract_date"].'</p>':' --- '; ?>
			 </div>
		  </div>
	   </div>	   
	</div>
	<hr/>
	<div class="row">
	   <div class="col-xs-6">
		  <h4> PROJECT APPLICATION FOR PAYMENT</h4>
		  <div class="row">
			 <div class="col-xs-12">
				<table width="100%" class="pro-table">
				   <thead>
					  <tr>
						 <th colspan="4" height="30"> CHANGE ORDER SUMMARY</th>
					  </tr>
					  <tr>
						 <th colspan="2" height="30" rowspan="2">
							<p>Change Orders approved in</p>
							<p>previous months by Owner</p>							
						 </th>
						 <th>Additions</th>
						 <th>Deductions</th>
					  </tr>					 
					  <tr>
						 <td><?php echo ($certificate_info['co_addition'])?'$'.number_format($certificate_info["co_addition"],2,'.',','):' --- '; ?></td>
						 <td><?php echo ($certificate_info['co_subtraction'])?'$'.number_format($certificate_info["co_subtraction"],2,'.',','):' --- '; ?></td>
					  </tr>					  
				   </thead>
				</table>
				<p>
				   The undersigned Constrution Manager certifies that to the best of the Construction Manager's knowledge, information and belief the work covered by this Application for Payment has benn completed in accordance with the Contract Documents, that all amounts have been paid to the Contractors for work for which previous Certificates for Payment were issued and payments received from the Owner, and that current payment shown herein is now due.
				</p>
				<h5>CONSTRUCTION MANAGER</h5>
				<p>By: <span class="by_name"><?php echo ($certificate_info['owner_first_name'])?$certificate_info["user_first_name"].' '.$certificate_info["user_last_name"]:''; ?></span> Date: <span class="by_date"><?php echo ($certificate_info['created_on'])?'$'.$certificate_info["created_on"]:''; ?></span></p>
			 </div>
		  </div>
	   </div>
	   <div class="col-xs-6">
		  <p>Application is made for Payment, as shown below, in connection with the Contact. Continuation Sheet, AIA Document G703, is attached.</p>
		  <div class="row">
			 <table width="100%" class="contract-table">
				<tr>
				   <th>TOTAL CONTRACT SUM</th>
				   <td>$ <span class="by_dollar"><?php echo ($certificate_info['total_contract_sum'])? number_format($certificate_info["total_contract_sum"],2,'.',','):''; ?></span></td>
				</tr>
				<tr>
				   <th>Net Change by Change Orders</th>
				   <td>$ <span class="by_dollar"><?php echo ($certificate_info['net_change_by_co'])?number_format($certificate_info["net_change_by_co"],2,'.',','):''; ?></span></td>
				</tr>
				<tr>
				   <th>TOTAL CONTRACT SUM TO DATE</th>
				   <td>$ <span class="by_dollar"><?php echo ($certificate_info['total_contract_sum_to_date'])?number_format($certificate_info["total_contract_sum_to_date"],2,'.',','):''; ?></span></td>
				</tr>
				<tr>
				   <th>TOTAL COMPLETED & STORED TO DATE</th>
				   <td>$ <span class="by_dollar"><?php echo ($certificate_info['total_completed_and_stored_till_date'])?number_format($certificate_info["total_completed_and_stored_till_date"],2,'.',','):''; ?></span></td>
				</tr>
				<tr>
				   <th colspan="2">RETAINAGE</th>
				</tr>				
				<tr>
				   <td>
					  Total Retainage
				   </td>
				   <td>$ <span class="by_dollar"><?php echo ($certificate_info['total_retainage'])?number_format($certificate_info["total_retainage"],2,'.',','):''; ?></span></td>
				</tr>
				<tr>
				   <th>
					  TOTAL EARNED LESS RETAINAGE 					 
				   </th>
				   <td>$ <span class="by_dollar"><?php echo ($certificate_info['total_earned_less_retainage'])?number_format($certificate_info["total_earned_less_retainage"],2,'.',','):''; ?></span></td>
				</tr>
				<tr>
				   <th>
					  LESS PREVIOUS CERTIFICATES FOR 
					  <p>Payment (prior Certificate)</p>
				   </th>
				   <td>$ <span class="by_dollar"><?php echo ($certificate_info['less_previous_certificates_for'])?number_format($certificate_info["less_previous_certificates_for"],2,'.',','):''; ?></span></td>
				</tr>
				<tr>
				   <th>CURRENT PAYMENT DUE</th>
				   <td>$ <span class="by_dollar"><?php echo ($certificate_info['current_payment_due'])?number_format($certificate_info["current_payment_due"],2,'.',','):''; ?></span></td>
				</tr>
				<tr>
				   <th>
					  BALANCE TO FINISH, PLUS RETAINAGE
				   </th>
				   <td>$ <span class="by_dollar"><?php echo ($certificate_info['balance_to_finish_and_retainage'])?number_format($certificate_info["balance_to_finish_and_retainage"],2,'.',','):''; ?></span></td>
				</tr>
				<tr>
				   <td colspan="2">
					  <hr/>
				   </td>
				</tr>
				<tr>
				   <th colspan="2">State of:</th>				   
				</tr>
				<tr>
				   <td colspan="2">
					  <p>Subscribed and sworn to before me this</p>
					  <p>Notary Public</p>
					  <p>My Commission expires</p>
				   </td>				  
				</tr>
			 </table>
		  </div>
	   </div>
	</div>
	<hr/>
	<div class="row">
	   <div class="col-xs-6">
		  <h4>ARCHITECT'S CERTIFICATE FOR PAYMENT</h4>
		  <p>In accordance with the Contract Documents, based on on-site observations and the data comprising the above application, the Architect certifies to the Owner that to the best of the Architec's knowledge, information and belief the work has progressed as indicated, the quality of the Work is in accordance with the Contract Documents, and the Contractor's are entitled to payment of the AMOUNT CERTIFIED.</p>
	   </div>
	   <div class="col-xs-6">
		  <table width="100%" class="contract-table">
			 <tr>
				<th>AMOUNT CERTIFIED</th>
				<td><span class="by_dollar"><?php echo ($certificate_info['current_payment_due'])?number_format($certificate_info["current_payment_due"],2,'.',','):''; ?></span></td>
			 </tr>
			 <tr>
				<td colspan="2">(Attach explanation if amount certified differs from the amount applied for.)</td>
			 </tr>
			 <tr>
				<th colspan="2">ARCHITECT:</th>
			 </tr>
			 <tr>
				<td>By: <span class="by_name"></span></td>
				<td>Date: <span class="by_name"></span></td>
			 </tr>
			 <tr>
				<td colspan="2">
				   <p>This Certificate is not negotiable. The AMOUNT CERTIFIED is payable only to the Contractor's named herein. Issuance, payment and acceptance of payment are without prejudice to any rights of the Owner or Contractor under this Contract.</p>
				</td>
			 </tr>
		  </table>
	   </div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<a href="javascript:void(0);" id="pay-app-list-details"><button class="sprite pull-right">Next</button></a>
		</div>
	</div>
 </div>