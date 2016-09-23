<a href="javascript:void(0);" class="btn btn-danger btn-sm btn-block compose_mailer replay_email" role="button" id=1>COMPOSE</a>
 <!-- Navigation - folders-->
 <ul class="nav nav-pills nav-stacked m-top message_nav">
	<?php
	$message_folders = isset($msg_data['message_folders'])?$msg_data['message_folders']:'';
	$unread_message_count = isset($msg_data['unread_message_count'])?$msg_data['unread_message_count']:'';
	$draft_message_count = isset($msg_data['draft_message_count'])?$msg_data['draft_message_count']:'';
	$inboxcount = "";
	$draftcount = "";
	// echo "<pre>"; print_r($msg_data);
	if($unread_message_count['inbox_count'] > 0)
	{
		$inboxcount = " ( ".$unread_message_count['inbox_count']." )";
	}
	if($draft_message_count['draft_count'] > 0)
	{
		$draftcount = " ( ".$draft_message_count['draft_count']." )";
	}
	
	for($i=0;$i<count($message_folders);$i++)
	{ ?>
	<li class="<?php if($message_folders[$i]['ub_message_folder_id'] == $msg_data['current_folder_id']) echo "active";?>"><a href="javascript:void(0);" id="<?php echo $message_folders[$i]['ub_message_folder_id'];?>" class="message_inbox" >	
	<i class=""><img class="<?php echo 'uni_mes_'.$message_folders[$i]['folder_name'];?>" src="<?php echo IMAGESRC.'strip.gif'; ?>" /> </i>
	<?php echo " ".$message_folders[$i]['folder_name'] ;
	switch (trim($message_folders[$i]['folder_name'])) 
	{
		case 'Inbox': //inbox
			echo $inboxcount;
			break;
		case 'Draft': //inbox
			echo $draftcount;
			break;
	}
	?></a></li>
	<?php
	} ?>
 </ul>
