<?php //echo "<pre>"; print_r($builder_details); ?>
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
					<p style="font-size:18px;color:#727272" align="left"><?php echo ucwords($builder_details['builder_address']).' '; ?>  </p>                    
				</td>
				<td>
					<p style="font-size:18px;color:#727272" align="right"><img src="<?php echo IMAGESRC.'print_image/phone.png'; ?>" /> Phone : <?php echo $builder_details['builder_phone']; ?></p>
				</td>
			</tr>
			<tr>
				<td colspan="2"><hr/></td>				
			</tr>
            <tr>
                <td colspan="2" style=" padding: 7px 14px 13px;" align="right"><strong>Print-date:<?php echo $builder_details['current_date']; ?></strong></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table border="0" align="center" cellpadding="0" cellspacing="0" style="border:2px solid #7B7B7B;  font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#181818;">
                        <tr >
                            <td style="padding: 10px;background-color:#7B7B7B; color:#ffffff" >
                                <p>Project Name: <?php echo $builder_details['project_name'];?></p>
                                <p>Project Address: <?php echo ucwords($builder_details['project_address']);?> </p>
                            </td>
                            <td style="font-size: 18px; color:#ffffff;background-color:#7B7B7B;">
                                <p>Owner: <?php echo ucwords($owner_name);?></br>
                                </p>
                            </td>
                        </tr>
                        <?php foreach ($result_data as $key => $value) {?>
                        <tr>
                            <td style="padding: 10px; font-size: 18px;color:#181818;">
                                <p>Selection Name: <?php echo $value['title'];?></br>
                                    Remaining From Allowance: <?php echo $value['allowance'];?></br>
                                    Due date: <?php echo $value['due_date'];?>
                                </p>
                            </td>
                            <td style="font-size: 18px; color:#181818">
                                <p>Category: <?php echo $value['category'];?></br>
                                    Location: <?php echo $value['location'];?></br>
                                    Status: <?php echo $value['status'];?>
                                </p>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="2">
                                <hr>
                            </td>
                        </tr>
                        <?php foreach ($choice_result_data as $key => $value) {?>
                        <tr>
                            <td style="padding:13px" colspan="2">
                                <p>Choices</p>
                                <table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#181818;border:2px solid #7B7B7B; border-collapse: collapse;" width="800">
                                    <tr style="background-color:#E8E8E8 ;border:2px solid #7B7B7B; border-collapse: collapse; ">
                                        <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">choice</th>
                                        <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">Added by</th>
                                        <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">Details</th>
                                        <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">Status</th>
                                        <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">Price</th>
                                        <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">Vendor</th>
                                        <th style=" border:2px solid #7B7B7B; border-collapse: collapse;">Installer</th>
                                    </tr>
                                    <tr>
                                        <td align="center" style=" border:1px solid #7B7B7B; border-collapse: collapse;  padding: 10px;">
                                            <p><?php echo $value['title'];?></p>
                                        </td>
                                        <td align="center" style=" border:1px solid #7B7B7B; border-collapse: collapse;  padding: 10px;">
                                            <p><?php echo $value['creator'];?></p>
                                        </td>
                                        <td align="center" style=" border:1px solid #7B7B7B; border-collapse: collapse;  padding: 10px;">
                                            <p><?php echo $value['description'];?></p>
                                        </td>
                                        <td align="center" style=" border:1px solid #7B7B7B; border-collapse: collapse;  padding: 10px;">
                                            <p><?php echo $value['status'];?></p>
                                        </td>
                                        <td align="center" style=" border:1px solid #7B7B7B; border-collapse: collapse;  padding: 10px;">
                                            <p><?php echo $value['owner_price'];?></p>
                                        </td>
                                        <td align="center" style=" border:1px solid #7B7B7B; border-collapse: collapse; padding: 10px;" >
                                            <p><?php echo $value['first_name'];?></p>
                                        </td>
                                        <td align="center" style=" border:1px solid #7B7B7B; border-collapse: collapse;  padding: 10px;">
                                            <p><?php echo $value['first_name'];?></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:13px" colspan="2">
                                <table border="0" align="center" cellpadding="0" cellspacing="0" style=" border-collapse: collapse; font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#181818;" width="800">
                                    <tr>
                                        <td style="padding:10px 200px;"></td>
                                        <td style="padding:10px;float:right;border:2px solid #7B7B7B; "  >
                                            <p>Total amount exceeded allowance :<?php echo $value['owner_price'];?></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:13px" colspan="2">
                                <table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#181818;" width="800">
                                    <tr>
                                        <td style="padding:10px" >
                                            <p>Approved by: <?php echo $value['creator'];?> Date: <?php echo $value['created_on'];?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td   style="padding: 10px 10px 50px;" >
                                            <p>Comments: <?php echo $value['sub_pricing_comments'];?> </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  height="20px" style="padding:10px" >
                                            <p>Disclaimer</p>
                                            <p><?php echo $selection_disclaimer;?></p>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
        </table>
    </body>
</html>
