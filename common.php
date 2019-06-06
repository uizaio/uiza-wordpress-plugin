<?php
define("API", get_option('uiza-authorization'));
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
    echo '<div class="wrap">';
    echo '<h1>Entities Management</h1>';
    //Module list
    require_once "list.php";
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
    add_settings_field("uiza-api-domain", "Api Domain", "uiza_text_api_domain", "uiza", "uiza_config");
    add_settings_field("uiza-authorization", "Authorization", "uiza_text_auth", "uiza", "uiza_config");
    register_setting("uiza_config", "uiza-api-domain");
    register_setting("uiza_config", "uiza-authorization");
}

/**
 * Add textfield value to setting page Uiza Api Domain
 *
 */
function uiza_text_api_domain()
{
    echo '<input type="text" name="uiza-api-domain" class="form-control w-50" value="' . stripslashes_deep(esc_attr(get_option('uiza-api-domain'))) . '" />';
}

/**
 * Add textfield value to setting page Uiza Authorization
 *
 */
function uiza_text_auth()
{
    echo '<input type="text" name="uiza-authorization"  class="form-control w-50" value="' . stripslashes_deep(esc_attr(get_option('uiza-authorization'))) . '" />';
}

/**
 * [add_custom_link_into_uiza_menu description]
 */
function add_custom_link_into_uiza_menu()
{
    global $submenu;
    $submenu['uiza'][] = ['Setting', 'manage_options', 'options-general.php?page=uiza'];
}
