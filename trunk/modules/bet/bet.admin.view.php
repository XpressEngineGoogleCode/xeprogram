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
            // 템플릿에서 사용할 변수를 Context::set()
            if($this->module_srl) Context::set('module_srl',$this->module_srl);
            Context::set('module_info', $this->module_info);
            $this->setTemplateFile('index');
        }
    }
?>
