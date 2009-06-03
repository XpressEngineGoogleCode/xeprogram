<?php
    /**
     * @class  bet
     * @author SMaker (dowon2308@paran.com)
     * @brief  bet 모듈의 high class
     **/

    class bet extends ModuleObject {

        /**
         * @brief 설치시 추가 작업이 필요할시 구현
         **/
        function moduleInstall() {
            $oModuleModel = &getModel('module');
            $oModuleController = &getController('module');
            $oBetController = &getController('bet');

            $module_info = $oModuleModel->getModuleConfig('bet');
            if($module_info->mid) {
                $_o = executeQuery('module.getMidInfo', $module_info);
                if(!$_o->data) unset($module_info);
            }

            if(!$module_info->mid) {
                $args->module = 'bet';
                $args->browser_title = 'betXE';
                $args->skin = 'default';
                $args->is_default = 'N';
                $args->mid = 'bet';
                $args->module_srl = getNextSequence();
                $output = $oModuleController->insertModule($args);

                $bet_args->mid = $args->mid;
                $oBetController->insertConfig($bet_args);
            }
        }

        /**
         * @brief 설치가 이상이 없는지 체크하는 method
         **/
        function checkUpdate() {
            $oModuleModel = &getModel('module');
            $oModuleController = &getController('module');
            $oBetController = &getController('bet');

            $module_info = $oModuleModel->getModuleConfig('bet');
            if(!$module_info->mid) return true;

			return false;
        }

        /**
         * @brief 업데이트 실행
         **/
        function moduleUpdate() {
            $oModuleModel = &getModel('module');
            $oModuleController = &getController('module');
            $oBetController = &getController('bet');

            $module_info = $oModuleModel->getModuleConfig('bet');
            if(!$module_info->mid) {
                $args->module = 'bet';
                $args->browser_title = 'betXE';
                $args->skin = 'default';
                $args->is_default = 'N';
                $args->mid = 'bet';
                $args->module_srl = getNextSequence();
                $output = $oModuleController->insertModule($args);

                $bet_args->mid = $args->mid;
                $oBetController->insertConfig($bet_args);
            }

            return new Object(0,'success_updated');
        }

        /**
         * @brief 캐시 파일 재생성
         **/
        function recompileCache() {
        }
    }
?>
