<?php

use Elgg\Router\Middleware\Gatekeeper;
use Elgg\Router\Middleware\LoggedOutGatekeeper;


require_once __DIR__.\DIRECTORY_SEPARATOR.'autoloader.php';
 

  $baseUrl_elgg_cache = _elgg_services()->amdConfig->getConfig()['baseUrl'];
// _elgg_services()->amdConfig->setBaseUrl('https://frdl.de/cdn/');
 // $baseUrl = _elgg_services()->amdConfig->getConfig()['baseUrl'];
   $baseUrl = 'https://frdl.de/cdn/';
   $baseUrl_cdn = 'https://cdn.startdir.de/';

  $deps=[
  	   "jquery", 
	  "jquery-ui/widgets/sortable", 
	  "elgg/Ajax",
	//  "convertArgToStr",
	  "admin/plugins",
	  "elgg/menus/dropdown",
	  "page/elements/topbar",
	  
 	  'jquery-ui/widget',
	  'elgg/hooks',
  ];
 


  $_paths = [
 
  ];

  $paths = [ 
         "cropperjs"=> [$baseUrl_elgg_cache."cropperjs/cropper.min"],
        "jquery-cropper/jquery-cropper"=> [$baseUrl_elgg_cache."jquery-cropper/jquery-cropper.min"],
        "input"=> [$baseUrl_elgg_cache."input"],
        "icon"=> [$baseUrl_elgg_cache."icon"],
        "elgg"=>[$baseUrl_elgg_cache."elgg"],
        "page"=> [$baseUrl_elgg_cache."page"],
        "jquery-ui/version"=> [$baseUrl_elgg_cache."jquery-ui/version"],
        "jquery"=> [$baseUrl_elgg_cache."jquery"],
        "jquery-ui/widgets/sortable"=> [$baseUrl_elgg_cache."jquery-ui/widgets/sortable"],
        "elgg/Ajax"=> [$baseUrl_elgg_cache."elgg/Ajax"],
        "elgg/widgets"=> [$baseUrl_elgg_cache."elgg/widgets"],
        "input/form"=> [$baseUrl_elgg_cache."input/form"],
        "elgg/reportedcontent"=> [$baseUrl_elgg_cache."elgg/reportedcontent"],
        "navigation/menu/elements/item_toggle"=> [$baseUrl_elgg_cache."navigation/menu/elements/item_toggle"],
        "elgg/menus/dropdown"=> [$baseUrl_elgg_cache."elgg/menus/dropdown"],
        "elgg/likes"=>[$baseUrl_elgg_cache."elgg/likes"],
        "icon/user/default"=> [$baseUrl_elgg_cache."icon/user/default"],
        "elgg/toggle"=> [$baseUrl_elgg_cache."elgg/toggle"],
        "page/elements/topbar"=> [$baseUrl_elgg_cache."page/elements/topbar"],
	  
	     'jquery-ui/widgets/mouse'=> [$baseUrl_elgg_cache."jquery-ui/widgets/mouse"],
	     'jquery-ui/position'=> [$baseUrl_elgg_cache."jquery-ui/position"],
	     'jquery-ui/widget' => [$baseUrl_elgg_cache."jquery-ui/widget"],
	     'elgg/hooks'=> [$baseUrl_elgg_cache."elgg/hooks"],  
	       
     
	     'elgg/system_messages'=> [$baseUrl."elgg/system_messages"],
	     'elgg/security'=> [$baseUrl."elgg/security"],
	     'elgg/i18n'=> [$baseUrl."elgg/i18n"],
    
 
	    'sprintf'=>[$baseUrl_cdn."sprintf-js@1.1.2/src/sprintf"], 
        "@frdl/forked/requirejs-loader/css"=>[$baseUrl_cdn."@frdl/forked/requirejs-loader/css"]
  ];
 
  foreach($_paths as $p){
	  $paths[$p] = $baseUrl_elgg_cache.$p;
  }

  foreach($paths as $name => $url){
	  $url = is_array($url) ? $url[0] : $url;
	  _elgg_services()->amdConfig->removePath($name);
	  _elgg_services()->amdConfig->addPath($name, $url);
  }

  
  $deps=array_unique($deps);
  foreach($deps as $d){
	 _elgg_services()->amdConfig->addDependency($d);
  }

 
return [
		
	'plugin' => [
		'name' => 'Webfan Webfat Elgg Bridge',
		'activate_on_install' => true,
	],
//	'bootstrap' => \my\Bootstrap::class,
	'routes' => [
		
	 
		'default:hybridauth' => [
			'path' => 'auth/login/{provider}/{action}/',
			'controller' => \Webfan\ElggPatch\Controller\Connect::class,
			'middleware' => [
			 //	LoggedOutGatekeeper::class,
			],
		//	'walled' => false,
		],
		
		'default:cdn' => [
			'path' => 'cdn/{path?}/{path0?}/{path1?}/{path2?}/{path3?}/{path4?}/{path5?}/{path6?}/{path7?}/{path8?}/{path9?}/{pathB0?}/{pathB1?}/{pathB2?}/{pathB3?}/{pathB4?}/{pathB5?}/{pathB6?}/{pathB7?}/{pathB8?}/{pathB9?}/{pathC0?}/{pathC1?}/{pathC2?}/{pathC3?}/{pathC4?}/{pathC5?}/{pathC6?}', 
			'controller' =>\Webfan\ElggPatch\Controller\CDN::class,
			'middleware' => [
			 //	LoggedOutGatekeeper::class,
			],
		],		
	],
	
 
	'views' => [
		'default' => [
			'disconnect' => ['priority' => 200],
		],
 
	],
	
	'view_extensions' => [
		'page/elements/head' => [
			'hooks/header_extend' => ['priority' => 1000],
		],
		'page/elements/foot' => [
			'hooks/footer_extend' => ['priority' => 1000],
		],
	],	
	
];
