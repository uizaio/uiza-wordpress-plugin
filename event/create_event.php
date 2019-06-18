<form name="form2" method="post" action="admin.php?page=uiza-event">
<label for="name">Name of event </label>
<input data-validation="required" data-validation-length="max255" type="text" class="form-control w-50" id="name" name="event_name" placeholder="Event name (max 255 characters)" maxlength="255" />
<label for="description">Description </label>
<textarea class="form-control w-50" id="description" name="description" rows="5" placeholder="Event description"></textarea>
<label for="name">Input link </label>
<input data-validation="url" type="text" class="form-control w-50" id="link" name="link" placeholder="The link (max 2083 characters)" maxlength="2083" />
<br />
<label for="dvr">Record Stream</label>
    <input class="control-input" type="radio" name="dvr" value="1"><span class="label">Yes</span>
    <input class="control-input" type="radio" name="dvr" value="0"><span class="label">No</span>
<br />
<!-- <input class="btn btn-secondary btn-sm" type="button" value="Cancel">
 --><input class="btn btn-primary btn-sm" type="submit" name="submit" value="Start Stream">
</form>
<script>
  $.validate({
    lang: 'en',
    errorMessagePosition: 'top',
    errorMessageClass: 'form-error'
  });
</script>
<?php
//Convert to VOD
if (isset($_POST['h_cid'])) {
    convertToVOD($_POST['h_cid']);
}
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
            "dvr" => intval($_POST['dvr']),
            "description" => $_POST['description'],
            "linkStream" => [
                $_POST['link'],
            ],
            "resourceMode" => "single",
        ];
        $infoLive = createLiveEvent($params);
        startLiveEvent($infoLive->id);
        wailLiveStatus($infoLive->id, 1, 'start', 30);
    }
}

// if (isset($infoLive) && $infoLive !== false) {
//     startLiveEvent($infoLive->id);
//     require_once "event.php";
// }
require_once "event_list.php";
require_once "record_list.php";
?>