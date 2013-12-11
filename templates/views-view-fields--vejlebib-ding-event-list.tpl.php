<?php

/**
 * @file views-view-fields--vejlebib-ding-event-list.tpl.php
 */
// Prepare a couple of variables.

// Get locale drawn from language settings
global $language;
$langcode = $language->language;
$start = strtotime($fields['field_ding_event_date_1']->content);
$price = ($fields['field_ding_event_price']->content < 1) ? t('Free') : intval($fields['field_ding_event_price']->content) . ' kr.';
$slug = $fields['field_ding_library_slug']->content;
?>
<?php foreach ($fields as $id => $field): ?>
  <?php if (!empty($field->separator)): ?>
    <?php print $field->separator; ?>
  <?php endif; ?>

  <?php
  // Format date with HTML for a leaf - use drupal's format_date()
  if($id == 'field_ding_event_date_1') {
    print '<div class="event-list-date-wrapper ' . $slug . '">
      <span class="event-list-day">' . format_date($start, 'custom', 'l', $langcode) .'</span>
      <div class="event-list-inner-wrapper">
        <span class="event-list-date">' . format_date($start, 'custom', 'j', $langcode) .'</span>
        <span class="event-list-month">' . format_date($start, 'custom', 'M', $langcode) .'</span>
      </div>
    </div>';
  }
  // Output price calculated above
  elseif ($id == 'field_ding_event_price') {
    print $price;
  }
  // Print rest of fields except library slug
  elseif ($id != 'field_ding_library_slug') {
    print $field->wrapper_prefix;
    print $field->label_html;
    print $field->content;
    print $field->wrapper_suffix;
  }
  ?>
<?php endforeach; ?>
