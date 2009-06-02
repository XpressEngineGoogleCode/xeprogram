<?php
    /**
     * @class  browser_titleModel
     * @author SMaker (dowon2308@paran.com)
     * @brief  browser_title 모듈의 Model class
     **/

    class browser_titleModel extends browser_title {

        /**
         * @brief 초기화
         **/
        function init() {
        }

        /**
         * @brief 등록된 규칙 가져오기
         **/
        function getRules() {
			return executeQueryArray('browser_title.getRules');
        }
    }
?>
