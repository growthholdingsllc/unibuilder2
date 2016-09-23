<link rel="stylesheet" href="<?php echo CSSSRC.'thumbnail.css';?>">
<div class="page-wrap">
	 <div class="profile">
		<div class="profile-avatar-wrap">
			<?php
					if (!empty($profile_pic)) 
					{
						$profile_pic = DOC_URL.$profile_pic;
						$profile_pic12 = DOC_URL.$profile_pic;
					}					
					else
					{
						if(isset($signature_img) && !empty($signature_img)){
							$profile_pic = IMAGESRC.'drag_drop_signature.jpg';
						}
						else{
							$profile_pic = IMAGESRC.'default.jpg';
						}
					}
			?>
		   <img src="<?php echo $profile_pic; ?>" id="profile-avatar" alt="Image for Profile">
		</div>
	 </div>
	 <div class="upload <?php if(isset($profile_pic12) && !empty($profile_pic12)){echo 'pointer_none';}else{echo 'pointer_enab';}?>">		
		<input type="file" id="uploader" class="custom-file-input" name="profile_pic" />
	 </div>
</div>  
<div class="row">
<div class="col-xs-12 text-left">
	<button id="profile_pic_delete" class="btn btn-danger delete m-top" type="button" onclick="delete_pic(<?php if(!empty($profile_pic_id)){echo $profile_pic_id;} ?>)" >Delete</button>
</div>    
</div>    

<script type="text/javascript" src="<?php echo JSSRC.'profile_upload.js';?>"></script>