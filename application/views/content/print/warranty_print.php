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
					 <p style="font-size:18px;color:#727272" align="left"><?php echo ucwords($builder_details['builder_address']).' '; ?> </p>
                    
				</td>
				<td>
					<p style="font-size:18px;color:#727272" align="right"><img src="<?php echo IMAGESRC.'print_image/phone.png'; ?>"> Phone : <?php echo $builder_details['builder_phone']; ?></p>
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
                    <table border="0" align="center" cellpadding="0" cellspacing="0" style="border:2px solid #7B7B7B;  font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#181818;">
                        <tr >
                            <td style="padding: 10px;background-color:#7B7B7B; color:#ffffff" >
                                <p>Project Name: <?php echo $builder_details['project_name'];?></p>
                                </p>
                                <p>Project Address: <?php echo ucwords($builder_details['project_address']);?> </p>
                            </td>
                            <td style="font-size: 18px; color:#ffffff;background-color:#7B7B7B;">
                                <p>Owner: <?php echo ucwords($owner_name);?></br>
                                </p>
                            </td>
                        </tr>
                        <?php foreach ($warranty_args as $key => $value) {?>
                        <tr>
                            <td style="padding: 10px; font-size: 18px;color:#181818;">
                                <p>Title: <?php echo $value['title'];?></br>
                                    Due date: <?php echo $value['created_on'];?>
                                </p>
                            </td>
                            <td style="font-size: 18px; color:#181818">
                                <p>Category: <?php echo $value['category'];?></br>
                                    Priority: <?php echo $value['priority'];?></br>
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
                        <tr>
                            <td style="padding:13px" colspan="2">
                                <table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#181818;border:2px solid #7B7B7B; border-collapse: collapse;" width="800">
                                    <?php foreach ($warranty_args as $key => $value) {?>
                                    <tr >
                                        <td style="font-size: 18px;color:#181818;">
                                            Description of the Problem:
                                        </td>
                                    </tr>
                                    <tr >
                                        <td style="padding:10px 10px 170px;">
                                            <?php echo $value['problem_description'];?>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td style="padding:10px;border:1px solid #7B7B7B;font-size: 18px;color:#181818;">
                                            <p>Service Coordinator: <?php echo $value['first_name'];?></br>
                                                Classification: <?php echo $value['classification'];?></br>
                                                Orig.Item.User: <?php echo $value['first_name'];?>
                                            </p>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </td>
                        </tr>
						<?php 
						if(isset($appoinment_args[0]))
						{
						?>
                        <tr>
                            <td style="padding:13px" colspan="2">
                                <table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#181818;border:2px solid #7B7B7B; border-collapse: collapse;" width="800">
                                    <tr >
                                        <td style="font-size: 18px;color:#181818;">
                                            Final Work Approval
                                        </td>
                                    </tr>
                                    <?php foreach ($appoinment_args as $key => $value) {?>
                                    <tr>
                                        <td style="padding:10px;font-size: 18px;color:#181818;">
                                            <p>Feedback: <?php echo $value['status'];?></p>
                                            <p>Completion Date: <?php echo $value['completion_date'];?></p>
                                            <p>Feedback Date: <?php echo $value['modified_on'];?></p>
                                            <p>Feedback by: <?php echo $value['first_name'];?></p>
                                            <p>Approval Comments</p>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td style="padding:10px 10px 100px;">
                                            <?php echo $value['approval_comments'];?>
                                        </td>
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
           
        </table>
    </body>
</html>
