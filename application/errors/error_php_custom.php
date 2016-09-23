<?php
// Unique error identifier
$error_id = uniqid('error'); ?>
<link rel="stylesheet" href="<?php echo CSSSRC.'error-php-custom.css';?>">	
<script type="text/javascript">
	document.documentElement.className = 'js';
	function koggle(elem)
	{
		elem = document.getElementById(elem);

		if (elem.style && elem.style['display'])
			// Only works with the "style" attr
		var disp = elem.style['display'];
		else if (elem.currentStyle)
			// For MSIE, naturally
		var disp = elem.currentStyle['display'];
		else if (window.getComputedStyle)
			// For most other browsers
		var disp = document.defaultView.getComputedStyle(elem, null).getPropertyValue('display');

		// Toggle the state of the "display" style
		elem.style.display = disp == 'block' ? 'none' : 'block';
		return false;
	}
</script>

<div id="exception_error">
	<h1><span class="type"><?php echo $type ?> [ <?php echo $code ?> ]:</span> <span class="message"><?php echo $message ?></span></h1>
	<div id="<?php echo $error_id ?>" class="content">
		<p><span class="file"><?php echo UNI_Exceptions::debug_path($file) ?> [ <?php echo $line ?> ]</span></p>
		
		<?php echo UNI_Exceptions::debug_source($file, $line) ?>
		
		<ol class="trace">
			<?php foreach (UNI_Exceptions::trace($trace) as $i => $step): ?>
			<li>
				<p>
					<span class="file">
					<?php if ($step['file']): $source_id = $error_id.'source'.$i; ?>
						<a href="#<?php echo $source_id ?>" onclick="return koggle('<?php echo $source_id ?>')"><?php echo UNI_Exceptions::debug_path($step['file']) ?> [ <?php echo $step['line'] ?> ]</a>
					<?php else: ?>
						{<?php echo 'PHP internal call'; ?>}
					<?php endif ?>
					</span>
					&raquo;
					<?php echo $step['function'] ?>(<?php if ($step['args']): $args_id = $error_id.'args'.$i; ?><a href="#<?php echo $args_id ?>" onclick="return koggle('<?php echo $args_id ?>')"><?php echo 'arguments' ?></a><?php endif ?>)
				</p>
			<?php if (isset($args_id)): ?>
				<div id="<?php echo $args_id ?>" class="collapsed">
					<table cellspacing="0">
					<?php foreach ($step['args'] as $name => $arg): ?>
						<tr>
							<td><code><?php echo $name ?></code></td>
							<td><pre><?php echo print_r($arg, TRUE) ?></pre></td>
						</tr>
					<?php endforeach ?>
					</table>
				</div>
			<?php endif ?>
			<?php if (isset($source_id)): ?>
				<pre id="<?php echo $source_id ?>" class="source collapsed"><code><?php echo $step['source'] ?></code></pre>
			<?php endif ?>
			</li>
			<?php unset($args_id, $source_id); ?>
			<?php endforeach ?>
		</ol>
	</div>

	<h2><a href="#<?php echo $env_id = $error_id.'environment' ?>" onclick="return koggle('<?php echo $env_id ?>')"><?php echo 'Environment' ?></a></h2>
	<div id="<?php echo $env_id ?>" class="content collapsed">
	
	<?php $included = get_included_files() ?>
		<h3><a href="#<?php echo $env_id = $error_id.'environment_included' ?>" onclick="return koggle('<?php echo $env_id ?>')"><?php echo 'Included files' ?></a> (<?php echo count($included) ?>)</h3>
		<div id="<?php echo $env_id ?>" class="collapsed">
			<table cellspacing="0">
			<?php foreach ($included as $file): ?>
				<tr>
					<td><code><?php echo UNI_Exceptions::debug_path($file) ?></code></td>
				</tr>
			<?php endforeach ?>
			</table>
		</div>

	<?php $included = get_loaded_extensions() ?>
		<h3><a href="#<?php echo $env_id = $error_id.'environment_loaded' ?>" onclick="return koggle('<?php echo $env_id ?>')"><?php echo 'Loaded extensions' ?></a> (<?php echo count($included) ?>)</h3>
		<div id="<?php echo $env_id ?>" class="collapsed">
			<table cellspacing="0">
			<?php foreach ($included as $file): ?>
				<tr>
					<td><code><?php echo UNI_Exceptions::debug_path($file) ?></code></td>
				</tr>
			<?php endforeach ?>
			</table>
		</div>
		
	<?php foreach (array('_SESSION', '_GET', '_POST', '_FILES', '_COOKIE', '_SERVER') as $var): ?>
		<?php if (empty($GLOBALS[$var]) OR ! is_array($GLOBALS[$var])) continue ?>
		<h3><a href="#<?php echo $env_id = $error_id.'environment'.strtolower($var) ?>" onclick="return koggle('<?php echo $env_id ?>')">$<?php echo $var ?></a></h3>
		<div id="<?php echo $env_id ?>" class="collapsed">
			<table cellspacing="0">
			<?php foreach ($GLOBALS[$var] as $key => $value): ?>
				<tr>
					<td><code><?php echo $key ?></code></td>
					<td><pre><?php echo print_r($value, TRUE) ?></pre></td>
				</tr>
			<?php endforeach ?>
			</table>
		</div>
	<?php endforeach ?>
	</div>
</div>
