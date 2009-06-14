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

            Context::set('module_info',$this->module_info = $oBetModel->getConfig());
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

        /**
         * @brief 배팅 등록
         **/
		function procBetSubmit() {
            // 권한 체크
            if(!$this->grant->manager) return new Object(-1, 'msg_not_permitted');

            // 글작성시 필요한 변수를 세팅
			$logged_info = Context::get('logged_info');
            $obj = Context::getRequestVars();
            $obj->module_srl = $this->module_info->module_srl;
            if($obj->is_notice!='Y'||!$this->grant->manager) $obj->is_notice = 'N';
			$obj->title = sprintf('[Bet] %s vs $s', $obj->team1, $obj->team2);

            // 관리자가 아니라면 게시글 색상/굵기 제거
            if(!$this->grant->manager) {
                unset($obj->title_color);
                unset($obj->title_bold);
            }
            // document module의 model 객체 생성
            $oDocumentModel = &getModel('document');

            // document module의 controller 객체 생성
            $oDocumentController = &getController('document');

            // 이미 존재하는 글인지 체크
            $oDocument = $oDocumentModel->getDocument($obj->document_srl, $this->grant->manager);

            // 이미 존재하는 경우 수정
            if($oDocument->isExists() && $oDocument->document_srl == $obj->document_srl) {
                $output = $oDocumentController->updateDocument($oDocument, $obj);
                $msg_code = 'success_updated';

            // 그렇지 않으면 신규 등록
            } else {
                $output = $oDocumentController->insertDocument($obj);
                $msg_code = 'success_registed';
                $obj->document_srl = $output->get('document_srl');
            }

            // 오류 발생시 멈춤
            if(!$output->toBool()) return $output;

            // 결과를 리턴
            $this->add('mid', Context::get('mid'));
            $this->add('document_srl', $output->get('document_srl'));

            // 성공 메세지 등록
            $this->setMessage($msg_code);
		}

        /**
         * @brief 배팅
         **/
		function procBet() {
			//if(!$grant->bet || $grant->manager) return new Object(-1, 'msg_not_permitted');
			if(!$grant->bet) return new Object(-1, 'msg_not_permitted');

			$oBetModel = &getModel('bet');
			$oMemberModel = &getModel('member');

			$logged_info = Context::get('logged_info');
			$member_srl = $loggged_info->member_srl;
			$document_srl = Context::get('document_srl');
			$team1_score = (int)Context::get('team1_score');
			$team2_score = (int)Context::get('team2_score');
			$point = (int)Context::get('point');

			if(!$document_srl) return new Object(-1, 'msg_invalid_request');
			if(!$team1_score || !$team2_score) return new Object(-1, 'msg_input_score');
			if(!$point || $point<1) return new Object(-1, 'msg_input_point');

			$prev_point = $oMemberModel->getPoint($member_srl);

		}
    }
?>
