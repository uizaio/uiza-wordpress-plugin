/*
* @Author: tritruong
* @Date:   2019-06-08 23:25:34
* @Last Modified by:   tritruong
* @Last Modified time: 2019-07-20 00:13:49
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
function showEmbledStream(live, appId) {
	return '<iframe id="iframe-' + live['id'] + '" width="560" height="315" src="https://sdk.uiza.io/#/' + appId + '/live/' + live['id'] + '/embed?iframeId=iframe-' + live['id'] + '&amp;streamName=' + live['channelName'] + '&amp;region=ap-southeast-1&amp;feedId=' + live['lastFeedId'] + '&amp;env=prod&amp;version=4&amp;native=true&amp;showCCU=true&amp;api=YXAtc291dGhlYXN0LTEtYXBpLnVpemEuY28=&playerId=null" frameborder="0" allowfullscreen="allowfullscreen" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allow="autoplay; fullscreen; encrypted-media"></iframe><script src=\'https://sdk.uiza.io/iframe_api.js\'/></script>';
}
function showWaitingJs() {
    return '<div class="text-center" id="loading"><div class="spinner-border loading-gif" role="status"><span class="sr-only">Loading...</span></div></div>';
}