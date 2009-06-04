<?php
    /**
     * @class  betModel
     * @author SMaker (dowon2308@paran.com)
     * @brief  bet 모듈의 Model class
     **/

    class betModel extends bet {

        /**
         * @brief 초기화
         **/
        function init() {
        }

        /**
         * @brief 설정 return
         **/
        function getConfig() {
            static $module_info = null;
            if(is_null($module_info)) {
                // module module_info의 값을 구함
                $oModuleModel = &getModel('module');
                $module_info = $oModuleModel->getModuleConfig('bet');

                $skin_info->module_srl = $module_info->module_srl;
                $oModuleModel->syncSkinInfoToModuleInfo($skin_info);

                // bet dummy module의 is_default 값을 구함
                $dummy = $oModuleModel->getModuleInfoByMid($module_info->mid);
				$module_info->skin = $dummy->skin;
                $module_info->is_default = $dummy->is_default;
                $module_info->module_srl = $dummy->module_srl;
                $module_info->browser_title = $dummy->browser_title;
                $module_info->layout_srl = $dummy->layout_srl;

                if(count($skin_info)) foreach($skin_info as $key => $val) $module_info->{$key} = $val;

                unset($module_info->grants);
            }
            return $module_info;
        }
    }
?>
