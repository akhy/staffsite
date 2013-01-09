<?php 

function tw_control($label, $controls)
{
	$label = form_label(humanize($label), $label, array('class' => 'control-label'));

	return <<< EOT
	<div class="control-group">
		$label
		<div class="controls">
			$controls
		</div>
	</div>
EOT;
}
