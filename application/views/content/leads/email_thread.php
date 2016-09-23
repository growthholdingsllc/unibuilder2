<?php 
   if (isset($no_email_thread) && !empty($no_email_thread)) 
   {
      echo '<div class="col-xs-12" center>'. $no_email_thread .'</div>';exit;

   }
   else
   {
      $count = 1;
      foreach($email_thread as $key=>$value) { 
   	?>
<div class="col-xs-12 mail-thread">
   <div class="mail-thread-con">
      <input type="hidden" class="message_id" id="message_id" value="<?php echo $value['ub_message_id']; ?>">
      <p>
         <label>From: </label>
         <?php echo $value['from_email_id'] ?> 
      </p>
      <p>
         <label>Sent: </label>
         <?php echo $value['sent_on'] ?> 
      </p>
      <p>
         <label>To: </label>
         <?php 
            if (!empty($value['to_other_emails'])) 
            {
               $email_id = array();
            	$level1_array = explode(EMAIL_SEPERATOR_LEVEL1, $value['to_other_emails']);
            	foreach($level1_array as $key => $level2_string)
               {
                  $email_address_array = explode(EMAIL_SEPERATOR_LEVEL2, $level2_string);
                  $email_id[] = $email_address_array['1'];
               }
               $to_email = implode(", ", $email_id);
               	echo $to_email; 
            }
            ?> 
      </p>
      <p>
         <label>CC: </label>
         <?php 
            if (isset($value['cc_other_emails']) && !empty($value['cc_other_emails'])) 
            {
            	$email_id = array();
              	$level1_array = explode(EMAIL_SEPERATOR_LEVEL1, $value['cc_other_emails']);
              	foreach($level1_array as $key => $level2_string)
            	{
            		$email_address_array = explode(EMAIL_SEPERATOR_LEVEL2, $level2_string);
            		$email_id[] = $email_address_array['1'];
            	}
            	$cc_email = implode(", ", $email_id);
            	echo $cc_email; 
            } 
            ?> 
      </p>
      <p>
         <label>Subject: </label>
         RE: <?php echo $value['subject'] ?> 
      </p>
      <hr />
      <?php echo $value['message_body'] ?>
      <hr />
   </div>
   
   <?php
      if (!empty($atachment_data)) 
      {
   ?>
   <p>
      <label><span class="glyphicon glyphicon-paperclip"></span> <u>Attachments</u></label>
   </p>
   <?php   
         for ($i=0; $i < count($atachment_data) ; $i++) 
         { 
            $ext = pathinfo($atachment_data[$i]['sys_file_name'], PATHINFO_EXTENSION);
            $actualdata = json_decode(DEFAULT_THUMB_IMAGE_ARRAY, true);
            $download_url = 'leads'.'/download_file';
            $file_download_url = $download_url.'/'.$activity_folder_id.'/'.$atachment_data[$i]['sys_file_name'];
            $encoded_download_url = $this->crypt->encrypt($file_download_url);
   ?> 
            <p><a href="<?php echo $encoded_download_url;?>" class="attachment-image"><img src="<?php echo $actualdata[$ext]['16']; ?>" /> <?php echo $atachment_data[$i]['file_name']; ?></a></p>
   <?php 
         }
      }
   ?>
   
   <hr />
   <div class="col-xs-12 text-right">
      <div class="action-btn">
         <?php 
            if ($count === 1) { ?>
            <a href="javascript:void(0);"  class="reply_forward" id="mail-reply-button-<?php echo $value['ub_message_id']; ?>">
				<button class="btn btn-blue" type="button"><img class="uni_reply" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Reply</button>
			</a> 
            <a href="javascript:void(0);" class="reply_forward" id="mail-reply-all-button-<?php echo $value['ub_message_id']; ?>">
				<button class="btn btn-blue" type="button"><img class="uni_replyall" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Reply All</button>
			</a> 
            <a href="javascript:void(0);" class="reply_forward" id="forward-button-<?php echo $value['ub_message_id']; ?>">
				<button class="btn btn-blue" id="forward" type="button"><img class="uni_forward" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Forward</button>
			</a> 
            <?php
            }
            else{ ?>
               <a href="javascript:void(0);" class="reply_forward" id="forward-button-<?php echo $value['ub_message_id']; ?>"><button class="btn btn-blue" id="forward" type="button"><img class="uni_forward" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Forward</button></a> 
           <?php }
         ?>
      </div>
   </div>
</div>
<?php $count++; } 
   if ($TotalRows > 1) 
   {
?>
   <div class="row clear-fix">
      <div class="col-md-4 pull-right">
         <button  id="previous" class="btn btn-sm btn-primary" onclick="onclick_previous();">Previous</button>
         <lable>Page <lable id="page_number" class="<?php echo $page_no; ?>"><?php echo $page_no; ?></lable> of <lable id="total_page" class="<?php echo $TotalRows; ?>"><?php echo $TotalRows; ?></lable></lable>
         <button  id="next" class="btn btn-sm btn-primary" onclick="onclick_next();">Next</button>
      </div>
   </div>
<?php 
   }
}
?>
