<?php
    /**
     * @class  betView
     * @author SMaker (dowon2308@paran.com)
     * @brief  bet 모듈의 view 클래스
     **/

    class betView extends bet {

        /**
         * @brief 초기화
         **/
        function init() {
			$oBetModel = &getModel('bet');
			$module_info = $oBetModel->getConfig();

            /**
             * 기본 모듈 정보들 설정 (list_count, page_count는 게시판 모듈 전용 정보이고 기본 값에 대한 처리를 함)
             **/
            if($module_info->list_count) $this->list_count = $module_info->list_count;
            if($module_info->search_list_count) $this->search_list_count = $module_info->search_list_count;
            if($module_info->page_count) $this->page_count = $module_info->page_count;

            // 템플릿 경로 지정

            $template_path = sprintf('%sskins/%s/',$this->module_path, $module_info->skin);
            if(!is_dir($template_path)) {
                $module_info->skin = 'default';
                $template_path = sprintf('%sskins/%s/',$this->module_path, $module_info->skin);
            }
            $this->setTemplatePath($template_path);

			Context::set('module_info', $module_info);
        }

        /**
         * @brief 배팅
         **/
        function dispBetContent() {
			$oDocumentModel = &getModel('document');

			// 목록을 구하기 위한 대상 모듈/ 페이지 수/ 목록 수/ 페이지 목록 수에 대한 옵션 설정
			$args->module_srl = $this->module_srl;
			$args->page = Context::get('page');
			$args->list_count = $this->list_count;
			$args->page_count = $this->page_count;

            // 검색과 정렬을 위한 변수 설정
            $args->search_target = Context::get('search_target');
            $args->search_keyword = Context::get('search_keyword');

            // 지정된 정렬값이 없다면 정렬 값을 지정함
            $args->sort_index = 'list_order';
            $args->order_type = 'asc';

            // 만약 검색어가 있으면 list_count를 search_list_count 로 이용
            if($args->search_keyword) $args->list_count = $this->search_list_count;

            // 일반 글을 구해서 context set
            $output = $oDocumentModel->getDocumentList($args);
            Context::set('document_list', $output->data);
            Context::set('total_count', $output->total_count);
            Context::set('total_page', $output->total_page);
            Context::set('page', $output->page);
            Context::set('page_navigation', $output->page_navigation);

            $this->setTemplateFile('list');
        }

        /**
         * @brief 배팅 등록
         **/
        function dispBetSubmit() {
            // 권한 체크
            if(!$this->grant->manager) return new Object(-1, 'msg_not_permitted');

			$oDocumentModel = &getModel('document');

            // GET parameter에서 document_srl을 가져옴
            $document_srl = Context::get('document_srl');
            $oDocument = $oDocumentModel->getDocument(0, $this->grant->manager);
            $oDocument->setDocument($document_srl);
            $oDocument->add('module_srl', $module_info->module_srl);

            Context::set('document_srl',$document_srl);
            Context::set('oDocument', $oDocument);

            $this->setTemplateFile('submit');
        }
    }
?>
