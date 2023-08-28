<?php

    $CDN_ENABLED = true;
   // $CDN_ENABLED = false;

     if(!class_exists(\IO4\Webfat::class)){
		require_once getcwd().\DIRECTORY_SEPARATOR
           .'mod'
           .\DIRECTORY_SEPARATOR
           .'webfan_webfat_elgg_bridge'
           .\DIRECTORY_SEPARATOR
           .'autoloader.php';
     }

   \IO4\Webfat::getStubRunner(getcwd().\DIRECTORY_SEPARATOR.'webfat.php', true, false);


 $isGuestUser = !elgg_is_logged_in();

 $user = \elgg_is_logged_in() ? \elgg_get_logged_in_user_entity() : false;
 
  $_client = new \Webfan\ElggPatch\Controller\Connect();

  $isWebfanConnected = \elgg_is_logged_in() ? file_exists($_client->getConnectionFileReverse('webfan',$user->guid)) : false;
  $isGoogleConnected = \elgg_is_logged_in() ? file_exists($_client->getConnectionFileReverse('google',$user->guid)) : false;

  $footerHtml = '';
 // if(!$isWebfanConnected || ! $isGoogleConnected){
	  	  if(!$isWebfanConnected){
			  $footerHtml.='<a href="/auth/login/webfan/connect/" title="connect with Webfan">connect with ❤️Webfan</a> ';
		  }else{
			  $footerHtml.='<a href="/auth/login/webfan/disconnect/" style="color:red;" title="disconnect from Webfan">disconnect from ❤️Webfan</a> ';
		  }

          $footerHtml.=' | ';

	  	  if(!$isGoogleConnected){
			  $footerHtml.='<a href="/auth/login/google/connect/" title="connect with Google">connect with <span style="background:url(https://www.google.com/favicon.ico) no-repeat;">Google</span></a> ';
		  }else{
			   $footerHtml.='<a href="/auth/login/google/disconnect/" style="color:red;" title="disconnect from Google">disconnect from <span style="background:url(https://www.google.com/favicon.ico) no-repeat;">Google</span></a> ';
		  }
//  }


if(!empty($footerHtml)){
 echo <<<HTMLCODE
<div class="elgg-inner" style="text-align:center;">
 $footerHtml
</div>
HTMLCODE;
}

echo <<<HTMLCODE
<script>
(()=>{
var _werbungDone=false, tim = false, prop = Object.defineProperty;
var isGuestUser ='$isGuestUser'; 


  function setCookie(name,value,days, path) {
	if('undefined'===typeof path){
	  var path = '/';	
	}
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
   document.cookie = name + "=" + (encodeURIComponent(value) || "")  + expires + "; path=" + path;
  }
  function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return decodeURIComponent(c.substring(nameEQ.length,c.length));
    }
    return null;
  }
  function eraseCookie(name) {   
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  }	
	
  function cookie(name){
	 if('string'===typeof name){
		 return getCookie(name);
	 }else{
		 return document.cookie;
	 }
  }	


 
