/**
 * @file   modules/bet/skins/default/js/bet.js
 * @author SMaker (dowon2308@paran.com)
 * @brief  bet 모듈의 javascript
 **/

/* 배팅 후 */
function completeBet(ret_obj) {
	var error = ret_obj['error'];
	var message = ret_obj['message'];
	var mid = ret_obj['mid'];
	var url = current_url.setQuery('mid',mid).setQuery('act','');

	alert(message);

	location.href = url;
}
/* 배팅 등록후 */
function completeBetSubmited(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];
    var mid = ret_obj['mid'];
    var document_srl = ret_obj['document_srl'];
    var category_srl = ret_obj['category_srl'];

    alert(message);

    var url;
    if(!document_srl)
    {
        url = current_url.setQuery('mid',mid).setQuery('act','');
    }
    else
    {
        url = current_url.setQuery('mid',mid).setQuery('document_srl',document_srl).setQuery('act','');
    }
    if(category_srl) url = url.setQuery('category',category_srl);
    location.href = url;
}

/* 배팅 삭제 */
function completeDeleteBet(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];
    var mid = ret_obj['mid'];
    var page = ret_obj['page'];

    var url = current_url.setQuery('mid',mid).setQuery('act','').setQuery('document_srl','');
    if(page) url = url.setQuery('page',page);

    //alert(message);

    location.href = url;
}

/* 검색 실행 */
function completeSearch(fo_obj, params) {
    fo_obj.submit();
}

// 현재 페이지 reload
function completeReload(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];

    location.href = location.href;
}