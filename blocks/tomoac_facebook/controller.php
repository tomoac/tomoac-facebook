<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));

class TomoacFacebookBlockController extends BlockController {
	protected $btTable = 'btFacebookTomoac';
	protected $btInterfaceWidth = "450";
	protected $btInterfaceHeight = "250";
	
	public function getBlockTypeDescription() {
		return t('Tomoac Facebook');
	}
	
	public function getBlockTypeName() {
		return t('Facebook Box by tomoac');
	}

	function save( $data ) {
		$db = Loader::db();
		if(intval($this->bID) > 0) {
			$q = "select count(*) as total FROM btFacebookTomoac WHERE bID = ".$this->bID;
			$total = $db->getOne($q);
		} else 
			$total = 0; 

		if( intval($total) == 0 ) { 
			$vals = array( intval($this->bID),
					$data['user'],	$data['type'],	$data['url'],	$data['send'],
					$data['layout'],$data['width'],	$data['height'],$data['faces'],
					$data['verb'],	$data['color'],	$data['border'],$data['font'],
					$data['stream'],$data['header']
			);
			$db->query("INSERT INTO btFacebookTomoac
					(bID, 
					user,	type,	url,	send,	layout,	width,	height,	faces,	verb,	color,	border,	font,	stream,	header
					) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", $vals);
		} else {
			$vals = array(
					$data['user'],	$data['type'],	$data['url'],	$data['send'],
					$data['layout'],$data['width'],	$data['height'],$data['faces'],
					$data['verb'],	$data['color'],	$data['border'],$data['font'],
					$data['stream'],$data['header']
					,intval($this->bID));
			$db->query("UPDATE btFacebookTomoac set 
					user=?,		type=?,		url=?,		send=?,
					layout=?,	width=?,	height=?,	faces=?,
					verb=?,		color=?,	border=?,	font=?,
					stream=?,	header=?
					WHERE bID = ?", $vals);
		}
	}
}
