<?php
    /**
     * @class  betAdminController
     * @author SMaker (dowon2308@paran.com)
     * @brief  bet 모듈의 admin controller 클래스
     **/

    class betAdminController extends bet {

        /**
         * @brief 초기화
         **/
        function init() {
        }

        /**
         * @brief 설정 저장
         **/
        function procBetAdminInsertConfig() {
			$oModuleModel = &getModel('module');
			$oBetModel = &getModel('bet');
            $oModuleController = &getController('module');
			$oBetController = &getController('bet');
            $module_info = $oBetModel->getConfig();

            // 이미 등록된 모듈의 유무 체크
            $_module_info = $oModuleModel->getModuleInfoByMid($module_info->mid);
            if($module_info->mid && $_module_info) {
                $module_info->module_srl = $_module_info->module_srl;
                $is_registed = true;
            } else {
                $is_registed = false;
            }

            // mid, browser_title, is_default 값이 바뀌면 처리
            $module_info->mid = $args->mid = Context::get('bet_mid');
            $args->browser_title = Context::get('browser_title');
            $args->is_default = Context::get('is_default');
            $args->skin = Context::get('bet_skin');
            $args->layout_srl = Context::get('layout_srl');

            $args->module = 'bet';
            $args->module_srl = $is_registed?$module_info->module_srl:getNextSequence();

            if($args->is_default == 'Y') {
                $output = $oModuleController->clearDefaultModule();
                if(!$output->toBool()) return $output;
            }

            if($is_registed) {
                $output = $oModuleController->updateModule($args);
				if(!$output->toBool()) return $output;
            } else {
                $output = $oModuleController->insertModule($args);
            }

            // 그외 정보 처리
            $module_info->iconshop_skin = Context::get('bet_skin');

            $oBetController->insertConfig($module_info);

            $this->setMessage("success_saved");
        }
    }
?>