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
			Context::set('module_info', $module_info);

            // 템플릿 경로 지정

            $template_path = sprintf("%sskins/%s/",$this->module_path, $module_info->skin);
            if(!is_dir($template_path)) {
                $module_info->skin = 'default';
                $template_path = sprintf("%sskins/%s/",$this->module_path, $module_info->skin);
            }
            $this->setTemplatePath($template_path);
        }

        /**
         * @brief 배팅
         **/
        function dispBetContent() {
            $this->setTemplateFile('list');
        }

        /**
         * @brief 배팅 등록
         **/
        function dispBetSubmit() {
            $this->setTemplateFile('submit');
        }
    }
?>
