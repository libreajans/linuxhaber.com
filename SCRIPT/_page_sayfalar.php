<?php
if (!defined('yakusha')) die('...');

$vt->sql('SELECT count(page_name) FROM rss_page WHERE page_name = %s')->arg($sayfa)->sor($cachetime);
$sonuc = $vt->alTek();

if ($sonuc)
{
	$vt->sql('SELECT id, page_title, page_content,page_image FROM rss_page WHERE page_name = %s')->arg($sayfa)->sor($cachetime);
	$sonuc = $vt->alHepsi();

	//seçmeli gelen alanlar
	$id 			= $sonuc[0]->id;
	$page_title 	= $sonuc[0]->page_title;
	$page_content 	= $sonuc[0]->page_content;
	$page_image 	= $sonuc[0]->page_image;

	$page_content 	= stripslashes($page_content);
	//yeni satırlamalar
	$page_content 	= pco_imla_denetle($page_content);
}

if ($sonuc){
?>

<div id="content">
<div class="post">

<div class="right_articles">
<a href="<?php echo SITELINK?>">Ana Sayfa</a> &raquo; <?php echo $page_title?>
<?php if ($_SESSION[SES]["ADMIN"]==1) echo ' | <a href="'.SITELINK.'/acp.php?menu=sayfalar&amp;duzenle='.$id.'">Düzenle</a>'; ?>
</div>

<div class="entry">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="top">
<div class="sagkutu"><img width="200" align="right" src="<?php echo PHOTOLINK?>/_images/<?php echo $page_image?>"></div>
<div><?php echo $page_content?></div>
<br><br>
</td>
</tr>
</table>

<div id="disqus_thread"></div>
<script type="text/javascript">
/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
// The following are highly recommended additional parameters. Remove the slashes in front to use.
var disqus_identifier = "<?php echo $site_link_canonical?>";
var disqus_url = "<?php echo $site_link_canonical?>";
var disqus_shortname = "kitaphaber";
var disqus_title = "<?php echo $content_title?>";

/* * * DON'T EDIT BELOW THIS LINE * * */
(function() {
var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
})();
</script>


</div>
</div>
</div>


<?php } else { include($siteyolu."/_lib_temp/_hata.php"); } ?>
