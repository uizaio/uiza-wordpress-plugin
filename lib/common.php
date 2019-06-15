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
        return false;
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
        Uiza\Entity::publish(["id" => $entityId]);
    } catch (\Uiza\Exception\ErrorResponse $e) {
        return false;
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
        require_once __DIR__ . "/../entities\detail.php";
    } else {
        echo '<div class="wrap"><h1>Entities Management</h1>';
        //Module list
        require_once __DIR__ . "/../entities\list.php";
        echo '</div>';
    }
}
function uiza_entity_detail()
{
    echo '<div class="wrap">';
    echo '<h1>Entity Detail</h1>';
    //Module list
    require_once __DIR__ . "/../entities\detail.php";
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
    return '<iframe id="iframe-' . $info['id'] . '" width="100%" height="100%" src="https://sdk.uiza.io/#/' . $info['app_id'] . '/publish/' . $info['id'] . '/embed?iframeId=iframe-' . $info['id'] . '&env=prod&version=4&api=YXAtc291dGhlYXN0LTEtYXBpLnVpemEuY28=&playerId=null" frameborder="0" allowfullscreen="allowfullscreen" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allow="autoplay; fullscreen; encrypted-media"></iframe><script src=\'https://sdk.uiza.io/iframe_api.js\'/></script>';
}
function getEmbedStream($live, $auth)
{
    return '<iframe id="iframe-' . $live->id . '" width="100%" height="100%" src="https://sdk.uiza.io/#/' . get_option('uiza-app-id') . '/live/' . $live->id . '/embed?iframeId=iframe-' . $live->id . '&streamName=' . $live->channelName . '&region=ap-southeast-1&feedId=' . $live->lastFeedId . '&env=prod&version=4&native=true&showCCU=true&api=YXAtc291dGhlYXN0LTEtYXBpLnVpemEuY28=&playerId=null" frameborder="0" allowfullscreen="allowfullscreen" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allow="autoplay; fullscreen; encrypted-media"></iframe><script src=\'https://sdk.uiza.io/iframe_api.js\'/></script>';
}
function showButtonEvent($live)
{
    if ($live['lastProcess'] == 'start') {
        return '<button _ngcontent-c11="" class="btn btn-sm btn-danger mr-right-10" id="stop_live_btn" val="stop" live="' . $live['id'] . '"><i _ngcontent-c11="" class="icon icon-stop" style="line-height: 0"></i>Stop Live </button>';
    } else {
        return '<button _ngcontent-c40="" class="btn btn-sm btn-info mr-right-10" id="start_live_btn" val="start" live="' . $live['id'] . '"><i _ngcontent-c40="" class="icon icon-livestream" style="line-height: 0"></i>Start Live</button>';
    }
}
function showErrorMessage($error)
{
    return '<div class="wrap"><div class="alert alert-danger alert-dismissible fade show" role="alert">' . $error . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>';
}
function showDefaultEmbed()
{
    return '<div class="col-md-7" style="background-image: url(' . plugin_dir_url(__FILE__) . '../images/imageHolder.jpg);height: 400px;">
    <span class="badge badge-pill badge-secondary video-not-ready">Not Ready</span>
    <div class="img-tracking"></div>
</div>';
}
function showEventDetail($detail)
{
    $tempText = '<div class="row">';
    if ($detail->lastProcess == 'start') {
        $tempText .= '<div class="col-sm"><div class="embed-responsive embed-responsive-16by9">' .
        getEmbedStream($detail, get_option('uiza-api-id')) .
            '</div></div>';
    } else {
        $tempText .= showDefaultEmbed();
    }
    $tempText .= '<div class="col-sm">
      <h4>Event Detail</h4>
      <div _ngcontent-c39="" class="pull-right">
          ' . showButtonEvent($detail) . '
          <button class="btn btn-outline-secondary btn-sm btn-control px-2" data-target="#myModal" type="button" id="show_embed_button" status="' . $detail->lastProcess . '">Get Embed</button>
      </div>
      <div class="row">
          <div class="col-md-5">
              <label>Name</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items">' . $detail->name . '</span></div>
      </div>
      <div class="row">
          <div class="col-md-5">
              <label>Description</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items">' . $detail->description . '</span></div>
      </div>
      <div class="row">
          <div class="col-md-5">
              <label>Encode</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items">' . (($detail->encode == 1) ? 'Yes' : 'No') . '</span></div>
      </div>
      <div class="row">
          <div class="col-md-5">
              <label>Feed type</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items">' . $detail->mode . '</span></div>
      </div>
      <div class="row">
          <div class="col-md-5">
              <label>Link stream</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items">' . trim($detail->linkStream, '[|]|"') . '</span></div>
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
    return '<div _ngcontent-c11="" style="position: relative"><div _ngcontent-c11="" class="img-tracking" style="background-image: url(\'' . plugin_dir_url(__FILE__) . '../images/imageHolder.jpg\');"></div></div>';
}
