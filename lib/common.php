<?php
define("API", get_option('uiza-api-key'));
function init()
{
    Uiza\Base::setAuthorization(API);
}

/**
 * [getListEntity]
 * @return [type] [description]
 */
function getListEntity()
{
    init();
    try {
        return json_decode(Uiza\Entity::list()->json, true)['data'];
    } catch (\Uiza\Exception\ErrorResponse $e) {
        return false;
    }
}

function getListLive()
{
    init();
    try {
        return json_decode(Uiza\Live::list()->json, true)['data'];
    } catch (\Uiza\Exception\ErrorResponse $e) {
        return false;
    }

}

/**
 * [getEntity]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function getEntityDetail($id)
{
    init();
    try {
        return Uiza\Entity::retrieve($id);
    } catch (\Uiza\Exception\ErrorResponse $e) {
        return $e;
    }

}

/**
 * [getEntity]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function getLiveDetail($id)
{
    init();
    try {
        return Uiza\Live::retrieve($id);
    } catch (\Uiza\Exception\ErrorResponse $e) {
        return false;
    }

}

/**
 * [publicEntity]
 * @param  [type] $entityId [description]
 * @return [type]           [description]
 */
function publicEntity($entityId)
{
    init();
    try {
        return Uiza\Entity::publish(["id" => $entityId]);
    } catch (\Uiza\Exception\ErrorResponse $e) {
        return $e;
    }

}

/**
 * [createLiveEvent]
 * @param  [type] $params [description]
 * @return [type]         [description]
 */
function createLiveEvent($params)
{
    init();
    try {
        return Uiza\Live::create($params);
    } catch (\Uiza\Exception\ErrorResponse $e) {
        return false;
    }

}

/**
 * [startLiveEvent]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function startLiveEvent($id)
{
    init();
    try {
        return Uiza\Live::startFeed(["id" => $id]);
    } catch (\Uiza\Exception\ErrorResponse $e) {
        return $e;
    }
}

/**
 * [stopLiveEvent]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function stopLiveEvent($id)
{
    init();
    try {
        return Uiza\Live::stopFeed(["id" => $id]);
    } catch (\Uiza\Exception\ErrorResponse $e) {
        return $e;
    }
}

/**
 * [retrieveLiveStream]
 * @return [type] [description]
 */
function retrieveLive($id)
{
    init();
    try {
        return Uiza\Live::retrieve($id);
    } catch (\Uiza\Exception\ErrorResponse $e) {
        return false;
    }
}

function getCallback($id)
{
    init();
    try {
        return Uiza\Callback::retrieve($id);
    } catch (\Uiza\Exception\ErrorResponse $e) {
        return false;
    }
}
/**
 * [listRecords]
 * @return [type] [description]
 */
function listRecords()
{
    init();
    try {
        return Uiza\Live::listRecorded();
    } catch (\Uiza\Exception\ErrorResponse $e) {
        return false;
    }

}

function convertToVOD($id)
{
    init();
    try {
        return Uiza\Live::convertToVOD(["id" => $id]); // Identifier of record (get from list record)
    } catch (\Uiza\Exception\ErrorResponse $e) {
        return $e;
    }
}
/**
 * [getStatusHtml]
 * @param  [type] $status [description]
 * @return [type]         [description]
 */
function getStatusHtml($status)
{
    if ($status == "success") {
        return '<span class="badge badge-pill badge-success">Success</span>';
    } else if ($status == "not-ready") {
        return '<span class="badge badge-pill badge-secondary">Not Ready</span>';
    }
    return '<span class="badge badge-pill badge-fail">Fail</span>';
}

/**
 * [getAWSUploadKey]
 * @return [type] [description]
 */
function getAWSUploadKey()
{
    init();
    try {
        return Uiza\Entity::getAWSUploadKey();
    } catch (\Uiza\Exception\ErrorResponse $e) {
        return false;
    }

}

/**
 *
 * Adding Menu and submenu under Uiza Tab
 */
