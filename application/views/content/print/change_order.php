<?php // echo "<pre>"; print_r($builder_details); ?>
<?php
   $count_cn = 0;
   if(!empty($builder_details['cost_code_data']['cost_code_id']))
   {
     $cost_code_id = explode(",",$builder_details['cost_code_data']['cost_code_id']);
     $count_cn = count($cost_code_id);
   }
   if(!empty($builder_details['cost_code_data']['quantity']))
   {
     $quantity = explode(",",$builder_details['cost_code_data']['quantity']);
   }
   if(!empty($builder_details['cost_code_data']['unit_cost']))
   {
     $unit_cost = explode(",",$builder_details['cost_code_data']['unit_cost']);
   }
   if(!empty($builder_details['cost_code_data']['total']))
   {
     $total = explode(",",$builder_details['cost_code_data']['total']);
   }
   if(!empty($builder_details['cost_code_data']['cost_variance_code']))
   {
     $cost_variance_code = explode(",",$builder_details['cost_code_data']['cost_variance_code']);
   }
?>
<html>
   <head>
      <title>Unibuilder</title>
	  <script type="text/javascript" src="<?php echo JSSRC.'jquery.min.js';?>"></script>
	  <script type="text/javascript">
	  $(function(){		  
		window.print();
	  });
	  </script>	  
   </head>
   <body>
      <table border="0" align="center" cellpadding="0" cellspacing="0" style="width:800px; margin:10px auto; font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#535353">
	    <tr>
            <td align="center" colspan="2">
               <img src="<?php if(isset($this->builder_logo_url) && !empty($this->builder_logo_url))
							{echo $this->builder_logo_url;} 
							else{echo IMAGESRC.'print_image/logo.png';}
			   ?>" width="460" height="124">
               
            </td>
		</tr>
		<tr>
			<td height="40">
				<p style="font-size:18px" align="left"><?php echo $builder_details['builder_address'].' '; ?></p>
            </td>
			<td>
				<p style="font-size:18px" align="left">
					<img src="<?php echo IMAGESRC.'print_image/phone.png'; ?>"> Phone : <?php echo $builder_details['builder_phone']; ?>
                </p>
			</td>
		</tr>
		<tr>
			<td colspan="2" ><hr/></td>			
		</tr>
         </tr>
         <tr>
            <td colspan="2" style=" padding: 7px 0px 13px;" align="right" >
               <h2 style="color:#343434">CHANGE ORDER</h2>
               <table border="0"  cellpadding="0" cellspacing="0" style="border:2px solid #8D8D8D; border-collapse: collapse; font-size:20px; font-family:Arial, Helvetica, sans-serif; width:265px;color:#535353">
                  <tr>
                     <td style="border:2px solid #8D8D8D; border-collapse: collapse;  padding:5px">
                        <p>Release Date</p>
                     </td>
                     <td style="border:2px solid #8D8D8D; border-collapse: collapse;  padding:5px">
                        <p><?php if(isset($builder_details['co_release_date']['modified_on'])) echo $builder_details['co_release_date']['modified_on']; ?></p>
                     </td>
                  </tr>
                  <tr>
                     <td style="border:2px solid #8D8D8D; border-collapse: collapse;  padding:5px">
                        <p>CO#</p>
                     </td>
                     <td style="border:2px solid #8D8D8D; border-collapse: collapse;  padding:5px">
                        <p><?php echo $builder_details['co_list_data']['ub_po_co_number']; ?></p>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td colspan="2" >
               <table border="0"  cellpadding="0" cellspacing="0"  style="padding-top:50px;">
                  <tr>
                     <td>
                        <table border="0"  cellpadding="0" cellspacing="0" WIDTH="300" style="margin-right:70px;font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#626262;">
                           <tr>
                              <td style="background-color:#E8E8E8;padding:6px;font-size:18px"><strong>Subcontractor / Builder user</strong></td>
                           </tr>
                           <tr>
                              <td STYLE="padding:6px;font-size:18px">
							<?php 
							if(isset($builder_details['subcontractor_data']['address']))
							{
							?>
                                 <p><?php echo $builder_details['subcontractor_data']['address']; ?></br><?php echo $builder_details['subcontractor_data']['city'].', '.$builder_details['subcontractor_data']['province']; ?></br><?php echo $builder_details['subcontractor_data']['country'].' '.$builder_details['subcontractor_data']['postal']; ?></br>Phone no:<?php echo $builder_details['subcontractor_data']['desk_phone']; ?></p>
							<?php 
							}		
							?>		
                              </td>
                           </tr>
                        </table>
                     </td>
                     <td>
                        <table border="0"  cellpadding="0" cellspacing="0" WIDTH="300" style="font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#626262;">
                           <tr>
                              <td style="background-color:#E8E8E8;padding:6px;font-size:18px"><strong>For Project</strong></td>
                           </tr>
                           <tr>
                              <td STYLE="padding:6px;font-size:18px">
                                 <p><?php echo $builder_details['project_name'];?></br><?php echo $builder_details['project_address'];?></br></p>
                              </td>
                           </tr>
                        </table>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td colspan="2" style="padding-top:50px; ">
               <table border="0"  cellpadding="0" cellspacing="0" width="800" style="color:#636363;border:2px solid #7B7B7B; border-collapse: collapse; font-size:18px;">
                  <tr>
                     <th style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:5px;background-color:#E8E8E8;">
                        <p>CO Title</p>
                     </th>
                     <th style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:5px;background-color:#E8E8E8;">
                        <p>Scheduled Completion</p>
                     </th>
                     <th style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:5px;background-color:#E8E8E8;">
                        <p>Status</p>
                     </th>
                     <th style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:5px;background-color:#E8E8E8;">
                        <p>Total Price</p>
                     </th>
                  </tr>
				  
                   <tr>
                     <td style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:10px" align="center">
                        <p><?php echo $builder_details['co_list_data']['title']; ?></p>
                     </td>
                     <td style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:10px" align="center">
                        <p><?php echo $builder_details['co_list_data']['due_date']; ?></p>
                     </td>
                     <td style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:10px" align="center">
                        <p><?php echo $builder_details['co_list_data']['po_status']; ?></p>
                     </td>
                     <td style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:10px" align="center">
                        <p><?php echo '$ '.$builder_details['co_list_data']['total_amount']; ?></p>
                     </td>
                  </tr> 

               </table>
            </td>
         </tr>
         <tr>
            <td colspan="2" style="padding:20px 0px;">
               <h3 style="font-size:18px">Scope of work</h3>
               <p><?php echo $builder_details['co_list_data']['scope_of_work']; ?>
               </p>
            </td>
         </tr>
         <tr>
            <td colspan="2" style="padding-top:0px; ">
               <table border="0"  cellpadding="0" cellspacing="0" width="800" style=" border-collapse: collapse; font-size:18px; color:#636363">
                  <tr>
                     <th style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:5px;background-color:#E8E8E8;">
                        <p>Cost Code</p>
                     </th>
                     <th style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:5px;background-color:#E8E8E8;">
                        <p>Qty</p>
                     </th>
                     <th style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:5px;background-color:#E8E8E8;">
                        <p>Unit Cost</p>
                     </th>
                     <th style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:5px;background-color:#E8E8E8;">
                        <p>Amount</p>
                     </th>
                  </tr>
				  <?php 
					$total_cost_code_amount = 0;
					for($i=0; $i < $count_cn; $i++)
                    {	
				  ?>
                  <tr>
                     <td style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:10px" align="center">
                        <p><?php echo $cost_variance_code[$i]; ?></p>
                     </td>
                     <td style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:10px" align="center">
                        <p><?php echo $quantity[$i]; ?></p>                        
                     </td>
                     <td style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:10px" align="center">
                        <p><?php echo '$ '.$unit_cost[$i]; ?></p>                        
                     </td>
                     <td style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:10px" align="center">
                        <p><?php echo '$ '.$total[$i]; ?></p>
                     </td>
                  </tr>
				   <?php 
					$total_cost_code_amount = $total_cost_code_amount + $total[$i];
					}
				  ?>
                  <tr>
                     <td></td>
                     <td></td>
                     <td style="  padding:10px"  align="right">
                        <p><strong>Total</strong></p>
                     </td>
                      <td style="border:2px solid #7B7B7B; border-collapse: collapse;  padding:10px" align="center">
                        <p><?php echo '$ '.number_format($total_cost_code_amount,2); ?></p>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td colspan="2" style="padding:40px 0px;">
               <p>A signature or electronic Acceptance is required for change order to be effective.</p>
            </td>
         </tr>
         <tr >
            <td colspan="2">
               <table border="0"  cellpadding="0" cellspacing="0" width="800" style="font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#626262;">
                  <tr>
                     <td style="padding: 10px 10px 2px 0px;">
                        <p>Approved: Manually by Builder</br>
                           Comment: 
                        </p>
                     </td>
                     <td align="right">
                        <p>
                           Date: <?php echo $builder_details['current_date']; ?>
                        </p>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
   </body>
</html>