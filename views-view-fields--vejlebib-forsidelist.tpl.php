<?php //dsm($fields); ?>

<div class="image">
  <?php print $fields['field_image_fid']->content; ?>
</div>


<div class="info">
  <h3><?php print l($fields['title']->content, $fields['field_link_teaser_url']->raw); ?></h3>
  <p><?php print $fields['field_text_teaser_value']->content; ?></p>
</div>



