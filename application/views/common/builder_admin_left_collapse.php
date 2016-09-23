<?php 
$all_data = $this->session->all_userdata(); 
// echo '<pre>';print_r($all_data);
$type=$all_data['ACCOUNT_TYPE'];
$commom_projects = isset($all_data['ACCOUNT'][$type]['COMMON']['COLLAPSE_PROJECT_LIST'])?$all_data['ACCOUNT'][$type]['COMMON']['COLLAPSE_PROJECT_LIST']:array();
$commom_projects = $this->users_project_list;
?>
<div class="pull-left">
	<div class="side-menu">
		<a href="javascript:void(0);" class="arrow-left">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<p>Viewing&nbsp;Projects</p>
		</a>
		<div class="col-xs-12 jobs-menu">			
				 <div class="jobs-menu-details pull-left">
				 <div class="col-xs-12" >
				 <?php
					echo form_dropdown('display_type[]', array('project_view'=>'Project View','template_view'=>'Template View'), 'Template View', "class='selectpicker form-control' id='display_type' data-live-search='true'");
				 ?>
				 </div>
				 <?php
						if(count($commom_projects) > 0 && isset($commom_projects) && !empty($commom_projects))
						{
						?>
					<div class="col-xs-12" >
						<div class="right-inner-addon">        
						<i class="glyphicon glyphicon-search"></i>
						<input type="search" class="form-control" id="Search_filter" placeholder="Search" />
						</div>
					</div>
					<div class="col-xs-12">
						<ul class="filter">
						
							<li class="<?php if(empty($this->project_id)&&($this->project_id == '')) echo "selected";?>"><a class="text-filter" href="javascript:void(0);" id="all_project" onclick="project_click(this.id)">All Projects</a></li>
						<?php
						foreach($commom_projects as $key=>$val)
						{
						?>
							<li class="<?php if(!empty($this->project_id)&&($this->project_id == $key)) echo "selected";?>"><a class="text-filter" href="javascript:void(0);" id="<?php echo $key; ?>" title="<?php echo $val; ?>" onclick="project_click(this.id,this.title)"><?php echo $val; ?> </a> <a href='<?php echo base_url().$this->crypt->encrypt('projects/save_project/'.$key).'#viewingaccess'; ?>'><span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span></a><a href='<?php echo base_url().$this->crypt->encrypt('projects/save_project/'.$key); ?>'><span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span></a></li>
						<?php
						}
						
						?>
							
						</ul>						
					</div>	
					<?php 
					}
					else
					{ 
						$controller_name = $this->router->fetch_class();
						// echo '<pre>';print_r($controller_name);exit;
						?>
						No project is created / assigned to you.
						<a href='<?php echo base_url().$this->crypt->encrypt('projects/save_project/'); ?>'> Please create a project</a>
						<?php
						if(isset($controller_name) && $controller_name != 'builder_dashboard')
						{
					?>
					No project is created / assigned to you .
					<a href='<?php echo base_url().$this->crypt->encrypt('projects/save_project/'); ?>' class="no_project"> Please create a project</a>
					<?php
						}
					} 
					?>					
				 </div>
		 </div>
	</div>
</div>
<script type="text/javascript">
//left_collapse function
function project_click(project_id,project_name)
{ 
	//alert(project_id); return false;
	var encoded_destroy_session = Base64.encode('builder_dashboard/set_project_details_in_session/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);

	var redirect_url = document.URL;	
	var ajaxUrl = base_url + find_users_basedon_project;
	jQuery.ajax({
		type:'POST',
		url:ajaxUrl,
		dataType:"json",
		data:'project_id='+project_id+'&project_name='+project_name+'&redirect_url='+redirect_url,
		success:function(res) {
			if(res.status == true){	
				window.location.href= res.redirect_url;
				location.reload(true);
			}
			/* if($('.filter li').hasClass("budget_enable")){
				var encoded_urls = Base64.encode('budget/project_budget/');
				var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
				window.location.href= base_url + ajax_encoded_urls;
			} */
		}
	});
}
</script>