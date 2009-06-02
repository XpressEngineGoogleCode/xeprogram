<?php
    /**
     * @class  browser_title
     * @author SMaker (dowon2308@paran.com)
     * @brief  browser_title 모듈의 high class
     **/

    class browser_title extends ModuleObject {

        /**
         * @brief 설치시 추가 작업이 필요할시 구현
         **/
        function moduleInstall() {
            $oModuleController = &getController('module');

			$oModuleController->insertActionForward('browser_title', 'view', 'dispBrowserTitleAdminIndex');
			$oModuleController->insertActionForward('browser_title', 'view', 'dispBrowserTitleAdminRuleManagement');
			$oModuleController->insertActionForward('browser_title', 'view', 'dispBrowserTitleAdminAddRule');
			$oModuleController->insertActionForward('browser_title', 'controller', 'procBrowserTitleAdminAddRule');

            return new Object();
        }

        /**
         * @brief 설치가 이상이 없는지 체크하는 method
         **/
        function checkUpdate() {
			$oModuleModel = &getModel('module');

			// Action forward 추가
            if(!$oModuleModel->getActionForward('dispBrowserTitleAdminIndex')) return true;
			if(!$oModuleModel->getActionForward('dispBrowserTitleAdminRuleManagement')) return true;
			if(!$oModuleModel->getActionForward('dispBrowserTitleAdminAddRule')) return true;
			if(!$oModuleModel->getActionForward('procBrowserTitleAdminAddRule')) return true;

            return false;
        }

        /**
         * @brief 업데이트 실행
         **/
        function moduleUpdate() {
            $oModuleModel = &getModel('module');
            $oModuleController = &getController('module');

            // Action forward 추가
            if(!$oModuleModel->getActionForward('dispBrowserTitleAdminIndex'))
                $oModuleController->insertActionForward('browser_title', 'view', 'dispBrowserTitleAdminIndex');
            if(!$oModuleModel->getActionForward('dispBrowserTitleAdminRuleManagement'))
                $oModuleController->insertActionForward('browser_title', 'view', 'dispBrowserTitleAdminRuleManagement');
			if(!$oModuleModel->getActionForward('dispBrowserTitleAdminAddRule'))
                $oModuleController->insertActionForward('browser_title', 'view', 'dispBrowserTitleAdminAddRule');
			if(!$oModuleModel->getActionForward('procBrowserTitleAdminAddRule'))
                $oModuleController->insertActionForward('browser_title', 'controller', 'procBrowserTitleAdminAddRule');

            return new Object(0,'success_updated');
        }

        /**
         * @brief 캐시 파일 재생성
         **/
        function recompileCache() {
        }
    }
?>