<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
	$form = Loader::helper('form');
	if($b != '' && intval($b->getBlockID()) > 0) {
		$db = Loader::db();
		$q = $db->query("select * FROM btFacebookTomoac WHERE bID = ".$b->getBlockID()." LIMIT 1");
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
	} else {
		$user = '<your appid>';
		$url = 'http://www.facebook.com/<your uri>';
		$width = 300;
		$color = 'light';
		$faces = '1';
		$stream = '1';
		$header = '1';
	}
?>

<div style="text-align: left" >

<!-- ================ Facebook ================ -->
<div id="ccm-button-facebook-tab">
<?php
//	print_r($_REQUEST);
	echo '<br /><table>';
	echo '<tr><td>'.t('AppID').'</td><td>'.'&nbsp;'.$form->text('user', $user) . "</td></tr>";
	echo '<tr><td>'.t('Facebook Page URL').'</td><td>'.'&nbsp;'.$form->text('url', $url, array('size' => '50')) . "</td></tr>";
	echo '<tr><td>'.t('Width').'</td><td>'.'&nbsp;'.$form->text('width', $width, array('size' => '4')) . "</td></tr>";
	echo '<tr><td>'.t('Height (option)').'</td><td>'.'&nbsp;'.$form->text('height', $height, array('size' => '4')) . "</td></tr>";
	echo '<tr><td>'.t('Color Scheme').'</td><td>'.'&nbsp;'.$form->select('color', array('light' => 'light', 'dark' => 'dark'), $color) . "</td></tr>";
	echo '<tr><td>'.t('Show Faces').'</td><td>'.'&nbsp;'.$form->checkbox('faces', '1', $faces) . "</td></tr>";
	echo '<tr><td>'.t('Border Color (option)').'</td><td>'.'&nbsp;'.$form->text('border', $border) . "</td></tr>";
	echo '<tr><td>'.t('Stream').'</td><td>'.'&nbsp;'.$form->checkbox('stream', '1', $stream) . "</td></tr>";
	echo '<tr><td>'.t('Header').'</td><td>'.'&nbsp;'.$form->checkbox('header', '1', $header) . "</td></tr>";
	echo '</table>';
?>
</div>


<!-- ================ Tab Setup ================ -->
<script type="text/javascript">
	var ccm_fpActiveTab = "ccm-button-twitter";	
	$("#ccm-button-tabs a").click(function() {
		$("li.ccm-nav-active").removeClass('ccm-nav-active');
		$("#" + ccm_fpActiveTab + "-tab").hide();
		ccm_fpActiveTab = $(this).attr('id');
		$(this).parent().addClass("ccm-nav-active");
		$("#" + ccm_fpActiveTab + "-tab").show();
	});
</script>

</div>
