<?php
/**
 * @file ting_object.tpl.php
 *
 * Template to render objects from the Ting database.
 */
 
//list available variables: 
//dpm(get_defined_vars());

/* 
** modifications to object data before display
*/
//remove part after ":" in DK5-string
//how to do this when working with $ting_classification_links?? string replace?
$wellejus_path = str_replace("/wellejus-opac", "", path_to_theme());

?>
<div id="ting-item-<?php print $ting_local_id; ?>" class="ting-item ting-item-full">
  <div class="ting-overview clearfix">
    <div class="left-column left">
      <div class="picture">
        <?php if ($image) { 
        		if (strpos($image, 'default_image.')) {
          		switch ( (string) $object->type ) {
          		  case 'Node':
          			  $typeimg = '<img title="" alt="" src="/' . $wellejus_path . '/images/nodepapir_180x248.png">';
          				break;
          		  case 'Tidsskrift':
          			case 'Tidsskriftsartikel':
          			case 'Periodikum':
          			  $typeimg = '<img title="" alt="" src="/' . $wellejus_path . '/images/magasin_180x248.png">';
          				break;
          			case 'Musik (net)':
          			case 'Netdokument':
      					case 'Lydbog (net)':
          			  $typeimg = '<img title="" alt="" src="/' . $wellejus_path . '/images/globe_180x248.png">';
          				break;
          			case 'Cd-rom':
          			case 'Wii':
          			case 'Playstation':
      					case 'Playstation 2':
      					case 'Playstation 3':
          			case 'Xbox': 
          			case 'Xbox 360': 
          			case 'Dvd':
      					case 'Blu-ray':
          			  $typeimg = '<img title="" alt="" src="/' . $wellejus_path . '/images/dvd_180x248.png">';
          				break;
          			case 'Lydbog (cd)':
      					case 'Lydbog (cd-mp3)':
          			case 'Cd (musik)':
          			  $typeimg = '<img title="" alt="" src="/' . $wellejus_path . '/images/cd_180x248.png">';
          				break;
          		  case 'Avis':
          			case 'Avisartikel':
          			  $typeimg = '<img title="" alt="" src="/' . $wellejus_path . '/images/avis_180x248.png">';
          				break;
          		  case 'Bog':
          			  $typeimg = '<img title="" alt="" src="/' . $wellejus_path . '/images/bog_180x248.png">';
          				break;
          			case 'Spil':
          			case 'Billedbog':
      					case 'Tegneserie':
      					case 'Video':
      					case 'Lydbog (bånd)':
          			default:
          			  $typeimg = '<img title="" alt="" src="/' . $wellejus_path . '/images/standart_180x248.png">';
          				break;
        	  }
      			$image = $typeimg;
      		}
				
				  print $image; ?>
				
				<?php } ?>
      </div>

    </div>

    <div class="right-column left">
      
			
			<?php if ($buttons) :?>
            <div class="ting-object-buttons">
            
            <?php
            /* START wiredloose: in vejlebib, use modified online_URL for OPACs */
            $proxy = variable_get('ting_proxy', NULL);
            if (!empty($object->online_url)) {
              if (!empty($object->record['dc:identifier']['dcterms:URI'][0]) && !empty($proxy['prefix']) ) {
                $object->online_url = str_replace($proxy['prefix'], "", $object->online_url);
              }
            }
            foreach ($buttons as $key => $value) {
              	if ($value['class']=='view-online') {
                  	$buttons[$key]['data'] = "<a href=\"" . $object->online_url . "\">See online</a>";
                      $buttons[$key]['class'] = "view-online opac";
                  }
            }
            /* END wiredloose: in vejlebib, use modified online_URL for OPACs */
            
            print theme('item_list', $buttons, NULL, 'ul', array('class' => 'buttons')) ?>
            </div>
      <?php endif; ?>

      <?php if (!empty($object->record['dc:subject']['dkdcplus:DK5']) 
      				 && $object->record['dc:subject']['dkdcplus:DK5'][0] != 'sk'
      				 && strpos('Bog,Node', $object->type) !== FALSE) { ?>
        <h4><?php print $ting_classification_links[0]; ?></h4>
      <?php } ?>
			
			<h2><?php print $ting_title; ?></h2>

      <div class='creator'>
        <?php if (sizeof($ting_creators_links) == 1) { ?>
          <span class='byline'><?php echo ucfirst(t('by')); ?></span>
          <?php print $ting_creators_links[0]; ?>
        <?php } ?>
        <?php if ($ting_publication_date) { ?>
          <span class='date'>(<?php print $ting_publication_date; ?>)</span>
        <?php } ?>
      </div>

      <?php if (isset($ting_title_full)) { ?>
        <p class="title-info">
           <span class="label"><?php print t('Additional title information:')?></span>
          <?php print $ting_title_full; ?>
        </p>
      <?php }?>

      <p class="abstract"><?php print $ting_abstract; ?></p>

      <?php if (isset($ting_series_links)) { ?>
        <p class="series">
         <span class="label"><?php print t('Series:')?></span>
          <?php print theme('item_list', $ting_series_links, NULL, 'span'); ?>
        </p>
      <?php } ?>
			
			<?php if ($object->subjects) : ?>
        <div class='terms'>
          <span class='title'><?php echo t('Terms:'); ?></span>
          <?php
            $subjects = array();
            foreach ($object->subjects as $subject) {
                $subjects[] = "<span class='term'>". l($subject, 'ting/search/dc.subject=\''. $subject . '\'') .'</span>';
            }
             print implode(', ', $subjects);
           ?>
        </div>
      <?php endif; ?>

      <?php if (isset($additional_main_content)) { print drupal_render($additional_main_content); } ?>
			
			<?php if (isset($additional_content)) { print drupal_render($additional_content); } ?>
			
			<div id="more-info">
        <a onclick="javascript: $('#ting-details').toggle(); $('#showInfo').toggle(); $('#hideInfo').toggle(); return false;" id="moreinfolink" href="#">
          <span id="showInfo">Vis flere detaljer</span>
					<span id="hideInfo" style="display:none;">Skjul detaljer</span>
			  </a>
      </div>
			
    </div>

  </div>

  <div id="ting-details" class="object-information ting-details clearfix">
  	<div class="ting-properties">
  	
      <?php print theme('item_list', array($ting_type), t('Type'), 'span', array('class' => 'type')); ?>
  		
  		<?php if (!empty($ting_language)) { ?>
      <?php print theme('item_list', array($ting_language), t('Language'), 'span', array('class' => 'language'));?>
      <?php } ?>
      <?php if (!empty($object->record['dc:language']['oss:spoken'])) { ?>
      <?php print theme('item_list', $object->record['dc:language']['oss:spoken'], t('Speech'), 'span', array('class' => 'language'));?>
      <?php } ?>
      <?php if (!empty($object->record['dc:language']['oss:subtitles'])) { ?>
      <?php print theme('item_list', $object->record['dc:language']['oss:subtitles'], t('Subtitles'), 'span', array('class' => 'language'));?>
      <?php } ?>
  		
  		<?php if (!empty($object->record['dc:subject']['oss:genre'])) { 
        foreach ($object->record['dc:subject']['oss:genre'] as $subject_genre) {
          $subjects_genre[] = l($subject_genre, 'ting/search/dc.subject=\''. $subject_genre .'\'');
        }
        print theme('item_list', $subjects_genre, t('Genre'), 'span');?>
      <?php } ?>
      
  		<?php if (!empty($ting_classification_links)) { ?>
  		  <?php print theme('item_list', $ting_classification_links, t('Classification'), 'span', array('class' => 'classification')); ?>
      <?php } ?>
  		
  		<?php if (!empty($ting_listing_links)) { ?>
  		  <?php print theme('item_list', $ting_listing_links, t('Listing'), 'span', array('class' => 'listing')); ?>
  		<?php } ?>
  		
  		<?php if (!empty($ting_subjects_links)) { ?>
  		  <?php print theme('item_list', $ting_subjects_links, t('Subjects'), 'span', array('class' => 'subjects')); ?>		
  		<?php } ?>
  				
      <?php if (!empty($object->record['dcterms:spatial']['dkdcplus:DBCF'])) { ?>
        <?php //print theme('item_list', $object->record['dcterms:spatial']['dkdcplus:DBCF'], t('Spatial'), 'span', array('class' => 'spatial')); ?>
      <?php } ?>
      
      <?php if (!empty($ting_contributors)) { ?>
      <?php print theme('item_list', $ting_contributors, t('Contributor'), 'span', array('class' => 'ting-contributors'));?>
      <?php } ?>
  		
			<?php if (!empty($object->record['dcterms:hasPart']['dkdcplus:track'])) { ?>
        <?php print theme('item_list', $object->record['dcterms:hasPart']['dkdcplus:track'], t('Contains'), 'span', array('class' => 'contains'));?>
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
      
			<?php if (!empty($ting_publisher)) { ?>
  		  <?php print theme('item_list', array($ting_publisher), t('publisher'), 'span', array('class' => 'ting-publisher')); ?>
      <?php } ?>
      <?php if (!empty($ting_record_label)) { ?>
  		  <?php print theme('item_list', array($ting_record_label), t('Record label'), 'span', array('class' => 'ting-record-label')); ?>
      <?php } ?>
			
			<?php if (!empty($object->record['dc:rights'][''])) { ?>
      <?php print theme('item_list', $object->record['dc:rights'][''], t('Rights'), 'span', array('class' => 'rights'));?>
      <?php } ?>
  		
			<?php if (!empty($ting_creators_links) && $ting_type == 'Tidsskriftsartikel') { ?>
  		  <?php print theme('item_list', $ting_creators_links, t('Creators'), 'span', array('class' => 'creators')); ?>		
  		<?php } ?>
			
			<?php if (!empty($ting_related) && $ting_type == 'Tidsskriftsartikel') { ?>
      <?php print theme('item_list', $ting_related, t('Related'), 'span', array('class' => 'ting-related'));?>
      <?php } ?>
			
    </div>
		
		<script>$('#ting-details').toggle();</script>
		
	  <?php //print $ting_details; ?>
	
	</div>

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