<?php
// $Id: views-view-unformatted.tpl.php,v 1.6 2008/10/01 20:52:11 merlinofchaos Exp $
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>

<h3>TAB-separated values</h3>
<div>
<?php print "Node-ID\tArrangementnavn\tBeskrivelse\tStednavn\tAdresse\tPostnr\tBy\tLand\tArrangement-start\tArrangement-slut\tTotalkapacitet\tBillettype\tEntrepris\tSalgsperiode-start\tSalgsperiode-slut"; ?>
</div>
<hr/>

<?php foreach ($rows as $id => $row): ?>
    <?php print $row; ?>
<?php endforeach; ?>