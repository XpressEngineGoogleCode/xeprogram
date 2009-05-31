<?php
    if(!defined("__ZBXE__")) exit();

    /**
    * @file loadAnimation.addon.php
    * @author SMaker (dowon2308@paran.com)
    * @brief jQuery loadAnimation Plugin
    **/
		//if(Context::get('module')) return; 
		if(Context::get('module') == 'admin') return;

		// Addon Called Position
		if(Context::getResponseMethod()!='HTML') return;
		if($called_position != 'before_module_init') return;

		// jQuery loadAnimation JS Plugin
		Context::addJsFile($addon_path.'js/jquery.loadAnimation.js');

		// Addon Setting Check
		if(!$addon_info->loading_image) $addon_info->loading_image = Context::getUrl().'common/tpl/images/loading.gif';
		if(!$addon_info->loading_bg) $addon_info->loading_bg = '#ccc';

		// loadAnimation Layer
		Context::addBodyHeader('<div id="jquery_loadanimation" />');

		// Script Source
		$jquery = <<<jquery
<script type="text/javascript">
var options = {
	loadSpeed: 'slow',
	closeSpeed: 'slow',
	zIndex: 100000,
	opacity: 0.9,
	color: '$addon_info->loading_bg',
	image: {
		src: '$addon_info->loading_image',
		alt: 'loading...',
		size: {
			width: 16,
			height: 16
		}
	}
};
jQuery(function($){
	$('#jquery_loadanimation').loadAnimation(options);
	$.loadAnimation.end();
});
</script>
jquery;
		Context::addHtmlHeader($jquery);
?>