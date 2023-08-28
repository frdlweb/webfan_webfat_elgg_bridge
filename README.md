Webfan Webfat Bridge for Elgg
------------------------------
* Bridge to [Webfat Framework, IO4 and Frdlweb](https://github.com/frdlweb/webfat)
  - Autoloads and Autoinstalls classes from servers (cdn, api, ...)
  - Look into [autoloader.php](autoloader.php) and the [CDN](https://webfan.de/install/) for source codes...
* CDN to mix assets with [frdl.js CDN](https://cdn.startdir.de)
  - Installs class [\Webfan\ElggPatch\Controller\CDN::class](https://webfan.de/install/?source=\Webfan\ElggPatch\Controller\CDN)
* Multi Oauth Providers Login
  - Installs class [\Webfan\ElggPatch\Controller\Connect::class](https://webfan.de/install/?source=\Webfan\ElggPatch\Controller\Connect)
  - To add an OAuth provider save the settings into a file {plugin-dir}/.config/{providers}.php 
    Example: Add the provider "webfan" in mod/webfan_webfat_elgg_bridge/.config/webfan.php 
    ````PHP
<?php

 return [
                'clientId'                => '...',  
                'clientSecret'            => '...',      
			    'redirectUri'             => 'https://example.com/auth/login/webfan/connect/', 
			    'urlAuthorize'            => 'https://webfan.de/apps/oauth2/authorize',   
			    'urlAccessToken'          => 'https://webfan.de/apps/oauth2/api/v1/token',    
			    'urlResourceOwnerDetails' => 'https://webfan.de/ocs/v2.php/cloud/user?format=json'	
		    ];    
    ````
 
