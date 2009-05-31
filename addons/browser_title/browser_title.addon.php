<?php
    if(!defined("__ZBXE__")) exit();

    /**
    * @file browser_title.addon.php
    * @author 트루 / SMaker (eutrue@gmail.com, dowon2308@paran.com)
    * @brief 타이틀 제어 애드온의 본체 파일입니다.
    **/
		// 불필요한 팝업에서의 타이틀 변경 방지
		if(Context::get('module')) return; 
		
		// 애드온의 실행 시점
		$call_position = array('before_module_proc','after_module_proc');

		
		if(in_array($called_position,$call_position)) @require_once($addon_path.'browser_title.lib.php');
		else return;

		// 파일 누락 검사
		if($called_position == 'before_module_proc') {
			if(!$browserTitleActived && ($logged_info->is_admin == 'Y' || $logged_info->is_site_admin)) {
				$errscript = '<script type="text/javascript">\n';
				$errscript .= 'alert(\'%s\')';
				$errscript .= '</script>';
				$errmsg = '[Error]\n타이틀 제어 애드온 실행 실패\n\n이유 : addons/browser_title/browser_title.lib.php 파일 누락\n\n(이 메세지는 관리자에게만 보입니다)';

				$errscript = sprintf($errscript,$errmsg);
				return Context::addHtmlFooter($errscript);
			}
		}

			// 사용자 정의 적용
			if(!$TotalModule) {
				if($customize1) {
					if(isDocumentView()) Context::setBrowserTitle($Customize1_documentBrowserTitle);
					else Context::setBrowserTitle($Customize1_defaultBrowserTitle);
				}
			
				if($customize2) {
					if(isDocumentView()) Context::setBrowserTitle($Customize2_documentBrowserTitle);
					else Context::setBrowserTitle($Customize2_defaultBrowserTitle);
				}
			
				if($customize3) {
					if(isDocumentView()) Context::setBrowserTitle($Customize3_documentBrowserTitle);
					else Context::setBrowserTitle($Customize3_defaultBrowserTitle);
				}
			
				if($customize4) {
					if(isDocumentView()) Context::setBrowserTitle($Customize4_documentBrowserTitle);
					else Context::setBrowserTitle($Customize4_defaultBrowserTitle);
				}

				if($customize5) {
					if(isDocumentView()) Context::setBrowserTitle($Customize5_documentBrowserTitle);
					else Context::setBrowserTitle($Customize5_defaultBrowserTitle);
				}

				if($customize6) {
					if(isDocumentView()) Context::setBrowserTitle($Customize6_documentBrowserTitle);
					else Context::setBrowserTitle($Customize6_defaultBrowserTitle);
				}

				if($customize7) {
					if(isDocumentView()) Context::setBrowserTitle($Customize7_documentBrowserTitle);
					else Context::setBrowserTitle($Customize7_defaultBrowserTitle);
				}

				if($customize8) {
					if(isDocumentView()) Context::setBrowserTitle($Customize8_documentBrowserTitle);
					else Context::setBrowserTitle($Customize8_defaultBrowserTitle);
				}
			} else {
			// 전체 모듈 적용
				if(isDocumentView()) Context::setBrowserTitle($Total_documentBrowserTitle);
				else Context::setBrowserTitle($Total_defaultBrowserTitle);
			}
?>