<?php

/**
 * @file
 * Template to render a Ting collection of books.
 */
 
//list available variables: 
//dpm(get_defined_vars()); 

/* 
** modifications to object data before display
*/
if (!empty($ting_subjects_links)) {
  foreach ($ting_subjects_links as $key => $value) {
	  $ting_subjects_links[$key] = str_replace('/search/', '/search/dc.subject=', $value);
	}
} 
 
?>
  <li>
    <?php if ($picture): ?>
    <div class="picture">
      <?php 
			if (strpos($picture, 'default_image.') && count($collection->types) == 1 ) { //&& strpos('Bog,Node', $collection->types[0]) !== FALSE
  			switch ( (string) $collection->types[0] ) {
    		  case 'Node':
    			  $typeimg = '<img style="width:80px;" src="/sites/all/themes/wellejus/images/nodepapir_180x248.png">';
    				break;
    		  case 'Tidsskrift':
    			case 'Tidsskriftsartikel':
    			case 'Periodikum':
    			  $typeimg = '<img style="width:80px;" src="/sites/all/themes/wellejus/images/magasin_180x248.png">';
    				break;
    			case 'Musik (net)':
    			case 'Netdokument':
					case 'Lydbog (net)':
    			  $typeimg = '<img style="width:80px;" src="/sites/all/themes/wellejus/images/globe_180x248.png">';
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
    			  $typeimg = '<img style="width:80px;" src="/sites/all/themes/wellejus/images/dvd_180x248.png">';
    				break;
    			case 'Lydbog (cd)':
					case 'Lydbog (cd-mp3)':
    			case 'Cd (musik)':
    			  $typeimg = '<img style="width:80px;" src="/sites/all/themes/wellejus/images/cd_180x248.png">';
    				break;
    		  case 'Avis':
    			case 'Avisartikel':
    			  $typeimg = '<img style="width:80px;" src="/sites/all/themes/wellejus/images/avis_180x248.png">';
    				break;
    		  case 'Bog':
    			  $typeimg = '<img style="width:80px;" src="/sites/all/themes/wellejus/images/bog_180x248.png">';
    				break;
    			case 'Spil':
    			case 'Billedbog':
					case 'Tegneserie':
					case 'Video':
					case 'Lydbog (bånd)':
    			default:
    			  $typeimg = '<img style="width:80px;" src="/sites/all/themes/wellejus/images/standart_180x248.png">';
    				break;
    	  }
    		$picture = $typeimg;      
			}
			
			print $picture; 
			?>
    </div>
    <?php endif; ?>

    <div class="record">
      <div class="types">
        <?php print $type_list; ?>
      </div>

      <h3>
			  <?php print l($ting_title, $ting_url, array('html' => TRUE, 'attributes' => array('class' =>'title'))) ;?>
      </h3>

      <div class="meta">
        <?php if ($ting_creators) : ?>
          <span class="creator">
            <?php 
            echo ucfirst(t('by')) . ' ';
            echo l($collection->creators_string, 'ting/search/dc.creator=\''.$collection->creators_string.'\'' );
            ?>
          </span>
        <?php endif; ?>
        <?php if ($ting_publication_date) : ?>
          <span class="publication_date">
            <?php echo t('(%publication_date%)', array('%publication_date%' => $ting_publication_date)) /* TODO: Improve date handling, localizations etc. */ ?>
          </span>
        <?php endif; ?>
      </div>

      <?php if (isset($ting_title_full)) { ?>
        <p class="title-info">
           <span class="label"><?php print t('Additional title information:')?></span>
          <?php print $ting_title_full; ?>
        </p>
      <?php }?>

      <?php if ($ting_abstract) : ?>
        <p class="abstract">
          <?php print $ting_abstract; ?>
        </p>
      <?php endif; ?>

      <div class="ting-details">
        <div class="ting-properties item-list">
  				<?php if (!empty($ting_series_links)) { ?>
    		    <?php 
						print '<div class="ting-series">';
						print theme('item_list', $ting_series_links, t('Series'), 'span'); 
						print '</div>';
						?>
    		  <?php } ?>
					
					<?php if (!empty($ting_classification_links)) { ?>
    		    <?php 
						print '<div class="ting-classification">';
						print theme('item_list', $ting_classification_links, t('Classification'), 'span'); 
						print '</div>';
						?>
    		  <?php } ?>
					
					<?php if (!empty($ting_listing_links)) { ?>
    		    <?php 
						print '<div class="ting-listing">';
						print theme('item_list', $ting_listing_links, t('Listing'), 'span'); 
						print '</div>';
						?>
    		  <?php } ?>
					
					<?php if (!empty($ting_subjects_links)) { ?>
    		    <?php 
						print '<div class="ting-subjects">';
						print theme('item_list', $ting_subjects_links, t('Subjects'), 'span'); 
						print '</div>';
						?>
    		  <?php } ?>
				</div>
      </div>

    </div>
  </li>
