<?php
// $Id: views-view-list.tpl.php,v 1.3 2008/09/30 19:47:11 merlinofchaos Exp $
?>

    <?php foreach ($rows as $id => $row): ?>
      <p><?php print $row; ?></p>
    <?php endforeach; ?>