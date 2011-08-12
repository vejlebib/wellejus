<?php
// $Id$

// Prepare a couple of variables.
$start = date_make_date($fields['field_datetime_value']->raw);
$price = ($fields['field_entry_price_value']->raw < 1) ? t('Free') : intval($fields['field_entry_price_value']->raw) . ' kr.';
$libString = $fields['field_library_ref_nid_1']->content;
$libString = strtolower( str_replace(" Bibliotek", "", $libString) );
// Translating danish characters, avoiding character set issues when styling with CSS afterwards
$trans = array("æ" => "ae", "Æ" => "AE", "ø" => "o", "Ø" => "O", "å" => "aa", "Å" => "AA");
$libString = strtr($libString, $trans);
?>
<div class="calendar-leafs">

  <div class="leaf <?php print $is_today ?> <?php print $libString; ?>">
    <div class="day"><?php print dynamo_datef($start, 'l');?></div>
    <div class="date"><?php print dynamo_datef($start, 'j');?></div>
    <div class="month"><?php print dynamo_datef($start, 'M');?></div>
  </div>
  
  <div class="info">
    <h4><?php print $fields['title']->content; ?></h4>
    <span><?php print $fields['field_library_ref_nid']->content; ?></span>
    <?php if (dynamo_datef($start, 'Hi') != '0000'): ?>
    <div class="time">
			<?php print dynamo_datef($start, 'H:i'); ?> - <?php print $price; ?>
    </div>
    <?php endif; ?>    
  </div>

</div>