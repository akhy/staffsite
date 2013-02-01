<?php 

function tw_control($label, $error = null, $controls)
{
	$label = form_label(humanize($label), $label, array('class' => 'control-label'));
	$error_class = is_null($error) ? '' : 'error';

	return <<< EOT
	<div class="control-group $error_class">
		$label
		<div class="controls">
			$controls
			<span class="help-inline">$error</span>
		</div>
	</div>
EOT;
}

function tw_error($text)
{
}
