<?php
/**
* @file ting_object.tpl.php
*
* Template to render objects from the Ting database.
*
* Available variables:
* - $object: The TingClientObject instance we're rendering.
* - $image: Image for the thing.
* - $title: Main title.
* - $other_titles: Also known as.
* - $alternative_titles: Array of other alternative titles. May be empty;
* - $creators: Authors of the item (string).
* - $date: The date of the thing.
* - $abstract: Short description.
*/

/* 
** modifications to object data before display
*/
//remove part after ":" in DK5-string
$dk5_pieces = explode(":", $object->record['dc:subject']['dkdcplus:DK5'][0]);
if ($dk5_pieces[0]) {
  $object->record['dc:subject']['dkdcplus:DK5'][0] = $dk5_pieces[0];
}

?>
<div id="ting-item-<?php print $object->localId; ?>" class="ting-item ting-item-full">
<div class="ting-overview clearfix">
<div class="left-column left">
<div class="picture">
  <?php 
  if ($image) { 
    if (strpos($image, 'default_image.')) {
  		switch ( (string) $object->type ) {
  		  case 'Node':
  			  $typeimg = '<img title="" alt="" src="/sites/all/themes/wellejus/images/nodepapir_180x248.png">';
  				break;
  		  case 'Tidsskrift':
  			case 'Tidsskriftsartikel':
  			case 'Periodikum':
  			  $typeimg = '<img title="" alt="" src="/sites/all/themes/wellejus/images/magasin_180x248.png">';
  				break;
  			case 'netmusik (album)':
  			case 'Netdokument':
  			  $typeimg = '<img title="" alt="" src="/sites/all/themes/wellejus/images/globe_180x248.png">';
  				break;
  			case 'CD-rom':
  			case 'Wii-spil':
  			case 'Playstation2-spil':
  			case 'XBOX-spil': 
  			case 'DVD':
  			  $typeimg = '<img title="" alt="" src="/sites/all/themes/wellejus/images/dvd_180x248.png">';
  				break;
  			case 'Lydbog (cd)':
				case 'Lydbog (cd-mp3)':
  			case 'CD':
  			  $typeimg = '<img title="" alt="" src="/sites/all/themes/wellejus/images/cd_180x248.png">';
  				break;
  		  case 'Avis':
  			case 'Avisartikel':
  			  $typeimg = '<img title="" alt="" src="/sites/all/themes/wellejus/images/avis_180x248.png">';
  				break;
  		  case 'Bog':
  			  $typeimg = '<img title="" alt="" src="/sites/all/themes/wellejus/images/bog_180x248.png">';
  				break;
  			case 'Spil':
  			case 'Billedbog':
  			case 'Video':
  			default:
  			  $typeimg = '<img title="" alt="" src="/sites/all/themes/wellejus/images/standart_180x248.png">';
  				break;
  	  }
			$image = $typeimg;
		}
		
		print $image;		
  } ?>
</div>

</div>

<div class="right-column left">
<?php if ($buttons) :?>
      <div class="ting-object-buttons">
      <?php print theme('item_list', $buttons, NULL, 'ul', array('class' => 'buttons')) ?>
</div>
<?php endif; ?>


<?php if (!empty($object->record['dc:subject']['dkdcplus:DK5']) 
				 && $object->record['dc:subject']['dkdcplus:DK5'][0] != 'sk'
				 && strpos('Bog,Node', $object->type) !== FALSE) { ?>
<h4><?php print l($object->record['dc:subject']['dkdcplus:DK5'][0], $object->record['dc:subject']['dkdcplus:DK5'][0]); ?></h4>
<?php } ?>


<h2><?php print $title; ?></h2>
<?php
      $titles = array();
      foreach (array_diff_key($object->record['dc:title'], array('' => 1)) as $type => $dc_title) {
        $titles = array_merge($titles, $dc_title);
      }
      ?>
<?php if ($other_titles) { ?>
<h2><?php print $other_titles; ?></h2>
<?php } ?>
<?php if ($alternative_titles) { ?>
<?php foreach ($alternative_titles as $title) { ?>
<h2>(<?php print check_plain($title); ?>)</h2>
<?php } ?>
<?php } ?>

