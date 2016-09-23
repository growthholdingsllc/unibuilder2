<div class="col-xs-12">
	<div class="row">
		<div class="col-xs-3">
			<a href="javascript:void(0);" id="pay_app_list" class="pull-left"><button class="sprite">Prev</button></a>
		</div>
		<div class="col-xs-3 pull-right">
			<!-- <a href="<?php echo base_url().$this->crypt->encrypt('prints/pay_app_certificate/'.$certificate_info['payapp_id']); ?>" class="pull-right" target="_blank" ><button class="btn btn-blue"><img class="uni_print" src="<?php echo IMAGESRC.'strip.gif'; ?>" /> Print</button></a> -->

			<button class="btn btn-blue" id="print_pay_app_certificate"><img class="uni_print" src="<?php echo IMAGESRC.'strip.gif'; ?>" /> Print</button>

			<input type="hidden" name="pay_app_certificate_id" id="pay_app_certificate_id" value="<?php echo (isset($certificate_info['payapp_id']) && $certificate_info['payapp_id'] > 0)?$certificate_info['payapp_id']:0;?>"/>

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
	<div class="row">
      <div class="col-xs-12">
         <table width="100%">
            <tr>
               <td rowspan="4" valign="top" height="25">To Owner:</td>
               <td valign="top" height="25"><?php echo ($certificate_info['owner_first_name'])?'<p>'.$certificate_info["owner_first_name"].' '.$certificate_info["owner_last_name"].'</p>':''; ?></td>
               <td rowspan="4"  valign="top">Project:</td>
               <td valign="top" height="25"><?php echo ($certificate_info['project_name'])?'<p>'.$certificate_info["project_name"].'</p>':''; ?></td>
               <td valign="top" height="25">Application No:</td>
               <td valign="top" height="25"><?php echo ($certificate_info['payapp_number'])?'<p>'.$certificate_info["payapp_number"].'</p>':' --- '; ?></td>
               <td rowspan="4"  valign="top">Distribution to:</td>
               <td rowspan="4"  valign="top">OWNER</td>
            </tr>
            <tr>
               <td valign="top" height="25"><?php echo ($certificate_info['owner_address'])?'<p>'.$certificate_info["owner_address"].'</p>':''; ?></td>
			   <td valign="top" height="25"><?php echo ($certificate_info['project_address'])?'<p>'.$certificate_info["project_address"].'</p>':''; ?></td>
               <td rowspan="3" valign="top">PERIOD TO:</td>
               <td rowspan="3" valign="top"><?php echo ($certificate_info['payapp_period_to'])?'<p>'.$certificate_info["payapp_period_to"].'</p>':' --- '; ?></td>
            </tr>
            <tr>
               <td valign="top" height="25"><?php echo ($certificate_info['owner_city'])?'<p>'.$certificate_info["owner_city"].'</p>':''; ?></td>
			   <td valign="top" height="25"><?php echo ($certificate_info['project_city'])?'<p>'.$certificate_info["project_city"].'</p>':''; ?></td>
            </tr>
            <tr>
               <td valign="top" height="25"><?php echo ($certificate_info['owner_province'])?'<p>'.$certificate_info["owner_province"].' '.$certificate_info["owner_postal"].'</p>':''; ?></td>
			   <td valign="top" height="25"><?php echo ($certificate_info['project_province'])?'<p>'.$certificate_info["project_province"].' '.$certificate_info["project_postal"].'</p>':''; ?></td>
            </tr>
            <tr>
               <td rowspan="4" valign="top">Construction Manager:</td>
               <td valign="top" height="25"><?php echo ($certificate_info['builder_name'])?'<p>'.$certificate_info["builder_name"].'</p>':''; ?></td>
               <td colspan="2" rowspan="4" ></td>
               <td rowspan="4" valign="top">PROJECT NO:</td>
               <td colspan="3" rowspan="4" valign="top"><?php echo ($certificate_info['project_no'])?'<p>'.$certificate_info["project_no"].'</p>':' --- '; ?></td>
            </tr>
            <tr>
               <td valign="top" height="25"><?php echo ($certificate_info['builder_address'])?'<p>'.$certificate_info["builder_address"].'</p>':''; ?></td>
            </tr>
            <tr>
               <td valign="top" height="25"><?php echo ($certificate_info['builder_city'])?'<p>'.$certificate_info["builder_city"].'</p>':''; ?></td>
            </tr>
            <tr>
               <td valign="top" height="25"><?php echo ($certificate_info['builder_province'])?'<p>'.$certificate_info["builder_province"].'</p>':''; ?></td>
            </tr>
            <tr>
               <td valign="top" height="25">Contract for:</td>
               <td valign="top" height="25"><?php echo ($certificate_info['project_no'])?'<p>'.$certificate_info["project_no"].'</p>':' --- '; ?></td>
               <td colspan="2" valign="top" height="25"></td>
               <td valign="top" height="25">Contract Date:</td>
               <td valign="top" height="25"><?php echo ($certificate_info['contract_date'])?'<p>'.$certificate_info["contract_date"].'</p>':' --- '; ?></td>
               <td valign="top" height="25"></td>
               <td valign="top" height="25"></td>
            </tr>
         </table>
      </div>
   </div>
   
	<hr/>
	
	<div class="row">
	   <div class="col-xs-6">
		  <h4> PROJECT APPLICATION FOR PAYMENT</h4>
		  <div class="row">
			 <div class="col-xs-12">
				<table width="100%" class="pro-table">				   
					  <tr>
						 <th colspan="4" height="30"> CHANGE ORDER SUMMARY</th>
					  </tr>
					  <tr>
						 <td colspan="2" height="30">
							<p>Change Orders approved in</p>
							<p>previous months by Owner</p>							
						 </td>
						 <td><strong>Additions</strong></td>
						 <td><strong>Deductions</strong></td>
					  </tr>					 
					  <tr>
						 <td colspan="2" align="right">TOTAL</td>
						 <td><?php echo ($certificate_info['co_addition'])?'$'.number_format($certificate_info["co_addition"],2,'.',','):' --- '; ?></td>
						 <td><?php echo ($certificate_info['co_subtraction'])?'$'.number_format($certificate_info["co_subtraction"],2,'.',','):' --- '; ?></td>
					  </tr>
					  <tr>
						<th colspan="2">Approved this Month</th>
						<th colspan="2"></th>
						</tr>
					<tr>
						<td>Number</td>
						<td>Date Approved</td>
						<td></td>
						<td></td>
					</tr>
					<?php 
					$total_addition = 0.00;
					$total_deduction = 0.00;
					$net_change_by_co = 0.00;
					if(isset($certificate_info["approved_this_month"]) && count($certificate_info["approved_this_month"])>0)
					{
						foreach($certificate_info["approved_this_month"] as $approved_this_month)
						{?>
						<tr>
							<td><?php echo (isset($approved_this_month['payapp_number']))?$approved_this_month['payapp_number']:'--';?></td>
							<td><?php echo (isset($approved_this_month['date_approved']))?$approved_this_month['date_approved']:'--';?></td>
							<td><?php echo (isset($approved_this_month['co_addition']))?'$'.number_format($approved_this_month['co_addition'],2,'.',','):'--';?></td>
							<td><?php echo (isset($approved_this_month['co_subtraction']))?'$'.number_format($approved_this_month['co_subtraction'],2,'.',','):'--';?></td>
						</tr>	
						<?php $total_addition = $total_addition + $approved_this_month['co_addition'];
						$total_deduction = $total_deduction + $approved_this_month['co_subtraction'];
						} 
					}
					$net_change_by_co = $certificate_info['co_addition'] + $certificate_info['co_subtraction'] + $total_addition + $total_deduction;
					?>	
					<tr>
						<td colspan="2" align="right">TOTAL</td>
						<td><?php echo '$'.number_format($total_addition,2,'.',',');?></td>
						<td><?php echo '$'.number_format($total_deduction,2,'.',',');?></td>
					</tr>
					<tr>
						<td colspan="2" align="right">Net Change by Change Orders</td>
						<td><?php echo ($net_change_by_co>=0)?'$'.number_format($net_change_by_co,2,'.',','):'';?></td>
						<td><?php echo ($net_change_by_co<0)?'$'.number_format($net_change_by_co,2,'.',','):'';?></td>						
						</tr>
				</table>				
				<p>
				   The undersigned Construction Manager certifies that to the best of the Construction Manager's knowledge, information and belief the work covered by this Application for Payment has been completed in accordance with the Contract Documents, that all amounts have been paid to the Contractors for work for which previous Certificates for Payment were issued and payments received from the Owner, and that current payment shown herein is now due.
				</p>
				<h5>CONSTRUCTION MANAGER</h5>
				<p>By: <span class="by_name"><?php echo ($certificate_info['owner_first_name'])?$certificate_info["user_first_name"].' '.$certificate_info["user_last_name"]:''; ?></span> Date: <span class="by_date"><?php echo ($certificate_info['created_on'])?''.$certificate_info["created_on"]:''; ?></span></p>
			 </div>
		  </div>
	   </div>
	   <div class="col-xs-6">
		  <p>Application is made for Payment, as shown below, in connection with the Contract.</p>
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
		  <p>In accordance with the Contract Documents, based on on-site observations and the data comprising the above application, the Architect certifies to the Owner that to the best of the Architect's knowledge, information and belief the work has progressed as indicated, the quality of the Work is in accordance with the Contract Documents, and the Contractor's are entitled to payment of the AMOUNT CERTIFIED.</p>
	   </div>
	   <div class="col-xs-6">
		  <table width="100%" class="contract-table">
			 <tr>
				<th>AMOUNT CERTIFIED</th>
				<td>$ <span class="by_dollar"><?php echo ($certificate_info['current_payment_due'])?number_format($certificate_info["current_payment_due"],2,'.',','):''; ?></span></td>
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

