<!-- views-view-fields--vejlebib-article-list.tpl.php -->

<?php
// Prepare variables.
$libString = $fields['field_library_ref_nid_1']->content;
$libString = strtolower( str_replace(" Bibliotek", "", $libString) );
// Translating danish characters, avoiding character set issues when styling with CSS afterwards
$trans = array("æ" => "ae", "Æ" => "AE", "ø" => "o", "Ø" => "O", "å" => "aa", "Å" => "AA");
$libString = strtr($libString, $trans);
?>

<div class="subject"><?php print $fields['tid']->content; ?> </div>

<h2 class="<?php print $libString; ?>"><?php print $fields['title']->content; ?></h2>

<div class="meta">
	 <?php print $fields['created']->content; ?>

	<?php if($fields['name']->content){ ?>
		<i><?php print t('by'); ?></i>
		<span class="author"><?php print $fields['name']->content; ?></span>
	<?php } ?>

	<?php 
	   if($fields['comment_count']->raw >= "1"){
	     print "(". $fields['comment_count']->content .")";
	   }  
	?>

</div>

<?php 
if($fields['field_teaser_value']->content OR $fields['body']->content){
?>
	<p>
 	<?php print $fields['field_teaser_value']->content; ?>  
 	<?php print $fields['body']->content; ?>    
	</p>
    <div class="more-link"><?php print $fields['view_node']->content; ?></div>
	
<?php } ?>


<?php if($fields['edit_node']->content){ ?>
	<?php print $fields['edit_node']->content; ?>
<?php } ?>

