<?php
startStopEvent();
$listLiveEvent = getListLive();
?>
<div id="message_display"></div>
<div _ngcontent-c12="" class="card-body">
<h5 _ngcontent-c11="" class="card-title">Tracking Events</h5>
<hr>
    <!---->
    <app-uiza-card-content _ngcontent-c11="">
        <div _ngcontent-c11="" class="col-md-12"></div>
        <div _ngcontent-c11="" class="col-md-12">
            <ul _ngcontent-c11="" class="list-event">
                <!---->
                <?php foreach ($listLiveEvent as $live) {?>
                <li _ngcontent-c11="">
                    <?=showEmbedInList($live)?>
                    <p _ngcontent-c11="" class="mr-top-10 title-two-line"><?=$live['name']?></p><a href="?page=uiza-event&id=<?=$live['id']?>" _ngcontent-c11="" class="btn btn-outline-secondary btn-sm" live-id="<?=$live['id']?>">View Detail</a>
                    <?=showButtonEvent($live)?>
                <?php }?>
            </ul>
        </div>
    </app-uiza-card-content>
    <!---->
</div>
<form name="form4" id="form4" action="admin.php?page=uiza-event" method="post">
    <input type="hidden" name="h_status" id="h_status" value="">
    <input type="hidden" name="h_id" id="h_id" value="">
</form>
<?=showWaiting()?>
<script type="text/javascript">
   // $('#start_live_btn, #stop_live_btn').click(function(e){
        // $('#h_status').val($(this).attr('val'));
        // $('#h_id').val($(this).attr('live'));
        // $('#form4').submit();
    //});
    //sendRequest();
    $(function() {
      $(document).on('click', '#start_live_btn, #stop_live_btn', function(e){
          e.preventDefault();
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
            beforeSend:function(){
                $('#loading').show();
            },
            success:function(data) {
              var jsonDecode = JSON.parse(data);
              //showEmbledPlayer
              if (jsonDecode['error'] == '0') {
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
function sendRequest(){
    $.ajax({
        url: ajaxurl,
        data: {
            'action': 'wail_push_event_ajax'
        },
        type: 'POST',
        dataType: 'json',
        async: false,
        success:function(data){
           console.log(data);
        },
        complete:function() {
       setInterval(sendRequest, 30000);
      }
    });
}
</script>
<style type="text/css">
  .loading-gif {
    top: 50%;
  }
</style>