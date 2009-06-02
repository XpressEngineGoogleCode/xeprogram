<?php
    /**
     * @class  betAdminView
     * @author SMaker (dowon2308@paran.com)
     * @brief  bet 모듈의 admin view 클래스
     **/

    class betAdminView extends bet {

        var $module_srl = 0;
        var $list_count = 20;
        var $page_count = 10;

        /**
         * @brief 초기화
         **/
        function init() {
            // 템플릿 경로 구함 (bet의 경우 tpl에 관리자용 템플릿 모아놓음)
            $this->setTemplatePath($this->module_path.'tpl');

        }

        /**
         * @brief 배팅 관리자 페이지
         **/
        function dispBetAdminContent() {
            // 스킨 목록을 구해옴
            $oModuleModel = &getModel('module');
            $skin_list = $oModuleModel->getSkins($this->module_path);
            Context::set('skin_list',$skin_list);

            // 레이아웃 목록을 구해옴
            $oLayoutMode = &getModel('layout');
            $layout_list = $oLayoutMode->getLayoutList();
            Context::set('layout_list', $layout_list);

            // 템플릿에서 사용할 변수를 Context::set()
            if($this->module_srl) Context::set('module_srl',$this->module_srl);
            Context::set('module_info', $this->module_info);
            $this->setTemplateFile('index');
        }
    }
?>
