<?php

if( ! defined('TTRPG-LV') ) exit;

?>

<ul>
	<li><strong>Line:</strong> diese Themen sollten im dem Spiel nicht vorkommen</li>
	<li><strong>Veil:</strong> diese Themen dürfen im Spiel vorkommen, passieren aber "Off-Screen" ohne Beschreibung</li>
	<li><strong>Okay:</strong> diese Themen dürfen im Spiel vorkommen und beschrieben werden (müssen aber nicht)</li>
</ul>

<form id="lv-form" action="post.php" method="POST">

	<?php

	if( ! empty($_REQUEST['error']) ) {
		echo '<p style="color: red;"><strong>Fehler</strong> beim speichern :( -- '.$_REQUEST['error'].'</p>';
	} elseif( isset($_REQUEST['success']) ) {
		echo '<p style="color: green;"><strong>Erfolgreich gespeichert</strong></p>';
	}

	?>

	<input type="hidden" name="group" value="<?= $group ?>">

	<table>

		<thead>
			<tr>
				<th>
					Line
				</th>
				<th>
					Veil
				</th>
				<th>
					Okay
				</th>
				<th class="topic">
					Thema
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
		<tr>
			<td class="line"><input type="radio" name="topic_<?= $id ?>" title="Line" value="line" <?= $line_checked ?> <?= $line_disabled ?>></td>
			<td class="veil"><input type="radio" name="topic_<?= $id ?>" title="Veil" value="veil" <?= $veil_checked ?> <?= $veil_disabled ?>></td>
			<td class="okay"><input type="radio" name="topic_<?= $id ?>" title="Okay" value="okay" <?= $okay_checked ?> <?= $okay_disabled ?>></td>
			<td class="topic"><?= $topic ?></td>
		</tr>
		<?php
	}
	?>

	<tr id="new-topic-line">
		<td class="new topic" colspan="4">
			<input type="text" id="new-topic" name="new" value="" placeholder="Thema"><button id="add-topic">hinzufügen</button>
		</td>
	</tr>

	<tr>
		<td colspan="4" class="submit">
			<button>Absenden</button>
		</td>
	</tr>

</form>
