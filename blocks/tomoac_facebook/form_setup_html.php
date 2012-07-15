<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

	$form = Loader::helper('form');
	$db = Loader::db();

	if(($bID > 0)||($b != '' && intval($b->getBlockID()) > 0)) {
		$rows = $db->query("SELECT * FROM btTomoacFacebook WHERE bID=".$b->getBlockID()." LIMIT 1");
		$row = $rows->fetchrow();
		$contents = json_decode( $row{'contents'} );

		$appid = $contents->{'appid'};
		$url = $contents->{'url'};
		$width = $contents->{'width'};
		$height = $contents->{'height'};
		$color = $contents->{'color'};
		$faces = $contents->{'faces'};
		$border = $contents->{'border'};
		$stream = $contents->{'stream'};
		$header = $contents->{'header'};
	}
	else {
		$appid = '<your appid>';
		$url = 'http://www.facebook.com/<your uri>';
		$width = '292';
		$height = '';
		$color = 'light';
		$faces = 'true';
		$border = '';
		$stream = 'true';
		$header = 'true';
	}
?>

<div style="text-align: left" >

<!-- ================ Facebook ================ -->
<div id="ccm-button-facebook-tab">
<?php
	echo '<br /><table>';
	echo '<tr><td>'.t('AppID').'</td><td>'.'&nbsp;'.$form->text('appid', $appid) . "</td></tr>";
	echo '<tr><td>'.t('Facebook Page URL').'</td><td>'.'&nbsp;'.$form->text('url', $url, array('size' => '50')) . "</td></tr>";
	echo '<tr><td>'.t('Width').'</td><td>'.'&nbsp;'.$form->text('width', $width, array('size' => '4')) . "</td></tr>";
	echo '<tr><td>'.t('Height (option)').'</td><td>'.'&nbsp;'.$form->text('height', $height, array('size' => '4')) . "</td></tr>";
	echo '<tr><td>'.t('Color Scheme').'</td><td>'.'&nbsp;'.$form->select('color', array(
						'light' => 'light', 
						'dark' => 'dark'), $color) . "</td></tr>";
	echo '<tr><td>'.t('Show Faces').'</td><td>'.'&nbsp;'.$form->checkbox('faces', 'true', $faces) . "</td></tr>";
	echo '<tr><td>'.t('Border Color (option)').'</td><td>'.'&nbsp;'.$form->text('border', $border) . "</td></tr>";
	echo '<tr><td>'.t('Stream').'</td><td>'.'&nbsp;'.$form->checkbox('stream', 'true', $stream) . "</td></tr>";
	echo '<tr><td>'.t('Header').'</td><td>'.'&nbsp;'.$form->checkbox('header', 'true', $header) . "</td></tr>";
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
