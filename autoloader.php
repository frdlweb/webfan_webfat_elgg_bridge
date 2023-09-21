<?php
namespace IO4;

  function _installClass($class){
	  $plugin_root = __DIR__;
	  $p = explode('\\', $class);
	  $_f = implode(\DIRECTORY_SEPARATOR, $p);
	 $classFile = "{$plugin_root}/classes/{$_f}.php";

   if (!file_exists($classFile) || filemtime($classFile)<30*24*60*60) {
	// check if composer dependencies are distributed with the plugin
	 if(!is_dir(dirname($classFile))){
		 mkdir(dirname($classFile), 0755, true);
	 }
 	file_put_contents(
	  $classFile,	
	  file_get_contents('https://webfan.de/install/?source='.urlencode($class))	
	);
  }

     if ( !class_exists($class ) ) {
       require_once $classFile;
     }  
  }


 $plugin_root = __DIR__;
 $traitFile = "{$plugin_root}/classes/Webfan/Webfat/getWebfatTrait.php";

 if (!file_exists($traitFile) || filemtime($traitFile)<30*24*60*60) {
	// check if composer dependencies are distributed with the plugin
	 if(!is_dir(dirname($traitFile))){
		 mkdir(dirname($traitFile), 0755, true);
	 }
 	file_put_contents(
	  $traitFile,	
	  file_get_contents('https://webfan.de/install/?source=Webfan\Webfat\getWebfatTrait')	
	);
 }

// See: https://github.com/frdlweb/webfat/blob/7b1fe168cc9328a65d66d5d147ffd39064e4cbf1/public/index.php#L4351
// recommended for production:
// putenv('IO4_WORKSPACE_SCOPE="@www@parent"');


 if ( !trait_exists( \Webfan\Webfat\getWebfatTrait::class ) ) {
     require_once  $traitFile;
 }



_installClass(\IO4\Webfat::class);
_installClass(\Webfan\ElggPatch\Controller\Connect::class);
_installClass(\Webfan\ElggPatch\Controller\CDN::class);
 
//\IO4\Webfat::getWebfat(getcwd().\DIRECTORY_SEPARATOR.'webfat.php', true, false);
