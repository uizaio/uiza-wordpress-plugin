/*
* @Author: tritruong
* @Date:   2019-06-08 23:25:34
* @Last Modified by:   tritruong
* @Last Modified time: 2019-06-23 14:11:36
*/
function showMessage(message, className) {
	return '<div class="wrap">' +
    '<div class="alert alert-' + className + ' alert-dismissible fade show" role="alert"><span>' + message + '</span>' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
    '</div>' +
'</div>';
}
function showEmbledPlayer(info, appId) {
	return '<iframe class="embed-responsive-item" id="iframe-' + info['id'] + '" src="https://sdk.uiza.io/#/' + appId + '/publish/' + info['id'] + '/embed?iframeId=iframe-' + info['id'] + '&env=prod&version=4" allowfullscreen="allowfullscreen" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allow="autoplay; fullscreen; encrypted-media" width="560" height="315" frameborder="0"></iframe>';
}