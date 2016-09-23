<?php if(isset($result_array) && !empty($result_array)){
   //print_r($result_array);exit;
   //echo(count($result_array['system_file_name']));exit;?>
<?php foreach ($result_array as $key => $value) {?>
<div class="row m-top">
   <div class="col-xs-4">
      <input type="hidden" class="form-control" name="name[]" value="<?php echo $value['name'] ?>"/>
      <label><?php echo $value['name'] ?></label>
     
     
   </div>
   <div class="col-xs-2 text-center">
   
   <div class="preview_file <?php if(isset($value['system_file_name'])){?>show<?php } else{?>hide<?php }?>">
   <div class="imagePreview"><img src="<?php if(isset($value['system_file_name'])){ echo  DOC_URL.$value['system_file_name'];  }?>" /></div>
   <div class="close_file"><!-- <a href="javascript:void(0);" onclick="delete_pic(<?php echo $value['file_id']; ?>)" class="close-file"><img src="<?php echo IMAGESRC.'file_close.png'; ?>"/></a> --></div>
   </div>
   
   <div class="file_name <?php if(isset($value['system_file_name'])){?>show<?php } else{?>hide<?php }?>"><?php if(isset($value['system_file_name'])) { echo $value['ui_file_name']; } ?></div>
   <div class="<?php if(isset($value['system_file_name'])){?>hide<?php } else{?>show<?php }?>" > No File Attached
   <!-- <input type="file" name="attachment[]" class="file_up" value="" /> -->
   </div>
  
   </div>
   <!-- <div class="col-xs-6">
      <p>No Document attached</p>
   </div> -->
</div> 
<?php }  }?>

<?php if(isset($documents_data) && !empty($documents_data)){?>
<?php foreach ($documents_data as $key => $value) {?>
<div class="row m-top">
   <div class="col-xs-4">
      <input type="hidden" class="form-control" name="name[]" value="<?php echo $value['name'] ?>"/>
     <label><?php echo $value['name'] ?></label>
     
   </div>
   <div class="col-xs-2 text-center">
   <div class="preview_file">
   <div class="imagePreview"></div>
   <div class="close_file"><a href="javascript:void(0);" class="close-file"><img src="<?php echo IMAGESRC.'file_close.png'; ?>"/></a></div>
   </div>
   <!-- <input type="hidden" name="delete_val[]" class="delete_val" value="0"> -->
   <div class="file_name"></div>
   <div class="btn btn-blue btn-file browse"> <img border="0" class="uni_attchment_second" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Browse
   <input type="file" name="attachment[]" class="file_up" value="" />
   </div>
   </div>
   <!-- <div class="col-xs-6">
      <p>No Document attached</p>
   </div> -->
</div> 
<?php } } ?>