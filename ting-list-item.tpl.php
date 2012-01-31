<?php
/**
 * @file
 * Display a ting objects as part of a list.
 */
 
//list available variables: 
dpm(get_defined_vars()); 

?>
<!-- ting-list-item.tpl -->
<div id="ting-item-<?php print $ting_local_id; ?>" class="ting-item clearfix">

  <div class="content clearfix">
    <div class="picture">
      <?php if ($image) { 
        		if (strpos($image, 'default_image.')) {
          		switch ( (string) $object->type ) {
          		  case 'Node':
          			  $typeimg = '<img title="" alt="" style="width:80px;" src="/sites/all/themes/wellejus/images/nodepapir_180x248.png">';
          				break;
          		  case 'Tidsskrift':
          			case 'Tidsskriftsartikel':
          			case 'Periodikum':
          			  $typeimg = '<img title="" alt="" style="width:80px;" src="/sites/all/themes/wellejus/images/magasin_180x248.png">';
          				break;
          			case 'Musik (net)':
          			case 'Netdokument':
      					case 'Lydbog (net)':
          			  $typeimg = '<img title="" alt="" style="width:80px;" src="/sites/all/themes/wellejus/images/globe_180x248.png">';
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
          			  $typeimg = '<img title="" alt="" style="width:80px;" src="/sites/all/themes/wellejus/images/dvd_180x248.png">';
          				break;
          			case 'Lydbog (cd)':
      					case 'Lydbog (cd-mp3)':
          			case 'Cd (musik)':
          			  $typeimg = '<img title="" alt="" style="width:80px;" src="/sites/all/themes/wellejus/images/cd_180x248.png">';
          				break;
          		  case 'Avis':
          			case 'Avisartikel':
          			  $typeimg = '<img title="" alt="" style="width:80px;" src="/sites/all/themes/wellejus/images/avis_180x248.png">';
          				break;
          		  case 'Bog':
          			  $typeimg = '<img title="" alt="" style="width:80px;" src="/sites/all/themes/wellejus/images/bog_180x248.png">';
          				break;
          			case 'Spil':
          			case 'Billedbog':
      					case 'Tegneserie':
      					case 'Video':
      					case 'Lydbog (bånd)':
          			default:
          			  $typeimg = '<img title="" alt="" style="width:80px;" src="/sites/all/themes/wellejus/images/standart_180x248.png">';
          				break;
        	  }
      			$image = $typeimg;
      		}
				
				  print $image; ?>
				
				<?php } ?>
    </div>

    <div class="info">
      <span class='date'><?php print $ting_publication_date; ?></span>
      <h3><?php print l($ting_title, $ting_url, array('html' => true)); ?></h3>

      <?php if (!empty($ting_creators_links)) { ?>
        <em><?php echo t('by'); ?></em>
        <?php print array_shift($ting_creators_links) ?>
      <?php } ?>

      <div class='language'><?php echo t('Language') . ': ' . $ting_language; ?></div>
      <?php if (!empty($ting_creators_links)) {
          foreach ($ting_creators_links as $creator_link) {
            print "<p>" . $creator_link . "</p>";
          }
      } ?>

      <?php if (isset($ting_title_full)) { ?>
        <p class="title-info">
           <span class="label"><?php print t('Additional title information:')?></span>
          <?php print $ting_title_full; ?>
        </p>
      <?php }?>

      <div class="more">
        <?php print $more_link; ?>
      </div>

      <?php if (isset($additional_content)) { print drupal_render($additional_content); } ?>
    </div>

  </div>

  <?php if ($buttons) :?>
    <div class="ting-object-buttons">
      <?php print theme('item_list', $buttons, NULL, 'ul', array('class' => 'buttons')) ?>
    </div>
  <?php endif; ?>
</div>
