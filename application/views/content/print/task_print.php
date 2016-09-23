<?php //echo "<pre>"; print_r($builder_details['task_data']); ?>
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
      <table border="0" align="center" cellpadding="0" cellspacing="0" style="width:800px; margin:10px auto; font-family:Arial, Helvetica, sans-serif; font-size:14px;color:#626262;">
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
				<p style="font-size:18px" align="left"><?php echo $builder_details['builder_address'].' '; ?> 
               </p>
			</td>
			<td>
				<p style="font-size:18px" align="right"><img src="<?php echo IMAGESRC.'print_image/phone.png'; ?>"> Phone : <?php echo $builder_details['builder_phone']; ?> 
               </p>
			</td>
		 </tr>
		 <tr>
			<td colspan="2"><hr/></td>
		 </tr>
         <tr>
            <td colspan="2" style=" padding: 7px 14px 13px;" align="right">Print-date: <?php echo $builder_details['current_date']; ?></td>
         </tr>
         <tr>
            <td colspan="2">
               <table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:Arial, Helvetica, sans-serif; font-size:16px;color:#181818;border:2px solid #7B7B7B;">
                  <tr >
                     <td style="background-color:#7B7B7B; padding:13px;color:#ffffff" colspan="2">
                        <p><strong>Project Name: <?php echo $builder_details['project_name']; ?></strong></p>
                        <p><strong>Project Address: <?php echo $builder_details['project_address']; ?></strong> </p>
                     </td>
                  </tr>
                  <tr>
                     <td style="padding: 10px 290px 2px 10px; font-size: 18px;color:#181818">
                        <p>Task Title: <?php echo $builder_details['task_data']['title']; ?></br>
                           Created By: <?php echo $builder_details['task_data']['creator']; ?></br>
                           Assigned To: <?php echo $builder_details['task_data']['assignedto']; ?>
                        </p>
                     </td>
                     <td style="font-size: 18px; color:#181818">
                        <p>Status: <?php echo $builder_details['task_data']['status']; ?></br>
                           DeadLine: <?php echo $builder_details['task_data']['due_date']; ?></br>
                           Priority: <?php echo $builder_details['task_data']['priority']; ?>
                        </p>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        <hr>
                     </td>
                  </tr>
                  <tr>
                     <td style="padding:13px" colspan="2">
                        <h4>Notes</h4>
                        <p><?php echo $builder_details['task_data']['note']; ?></p>
                     </td>
                  </tr>
                  <tr>
                     <td style="padding:13px" colspan="2">
                        <h4>Check List</h4>
                        <form action="">
                           <?php 
                              $count_cn = 1;
                              if(!empty($builder_details['task_data']['description']))
                              {
                                 $description = explode(",",$builder_details['task_data']['description']);
                                 $count_cn = count($description);
                              }
                              if(!empty($builder_details['task_data']['description_checkbox']))
                              {
                                 $description_checkbox = explode(",",$builder_details['task_data']['description_checkbox']);
                                 //echo '<pre>';print_r($description_checkbox);exit;
                              }
                           for($i=0; $i < $count_cn; $i++)
                            {
                            ?>   
                              <input type="checkbox" name="" value="" style="width: 29px;height: 23px;" disabled="disabled" <?php if(isset($description_checkbox[$i]) && !empty($description_checkbox[$i]) && $description_checkbox[$i] === 'Yes') echo  "checked='checked'";?> ><?php if(isset($description[$i])) {echo $description[$i];} ?><br/>
                           <?php } ?>
                           
                        </form>
                     </td>
                  </tr>
                  <tr>
                     <td style="padding:13px" colspan="2">
                        <h4>Tags</h4>
                        <table border="0" align="center" cellpadding="0" cellspacing="0" style="border:2px solid #7B7B7B; border-collapse: collapse;" width="800">
                           <tr>
                              <td style="padding:10px">
                                 <p><?php echo $builder_details['task_data']['tags']; ?></p>
                              </td>
                           </tr>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td style="padding:13px" colspan="2">
                        <h4>Photos(s)</h4>
                        <?php for($i=0; $i < count($builder_details['file_path']); $i++)
                            {
                            ?>   
                              <img src="<?php echo $builder_details['file_path'][$i]; ?>" height="300" width="300"/><br/>
                           <?php if($i != count($builder_details['file_path'])-1) {echo '<p>&nbsp;</p>';} } ?>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
   </body>
</html>