function uiza_add_menu()
{
    add_menu_page('Uiza', 'Uiza', 'manage_options', 'uiza', 'uiza_page');
    add_submenu_page('uiza', 'Setting', 'Setting', 'manage_options', 'uiza', 'uiza_page');
    add_submenu_page('uiza', 'Entities Management', 'Entities Management', 'manage_options', 'uiza-entities', 'uiza_entities');
    add_submenu_page('uiza', 'Create Task', 'Create Task', 'manage_options', 'uiza-task', 'uiza_task');
    add_submenu_page('uiza', 'Create Event', 'Create Event', 'manage_options', 'uiza-event', 'uiza_event');
}

/**
 * Setting Page Options
 * Add setting page
 * Save setting page
 *
 */
function uiza_page()
{
    echo '<div class="wrap"><h1>Setting</h1><form method="post" action="options.php">';
    if (isset($_GET['settings-updated'])) {
        echo '<div id="message_display"><div class="wrap"><div class="alert alert-success alert-dismissible fade show" role="alert"><span>Settings saved.</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div></div></div>';
    }

    settings_fields("uiza_config");
    do_settings_sections("uiza");
    submit_button();
    echo '</form></div>';
}

/**
 * [uiza_task]
 * @return [type] [description]
 */
function uiza_task()
{
    echo '<div class="wrap"><h1>Create Task</h1>';
    require_once __DIR__ . "/../task/create_task.php";
    echo '</div>';
}

/**
 * [uiza_event]
 * @return [type] [description]
 */
function uiza_event()
{
    if (isset($_GET['id'])) {
        require_once __DIR__ . "/../event/event_detail.php";
    } else {
        echo '<div class="wrap">';
        echo '<h1>Create new Live Event</h1>';
        echo '<label class="small">Create event for your livestream</label><br />';
        require_once __DIR__ . "/../event/create_event.php";
        echo '</div>';
    }
}

/**
 * [uiza_entities]
 * @return [type] [description]
 */
function uiza_entities()
{
    if (isset($_GET['id'])) {
        require_once __DIR__ . "/../entities/detail.php";
    } else {
        echo '<div class="wrap"><h1>Entities Management</h1>';
        //Module list
        require_once __DIR__ . "/../entities/list.php";
        echo '</div>';
    }
}
function uiza_entity_detail()
{
    echo '<div class="wrap">';
    echo '<h1>Entity Detail</h1>';
    //Module list
    require_once __DIR__ . "/../entities/detail.php";
    echo '</div>';
}
/**
 * Init setting section, Init setting field and register settings page
 *
 * @since 1.0
 */
function uiza_settings()
{
    add_settings_section("uiza_config", "", null, "uiza");
    add_settings_field("uiza-app-id", "App ID", "uiza_text_app_id", "uiza", "uiza_config");
    add_settings_field("uiza-api-key", "API Key", "uiza_text_api_key", "uiza", "uiza_config");
    register_setting("uiza_config", "uiza-app-id");
    register_setting("uiza_config", "uiza-api-key");
}

/**
 * Add textfield value to setting page Uiza Api Domain
 *
 */
function uiza_text_app_id()
{
    echo '<input type="text" name="uiza-app-id" class="form-control w-50" value="' . stripslashes_deep(esc_attr(get_option('uiza-app-id'))) . '" />';
}

/**
 * Add textfield value to setting page Uiza Authorization
 *
 */
function uiza_text_api_key()
{
    echo '<input type="text" name="uiza-api-key"  class="form-control w-50" value="' . stripslashes_deep(esc_attr(get_option('uiza-api-key'))) . '" />';
}

/**
 * [add_custom_link_into_uiza_menu]
 */
function add_custom_link_into_uiza_menu()
{
    global $submenu;
    $submenu['uiza'][] = ['Setting', 'manage_options', 'options-general.php?page=uiza'];
}

/**
 * [getAppId description]
 * @return [type] [description]
 */
