<?php
/*
*** ARKIBAS SEARCH WIDGET implemented as a custom template
*/
?>

<SCRIPT LANGUAGE="JavaScript" SRC="http://search.arkibas.dk/arkibas-formchecker.js"></SCRIPT>
<form id="arkibas_search_form" name="arkibas_search_form" action="http://search.arkibas.dk" target="_blank" method="get" onsubmit="return arkibasCheckform(this);">
<table style="margin:auto;"><tr>
<td class="arkibas_logo">
  <a href="http://www.arkibas.info" target="_blank">
	  <img src="http://search.arkibas.dk/logo.jpg" border="0" title="Tryk p&aring; logoet og f&aring; mere at vide om Arkibas" />
	</a>
</td>
<td>
  <input type="text" class="arkibas_freetext" name="freetext" value="Friteksts&oslash;gning" onfocus="javascript: if (this.value == 'Friteksts&oslash;gning') this.value = '';" />
  <span class="arkibas_period">Periode:</span>
  <input type="text" class="arkibas_year_from" name="year_from" value="Fra" onfocus="javascript: if (this.value == 'Fra') this.value = '';" />
  <input type="text" class="arkibas_year_to" name="year_to" value="Til" onfocus="javascript: if (this.value == 'Til') this.value = '';" /> 
  <input type="submit" class="arkibas_submit" value="S&oslash;g" title="Tryk her for at starte søgning" />
  <input type="reset" class="arkibas_submit" value="Ryd" title="Tryk her for at rydde de tre indtastningsfelter" />
</td>
<td><a href="http://www.arkibas.dk/miniarkibasdk/help.pdf" target="_blank"><img src="http://search.arkibas.dk/help.png" border="0" title="Tryk her for at f&aring; hj&aelig;lp til s&oslash;gning"></a></td>
</tr></table>
</form>

