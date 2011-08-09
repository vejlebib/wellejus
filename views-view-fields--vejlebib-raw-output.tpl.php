<?php
// $Id$

// Prepare a couple of variables.
$sales_period_start = $fields['changed']->content;
$sales_period_end = $fields['field_datetime_value']->raw;

$price = ($fields['field_entry_price_value']->raw < 1) ? t('Free') : intval($fields['field_entry_price_value']->raw) . ' kr.';
$libString = $fields['field_library_ref_nid_1']->content;
$libString = strtolower( str_replace(" Bibliotek", "", $libString) );
// Translating danish characters, avoiding character set issues when styling with CSS afterwards
$trans = array("æ" => "ae", "Æ" => "AE", "ø" => "o", "Ø" => "O", "å" => "aa", "Å" => "AA");
$libString = strtr($libString, $trans);
?>

<?php print $fields['nid']->content . "\t"; ?>
<?php print $fields['title']->content . "\t"; ?>
<?php print $fields['field_teaser_value']->content . "\t"; ?>
<?php print $fields['body']->content . "\t"; ?>
<?php print $fields['field_library_ref_nid']->content . "\t"; ?>
<?php print $fields['street']->content . "\t"; ?>
<?php print $fields['postal_code']->content . "\t"; ?>
<?php print $fields['city']->content . "\t"; ?>
<?php print $fields['country']->content . "\t"; ?>
<?php print $fields['field_datetime_value']->raw . "\t";?>
<?php print $fields['field_datetime_value2']->raw . "\t";?>
<?php print "-1\t";?>
<?php print "standard\t";?>
<?php print $fields['field_entry_price_value']->raw . "\t";?>
<?php print $sales_period_start . "\t";?>
<?php print $sales_period_end . "\t";?>