<div class='creator'>
<span class='byline'><?php echo ucfirst(t('by')); ?></span>
<?php print str_replace('ting/search/', 'ting/search/dc.creator=', $creators); ?>
<?php if ($date) { ?>
<span class='date'> (<?php print $date; ?>)</span>
<?php } ?>
</div>
<p><?php print $abstract; ?></p>
<?php if ($object->subjects) : ?>
<div class='terms'>
<span class='title'><?php echo t('Terms:'); ?></span>
<?php
            $subjects = array();
            foreach ($object->subjects as $subject) {
                $subjects[] = "<span class='term'>". l($subject, 'ting/search/dc.subject='. $subject) ."</span>";
            }
             print implode(', ', $subjects);
           ?>
</div>
<?php endif; ?>

<div id="object-right">
<?php if (isset($additional_main_content)) { print drupal_render($additional_main_content); } ?>
</div>

<div id="object-left">
  <!--<span id="statuslabel"><?php print(t("Tilgængelighed:"))?></span>-->
  <?php if (isset($additional_content)) { print drupal_render($additional_content); } ?>
  <div id="more-info">
    <a onclick="javascript:$('#object-details').toggle(); $('#showInfo').toggle(); $('#hideInfo').toggle(); return false;" id="moreinfolink" href="#" style="display:none;" >
    <span id="showInfo">Vis flere detaljer</span><span id="hideInfo" style="display:none;">Skjul detaljer</span></a>
  </div>
</div>

</div>



</div>


<div id="object-details"class="object-information clearfix">
<?php
    //we printed the first part up above so remove that
    unset($object->record['dcterms:abstract'][''][0]);
    ?>
<div class="abstract"><?php print implode(' ; ', format_danmarc2((array)$object->record['dcterms:abstract'][''])) ?></div>

<?php print theme('item_list', array($object->type), t('Type'), 'span', array('class' => 'type')); ?>
<?php if (!empty($object->record['dc:format'][''])) { ?>
<?php print theme('item_list', $object->record['dc:format'][''], t('Format'), 'span', array('class' => 'format'));?>
<?php } ?>
<?php if (!empty($object->record['dcterms:isPartOf'][''])) { ?>
<?php print theme('item_list', $object->record['dcterms:isPartOf'][''], t('Available in'), 'span', array('class' => 'is-part-of'));?>
<?php } ?>


<?php if (!empty($object->language)) { ?>
<?php print theme('item_list', array($object->language), t('Language'), 'span', array('class' => 'language'));?>
<?php } ?>
<?php if (!empty($object->record['dc:language']['oss:spoken'])) { ?>
<?php print theme('item_list', $object->record['dc:language']['oss:spoken'], t('Speech'), 'span', array('class' => 'language'));?>
<?php } ?>
<?php if (!empty($object->record['dc:language']['oss:subtitles'])) { ?>
<?php print theme('item_list', $object->record['dc:language']['oss:subtitles'], t('Subtitles'), 'span', array('class' => 'language'));?>
<?php } ?>

<?php if (!empty($object->record['dc:subject']['oss:genre'])) { 
  foreach ($object->record['dc:subject']['oss:genre'] as $subject_genre) {
    $subjects_genre[] = l($subject_genre, 'ting/search/dc.subject='. $subject_genre);
  }
  print theme('item_list', $subjects_genre, t('Genre'), 'span');?>
<?php } ?>

<?php if (!empty($object->record['dc:subject']['dkdcplus:DK5'])) { 
  foreach ($object->record['dc:subject']['dkdcplus:DK5'] as $subject_DK5) {
    $subjects_DK5[] = l($subject_DK5, 'ting/search/dc.subject='. $subject_DK5);
  }
  print theme('item_list', $subjects_DK5, t('Classification'), 'span');?>
<?php } ?>
<?php if (!empty($object->record['dcterms:spatial'][''])) { ?>
<?php print theme('item_list', $object->record['dcterms:spatial'][''], NULL, 'span', array('class' => 'spatial')); ?>
<?php } ?>

<?php if (!empty($object->record['dc:contributor']['oss:dkind'])) { ?>
<?php print theme('item_list', $object->record['dc:contributor']['oss:dkind'], t('Reader'), 'span', array('class' => 'contributor'));?>
<?php } ?>
<?php if (!empty($object->record['dc:contributor']['oss:act'])) { ?>
<?php print theme('item_list', $object->record['dc:contributor']['oss:act'], t('Actor'), 'span', array('class' => 'contributor'));?>
<?php } ?>
<?php if (!empty($object->record['dc:contributor']['oss:mus'])) { ?>
<?php print theme('item_list', $object->record['dc:contributor']['oss:mus'], t('Musician'), 'span', array('class' => 'contributor'));?>
<?php } ?>

