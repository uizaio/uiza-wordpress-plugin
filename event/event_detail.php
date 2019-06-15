<div id="error_display">
<?php
require_once __DIR__ . "/../lib/common.php";
$id = $_GET['id'];
$live = $_GET['live'];
$action = $_GET['action'];
if ($id == '' || !preg_match('/^\w{8}-\w{4}-\w{4}-\w{4}-\w{12}$/', $id)) {
    echo showErrorMessage('You should correct id as example: b55a899e-4c40-44ed-96c1-c767227366f4.');
}
//Get detail live stream
$detailLive = getLiveDetail($id);

if ($action == 'start') {
    $result = startLiveEvent($id);
    if ($result->statusCode == 403) {
        echo showErrorMessage('Sorry, this feed is not start now. Please try again later!');
    }
}if ($action == 'stop') {
    $result = stopLiveEvent($id);
    if ($result->statusCode == 400) {
        echo showErrorMessage('Sorry, this feed is initialing, can not stop now. Please try again later!');
    }
}
?>
</div>
<div class="container">
<p>
<div class="alert alert-success alert-dismissible" id="embed-code-copy" style="display: none;">
  <button type="button" class="close" id="close-show-embed">&times;</button>
  <strong>Embed Code!</strong>  Copied success.
</div>
</p>
<p><h4>Streaming Detail</h4>
</p>
<?=showEventDetail($detailLive)?>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-embed modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Embed Code</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <textarea rows="10" readonly="true" id="show_embed_text">
          <?=getEmbedStream($detailLive, get_option('uiza-api-id'))?>
        </textarea>
     </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <div class="text-center">
            <button class="btn btn-secondary mr-right-10" data-dismiss="modal" type="button" id="close-modal"> Close </button>
            <button class="btn btn-primary" type="button" id="copy"> Copy </button>
          </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(function() {
    $('#show_embed_button').click(function(e) {
        if ($(this).attr('status') == 'start') {
          $('#myModal').show();
        } else {
          $('#error_display').html('<?=showErrorMessage('Live event is not start')?>');
        }
    });
    $("#copy").click(function(){
        $("#show_embed_text").select();
        document.execCommand('copy');
        $('#myModal').hide();
        $('#embed-code-copy').show();
    });
    $("#close-show-embed").click(function(e) {
      $("#embed-code-copy").hide();
    });
    $('#close-modal, .close').click(function(e) {
      $('#myModal').hide();
    });
    $('#start_live_btn, #stop_live_btn').click(function(e) {
        var url = new URL(window.location.href);
        url.searchParams.set('action', $(this).attr('val'));
        window.location.href = url;
    });
  });
</script>