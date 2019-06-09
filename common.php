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
    require_once "upload.php";
    echo '</div>';
}

/**
 * [uiza_event]
 * @return [type] [description]
 */
function uiza_event()
{
    echo '<div class="wrap">';
    echo '<h1>Create Event</h1>';
    echo '</div>';
}

/**
 * [uiza_entities]
 * @return [type] [description]
 */
function uiza_entities()
{
    if (isset($_GET['id'])) {
        require_once "detail.php";
    } else {
        echo '<div class="wrap"><h1>Entities Management</h1>';
        //Module list
        require_once "list.php";
        echo '</div>';
    }
}
function uiza_entity_detail()
{
    echo '<div class="wrap">';
    echo '<h1>Entity Detail</h1>';
    //Module list
    require_once "detail.php";
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
