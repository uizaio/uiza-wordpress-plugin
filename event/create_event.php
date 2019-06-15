<form method="post" action="admin.php?page=uiza-event">
<label for="name">Name of event </label>
<input type="text" class="form-control w-50" id="name" name="event_name" placeholder="Event name (max 255 characters)" maxlength="255" />
<label for="description">Description </label>
<textarea class="form-control w-50" id="description" name="description" rows="5" placeholder="Event description"></textarea>
<label for="name">Input link </label>
<input type="text" class="form-control w-50" id="link" name="link" placeholder="The link (max 2083 characters)" maxlength="2083" />
<br />
<!-- <input class="btn btn-secondary btn-sm" type="button" value="Cancel">
 --><input class="btn btn-primary btn-sm" type="submit" name="submit" value="Start Stream">
</form>
<?php
if ($_POST['mode'] == 'ajax') {
    if ($_POST['status'] == 'start') {
        return startLiveEvent($_POST['id']);
    } elseif ($_POST['status'] == 'stop') {
        return stopLiveEvent($_POST['id']);
    }
} else {
    if (isset($_POST['submit'])) {
        $params = [
            "name" => $_POST['event_name'],
            "mode" => "pull",
            "encode" => 0,
            "dvr" => 0,
            "description" => $_POST['description'],
            "linkStream" => [
                $_POST['link'],
            ],
            "resourceMode" => "single",
        ];
        $infoLive = createLiveEvent($params);
    }
}

// if (isset($infoLive) && $infoLive !== false) {
//     startLiveEvent($infoLive->id);
//     require_once "event.php";
// }
$listLiveEvent = getListLive();
require_once "event_list.php";
?>
<video id="videojs-player_html5_api" webkit-playsinline="webkit-playsinline" playsinline="playsinline" class="vjs-tech" tabindex="-1" src="blob:https://sdk.uiza.io/bc9fa76b-3aec-4ee3-97b4-0e64a7c738ed"></video>