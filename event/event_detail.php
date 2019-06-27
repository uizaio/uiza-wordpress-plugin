<div id="error_display">
<?php
require_once __DIR__ . "/../lib/common.php";
$id = $_GET['id'];
$live = $_GET['live'];
$action = $_GET['action'];
if ($id == '' || !preg_match('/^\w{8}-\w{4}-\w{4}-\w{4}-\w{12}$/', $id)) {
    die(showErrorMessage('You should correct id as example: b55a899e-4c40-44ed-96c1-c767227366f4.'));
}
//Process action start stop event
startStopEvent();
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
<div id="message_display"></div>
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
          <?=getEmbedStream($detailLive)?>
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
<form name="form3" id="form3" action="admin.php?page=uiza-event&id=<?=$id?>" method="post">
    <input type="hidden" name="h_status" id="h_status" value="">
    <input type="hidden" name="h_id" id="h_id" value="">
</form>
<?=showWaiting()?>
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
    // $('#start_live_btn, #stop_live_btn').click(function(e) {
    //     var url = new URL(window.location.href);
    //     url.searchParams.set('action', $(this).attr('val'));
    //     window.location.href = url;
    // });
    // $('#start_live_btn, #stop_live_btn').click(function(e){
    //     $('#h_status').val($(this).attr('val'));
    //     $('#h_id').val($(this).attr('live'));
    //     $('#form3').submit();
    // });
    $(document).on('click', '#start_live_btn, #stop_live_btn', function(e){
        e.preventDefault();
        $('#loading').show();
        $.ajax({
          url: ajaxurl,
          data: {
              'action': 'start_stop_event_ajax',
              'live' : $(this).attr('live'),
              'status' : $(this).attr('val'),
          },
          type: 'POST',
          dataType: 'json',
          async: false,
          success:function(data) {
            var jsonDecode = JSON.parse(data);
            //showEmbledPlayer
            if (jsonDecode['error'] == '0') {
              if (jsonDecode['start'] == '1') {
                // $('#start_live_btn').removeClass('btn-info');
                // $('#start_live_btn').addClass('btn-danger');
                // $('#start_live_btn').attr('live', JSON.parse(jsonDecode['data'])['data']['id']);
                // $('#start_live_btn').text('Stop Live');
                // $('#start_live_btn').attr('id', 'stop_live_btn');
                // $('#show_embed_button').attr('status', 'start');
                $('#show_embed_video_play').html(showEmbledStream(JSON.parse(jsonDecode['data'])['data'], '<?=get_option('uiza-app-id')?>'));
                $('#show_embed_text').text(showEmbledStream(JSON.parse(jsonDecode['data'])['data'], '<?=get_option('uiza-app-id')?>'));
              }
              // } else {
              //   $('#stop_live_btn').removeClass('btn-danger');
              //   $('#stop_live_btn').addClass('btn-info');
              //   $('#stop_live_btn').attr('live', JSON.parse(jsonDecode['data'])['data']['id']);
              //   $('#stop_live_btn').text('Start Live');
              //   $('#stop_live_btn').attr('id', 'start_live_btn');
              //   $('#show_embed_button').attr('status', 'stop');
              //   $('#show_embed_video_play').html('<?=showDefaultEmbed()?>');
              // }
              $('#message_display').html(showMessage(jsonDecode['message'], 'success'));
              setTimeout(function() {location.reload()}, 3000);
            } else {
              $('#message_display').html(showMessage(jsonDecode['message'], 'warning'));
            }
            $('#loading').hide();
          },
          error: function(errorThrown){
              $('#loading').hide();
          }
        });
    });
  });
</script>