   <p>&nbsp;</p>
   <?php if($comments_list != false){?><p> <span class="pull-right"><a href='javascript:void(0);' class="comment-image" data-toggle="modal" data-target="#commentModal"><img alt="home" src="<?php echo IMAGESRC.'comment-add.png'?>" border="0"/></a></span> </p><?php } ?>
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
                 <?php if($value['show_owner'] == 'Yes') { ?><p><img src="<?php echo IMAGESRC.'owner.png'; ?>" title="Owner"></p><?php } ?>

                 <?php if($value['show_sub'] == 'Yes') { ?><p><img src="<?php echo IMAGESRC.'sub.png'; ?>" title="Subcontractor"></p><?php } ?>
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