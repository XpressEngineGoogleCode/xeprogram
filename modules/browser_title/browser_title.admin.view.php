<?php
    /**
     * @class  browser_titleAdminView
     * @author SMaker (dowon2308@paran.com)
     * @brief  browser_title 모듈의 admin view class
     **/

    class browser_titleAdminView extends browser_title {

        /**
         * @brief 초기화
         **/
        function init() {
            // 템플릿 경로 지정
            $this->setTemplatePath($this->module_path.'tpl');
        }

        /**
         * @brief 관리자 페이지 메인
         **/
        function dispBrowserTitleAdminIndex() {
            // 등록된 규칙 목록을 가져옴
            //$oBrowser_titleModel = &getModel('browser_title');
            //$rules = $oBrowser_titleModel->getRules();
            //Context::set('rules',$rules);

            // 템플릿 파일 지정
            $this->setTemplateFile('index');
        }

        /**
         * @brief 규칙 관리 페이지
         **/
        function dispBrowserTitleAdminRuleManagement() {
            // 등록된 규칙 목록을 가져옴
            $oBrowserTitleModel = &getModel('browser_title');
            $output = $oBrowserTitleModel->getRules();
            Context::set('rule_list',$output->data);

            // 템플릿 파일 지정
            $this->setTemplateFile('rule_list');
        }

        /**
         * @brief 규칙 등록 페이지
         **/
        function dispBrowserTitleAdminAddRule() {
            // 템플릿 파일 지정
            $this->setTemplateFile('add_rule');
        }
    }
?>
