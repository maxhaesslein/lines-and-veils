<?php

if( ! defined('LINESANDVEILS') ) exit;

?>

<ul>
	<li><strong><?= __('Line') ?>:</strong> <?= __('these themes should not be in the game' ) ?></li>
	<li><strong><?= __('Veil') ?>:</strong> <?= __('these themes may occur in the game, but happen "off-screen" without description') ?></li>
	<li><strong><?= __('Okay') ?>:</strong> <?= __('these topics may be included and described in the game (but don\'t have to be)') ?></li>
</ul>

<form id="lv-form" action="post.php" method="POST">

	<?php

	if( ! empty($_REQUEST['error']) ) {
		echo '<p style="color: red;"><strong>'.__('Error').'</strong> '.__('while saving').' :( -- '.$_REQUEST['error'].'</p>';
	} elseif( isset($_REQUEST['success']) ) {
		echo '<p style="color: green;"><strong>'.__('Successfully saved').'</strong></p>';
	}

	?>

	<input type="hidden" name="group" value="<?= $group ?>">

	<table>

		<thead>
			<tr>
				<th>
					<?= __('Line') ?>
				</th>
				<th>
					<?= __('Veil') ?>
				</th>
				<th>
					<?= __('Okay') ?>
				</th>
				<th class="topic">
					<?= __('Theme') ?>
				</th>
			</tr>
		</thead>

	<?php
	foreach( $topics as $topic => $value ) {

		$id = sanitize_title($topic);

		$line_checked = '';
		$veil_checked = '';
		$okay_checked = '';

		$line_disabled = '';
		$veil_disabled = '';
		$okay_disabled = '';

		if( $value == 'line' ) {
			$line_checked = 'checked';
			$veil_disabled = 'disabled';
			$okay_disabled = 'disabled';
		} elseif( $value == 'veil' ) {
			$veil_checked = 'checked';
			$okay_disabled = 'disabled';
		} else {
			$okay_checked = 'checked';
		}

		?>
		<input type="hidden" name="<?= $id ?>" value="<?= sanitize_title($topic, false) ?>">
		<tr class="state-<?= $value ?>">
			<td class="line"><label><input type="radio" name="topic_<?= $id ?>" title="<?= __('Line') ?>" value="line" <?= $line_checked ?> <?= $line_disabled ?>></label></td>
			<td class="veil"><label><input type="radio" name="topic_<?= $id ?>" title="<?= __('Veil') ?>" value="veil" <?= $veil_checked ?> <?= $veil_disabled ?>></label></td>
			<td class="okay"><label><input type="radio" name="topic_<?= $id ?>" title="<?= __('Okay') ?>" value="okay" <?= $okay_checked ?> <?= $okay_disabled ?>></label></td>
			<td class="topic"><?= $topic ?></td>
		</tr>
		<?php
	}
	?>

	<tfoot>
		<tr id="new-topic-line">
			<th class="new topic" colspan="4">
				<span class="new-form-wrapper">
					<input type="text" id="new-topic" name="new" value="" placeholder="<?= __('Theme') ?>"><button id="add-topic"><?= __('add') ?></button>
				</span>
			</th>
		</tr>
		<tr>
			<th colspan="4" class="submit">
				<button><?= __('send') ?></button>
			</th>
		</tr>
	</tfoot>

</form>
