/**
 * @file   modules/browser_title/js/browser_title.js
 * @author SMaker (dowon2308@paran.com)
 * @brief  browser_title 모듈의 관리자용 javascript
 **/


/* 규칙 등록 후 */
function completeAddRule(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];

    var page = ret_obj['page'];

    alert(message);

    var url = current_url.setQuery('act','dispBrowserTitleRuleManagement');
    if(page) url.setQuery('page',page);
    location.href = url;
}