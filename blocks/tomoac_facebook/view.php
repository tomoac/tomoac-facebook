<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

	$lc = Page::getByID($linkID);
	$c = Page::getCurrentPage();
	$path = $lc->getCollectionPath();
	if(!empty($path)) {
		$path = "/index.php?cID=".$lc->cID; 
	}

	$db = Loader::db();
	if(intval($this->bID) > 0) {
		$q = $db->query("select * FROM btFacebookTomoac WHERE bID = ".$this->bID." LIMIT 1");
		$row = $q->fetchRow();

		$user = $row['user'];
		$type = $row['type'];

		$url = $row['url'];
		$send = $row['send'];
		$layout = $row['layout'];
		$width = $row['width'];
		$height = $row['height'];
		$faces = $row['faces'];
		$verb = $row['verb'];
		$color = $row['color'];
		$border = $row['border'];
		$font = $row['font'];
		$stream = $row['stream'];
		$header = $row['header'];
	}
?>
<div>

<table border="0"><tr>

<td>
<!-- ================  Facebook Box ================ -->
<?php
	$data_href = $url;
	$faces  = $faces ?'true':'false';
	$stream = $stream?'true':'false';
	$header = $header?'true':'false';
	$height = $height?' data-height="'.$height.'"':'';
	$border = $border?' data-border-color="'.$border.'"':'';
	$color  = $color ?' data-colorscheme="'.$color.'"':'';
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=<?php echo $user; ?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like-box" data-href="<?php echo $data_href; ?>" 
	data-width="<?php echo $width; ?>" <?php echo $height; ?>
	<?php echo $color; ?>
	data-show-faces="<?php echo $faces; ?>" 
	data-stream="<?php echo $stream; ?>" 
	<?php echo $border; ?>
	data-header="<?php echo $header; ?>"></div>
</td>

<!--
<td>
-->
<!-- ================  Facebook button ================ -->
<!--
<?php
	$data_href = $url;
	if($hattl != '')
		$hattl = 'data-hatena-bookmark-title="'.$hattl.'"'
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-href="<?php echo $data_href; ?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>
</td>
-->

</tr></table>

</div>
