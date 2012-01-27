<?php
/**
 * @file
 * Display a ting objects as part of a list.
 *
 * Available variables:
 * - $object: The thing..
 * - $local_id: The local id if the thing.
 * - $type: Type of the thing.
 * - $image: Image.
 * - $date: The date of the thing.
 * - $creator: Primary author.
 * - $additional_creators: Other authors.
 * - $language: The language of the item.
 * - $more_link: Link to details page.
 */
?>
<!-- ting-list-item.tpl -->
<div id="ting-item-<?php print $local_id; ?>" class="ting-item clearfix">

  <div class="content clearfix">
    <div class="picture">
      <?php if ($image) { ?>
        <?php 
  			if (strpos($image, 'default_image.')) {
      		switch ( (string) $type) {
      		  case 'Node':
      			  $typeimg = '<img style="width:80px;" src="/sites/all/themes/wellejus/images/nodepapir_180x248.png">';
      				break;
      		  case 'Tidsskrift':
      			case 'Tidsskriftsartikel':
      			case 'Periodikum':
      			  $typeimg = '<img style="width:80px;" src="/sites/all/themes/wellejus/images/magasin_180x248.png">';
      				break;
      			case 'netmusik (album)':
      			case 'Netdokument':
      			  $typeimg = '<img style="width:80px;" src="/sites/all/themes/wellejus/images/globe_180x248.png">';
      				break;
      			case 'CD-rom':
      			case 'Wii-spil':
      			case 'Playstation2-spil':
      			case 'XBOX-spil': 
      			case 'DVD':
      			  $typeimg = '<img style="width:80px;" src="/sites/all/themes/wellejus/images/dvd_180x248.png">';
      				break;
      			case 'Lydbog (cd)':
						case 'Lydbog (cd-mp3)':
      			case 'CD':
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
      			case 'Video':
      			default:
      			  $typeimg = '<img style="width:80px;" src="/sites/all/themes/wellejus/images/standart_180x248.png">';
      				break;
      	  }
    		  $image = $typeimg;
      	}
				
				print $image; 
				?>
      <?php } ?>
    </div>

    <div class="info">
      <span class='date'><?php print $date; ?></span>
      <h3><?php print $title; ?></h3>

      <em><?php echo t('by'); ?></em>
      <?php print $creator ?>

      <div class='language'><?php echo t('Language') . ': ' . $language; ?></div>
      <?php
      foreach ($additional_creators as $creator) {
        print "<p>" . $creator . "</p>";
      }
      ?>

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
