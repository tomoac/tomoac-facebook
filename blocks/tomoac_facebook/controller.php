<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));

class TomoacFacebookBlockController extends BlockController {
	protected $btTable = 'btTomoacFacebook';
	protected $btInterfaceWidth = "450";
	protected $btInterfaceHeight = "250";
	
	public function getBlockTypeDescription() {
		return t('Tomoac Facebook');
	}
	
	public function getBlockTypeName() {
		return t('Facebook Box by tomoac');
	}

	function view(){
//		error_log('view bid='.$this->bID,0);

		$page = Page::getCurrentPage();
		$url = BASE_URL . DIR_REL . $page->getCollectionPath();

		$db = Loader::db();

		if(intval($this->bID) == 0)
			return;

		$this->set('bID',intval($this->bID));

		$rows = $db->query("SELECT * FROM btTomoacFacebook WHERE bID=$this->bID LIMIT 1");
		$row = $rows->fetchrow();
		$contents = json_decode( $row{'contents'} );

		$appid  = $contents->{'appid'};
		$url    = $contents->{'url'};
		$width  = $contents->{'width'};
		$height = $contents->{'height'}?' data-height="'.$contents->{'height'}.'"':'';
		$color  = $contents->{'color'} ?' data-colorscheme="'.$contents->{'color'}.'"':'';
		$faces  = $contents->{'faces'};
		$border = $contents->{'border'}?' data-border-color="'.$contents->{'border'}.'"':'';
		$stream = $contents->{'stream'};
		$header = $contents->{'header'};

		$html = '
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId='.$appid.'";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>
<div class="fb-like-box" data-href="'.$url.'" data-width="'.$width.'" data-show-faces="'.$faces.'" data-stream="'.$stream.'" data-header="'.$header.'"'.$height.$color.$border.'></div>
';
		$this->set('facebook', $html);
	}

	function save( $data ) {

		$bID = $this->bID;

		$facebook['appid'] = $data['appid'];
		$facebook['url'] = $data['url'];
		$facebook['width'] = $data['width'];
		$facebook['height'] = $data['height'];
		$facebook['color'] = $data['color'];
		$facebook['faces'] = $data['faces']?'true':'false';
		$facebook['border'] = $data['border'];
		$facebook['stream'] = $data['stream']?'true':'false';
		$facebook['header'] = $data['header']?'true':'false';

		$contents = json_encode( $facebook );

		$db = Loader::db();
		if(intval($bID) > 0) {
			$q = "SELECT count(*) AS total FROM btTomoacFacebook WHERE bID=$bID";
			$total = $db->getOne($q);
		} else 
			$total = 0;

		$vals = array( intval($bID), $contents);
		if( intval($total) == 0 )
			$db->query("INSERT INTO btTomoacFacebook (bID, contents ) values (?,?)", $vals);
		else
			$db->query("UPDATE btTomoacFacebook set bID=?, contents=? WHERE bID=$bID", $vals);
	}
}
