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
			$oDocumentController = &getController('document');
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

				$oDocumentController->insertDocumentExtraKey($args->module_srl, 1, 'team1', 'text', 'Y', 'N', '', '', 'team1');
				$oDocumentController->insertDocumentExtraKey($args->module_srl, 2, 'team2', 'text', 'Y', 'N', '', '', 'team2');
				$oDocumentController->insertDocumentExtraKey($args->module_srl, 3, 'team1_score', 'text', 'Y', 'N', '', '', 'team1_score');
				$oDocumentController->insertDocumentExtraKey($args->module_srl, 3, 'team2_score', 'text', 'Y', 'N', '', '', 'team2_score');

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

			$args->module_srl = $oModuleModel->getModuleSrlByMid($module_info->mid);
			if(is_array($args->module_srl)) $args->module_srl = $args->module_srl['0'];
			$args->var_type = 'text';
			$args->var_is_required = 'Y';
			$args->var_search = 'N';
			$args->var_default = '';
			$args->var_desc = '';
			$var_idxs = array(1,2,3,4);
			$var_names = array('team1','team2','team1_score','team2_score');
			$eids = array('team1','team2','team1_score','team2_score');
			$count = count($var_idxs);
			for($i=0; $i<$count; $i++) {
				$args->var_idx = $var_idxs[$i];
				$args->var_name = $var_names[$i];
				$args->eid = $eids[$i];
				$isExists = executeQuery('bet.getDocumentExtraKey',$args);
				if(!$isExists->data) {
					return true;
				}
			}
			return false;
        }

        /**
         * @brief 업데이트 실행
         **/
        function moduleUpdate() {
            $oModuleModel = &getModel('module');
            $oModuleController = &getController('module');
			$oDocumentController = &getController('document');
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
			}
				unset($args->module);
				unset($args->browser_title);
				unset($args->skin);
				unset($args->is_default);
				unset($args->mid);
				$args->module_srl = $oModuleModel->getModuleSrlByMid($module_info->mid);
				if(is_array($args->module_srl)) $args->module_srl = $args->module_srl['0'];
				$args->var_type = 'text';
				$args->var_is_required = 'Y';
				$args->var_search = 'N';
				$args->var_default = '';
				$args->var_desc = '';
				$var_idxs = array(1,2,3,4);
				$var_names = array('team1','team2','team1_score','team2_score');
				$eids = array('team1','team2','team1_score','team2_score');
				$count = count($var_idxs);
				for($i=0; $i<$count; $i++) {
					$args->var_idx = $var_idxs[$i];
					$args->var_name = $var_names[$i];
					$args->eid = $eids[$i];
					$isExists = executeQuery('bet.getDocumentExtraKey',$args);
					if(!$isExists->data) {
						$oDocumentController->insertDocumentExtraKey($args->module_srl, $args->var_idx, $args->var_name, $args->var_type, $args->var_is_required, $args->var_search, $args->var_default, $args->var_desc, $args->eid);
					}
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