function getAppId()
{
    $apiKey = get_option('uiza-api-key');
    if ($apiKey == '' || !preg_match('/^uap-\w{32}-\w{8}$/', $apiKey)) {
        return false;
    }
    $split = explode('-', $apiKey);
    return $split[1];
}

/**
 * [getEmbed description]
 * @param  [type] $info [description]
 * @return [type]       [description]
 */
function getEmbed($info)
{
    return '<iframe id="iframe-' . $info['id'] . '" width="560" height="315" src="https://sdk.uiza.io/#/' . $info['app_id'] . '/publish/' . $info['id'] . '/embed?iframeId=iframe-' . $info['id'] . '&amp;env=prod&amp;version=4&amp;api=YXAtc291dGhlYXN0LTEtYXBpLnVpemEuY28=&amp;playerId=null" frameborder="0" allowfullscreen="allowfullscreen" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allow="autoplay; fullscreen; encrypted-media"></iframe><script src=\'https://sdk.uiza.io/iframe_api.js\'/></script>';
}
function getEmbedStream($live)
{
    return '<iframe id="iframe-' . $live->id . '" width="560" height="315" src="https://sdk.uiza.io/#/' . get_option('uiza-app-id') . '/live/' . $live->id . '/embed?iframeId=iframe-' . $live->id . '&amp;streamName=' . $live->channelName . '&amp;region=ap-southeast-1&amp;feedId=' . $live->lastFeedId . '&amp;env=prod&amp;version=4&amp;native=true&amp;showCCU=true&amp;api=YXAtc291dGhlYXN0LTEtYXBpLnVpemEuY28=&playerId=null" frameborder="0" allowfullscreen="allowfullscreen" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allow="autoplay; fullscreen; encrypted-media"></iframe><script src=\'https://sdk.uiza.io/iframe_api.js\'/></script>';
}
function showButtonEvent($live)
{
    if ($live['lastProcess'] == 'start') {
        return '<button _ngcontent-c11="" class="btn btn-sm btn-danger mr-right-10" id="stop_live_btn" val="stop" live="' . $live['id'] . '"><i _ngcontent-c11="" class="icon icon-stop" style="line-height: 0"></i>Stop Live </button>';
    } elseif ($live['lastProcess'] == 'in-process') {
        return '<button _ngcontent-c11="" class="btn btn-sm btn-warning mr-right-10" id="stop_live_btn" val="stop" live="' . $live['id'] . '"><i _ngcontent-c33="" style="line-height: 0" class="icon icon-estime"></i>Processing</button>';
    } else {
        return '<button _ngcontent-c40="" class="btn btn-sm btn-info mr-right-10" id="start_live_btn" val="start" live="' . $live['id'] . '"><i _ngcontent-c40="" class="icon icon-livestream" style="line-height: 0"></i>Start Live</button>';
    }
}
function showErrorMessage($error)
{
    return '<div class="wrap"><div class="alert alert-danger alert-dismissible fade show" role="alert">' . $error . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>';
}
function showDefaultEmbed($lassProcess = null)
{
    $process = '<span _ngcontent-c33="" class="badge badge-success">Stream is waiting for signal. Learn <a _ngcontent-c33="" href="https://help.uiza.io/articles/2998603-obs-guideline" rel="noopener noreferrer" target="_blank">how to push signal here</a></span>';
    $notReady = '<span class="badge badge-pill badge-secondary video-not-ready">Not Ready</span>';
    if ($lassProcess == 'in-process') {
        $tmp = $process;
    } else {
        $tmp = $notReady;
    }
    return '<div class="col-sm" style="background-image: url(' . plugin_dir_url(__FILE__) . '../images/imageHolder.jpg);height: 315px;background-position: 50% center;"><div class="img-tracking">' . $tmp . '</div></div>';
}
function showEventDetail($detail)
{
    $tempText = '<div class="row"><div class="col-sm" id="show_embed_video_play">';
    if ($detail->lastProcess == 'start') {
        $tempText .= getEmbedStream($detail);
    } elseif ($detail->lastProcess == 'in-process') {
        $tempText .= showDefaultEmbed('in-process');
    } else {
        $tempText .= showDefaultEmbed();
    }
    $tempText .= '</div><div class="col-sm">
      <h4>Event Detail</h4>
      <div class="row">
          <div _ngcontent-c39="" class="col-md-8">
              ' . showButtonEvent($detail) . '
              <button class="btn btn-outline-secondary btn-sm btn-control px-2" data-target="#myModal" type="button" id="show_embed_button" status="' . $detail->lastProcess . '">Get Embed</button>
          </div>
      </div>
      <div class="row">
          <div class="col-md-3">
              <label>Name</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items">' . $detail->name . '</span></div>
      </div>
      <div class="row">
          <div class="col-md-3">
              <label>Description</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items">' . $detail->description . '</span></div>
      </div>
      <div class="row">
          <div class="col-md-3">
              <label>Encode</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items">' . (($detail->encode == 1) ? 'Yes' : 'No') . '</span></div>
      </div>
      <div class="row">
          <div class="col-md-3">
              <label>Record Stream</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items">' . (($detail->dvr == 1) ? 'Yes' : 'No') . '</span></div>
      </div>
      <div class="row">
          <div class="col-md-3">
              <label>Feed type</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items">' . $detail->mode . '</span></div>
      </div>
      <div class="row">
          <div class="col-md-3">
              <label>Stream url</label>
          </div>
          <div class="col-md-9"><span class="ellipsis-items">' . $detail[0]['streamUrl'] . '</span></div>
      </div>
      <div class="row">
          <div class="col-md-3">
              <label>Stream key</label>
          </div>
          <div class="col-md-9"><span class="ellipsis-items">' . $detail[0]['streamKey'] . '</span></div>
      </div>
    </div></div>';
    return $tempText;
}
function showEmbedInList($info)
{
    if ($info['lastProcess'] == 'start') {
        return '
            <div _ngcontent-c11="" style="position: relative">
                <div _ngcontent-c18="" style="position: relative">
                    <div _ngcontent-c18="">
                        <app-uiza-player _ngcontent-c18="" _nghost-c19="">
                            <section _ngcontent-c19="" class="uiza-player">
                                <div style="position: relative; display: block; max-width: 100%;">
                                    <div style="padding-bottom: 56.25%;">
                                        <iframe id="iframe-' . $info['id'] . '" src="https://sdk.uiza.io/#/' . get_option('uiza-app-id') . '/live/' . $info['id'] . '/embed?iframeId=iframe-' . $info['id'] . '&amp;streamName=' . $info['channelName'] . '&amp;region=ap-southeast-1&amp;feedId=' . $info['lastFeedId'] . '&amp;env=prod&amp;version=4&amp;native=true&amp;showCCU=true&amp;api=YXAtc291dGhlYXN0LTEtYXBpLnVpemEuY28=" style="position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px;" allowfullscreen="allowfullscreen" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allow="autoplay; fullscreen; encrypted-media" width="100%" height="100%" frameborder="0"></iframe>
                                    </div>
                                </div>
                            </section>
                        </app-uiza-player>
                    </div>
                    <ul _ngcontent-c18="" class="ulInfo">
                        <li _ngcontent-c18="" class="mr-top-6"><span _ngcontent-c18="" class="badge badge-success">Streaming</span></li>
                    </ul>
                </div>
            </div>';
    }
    if ($info['lastProcess'] == 'in-process') {
        return '<div _ngcontent-c11="" style="position: relative"><div _ngcontent-c11="" class="img-tracking" style="background-image: url(\'' . plugin_dir_url(__FILE__) . '../images/imageHolder.jpg\');"></div></div>';
    }
    return '<div _ngcontent-c11="" style="position: relative"><div _ngcontent-c11="" class="img-tracking" style="background-image: url(\'' . plugin_dir_url(__FILE__) . '../images/imageHolder.jpg\');"></div></div>';
}
function wailLiveStatus($id, $second, $status, $time_out_sec)
{
    $start = microtime(true);
    while (1) {
        $tmpDetail = getLiveDetail($id);
        if ($tmpDetail->lastProcess == $status || microtime(true) - $start > $time_out_sec) {
            return true;
        }
        sleep($second);
    }
    return false;
}
function wailPublicStatus($id, $second, $status, $time_out_sec)
{
    $start = microtime(true);
    while (1) {
        $tmpDetail = getEntityDetail($id);
        if ($tmpDetail->publishToCdn == $status || microtime(true) - $start > $time_out_sec) {
            return true;
        }
        sleep($second);
    }
    return false;
}
function startStopEvent()
{
    if (isset($_POST['h_status']) && isset($_POST['h_id'])) {
        if ($_POST['h_status'] == 'start') {
            $result = startLiveEvent($_POST['h_id']);
            wailLiveStatus($_POST['h_id'], 1, 'start', 120);
            if ($result->statusCode == 403) {
                echo showErrorMessage('Sorry, this feed is not start now. Please try again later!');
            }
        } elseif ($_POST['h_status'] == 'stop') {
            $result = stopLiveEvent($_POST['h_id']);
            wailLiveStatus($_POST['h_id'], 1, 'stop', 120);
            if ($result->statusCode == 400) {
                echo showErrorMessage('Sorry, this feed is initialing, can not stop now. Please try again later!');
            }
        }
    }
}

