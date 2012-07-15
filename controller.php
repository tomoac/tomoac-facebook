<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

class TomoacFacebookPackage extends Package {

     protected $pkgHandle = 'tomoac_facebook';
     protected $appVersionRequired = '5.4.0';
     protected $pkgVersion = '0.2.1';

     public function getPackageDescription() {
          return t('Tomoac facebook');
     }

     public function getPackageName() {
          return t('Facebook Box by tomoac');
     }

     public function install() {
          $pkg = parent::install();

          // install block 
          BlockType::installBlockTypeFromPackage('tomoac_facebook', $pkg); 
     }
}
?>