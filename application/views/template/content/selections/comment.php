   <p>&nbsp;</p>
   <?php if($comments_list != false){?><p> <span class="pull-right"><a href='javascript:void(0);' class="comment-image" data-toggle="modal" data-target="#commentModal"><img alt="home" class="uni_new_comment" src="<?php echo IMAGESRC.'strip.gif'?>" border="0"/></a></span> </p><?php } ?>
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
             if($count%2!=0 && $count%3!=0 && $count%1==0)
             {
               $class = 'alert alert-info';
             }
             if($count%2==0 && $count%3!=0)
             {
               $class = 'alert alert-warning';
             }
             if($count%2!=0 && $count%3==0)
             {
               $class = 'alert alert-success';
             }
          ?>
          <div class="<?php echo $class;?>" role="alert">
            <div class="row">
               <div class="col-xs-11">
                  <p><?php echo $value['comments'] ?>.</p>
                  <p class="text-muted">- <?php echo $value['first_name'] ?> on <?php echo $value['comment_created_on'] ?></p>
               </div>
               <div class="col-xs-1">
                 <?php if($value['show_owner'] == 'Yes') { ?><p><a href="#"> <img class="uni_owner" src="<?php echo IMAGESRC.'strip.gif'; ?>"</p><?php } ?>
                 <?php if($value['show_sub'] == 'Yes') { ?><p><a href="#"> <img class="uni_sub" src="<?php echo IMAGESRC.'strip.gif'; ?>"></span></a></p><?php } ?>
         
                 <p><a href='javascript:void(0);' id="<?php if(isset($value['ub_comments_id'])) echo $value['ub_comments_id']; ?>" onclick="delete_comment(this.id)"><img src="<?php echo IMAGESRC.'delete.png'; ?>"</a></p>
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