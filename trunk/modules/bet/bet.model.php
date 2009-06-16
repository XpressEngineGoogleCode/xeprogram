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

		/**
		 * @brief 배팅 가능 여부 구하기
		 **/
		function getBetable($document_srl) {
			if(!$document_srl) return;

			$oDocumentModel = &getModel('document');

			$oDocument = $oDocumentModel->getDocument($document_srl);
			$betDate = date("YmdHis", time()-60*60*24);

			if($oDocument->get('regdate')>$betDate) return true;
			return false;
		}

        /**
         * @brief 배율 구하기
         **/
		function getBetMagnifications($document_srl) {
			if(!$document_srl) return;

			$output = executeQuery('bet.getBetMagnifications');
			if(!$output->toBool()) return $output;
			return $output->data;
		}

        /**
         * @brief 점수 구하기
         **/
		function getBetScore($document_srl, $team_no) {
			$team_no = (int)$team_no;

			if(!$team_no) return;

			$output = executeQuery('bet.getBetScore');
			if(!$output->toBool()) return $output;
			return $output->data;
		}

        /**
         * @brief 배팅 로그 구하기
         **/
		function getBetLog($document_srl, $member_srl) {
			if(!$document_srl || !$member_srl) return;

			$output = executeQuery('bet.getBetScore');
			if(!$output->toBool()) return $output;
			return $output->data;
		}
    }
?>
