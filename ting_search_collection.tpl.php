<?php

/**
 * @file
 * Template to render a Ting collection of books.
 */
 
?>
  <li>
    <?php if ($picture): ?>
    <div class="picture">
      <?php print $picture; ?>
    </div>
    <?php endif; ?>

    <div class="record">
      <div class="types">
        <?php print $type_list; ?>
      </div>

      <h3>
			  <?php 
				if (count($collection->types) == 1 && strpos('Bog,Node', $collection->types[0]) !== FALSE) {
				  $dk5_pieces = explode(":", $collection->objects[0]->record['dc:subject']['dkdcplus:DK5'][0]); 
					if ($dk5_pieces[0] != 'sk') {
					  print $dk5_pieces[0] . " "; 
				  }
				} 
			  ?>
			  <?php print l($collection->title, $collection->url, array('attributes' => array('class' =>'title'))) ;?>
      </h3>

      <div class="meta">
        <?php if ($collection->creators_string) : ?>
          <span class="creator">
            <?php 
            echo ucfirst(t('by')) . ' ';
            echo l($collection->creators_string, 'ting/search/dc.creator='.$collection->creators_string );
            ?>
          </span>
        <?php endif; ?>
        <?php if ($collection->date) : ?>
          <span class="publication_date">
            <?php echo t('(%publication_date%)', array('%publication_date%' => $collection->date)) /* TODO: Improve date handling, localizations etc. */ ?>
          </span>
        <?php endif; ?>
      </div>

      <?php if ($collection->abstract) : ?>
      <div class="abstract">
        <p>
          <?php print check_plain($collection->abstract); ?>
        </p>
      </div>
      <?php endif; ?>

      <?php if ($collection->subjects) : ?>
        <div class="subjects">
          <h4><?php echo t('Subjects:') ?></h4>
          <ul>
            <?php foreach ($collection->subjects as $subject) : ?>
              <li><?php echo l($subject, 'ting/search/dc.subject='.$subject) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

    </div>
  </li>

