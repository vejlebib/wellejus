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
<div>
  INSERT INTO event (title, description, place, address, postcode, city, country, date_day, date_month, date_year, hour, minute, no_capacity_limit, ticket_type, ticket_price) VALUES ('<?php print $fields['title']->content; ?>', '<?php print $fields['field_teaser_value']->content; ?>/r/n<?php print $fields['body']->content; ?>', '<?php print $fields['field_library_ref_nid']->content; ?>', '<?php print $fields['street']->content; ?>', '<?php print $fields['postal_code']->content; ?>', '<?php print $fields['city']->content; ?>', '<?php print $fields['country']->content; ?>', <?php print dynamo_datef($start, 'j');?>, '<?php print dynamo_datef($start, 'M');?>', <?php print dynamo_datef($start, 'Y');?>, <?php print dynamo_datef($start, 'H');?>, <?php print dynamo_datef($start, 'i');?>, 1, 'standard', <?php print $fields['field_entry_price_value']->raw;?>);  
</div>
<br/>