async function  werbung(){ 		
		if(!_werbungDone
		&& (!navigator.doNotTrack || 'unspecified'===navigator.doNotTrack) 
		&& getCookie('eu-cookie')=='1'
		&& isGuestUser=='1'){
			      _werbungDone=true;
	 			    var pubId=false;
			     try{
	                var lines = await new Promise((resolve, reject)=>{
					     require(['text!' +
													  window.location.protocol 
													  + '//'
													  + window.location.host 
													  +  '/ads.txt'], lines=>{
													     resolve(lines);
													  });
													  
													  });
					  
					 
				 }catch(e){
					console.warn(e); 
					 return;
				 }
			 
			  if(Array.isArray(lines)){
				   lines.forEach(line=>{
		                 var [provider, id, MODE, hash]=line.split(/\,/);
		                if(provider==='google.com'){
							pubId='ca-' + id.trim();
						}
	               });
			  }else if('string' === typeof lines){
				  var [provider, id, MODE, hash]=lines.split(/\,/);
		                if(provider==='google.com'){
							pubId='ca-' + id.trim();
						}
			  }
			 
                (function(g, d,o) {
                    if('string'!==typeof o){
					  return;	
					}
                        if ("undefined" === typeof window.adsbygoogle) {
                            var s = d.createElement("script");
                            s.onload = g;
                            s.src = "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js";
                            d.head.append(s);
                        } else {
                            g();
                        }
                   
                }(function g() {
                    (adsbygoogle = window.adsbygoogle || []).push({
                        google_ad_client: pubId,
                        enable_page_level_ads: true
                    });
                }, document,pubId));           	  	
		}
}

 async function __patch_webfan(){
   

    if('undefined'!== typeof document.querySelectorAll('a[href="https://frdl.de//terms"]')[0] && getCookie('eu-cookie')!='1'){
      document.querySelectorAll('a[href="https://frdl.de//terms"]')[0].href='https://frdl.de/privacy';
    }
 
   if(!_werbungDone && (!navigator.doNotTrack || 'unspecified'===navigator.doNotTrack) && getCookie('eu-cookie')=='1'  && isGuestUser=='1' ){
     werbung();
   }


    (el=>{
	  if(null === el){
	    return;
	  }
	  if('/'===location.pathname){
	    // el.style.display='none';
	     el.href='https://startforum.de/p/network';
		 el.innerHTML='<span class="elgg-anchor-label">☕Startforums</span>';
	  }else{
	   //  el.style.display='inline-block';
	     el.href='/';
		 el.innerHTML='<span class="elgg-anchor-label">����Network</span>';
	  }
	})(document.querySelector('nav > ul > li[data-menu-item="custom3"] > a'));


	if(tim){
	  clearTimeout(tim);	
	}
	
	tim=setTimeout(__patch_webfan, 1000);
 }

 document.addEventListener("DOMContentLoaded",__patch_webfan);
 
 document.addEventListener("DOMContentLoaded",()=>{
   var el = document.querySelector('h1.elgg-heading-site > a[href="https://frdl.de/"].elgg-anchor');
   if(el !== null){
     el.setAttribute('href', 'https://frdlweb.de');
     el.setAttribute('title', 'Frdlweb Home');
   }
 }); 
  
 
})(); 
</script>
HTMLCODE;

  if(!$CDN_ENABLED){
    return;
  }

  $amdconfig= _elgg_services()->amdConfig->getConfig();
  $baseUrl_elgg = $amdconfig['baseUrl'];
  $amdconfig['baseUrl'] = 'https://frdl.de/cdn/';
//  unset($amdconfig['deps']);
  

   array_walk($amdconfig['paths'], function(&$item, $key){
      $item = is_array($item) ? $item[0] : $item; 
   });
  

  $webfanConfigquery = 'DEBUG.enabled=false&website.consent.ads=false'
	  .'&angularjs.html5mode.rewriteLinks=false&angularjs.html5mode.enabled=false'
	  .'&angularjs.bootstrap.skip=true'
	  .'&website.worker.enabled=false'
	 // .'&requirejs.map.*.elgg='.$amdconfig['baseUrl'].'elgg'
	  .'&'
	  .(new \Webfan\Webfat\App\KernelFunctions)->toConfigQuery(
	 // .$toConfigQuery(
					 [
					    'requirejs' =>	 $amdconfig,
						 
					 ], false);

 
echo <<<HTMLCODE

<script>
((q, w,d)=>{
var s=d.createElement('script');
s.setAttribute('src', 'https://io4.xyz.webfan3.de/webfan.js?cdn=https://cdn.startdir.de&?' + q);	
s.async='defer';
s.onload=()=>{
	w.frdlweb.ready(async()=>{ 
	   	  window.\$ = window.jQuery;
	});
};
d.head.prepend(s);		
})('$webfanConfigquery', window, document);
</script>
HTMLCODE;

