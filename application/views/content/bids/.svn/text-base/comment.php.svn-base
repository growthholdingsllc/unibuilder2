   <div id="comments_area">
   <p>&nbsp;</p>
   <?php if($comments_list != false){?><p> <span class="pull-right"><a href='javascript:void(0);' class="comment-image" data-toggle="modal" data-target="#commentModal"><img border="0" class="uni_new_comment" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a></span> </p><?php } ?>
    <label>Discussions</label>
    <div class="jumbotron">
      <div id="comment_block">
       <?php 
         if($comments_list != false){?>
          <div class="inner-jumbotron" id="list_comments_div">
          <?php
            $count = 1;
            $class = "";
            foreach ($comments_list as $key => $value) 
            {
             if($value['account_type'] == '100')
             {
               $class = 'alert alert-info';
               $added_by = 'Added By Builder';
             }
             if($value['account_type'] == '300')
             {
               $class = 'alert alert-warning';
               $added_by = 'Added By Sub';
             }
             if($value['account_type'] == '200')
             {
               $class = 'alert alert-success';
               $added_by = 'Added By Owner';
             }
          ?>
          <div class="<?php echo $class;?>" role="alert">
            <div class="row">
               <div class="col-xs-11">
                  <p><?php echo $value['comments'] ?>.</p>
                  <p class="text-muted">- <?php echo $value['first_name'] ?> on <?php echo $value['comment_created_on'] ?><p><?php echo $added_by; ?></p></p>
               </div>
               <div class="col-xs-1">
                 <?php if($value['created_by'] == $this->user_id){ ?>
                 <p><a href='javascript:void(0);' id="<?php if(isset($value['ub_comments_id'])) echo $value['ub_comments_id']; ?>" onclick="delete_comment(this.id)"><img src="<?php echo IMAGESRC.'delete.png'; ?>"></a></p>
                 <?php } ?>
               </div>
            </div>
          </div>
          <?php 
           $count++;
           }
      
          ?>        
          </div>
          <?php } ?>
          <div>
        </div>
      </div>
      <p class="text-center">
        <?php if($comments_list != true){ ?><button class="btn btn-blue" type="button" data-toggle="modal" data-target="#commentModal">
		<img border="0" class="uni_new_comment" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Add Comment</button><?php } ?>
      </p>
   </div>
</div>

<!-- Delete Comment -->
<div class="modal fade confirmModal" id="confirm_comment_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Are you sure you want to delete?       
      </h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">              
              <div class="row col-xs-12">                       
        <button class="btn btn-gray m-left-1 pull-right" type="button" id="cancel_comment_confirm" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> CANCEL</button>  
        <button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_comment_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> OK</button>        
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>