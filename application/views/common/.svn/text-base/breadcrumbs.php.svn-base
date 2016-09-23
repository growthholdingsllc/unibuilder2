<?php 
if($this->user_account_type == BUILDERADMIN)
{
?>
<li><a href="<?php echo base_url().$this->crypt->encrypt('builder_dashboard/index/'); ?>">Dashboard</a></li> 
<?php 
}
else if($this->user_account_type == SUBCONTRACTOR)
{
?>
<li><a href="<?php echo base_url().$this->crypt->encrypt('subcontractor_dashboard/index/'); ?>">Dashboard</a></li> 
<?php 
}
else if($this->user_account_type == OWNER)
{
?>
<li><a href="<?php echo base_url().$this->crypt->encrypt('owner_dashboard/index/'); ?>">Dashboard</a></li> 
<?php 
}
?>
<!--<?php 
if($this->module != 'leads' && $this->module != 'setup' && $this->module != 'subcontractor' && $this->module != 'BUILDERUSER' && $this->module != 'SUBUSERS' && $this->module != 'USERROLES' && $this->module != 'preferences' && $this->module != 'my404' && $this->module != 'user' && $this->module != 'projects' && $this->module != 'docs' && $this->module != 'photos')
{
	if(!empty($this->project_name))
	{
	?>
	<li class="pro_name pull-right"><span>Project Name :</span>
	<?php if(isset($this->project_name) && $this->project_name!='')
	{
	echo $this->project_name;
	}
	?>
	</li>
	<?php 
	}
}
?>-->