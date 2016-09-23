<?php //echo "<pre>"; print_r($certificate_info); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Unibuilder</title>
        <script type="text/javascript" src="<?php echo JSSRC.'jquery.min.js';?>"></script>
        <script type="text/javascript">
            $(function(){		  
            window.print();
            });
        </script>	 
    </head>
    <body>
        <table width="1100" border="0" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;color:#181818;">
            <tr>
                <td align="center" colspan="2">
                    <img src="<?php if(isset($this->builder_logo_url) && !empty($this->builder_logo_url))
                        {echo $this->builder_logo_url;} 
                        else{echo IMAGESRC.'print_image/logo.png';}
                        ?>" width="460" height="114" alt="logo" />
                    
                </td>
            </tr>
			<tr>
				<td height="40">
					<p style="font-size:18px;color:#727272" align="left"><?php echo ucwords($builder_details['builder_address']).' '; ?>  </p>                    
				</td>
				<td>
					<p style="font-size:18px;color:#727272" align="right"><img src="<?php echo IMAGESRC.'print_image/phone.png'; ?>"> Phone : <?php echo $builder_details['builder_phone']; ?></p>
				</td>
			</tr>
			<tr>
				<td colspan="2" ><hr/></td>				
			</tr>
            <tr>
                <td colspan="2" align="left" valign="middle">
                    <h3 style="padding:0px;margin:0px">APPLICATION AND CERTIFICATE FOR PAYMENT</h3>
                </td>
            </tr>
            <tr>
                <td colspan="2" valign="middle">
                    <hr style="color:#EEEEEE"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%" border="0">
                        <tr>
                            <td rowspan="5" valign="top">To Owner:</td>
                            <td height="25" valign="top"><?php echo $certificate_info['owner_first_name']; ?></td>
                            <td rowspan="11" valign="top">Project:</td>
                            <td height="25" valign="top"><?php echo $certificate_info['project_name']; ?></td>
                            <td valign="top">Application No:</td>
                            <td height="25" valign="top"><?php echo $certificate_info['payapp_number']; ?></td>
                            <td rowspan="11" valign="top">Distribution to:</td>
                            <td rowspan="11" valign="top">Owner</td>
                        </tr>
                        <tr>
                            <td height="25"><?php echo $certificate_info['owner_address']; ?></td>
                            <td height="25"><?php echo $certificate_info['project_address']; ?></td>
                            <td>PERIOD TO:</td>
                            <td height="25"><?php echo $certificate_info['payapp_period_to']; ?></td>
                        </tr>
                        <tr>
                            <td height="25"><?php echo $certificate_info['owner_city'].' '.$certificate_info['owner_postal']; ?></td>
                            <td height="25"><?php echo $certificate_info['project_city'].' '.$certificate_info['project_postal']; ?></td>
                            <td rowspan="7" valign="top">PROJECT NO:</td>
                            <td rowspan="7" valign="top"><?php echo $certificate_info['project_no']; ?></td>
                        </tr>
                        <tr>
                            <td height="25"><?php echo $certificate_info['owner_province']; ?></td>
                            <td height="25"><?php echo $certificate_info['project_province']; ?></td>
                        </tr>
                        <tr>
                            <td height="25"><?php echo $certificate_info['owner_country']; ?></td>
                            <td rowspan="7" valign="top"><?php echo $certificate_info['project_country']; ?></td>
                        </tr>
                        <tr>
                            <td rowspan="4" valign="top">Construction Manager:</td>
                            <td height="25" valign="top"><?php echo $certificate_info['builder_name']; ?></td>
                        </tr>
                        <tr>
                            <td height="25"><?php echo $certificate_info['builder_address']; ?></td>
                        </tr>
                        <tr>
                            <td height="25"><?php echo $certificate_info['builder_city'].' '.$certificate_info['builder_postal']; ?></td>
                        </tr>
                        <tr>
                            <td height="25"><?php echo $certificate_info['builder_province']; ?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="25">Contract for:</td>
                            <td height="25">--</td>
                            <td height="25">Contract Date:</td>
                            <td height="25"><?php echo $certificate_info['contract_date']; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" height="20">
                    <hr style="color:#EEEEEE"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%" border="0" cellpadding="10">
                        <tr>
                            <td width="50%" valign="top">
                                <h3 style="padding:0px;margin:0px">PROJECT APPLICATION FOR PAYMENT</h3>
                            </td>
                            <td width="50%" valign="top">
                                <p  style="font-size:14px;color:#000;padding:0px;margin:0px" align="left">Application is made for Payment, as shown below, in connection with the Contact. Continuation Sheet, AIA Document G703, is attached.</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" height="100">
                                <table width="100%" border="0" cellspacing="0" cellpadding="5" style="border:1px solid #ccc;">
                                    <tr>
                                        <td colspan="4"  style="border-bottom:1px solid #ccc;"><strong>CHANGE ORDER SUMMARY</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" valign="top"  style="border-right:1px solid #ccc;">
                                            <p>Change Orders approved in</p>
                                            <p>previous months by Owner</p>
                                        </td>
                                        <td  style="border-right:1px solid #ccc;"><strong>Additions</strong></td>
                                        <td  style="border-right:0px solid #ccc;"><strong>Deductions</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right" style="border-top:1px solid #ccc;border-right:1px solid #ccc;">TOTAL</td>
                                        <td  style="border-top:1px solid #ccc;border-right:1px solid #ccc;"><?php echo ($certificate_info['co_addition'])?'$'.number_format($certificate_info["co_addition"],2,'.',','):' --- '; ?></td>
                                        <td  style="border-top:1px solid #ccc;"><?php echo ($certificate_info['co_subtraction'])?'$'.number_format($certificate_info["co_subtraction"],2,'.',','):' --- '; ?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" align="left" style="border-top:1px solid #ccc;border-right:1px solid #ccc;">Approved this Month</th>
                                        <th colspan="2" style="border-top:1px solid #ccc;"></th>
                                    </tr>
                                    <tr>
                                        <td  style="border-top:1px solid #ccc; border-right:1px solid #ccc;">Number</td>
                                        <td  style="border-top:1px solid #ccc;border-right:1px solid #ccc;">Date Approved</td>
                                        <td  style="border-top:1px solid #ccc; border-right:1px solid #ccc;"></td>
                                        <td  style="border-top:1px solid #ccc;"></td>
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
                                        <td style="border-top:1px solid #ccc;border-right:1px solid #ccc;"><?php echo (isset($approved_this_month['payapp_number']))?$approved_this_month['payapp_number']:'--';?></td>
                                        <td style="border-top:1px solid #ccc;border-right:1px solid #ccc;"><?php echo (isset($approved_this_month['date_approved']))?$approved_this_month['date_approved']:'--';?></td>
                                        <td style="border-top:1px solid #ccc;border-right:1px solid #ccc;"><?php echo (isset($approved_this_month['co_addition']))?'$'.number_format($approved_this_month['co_addition'],2,'.',','):'--';?></td>
                                        <td style="border-top:1px solid #ccc;border-right:1px solid #ccc;"><?php echo (isset($approved_this_month['co_subtraction']))?'$'.number_format($approved_this_month['co_subtraction'],2,'.',','):'--';?></td>
                                    </tr>
                                    <?php $total_addition = $total_addition + $approved_this_month['co_addition'];
                                        $total_deduction = $total_deduction + $approved_this_month['co_subtraction'];
                                        } 
                                        }
                                        $net_change_by_co = $certificate_info['co_addition'] + $certificate_info['co_subtraction'] + $total_addition + $total_deduction;
                                        ?>
                                    <tr>
                                        <td colspan="2" align="right" style="border-top:1px solid #ccc; border-right:1px solid #ccc;">TOTAL</td>
                                        <td style="border-top:1px solid #ccc; border-right:1px solid #ccc;">

                                            <?php if($certificate_info['co_addition'] == ''){ echo "---";}else{ ?>
                                            <?php echo '$'.number_format($total_addition,2,'.',','); }?>
                                        </td>
                                        <td style="border-top:1px solid #ccc;">
                                            <?php if($certificate_info['co_subtraction'] == ''){ echo "---";}else{ ?>
                                            <?php echo '$'.number_format($total_deduction,2,'.',','); }?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right" style="border-top:1px solid #ccc; border-right:1px solid #ccc;">Net Change by Change Orders</td>
                                        <td style="border-top:1px solid #ccc; border-right:1px solid #ccc;">
                                            <?php if($certificate_info['co_subtraction'] == ''){ echo "---";}else{ ?>
                                            <?php echo ($net_change_by_co>=0)?'$'.number_format($net_change_by_co,2,'.',','):'---'; }?>
                                        </td>
                                        <td style="border-top:1px solid #ccc;"><?php echo ($net_change_by_co<0)?'$'.number_format($net_change_by_co,2,'.',','):'---';?></td>
                                    </tr>
                                </table>
                            </td>
                            <td rowspan="5" valign="top">
                                <table width="100%" border="0">
                                    <tr>
                                        <td height="28"><strong>TOTAL CONTRACT SUM</strong></td>
                                        <td> <?php echo ($certificate_info['total_contract_sum'])?'$'.number_format($certificate_info["total_contract_sum"],2,'.',','):'---'; ?></td>
                                    </tr>
                                    <tr>
                                        <td height="28">Net Change by Change Orders</td>
                                        <td> <?php echo ($certificate_info['net_change_by_co'])?'$'.number_format($certificate_info["net_change_by_co"],2,'.',','):'---'; ?></td>
                                    </tr>
                                    <tr>
                                        <td height="28"><strong>TOTAL CONTRACT SUM TO DATE</strong></td>
                                        <td><?php echo ($certificate_info['total_contract_sum_to_date'])?'$'.number_format($certificate_info["total_contract_sum_to_date"],2,'.',','):'---'; ?></td>
                                    </tr>
                                    <tr>
                                        <td height="28"><strong>TOTAL COMPLETED &amp; STORED TO DATE</strong></td>
                                        <td><?php echo ($certificate_info['total_completed_and_stored_till_date'])?'$'. number_format($certificate_info["total_completed_and_stored_till_date"],2,'.',','):'---'; ?></td>
                                    </tr>
                                    <tr>
                                        <td height="28" colspan="2"><strong>RETAINAGE</strong></td>
                                    </tr>
                                    <tr>
                                        <td height="28">Total Retainage </td>
                                        <td><?php echo ($certificate_info['total_retainage'])?'$'.number_format($certificate_info["total_retainage"],2,'.',','):'---'; ?></td>
                                    </tr>
                                    <tr>
                                        <td height="28"><strong>TOTAL EARNED LESS RETAINAGE </strong></td>
                                        <td> <?php echo ($certificate_info['total_earned_less_retainage'])?'$'.number_format($certificate_info["total_earned_less_retainage"],2,'.',','):'---'; ?></td>
                                    </tr>
                                    <tr>
                                        <td height="28">
                                            <strong>LESS PREVIOUS CERTIFICATES FOR</strong>
                                            <p style="margin:0px;padding:0px;"><strong>Payment (prior Certificate)</strong></p>
                                        </td>
                                        <td valign="bottom"> <?php echo ($certificate_info['less_previous_certificates_for'])?'$'. number_format($certificate_info["less_previous_certificates_for"],2,'.',','):'---'; ?></td>
                                    </tr>
                                    <tr>
                                        <td height="28"><strong>CURRENT PAYMENT DUE</strong></td>
                                        <td><?php echo ($certificate_info['current_payment_due'])?'$'.number_format($certificate_info["current_payment_due"],2,'.',','):'---'; ?></td>
                                    </tr>
                                    <tr>
                                        <td height="28"><strong>BALANCE TO FINISH, PLUS RETAINAGE</strong></td>
                                        <td> <?php echo ($certificate_info['balance_to_finish_and_retainage'])?'$'. number_format($certificate_info["balance_to_finish_and_retainage"],2,'.',','):'---'; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <hr style="color:#EEEEEE" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="28" colspan="2"><strong>State of:</strong></td>
                                    </tr>
                                    <tr>
                                        <td height="28" colspan="2">Subscribed and sworn to before me this</td>
                                    </tr>
                                    <tr>
                                        <td height="28" colspan="2">Notary Public</td>
                                    </tr>
                                    <tr>
                                        <td height="28" colspan="2">My Commission expires</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="30" align="left" valign="top">
                                <p style="font-size:14px;color:#000;margin:0px;padding:0px;" align="left">The undersigned Constrution Manager certifies that to the best of the Construction Manager's knowledge, information and belief the work covered by this Application for Payment has benn completed in accordance with the Contract Documents, that all amounts have been paid to the Contractors for work for which previous Certificates for Payment were issued and payments received from the Owner, and that current payment shown herein is now due. </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5>CONSTRUCTION MANAGER</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>By: <?php echo ($certificate_info['owner_first_name'])?$certificate_info["user_first_name"].' '.$certificate_info["user_last_name"]:''; ?> Date: <?php echo ($certificate_info['created_on'])?$certificate_info["created_on"]:''; ?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr style="color:#EEEEEE"/>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" height="25">
                    <table width="100%" border="0">
                        <tr>
                            <td width="50%" valign="middle">
                                <h3 style="margin:0px;padding:0px;">ARCHITECT'S CERTIFICATE FOR PAYMENT</h3>
                            </td>
                            <td width="50%" rowspan="2" valign="top">
                                <table width="100%" border="0">
                                    <tr>
                                        <td><strong>AMOUNT CERTIFIED</strong></td>
                                        <td>$ <?php echo ($certificate_info['current_payment_due'])?number_format($certificate_info["current_payment_due"],2,'.',','):''; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p>(Attach explanation if amount certified differs from the amount applied for.)</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>ARCHITECT:</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>By: </strong></td>
                                        <td><strong>Date: </strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p>This Certificate is not negotiable. The AMOUNT CERTIFIED is payable only to the Contractor's named herein. Issuance, payment and acceptance of payment are without prejudice to any rights of the Owner or Contractor under this Contract.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <p style="font-size:14px;color:#000;margin:0px;padding:0px;" align="left">In accordance with the Contract Documents, based on on-site observations and the data comprising the above application, the Architect certifies to the Owner that to the best of the Architec's knowledge, information and belief the work has progressed as indicated, the quality of the Work is in accordance with the Contract Documents, and the Contractor's are entitled to payment of the AMOUNT CERTIFIED.</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" height="25"></td>
            </tr>
        </table>
    </body>
</html>