<?php if (!empty($object->record['dcterms:hasPart']['oss:track'])) { ?>
<?php print theme('item_list', $object->record['dcterms:hasPart']['oss:track'], t('Contains'), 'span', array('class' => 'contains'));?>
<?php } ?>

<?php if (!empty($object->record['dcterms:isReferencedBy'][''])) { ?>
<?php print theme('item_list', $object->record['dcterms:isReferencedBy'][''], t('Referenced by'), 'span', array('class' => 'referenced-by'));?>
<?php } ?>


<?php if (!empty($object->record['dc:description'])) { ?>
<?php foreach ($object->record['dc:description'] as $type => $dc_description) { ?>
<?php print theme('item_list', $dc_description, t('Description'), 'span', array('class' => 'description'));?>
<?php } ?>
<?php } ?>

<?php if (!empty($object->record['dc:source'][''])) { ?>
<?php print theme('item_list', $object->record['dc:source'][''], t('Original title'), 'span', array('class' => 'titles'));?>
<?php } ?>
<?php if (!empty($object->record['dcterms:replaces'][''])) { ?>
<?php print theme('item_list', $object->record['dcterms:replaces'][''], t('Previous title'), 'span', array('class' => 'titles'));?>
<?php } ?>
<?php if (!empty($object->record['dcterms:isReplacedBy'][''])) { ?>
<?php print theme('item_list', $object->record['dcterms:isReplacedBy'][''], t('Later title'), 'span', array('class' => 'titles'));?>
<?php } ?>

<?php if (!empty($object->record['dc:identifier']['dkdcplus:ISBN'])) { ?>
<?php print theme('item_list', $object->record['dc:identifier']['dkdcplus:ISBN'], t('ISBN no.'), 'span', array('class' => 'identifier'));?>
<?php } ?>

<?php
    /* wiredloose: We will display the online_url instead of original identifier-line in Vejle Bibliotekerne */
    if (!empty($object->record['dc:identifier']['dcterms:URI'])) {
      $uris = array();
      foreach ($object->record['dc:identifier']['dcterms:URI'] as $uri) {
        /* wiredloose: LINE OVERRIDDEN 
        $uris[] = l($uri, $uri);
        */
        $uris[] = l($object->online_url, $object->online_url);
      }
      print theme('item_list', $uris, t('Host publication'), 'span', array('class' => 'identifier'));
    }
    ?>

<?php if (!empty($object->record['dkdcplus:version'][''])) { ?>
<?php print theme('item_list', $object->record['dkdcplus:version'][''], t('Version'), 'span', array('class' => 'version'));?>
<?php } ?>

<?php if (!empty($object->record['dcterms:extent'][''])) { ?>
<?php print theme('item_list', $object->record['dcterms:extent'][''], t('Extent'), 'span', array('class' => 'version'));?>
<?php } ?>
<?php if (!empty($object->record['dc:publisher'][''])) { ?>
<?php print theme('item_list', $object->record['dc:publisher'][''], t('Publisher'), 'span', array('class' => 'publisher'));?>
<?php } ?>
<?php if (!empty($object->record['dc:rights'][''])) { ?>
<?php print theme('item_list', $object->record['dc:rights'][''], t('Rights'), 'span', array('class' => 'rights'));?>
<?php } ?>
</div>
<script charset="UTF-8" type="text/javascript">
$('#object-details').toggle(); $('#moreinfolink').toggle();
</script>

<?php
  $collection = ting_get_collection_by_id($object->id);
  if ($collection instanceof TingClientObjectCollection && is_array($collection->types)) {
    // Do we have more than only this one type?
    if (count($collection->types) > 1) {
      print '<div class="ding-box-wide object-otherversions">';
      print '<h3>'. t('Also available as: ') . '</h3>';
      print "<ul>";
      foreach ($collection->types as $type) {
        if ($type != $object->type) {
          $material_links[] = '<li class="category">' . l($type, $collection->url, array('fragment' => $type)). '</li>';
        }
      }
      print implode(' ', $material_links);
      print "</ul>";
      print "</div>";
    }
  }
  ?>

</div>
