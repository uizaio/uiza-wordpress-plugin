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
// if (isset($infoLive) && $infoLive !== false) {
//     startLiveEvent($infoLive->id);
//     require_once "event.php";
// }
$listLiveEvent = getListLive();
require_once "event_list.php";
?>