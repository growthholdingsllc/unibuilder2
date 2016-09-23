 <?php // echo "<pre>"; print_r($builder_details); ?>
 <?php 
   $count_cn = 0;
   if(!empty($get_cost_code_result['cost_code_description']))
   {
     $description = explode(",",$get_cost_code_result['cost_code_description']);
     $count_cn = count($description);
   }
   if(!empty($get_cost_code_result['ub_bid_cost_code_id']))
   {
     $cost_code_id = explode(",",$get_cost_code_result['ub_bid_cost_code_id']);
   }
   if(!empty($get_cost_code_result['cost_code_id']))
   {
     $ub_cost_code_id = explode(",",$get_cost_code_result['cost_code_id']);
   }
   if(!empty($get_cost_code_result['cost_code_id']))
   {
     $cost_code_id_dropdown = explode(",",$get_cost_code_result['cost_code_id']);
   }
   if(!empty($get_cost_code_result['cost_variance_code']))
   {
    $cost_variance_code = explode(",",$get_cost_code_result['cost_variance_code']);
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
	 <table border="0" align="center" cellpadding="0" cellspacing="0" style="width:800px; margin:10px auto; font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#181818;">	 
		<tr>
		   <td align="center" colspan="2">
			  <img src="<?php if(isset($this->builder_logo_url) && !empty($this->builder_logo_url))
                        {echo $this->builder_logo_url;} 
                        else{echo IMAGESRC.'print_image/logo.png';}
                        ?>" width="460" height="124" alt="logo" />
			   			  
		   </td>
		</tr>
		<tr>
			<td height="40">
				<p style="font-size:18px;color:#727272" align="left"><?php echo ucwords($builder_details['builder_address']).' '; ?></p> 
			</td>
			<td>
				<p  style="font-size:18px;color:#727272" align="right"><img src="<?php echo IMAGESRC.'print_image/phone.png'; ?>"> Phone : <?php echo $builder_details['builder_phone']; ?>
			  </p>
			</td>
		</tr>
		<tr>
			<td colspan="2"><hr/></td>			
		</tr>
		<tr>
		   <td colspan="2" style=" padding: 7px 14px 13px;" align="right"><strong>Print-date: <?php echo $builder_details['current_date']; ?></strong></td>
		</tr>
		<tr>
		   <td colspan="2">
			  <table border="0" align="center" cellpadding="0" cellspacing="0" style="border:2px solid #7B7B7B;  font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#181818; width:100%;">
				 <tr >
					<td style="background-color:#7B7B7B; padding:13px;color:#ffffff" colspan="2">
					   <p>Project Name: <?php echo ucwords($builder_details['project_name']);?></p>
					   <p>Project Address: <?php echo ucwords($builder_details['project_address']);?> </p>
					</td>
				 </tr>
				 <tr>
					<td style="padding-left:13px">
					   <p>&nbsp;</p>
					   <h4>Bid Package Name</h4>
					   <?php echo $bid_data['package_title']; ?>
					</td>
					<td style="padding:13px;float:right;">
					   <p>Status: <?php echo $bid_data['status']; ?></p>
					   <p>DeadLine: <?php echo $bid_data['due_date']; ?></p>
					</td>
				 </tr>
				 <tr>
					<td colspan="2">
					   <hr>
					</td>
				 </tr>
				 <tr>
					<td style="padding:13px" colspan="2">
					   <h4>Bid Package Description</h4>
					   <?php echo (!empty($bid_data['description']))?$bid_data['description']:'N/A'; ?>
					</td>
				 </tr>
				 <?php 
				 if(isset($bid_data['pricing_format']) && $bid_data['pricing_format'] == "Line Items" && $count_cn > 0)
				 {	 
				 ?>
				 <tr>
					<td style="padding:13px" colspan="2">
					   <h4>Pricing</h4>
					   <table style="border:2px solid #7B7B7B;  border-collapse: collapse; padding: 10px;  font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#181818;" border="0" align="center" cellpadding="0" cellspacing="0" width="800" >
						  <tr style="background-color:#E8E8E8 " >
							 <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">Cost Code</th>
							 <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">Sub Description</th>
						  </tr>
						  <?php 
						   for($i=0; $i < $count_cn; $i++)
						   {
						   ?> 
						  <tr  >
							 <td align="center" style=" border:2px solid #7B7B7B; border-collapse: collapse; padding: 10px;">
								<?php echo $cost_variance_code[$i]; ?>

							 </td>
							 <td align="center"style=" border:2px solid #7B7B7B; border-collapse: collapse; padding: 10px;" >
								<p><?php echo $description[$i]; ?></p>
								
							 </td>
						  </tr>
						  <?php 
                            }
                          ?> 
					   </table>
					</td>
				 </tr>
				 <?php 
				 }
				 else if(isset($bid_data['pricing_format']) && $bid_data['pricing_format'] == "Flat Fee" && count($request_data)>0)
			     {	
				 ?>
				 <tr>
					<td style="padding:13px" colspan="2">
					   <h4>Pricing</h4>
					   <p>Flat Fee</p>
					</td>
				 </tr>	   
				 <?php 
				 }
				 if(isset($bid_data['has_checklist']) && $bid_data['has_checklist'] == 'Yes' && !empty($checklist_info))
				 {
				 ?>
				 <tr>
					<td style="padding:13px" colspan="2">
					   <h4>Checklist</h4>
					   <table border="0" align="center" cellpadding="0" cellspacing="0" style="border:2px solid #7B7B7B; border-collapse: collapse; font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#181818;" width="800">
						  <tr>
							 <td style="padding:10px">
								<p><?php echo $checklist_info; ?></p>
							 </td>
						  </tr>
					   </table>
					</td>
				 </tr>
				 <?php 
				 }
				 if(count($request_data)>0)
				 {
				 ?>
				 <tr>
					<td style="padding:13px" colspan="2">
					   <h4>Invited Subcontractors</h4>
					   <table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#181818;border:2px solid #7B7B7B; border-collapse: collapse;" width="800">
						  <tr style="background-color:#E8E8E8 ;border:2px solid #7B7B7B; border-collapse: collapse; ">
							 <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">sub</th>
							 <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">Released</th>
							 <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">Sub viewed</th>
							 <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">will Bids</th>
							 <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">Submitted</th>
							 <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">Amount</th>
							 <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">Status</th>
						  </tr>
						  <?php foreach ($request_data as $key => $value) {?>
						  <tr>
						   <td style=" border:2px solid #7B7B7B; border-collapse: collapse;"><?php echo $value['subcontractor_name'];?></td>
						   <td style=" border:2px solid #7B7B7B; border-collapse: collapse;"><?php echo $value['released_date'];?></td>
						   <td style=" border:2px solid #7B7B7B; border-collapse: collapse;"><?php echo $value['sub_viewed'];?></td>
						   <td style=" border:2px solid #7B7B7B; border-collapse: collapse;"><?php echo $value['will_bid'];?></td>
						   <td style=" border:2px solid #7B7B7B; border-collapse: collapse;"><?php echo $value['submitted'];?></td>
						   <td style=" border:2px solid #7B7B7B; border-collapse: collapse;"><?php echo $value['bid_amount'];?></td>
						   <td style=" border:2px solid #7B7B7B; border-collapse: collapse;"><?php echo $value['bid_sub_status'];?></td>
						  </tr>
						  <?php } ?>
					   </table>
					</td>
				 </tr>
				 <?php 
				 }
				 ?>
			  </table>
		   </td>
		</tr>
		<tr>
		   <td colspan="2">&nbsp;</td>
		</tr>		
		<!--<tr>
		   <td align="right" style="padding:20px 0px"><img src="<?php echo IMAGESRC.'print_image/footer-logo.png'; ?>"></td>
		</tr>-->
	 </table>
  </body>
</html>