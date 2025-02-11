<?php

define( 'TTRPG-LV', 'view' );

include_once('include/helper.php');
include_once('include/variables.php');

include_once('snippets/head.php');
?>
<body id="offline">

<main>
	<h1>Lines & Veils</h1>

	<?php
	if( $group ) {
		include_once('snippets/form.php');
	} else {
		include_once('snippets/login.php');
	}
	?>

</main>

</body>
</html>