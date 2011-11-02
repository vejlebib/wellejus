<?php
// $Id$

/**
 * @file
 * CUSTOM Template to render nodes - vbcontent, showing ONLY the body text.
 */

?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">

	<div class="content">
		<?php print $node->content['body']['#value'] ?>
	</div>

</div>