function publish_entity_ajax()
{
    if (isset($_REQUEST)) {
        $id = $_REQUEST['entity_id'];
        $result = getEntityDetail($id);
        if ($result->publishToCdn == 'success') {
            wp_send_json(json_encode(['error' => 1, 'message' => 'The entity has already puslished!', 'data' => $result->getLastResponse()->json]));
        } else {
            publicEntity($id);
            wailPublicStatus($id, 1, 'success', 120);
            $result = getEntityDetail($id);
            if ($result->publishToCdn == 'success') {
                wp_send_json(json_encode(['error' => 0, 'message' => 'The entity was puslished successfully!', 'data' => $result->getLastResponse()->json]));
            } else {
                wp_send_json(json_encode(['error' => 1, 'message' => 'The entity is inprogress, please wait...!', 'data' => $result->getLastResponse()->json]));
            }
        }
    }
}
function start_stop_event_ajax()
{
    if (isset($_REQUEST)) {
        $live = $_REQUEST['live'];
        $status = $_REQUEST['status'];
        if ($status == 'start') {
            $resultStart = startLiveEvent($live);
            wailLiveStatus($live, 1, 'start', 3);
            if ($resultStart->statusCode == 403) {
                wp_send_json(json_encode(['error' => 1, 'start' => 0, 'message' => 'Sorry, this feed is not start now. Please try again later!', 'data' => $result->getLastResponse()->json]));
            } else {
                $result = getLiveDetail($live);
                wp_send_json(json_encode(['error' => 0, 'start' => 1, 'message' => 'The streaming event was start successfully!', 'data' => $result->getLastResponse()->json]));
            }
        } elseif ($status == 'stop') {
            $result = stopLiveEvent($live);
            wailLiveStatus('live', 1, 'stop', 3);
            if ($result->statusCode == 400) {
                wp_send_json(json_encode(['error' => 1, 'start' => 0, 'message' => 'Sorry, this feed is initialing, can not stop now. Please try again later!', 'data' => $result->getLastResponse()->json]));
            } else {
                wp_send_json(json_encode(['error' => 0, 'start' => 0, 'message' => 'The streaming event was stop successfully!', 'data' => $result->getLastResponse()->json]));

            }
        }
    }
}
function wail_push_event_ajax()
{
    if (isset($_REQUEST)) {
        $result = getLiveDetail($live);
        wp_send_json(json_encode(['error' => 0, 'start' => 1, 'message' => '', 'data' => $result->json]));
    }
}
function showWaiting()
{
    return '<div class="text-center" style="display: none;" id="loading">
  <div class="spinner-border loading-gif" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>';
}
