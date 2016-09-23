<div class="row">
   <ol class="breadcrumb">
      <li class="active">Dashboard</li>
   </ol>
</div>
<div class="row">
   <div class="col-xs-12 dashboard-body">
      <div class="col-xs-4">
         <div class="col-xs-12">
            <div class="panel panel-primary">
               <div class="panel-heading"><a href="javascript:void(0);" id="mail_notification_refresh" class="glyphicon glyphicon-refresh pull-right" aria-hidden="true"></a> <strong>MAIL NOTIFICATION</strong></div>
               <div class="panel-body">
                  <!-- mail notifications list -->
                  <div id="load_mail_notification_to_div" class="scroll-pane">
                     <?php $this->load->view('content/dashboard/dashboard_sections/mail_notification'); ?>
                  </div>
               </div>
            </div>
            <div class="panel panel-primary">
               <div class="panel-heading"><a href="javascript:void(0);" class="glyphicon glyphicon-refresh pull-right" id="task_refresh" aria-hidden="true"></a> <strong>TASK'S</strong></div>
               <div class="panel-body">
                  <div class="panel panel-default">
                     <!-- tasks list -->
                     <div id="load_task_to_div" class="scroll-pane">
                        <?php $this->load->view('content/dashboard/dashboard_sections/tasks'); ?>
                     </div>
                  </div>
               </div>
            </div>
				<div class="panel panel-primary" id="weather-disable">
					<div class="panel-heading"><a href="javascript:void(0);" id="weather_refresh" class="glyphicon glyphicon-refresh pull-right" aria-hidden="true"></a> <strong>CURRENT WEATHER</strong></div>
					<div id="load_weather_to_div">
						<?php $this->load->view('content/dashboard/dashboard_sections/current_weather'); ?>
					</div>
				</div>
         </div>
         <div class="col-xs-12">
            <div class="panel panel-primary project-cost">
               <div class="panel-heading "><strong>WARRANTY ALERT'S</strong><a href="javascript:void(0);" id="warranty_refresh" class="glyphicon glyphicon-refresh pull-right" aria-hidden="true"></a> </div>
               <div class="panel-body">
                  <!-- warranty alert list -->
                  <div id="load_warranty_to_div" class="scroll-pane">
                     <?php $this->load->view('content/dashboard/dashboard_sections/warranty_alerts'); ?>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xs-12">
            <div class="panel panel-primary project-cost">
               <div class="panel-heading "><strong>SELECTIONS</strong><a href="javascript:void(0);" id="selection_refresh" class="glyphicon glyphicon-refresh pull-right" aria-hidden="true"></a> </div>
               <div class="panel-body">
                  <!-- warranty alert list -->
                  <div id="load_selection_to_div" class="scroll-pane">
                     <?php $this->load->view('content/dashboard/dashboard_sections/selections_alerts'); ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
	  <div class="col-xs-8">
		<!-- Jssor Slider Begin -->
    <!-- To move inline styles to css file/block, please specify a class name for each element. --> 
    <div id="slider2_container" style="position: relative; top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden; ">
        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            
        </div>
        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1300px; height: 500px; overflow: hidden;">
			<?php 
			if(isset($recent_images))
			{
				foreach($recent_images as $key => $val)
				{
				?>
				<div>
					<img u="image" src="<?php echo $val; ?>" />
					<img u="thumb" src="<?php echo $val; ?>" />
				</div>
				<?php 
				}
			}
			?>
        </div>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora02l" style="top: 123px; left: 8px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora02r" style="top: 123px; right: 8px;">
        </span>        
        <div u="thumbnavigator" class="jssort03" style="left: 0px; bottom: 0px;">
            <!-- the following background element is optional -->
            <div style=" background-color: #000; filter:alpha(opacity=30); opacity:.3; width: 1300px; height:100%;"></div>
            <!-- Thumbnail Item Skin Begin -->
            <div u="slides" style="cursor: default;">
                <div u="prototype" class="p">
                    <div class=w><div u="thumbnailtemplate" class="t"></div></div>
                    <div class=c></div>
                </div>
            </div>            
        </div>
		</div>
	  </div>
   </div>
</div>
<script type="text/javascript">           
   this.owner_dashboard_page = 'yes';    
</script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">	
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'owner_slider.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'jssor.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jssor.slider.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'owner_dashboard.js';?>"></script>