<input type="hidden" name="include_certificate_val" id="include_certificate_val" value="No">

 <div class="modal fade confirmModal" id="certificateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="checkbox_areas">
      <h4>Include data with 0.00 while printing?  
      </h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">              
              <div class="row col-xs-12" id="disable_checkbox">
              <!--<input type="checkbox" value="No" id="include_certificate" class="include_certificate" >
              <input type="hidden" value="No">-->
			  <a href="javascript:void(0);" class="unchecked_marked"><img alt="home" src="<?php echo IMAGESRC.'box-1s.png'?>" border="0"/></a>	
			 <a href="javascript:void(0);" class="checked_marked"><img alt="home" src="<?php echo IMAGESRC.'green_tickboxs.png'?>" border="0"/></a>	
			 <input type="hidden" id="marked-list" name="marked-list" value="No" />
              <!-- <input type="hidden" name="include_val" id="include_val" value="No"> -->                            
           <!--  <button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal">
               <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> CANCEL
            </button>  --> 
            <button class="btn btn-blue m-left-1 pull-right" type="button" id="certificate_confirm">
               <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> OK
            </button>            
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<script>
 $(function() {
	$('.checked_marked').hide();
	var mark_check = $('#marked-list').val();

	if(mark_check === 'Yes'){
		$('.checked_marked').show();
		$('.unchecked_marked').hide();
	}
	else{
		$('.checked_marked').hide();
		$('.unchecked_marked').show();
	}
	$('.unchecked_marked').click(function(){
		$(this).hide();
		$('.checked_marked').show();
		$('#marked-list').attr("checked", true);
		$('#marked-list').val("Yes");
		$('.check-list-box-hidden').val("Yes");
		/* $('.check-list-box input[type="checkbox"]').attr('checked',true);
		$('.check-list-box input[type="checkbox"]').parent().find('icheckbox_square-red').addClass('checked');  */
		$('.check-list-box').iCheck('check');
		$('.check-list-box').parent('.icheckbox_square-red').addClass('checked'); 
	});
	$('.checked_marked').click(function(){
		$(this).hide();
		$('.unchecked_marked').show();
		$('#marked-list').attr("checked", false);
		$('#marked-list').val("No");
		$('.check-list-box-hidden').val("No");
		$('.check-list-box').iCheck('uncheck');
		$('.check-list-box').parent('.icheckbox_square-red').removeClass('checked');
	});
});

</script> 