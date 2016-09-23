<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<head>
	<title>Unibuilder</title>		
</head>
<html>
   <body>
      <table border="0" align="center" cellpadding="0" cellspacing="0" width="780" style="width:780px;margin:0px auto; font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#535353">
         <tr>
            <td align="center" colspan="2">
               <img src="<?php if(isset($this->builder_logo_url) && !empty($this->builder_logo_url))
							{echo $this->builder_logo_url;} 
							else{echo IMAGESRC.'print_image/logo.png';}
			   ?>" width="460" height="124">
                             
            </td>			
         </tr>
		 <tr>
			<td>
				<p style="font-size:18px;" align="left"><?php echo isset($builder_details['builder_address'])?ucwords($builder_details['builder_address']):''; ?></p>
			</td>
			<td>
				<p style="font-size:18px;" align="right"><img src="<?php echo IMAGESRC.'print_image/phone.png'; ?>"/> Phone : <?php echo isset($builder_details['builder_phone'])?$builder_details['builder_phone']:''; ?></p>
			</td>
		 </tr>		 
		 <tr>
			<td colspan="2" style="width:760px;">
				<hr style="width:100%;margin:0px;padding:0px;"/>
			</td>
		 </tr>
		 <tr>
			<td colspan="2" style="width:760px;">
				<h2 style="color:#343434;float:right;text-align:right;margin:0px;padding:0px;">INVOICE</h2>
			</td>
		 </tr>
		 
		 <tr>
            <td colspan="2" style="width:760px; padding:10px 0px 5px;" align="right" >               
               <table border="0"  cellpadding="0" cellspacing="0" width="300" align="right" style="float:right;border:1px solid #8D8D8D; border-collapse: collapse; font-size:14px; font-family:Arial, Helvetica, sans-serif; width:300px; color:#535353;">
                  <tr>
                     <td style="border:1px solid #8D8D8D; border-collapse: collapse;padding:4px 2px">
                        <p style="margin:0px;padding:0px;text-align:left;font-weight:bold;">Invoice#</p>
                     </td>
                     <td style="border:1px solid #8D8D8D; border-collapse: collapse;  padding:4px 2px">
                        <p style="margin:0px;padding:0px;"><?php echo isset($invoice_data['invoice_no'])?$invoice_data['invoice_no']:''; ?></p>
                     </td>
                  </tr>
                  <tr>
                     <td style="border:1px solid #8D8D8D; border-collapse: collapse;  padding:4px 2px">
                        <p style="margin:0px;padding:0px;text-align:left;font-weight:bold;">Date</p>
                     </td>
                     <td style="border:1px solid #8D8D8D; border-collapse: collapse;  padding:4px 2px">
                        <p style="margin:0px;padding:0px;"><?php echo isset($builder_details['current_date'])?$builder_details['current_date']:''; ?></p>
                     </td>
                  </tr>
                  <tr>
                     <td style="border:1px solid #8D8D8D; border-collapse: collapse;  padding:4px 2px">
                        <p style="margin:0px;padding:0px;text-align:left;font-weight:bold;">For Period</p>
                     </td>
                     <td style="border:1px solid #8D8D8D; border-collapse: collapse;  padding:4px 2px">
                        <p style="margin:0px;padding:0px;"><?php echo isset($invoice_data['invoice_from_date'])?$invoice_data['invoice_from_date']:''; ?><br>to<br><?php echo isset($invoice_data['invoice_to_date'])?$invoice_data['invoice_to_date']:''; ?></p>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
		  <tr>
            <td colspan="2" style="width:760px;" align="left">
               <table border="0"  cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                     <td width="100%">
                        <table border="0"  cellpadding="0" cellspacing="0" width="300" align="left" style="margin-right:70px;font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#626262;">
                           <tr>
                              <td style="background-color:#E8E8E8;padding:4px 2pxfont-size:14px;font-weight:bold;"><strong>Invoiced to</strong></td>
                           </tr>
                           <tr>
                              <td style="padding:4px 2px;font-size:14px">
                                 <p style="margin:0px;padding:0px;"><?php echo ucwords($builder_details['builder_name']);?>
								 <br><?php echo isset($invoice_data['address'])?ucwords($invoice_data['address']):'';?>
								 <br><?php echo isset($invoice_data['city'])?ucwords($invoice_data['city']):'';?>
								 <br><?php echo isset($invoice_data['province'])?ucwords($invoice_data['province'].' - '.$invoice_data['pincode']):'';?>
								 <br><?php echo isset($invoice_data['country'])?ucwords($invoice_data['country']):'';?>
								 <br>Phone no: <?php echo isset($invoice_data['phone_number'])?$invoice_data['phone_number']:'';?>
								 </p>
                              </td>
                           </tr>
                        </table>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
		 <tr>
            <td colspan="2" style="width:760px;padding-top:20px;" align="left">
               <table border="0"  cellpadding="0" cellspacing="0" width="100%" style="width:760px;border-collapse: collapse; font-size:14px; color:#636363;font-family:Arial, Helvetica, sans-serif;">
                  <tr>
                     <th style="width:60px;border:1px solid #7B7B7B; border-collapse: collapse;  padding:4px 2px;background-color:#E8E8E8;">
                        <p style="margin:0px;padding:0px;">Item#</p>
                     </th>
                     <th style="width:200px;border:1px solid #7B7B7B; border-collapse: collapse;  padding:4px 2px;background-color:#E8E8E8;">
                        <p style="margin:0px;padding:0px;">Plan Name</p>
                     </th>
                     <th style="width:250px;border:1px solid #7B7B7B; border-collapse: collapse;  padding:4px 2px;background-color:#E8E8E8;">
                        <p style="margin:0px;padding:0px;">Description</p>
                     </th>
                     <th style="width:100px;border:1px solid #7B7B7B; border-collapse: collapse;  padding:4px 2px;background-color:#E8E8E8;">
                        <p style="margin:0px;padding:0px;">Period</p>
                     </th>
                     <th style="width:100px;border:1px solid #7B7B7B; border-collapse: collapse;  padding:4px 2px;background-color:#E8E8E8;">
                        <p style="margin:0px;padding:0px;">Amount</p>
                     </th>
                  </tr>
				  <tr>
                     <td style="width:60px;border:1px solid #7B7B7B; border-collapse: collapse;  padding:4px 2px" align="center">
                        <p style="margin:0px;padding:0px;">1</p>
                     </td>
                     <td  style="width:200px;border:1px solid #7B7B7B; border-collapse: collapse; padding:4px 2px" align="center">
                        <p style="margin:0px;padding:0px;"><?php echo isset($invoice_data['plan_name'])?$invoice_data['plan_name']:''; ?></p>
                     </td>
                     <td  style="width:250px;border:1px solid #7B7B7B; border-collapse: collapse; padding:4px 2px" >
                        <p style="margin:0px;padding:0px;"><?php echo $invoice_data['plan_description']; ?> </p>
                     </td>
                     <td  style="width:100px;border:1px solid #7B7B7B; border-collapse: collapse; padding:4px 2px" >
                        <p style="margin:0px;padding:0px;text-align:center;"><?php echo isset($invoice_data['invoice_from_date'])?$invoice_data['invoice_from_date']:''; ?></p>
                        <p style="margin:0px;padding:0px;text-align:center;">(to)</p>
                        <p style="margin:0px;padding:0px;text-align:center;"><?php echo isset($invoice_data['invoice_to_date'])?$invoice_data['invoice_to_date']:''; ?></p>
                     </td>
                     <td style="width:100px;border:1px solid #7B7B7B; border-collapse: collapse; padding:4px 2px" align="center">
                        <p style="margin:0px;padding:0px;">$<?php echo isset($invoice_data['invoice_amount'])?$invoice_data['invoice_amount']:''; ?></p>
                     </td>
                  </tr>
                  
                  <tr>   
					<td colspan="3" style="width:510px;border-right:1px solid #7B7B7B;"></td> 				  
                     <td  style="width:100px;border:1px solid #7B7B7B; border-collapse: collapse; padding:4px 2px"  align="right">
                        <p style="margin:0px;padding:4px 2px;"><strong>Total</strong></p>
                     </td>
                     <td style="width:100px;border:1px solid #7B7B7B; border-collapse: collapse; padding:4px 2px" align="center">
                        <p style="margin:0px;padding:4px 2px;">$<?php echo isset($invoice_data['invoice_amount'])?$invoice_data['invoice_amount']:''; ?> USD</p>
                     </td>
                  </tr>
                  <tr>
                    <td colspan="3" style="width:510px;border-right:1px solid #7B7B7B;"></td> 
                     <td style="width:100px;border:1px solid #7B7B7B; border-collapse: collapse;padding:4px 2px"  align="right">
                        <p style="margin:0px;padding:4px 2px;"><strong>Tax@0%</strong></p>
                     </td>
                     <td style="width:100px;border:1px solid #7B7B7B; border-collapse: collapse; padding:4px 2px" align="center">
                        <p style="margin:0px;padding:4px 2px;">$0.00 USD</p>
                     </td>
                  </tr>
                  <tr>  
					<td colspan="3" style="width:510px;border-right:1px solid #7B7B7B;"></td> 
                     <td style="width:100px; border:1px solid #7B7B7B; border-collapse: collapse;padding:4px 2px"  align="right">
                        <p style="margin:0px;padding:4px 2px;"><strong>Total Due</strong></p>
                     </td>
                     <td style="width:100px;border:1px solid #7B7B7B; border-collapse: collapse; padding:4px 2px" align="center">
                        <p style="margin:0px;padding:4px 2px;"><strong>$<?php echo isset($invoice_data['invoice_amount'])?$invoice_data['invoice_amount']:''; ?> USD</strong></p>
                     </td>
                  </tr>
                 
               </table>
            </td>
         </tr>
		<tr>
			<td colspan="2" style="padding:20px 0px;width:760px;" align="left"> 
			   <table border="0"  cellpadding="0" cellspacing="0" width="300" align="left" style="width:300px; border-collapse: collapse; margin-right:70px;font-family:Arial, Helvetica, sans-serif; font-size:14px;color:#626262;">
				  <tr>
					 <td style="background-color:#E8E8E8;padding:4px 2px;font-size:14px;font-weight:bold;border-top:1px solid #7B7B7B;border-left:1px solid #7B7B7B;border-right:1px solid #7B7B7B;"><strong>Other Comments</strong></td>
				  </tr>
				  <tr>
					 <td style="font-size:18px;border-bottom:1px solid #7B7B7B;border-right:1px solid #7B7B7B;border-left:1px solid #7B7B7B;">
						<p style="margin:0px;padding:4px 2px;height:90px;width:300px;float:left;">&nbsp;</p>
					 </td>
				  </tr>
			   </table>
			</td>			
         </tr>
		  <tr>
            <td colspan="2" align="center" style="width:760px;padding-top:5px;text-align:center;font-family:Arial, Helvetica, sans-serif;font-size:14px;">
               <p style="margin:0px;padding:0px;text-align:center">This computer generated Invoice and doesn't require Signature</p>
               <p style="margin:0px;padding:0px;text-align:center">Thank you for your business</p>
            </td>
         </tr>      
         </table>
   </body>
</html>