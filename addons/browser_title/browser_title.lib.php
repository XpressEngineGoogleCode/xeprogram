<?php
    if(!defined("__ZBXE__")) exit();

    /**
    * @file browser_title.lib.php
    * @author 트루 / SMaker (eutrue@gmail.com, dowon2308@paran.com)
    * @brief 타이틀 제어 애드온의 실제 처리 파일
    **/
			/**
	         * @brief 글 읽기 화면인지를 확인하는 함수
			 **/
			function isDocumentView() {
				if(Context::get('document_srl')!='' && Context::get('act')!='dispBoardWrite') return true;
				return false;
			}

			/**
	         * @brief 예약어 치환 함수
			 **/
			function keyword($replace,$replace2,$str) {
				if(!preg_match('/^\{[a-Z]\}/$',$replace)) $replace = sprintf('{%s}',$replace);

				$str = str_replace($replace,$replace2,$str);

				return $str;
			}

			/**
	         * @brief 예약어 처리 함수
			 **/
			function keywordExec($var) {
				if(!$var) return;

				// defualt
				$var = keyword('default',getBrowserTitle(),$var);
				// title
				$var = keyword('title',getDocumentTitle(),$var);
				// category
				$var = keyword('category',getDocumentCategory(),$var);

				return $var;
			}

			/**
	         * @brief 현재 글의 제목을 구하는 함수
			 * 글 읽기 화면에서만 유효
			 **/
			function getDocumentTitle() {
				if(!Context::get('document_srl')) return;

				// document 모듈의 model
				$oDocumentModel = &getModel('document');

				$oDocument = $oDocumentModel->getDocument(Context::get('document_srl'));
				$s = $oDocument->getTitleText();

				return $s;
			}

			/**
	         * @brief 현재 글의 분류를 구하는 함수
			 * 글 읽기 화면에서만 유효
			 **/
			function getDocumentCategory() {
				if(!Context::get('document_srl')) return;

				// document 모듈의 model
				$oDocumentModel = &getModel('document');

				$oDocument = $oDocumentModel->getDocument(Context::get('document_srl'));
				$category_srl = $oDocument->get('category_srl');

				// 분류가 없을 경우 그냥 return
				if($category_srl == 0) return;

				$category_info = $oDocumentModel->getCategory($category_srl);
				$category_title = sprintf('[%s]',$category_info->title);
				
				return $category_title;
			}

			/**
	         * @brief 현재 브라우저의 제목을 구하는 함수
			 **/
			function getBrowserTitle() {
				return html_entity_decode(htmlspecialchars(Context::getBrowserTitle()));
			}

		$browserTitleActived = true;

		// 현재 타이틀
		$getBrowserTitle = getBrowserTitle();

		// 나중에 쉽게 쓸 수 있도록 여러 가지 정보를 변수에 넣기
		$curdomain = getenv('HTTP_HOST');
		$docu_srl = Context::get('document_srl');
		$docu_sbj = getDocumentTitle();

		// 애드온 설정
		$Customize1_defaultBrowserTitle = trim($addon_info->customize1_title);
		$Customize1_documentBrowserTitle = trim($addon_info->customize1_title2);
		$Customize2_defaultBrowserTitle = trim($addon_info->customize2_title);
		$Customize2_documentBrowserTitle = trim($addon_info->customize2_title2);
		$Customize3_defaultBrowserTitle = trim($addon_info->customize3_title);
		$Customize3_documentBrowserTitle = trim($addon_info->customize3_title2);
		$Customize4_defaultBrowserTitle = trim($addon_info->customize4_title);
		$Customize4_documentBrowserTitle = trim($addon_info->customize4_title2);
		$Customize5_defaultBrowserTitle = trim($addon_info->customize5_title);
		$Customize5_documentBrowserTitle = trim($addon_info->customize5_title2);
		$Customize6_defaultBrowserTitle = trim($addon_info->customize6_title);
		$Customize6_documentBrowserTitle = trim($addon_info->customize6_title2);
		$Customize7_defaultBrowserTitle = trim($addon_info->customize7_title);
		$Customize7_documentBrowserTitle = trim($addon_info->customize7_title2);
		$Customize8_defaultBrowserTitle = trim($addon_info->customize8_title);
		$Customize8_documentBrowserTitle = trim($addon_info->customize8_title2);
		$Total_defaultBrowserTitle = trim($addon_info->total_title);
		$Total_documentBrowserTitle = trim($addon_info->total_title2);

		// 사용자 정의 예약어 처리
		$Customize1_defaultBrowserTitle = keywordExec($Customize1_defaultBrowserTitle);
		$Customize1_documentBrowserTitle = keywordExec($Customize1_documentBrowserTitle);
		$Customize2_defaultBrowserTitle = keywordExec($Customize2_defaultBrowserTitle);
		$Customize2_documentBrowserTitle = keywordExec($Customize2_documentBrowserTitle);
		$Customize3_defaultBrowserTitle = keywordExec($Customize3_defaultBrowserTitle);
		$Customize3_documentBrowserTitle = keywordExec($Customize3_documentBrowserTitle);
		$Customize4_defaultBrowserTitle = keywordExec($Customize4_defaultBrowserTitle);
		$Customize4_documentBrowserTitle = keywordExec($Customize4_documentBrowserTitle);
		$Customize5_defaultBrowserTitle = keywordExec($Customize5_defaultBrowserTitle);
		$Customize5_documentBrowserTitle = keywordExec($Customize5_documentBrowserTitle);
		$Customize6_defaultBrowserTitle = keywordExec($Customize6_defaultBrowserTitle);
		$Customize6_documentBrowserTitle = keywordExec($Customize6_documentBrowserTitle);
		$Customize7_defaultBrowserTitle = keywordExec($Customize7_defaultBrowserTitle);
		$Customize7_documentBrowserTitle = keywordExec($Customize7_documentBrowserTitle);
		$Customize8_defaultBrowserTitle = keywordExec($Customize8_defaultBrowserTitle);
		$Customize8_documentBrowserTitle = keywordExec($Customize8_documentBrowserTitle);
		
		// 전체 모듈 예약어 처리
		$Total_defaultBrowserTitle = keywordExec($Total_defaultBrowserTitle);
		$Total_documentBrowserTitle = keywordExec($Total_documentBrowserTitle);

		// 사용자 정의 1
		if($addon_info->customize1) {
			$domain1 = str_replace("\r\n","\n",trim($addon_info->customize1_domain));
			$domain1 = str_replace("\n",",",$domain1);
			$domain1 = explode(",",$domain1);

			$mid_list1 = str_replace("\n",",",trim($addon_info->customize1_module));
			$mid_list1 = explode(",",$mid_list1);
			
			if(in_array(Context::get('mid'), $mid_list1) && (in_array($curdomain,$domain1) || !$domain1)) $customize1 = true;
			else $customize1 = false;
		}
		
		// 사용자 정의 2
		if($addon_info->customize2) {
			$domain2 = str_replace("\r\n","\n",trim($addon_info->customize2_domain));
			$domain2 = str_replace("\n",",",$domain2);
			$domain2 = explode(",",$domain2);

			$mid_list2 = str_replace("\n",",",trim($addon_info->customize2_module));
			$mid_list2 = explode(",",$mid_list2);

			if(in_array(Context::get('mid'), $mid_list2) && (in_array($curdomain,$domain2) || !$domain2)) $customize2 = true;
			else $customize2 = false;
		}
		
		// 사용자 정의 3
		if($addon_info->customize3) {
			$domain3 = str_replace("\r\n","\n",trim($addon_info->customize3_domain));
			$domain3 = str_replace("\n",",",$domain3);
			$domain3 = explode(",",$domain3);

			$mid_list3 = str_replace("\n",",",trim($addon_info->customize3_module));
			$mid_list3 = explode(",",$mid_list3);

			if(in_array(Context::get('mid'), $mid_list3) && (in_array($curdomain,$domain3) || !$domain3)) $customize3 = true;
			else $customize3 = false;
		}
		
		// 사용자 정의 4
		if($addon_info->customize4) {
			$domain4 = str_replace("\r\n","\n",trim($addon_info->customize4_domain));
			$domain4 = str_replace("\n",",",$domain4);
			$domain4 = explode(",",$domain4);

			$mid_list4 = str_replace("\n",",",trim($addon_info->customize4_module));
			$mid_list4 = explode(",",$mid_list4);

			if(in_array(Context::get('mid'), $mid_list4) && (in_array($curdomain,$domain4) || !$domain4)) $customize4 = true;
			else $customize4 = false;
		}
			
		// 사용자 정의 5
		if($addon_info->customize5) {
			$domain5 = str_replace("\r\n","\n",trim($addon_info->customize5_domain));
			$domain5 = str_replace("\n",",",$domain5);
			$domain5 = explode(",",$domain5);

			$mid_list5 = str_replace("\n",",",trim($addon_info->customize5_module));
			$mid_list5 = explode(",",$mid_list5);

			if(in_array(Context::get('mid'), $mid_list5) && (in_array($curdomain,$domain5) || !$domain5)) $customize5 = true;
			else $customize5 = false;
		}

		// 사용자 정의 6
		if($addon_info->customize6) {
			$domain6 = str_replace("\r\n","\n",trim($addon_info->customize6_domain));
			$domain6 = str_replace("\n",",",$domain6);
			$domain6 = explode(",",$domain6);

			$mid_list6 = str_replace("\n",",",trim($addon_info->customize6_module));
			$mid_list6 = explode(",",$mid_list6);

			if(in_array(Context::get('mid'), $mid_list6) && (in_array($curdomain,$domain6) || !$domain6)) $customize6 = true;
			else $customize6 = false;
		}

		// 사용자 정의 7
		if($addon_info->customize7) {
			$domain7 = str_replace("\r\n","\n",trim($addon_info->customize7_domain));
			$domain7 = str_replace("\n",",",$domain7);
			$domain7 = explode(",",$domain7);

			$mid_list7 = str_replace("\n",",",trim($addon_info->customize7_module));
			$mid_list7 = explode(",",$mid_list7);

			if(in_array(Context::get('mid'), $mid_list7) && (in_array($curdomain,$domain7) || !$domain7)) $customize7 = true;
			else $customize7 = false;
		}

		// 사용자 정의 8
		if($addon_info->customize8) {
			$domain8 = str_replace("\r\n","\n",trim($addon_info->customize8_domain));
			$domain8 = str_replace("\n",",",$domain8);
			$domain8 = explode(",",$domain8);

			$mid_list8 = str_replace("\n",",",trim($addon_info->customize8_module));
			$mid_list8 = explode(",",$mid_list8);

			if(in_array(Context::get('mid'), $mid_list8) && (in_array($curdomain,$domain8) || !$domain8)) $customize8 = true;
			else $customize8 = FALSE;
		}

		// 전체 모듈
		if($addon_info->total_module == "Y" && !in_array(Context::get('mid'),$but_list)) {
			$but_list = str_replace("\r\n","\n",trim($addon_info->total_but_list));
			$but_list = str_replace("\n",",",trim($addon_info->total_but_list));
			$but_list = explode(",",$but_list);
			$TotalModule = true;
		} else {
			$TotalModule = false;
		}

?>