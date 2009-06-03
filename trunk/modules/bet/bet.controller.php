<?php
    /**
     * @class  betController
     * @author SMaker (dowon2308@paran.com)
     * @brief  bet 모듈의 Controller class
     **/

    class betController extends bet {

        /**
         * @brief 초기화
         **/
        function init() {
            $oBetModel = &getModel('bet');
            $oModuleModel = &getModel('module');

            Context::set('module_info',$this->module_info = $oIconshopModel->getConfig());
            $this->grant = $oModuleModel->getGrant($this->module_info, Context::get('logged_info'), $this->xml_info);
            Context::set('grant', $this->grant);
        }

        /**
         * @brief 설정 저장
         * 설정은 module config를 이용해서 저장함
         * 대상 : 스킨, 권한, 스킨 정보
         **/
        function insertConfig($bet) {
            $oModuleController = &getController('module');
            $oModuleController->insertModuleConfig('bet', $bet);
        }
    }
?>
