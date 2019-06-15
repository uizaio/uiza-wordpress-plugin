<?php
if (isset($_POST['h_status']) && isset($_POST['h_id'])) {
    if ($_POST['h_status'] == 'start') {
        $result = startLiveEvent($_POST['h_id']);
        if ($result->statusCode == 403) {
            echo showErrorMessage('Sorry, this feed is not start now. Please try again later!');
        }
    } elseif ($_POST['h_status'] == 'stop') {
        $result = stopLiveEvent($_POST['h_id']);
        if ($result->statusCode == 400) {
            echo showErrorMessage('Sorry, this feed is initialing, can not stop now. Please try again later!');
        }
    }
}
?>
<div _ngcontent-c12="" class="card-body">
<h5 _ngcontent-c11="" class="card-title">Tracking Event</h5>
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
<form name="form1" id="form1" action="admin.php?page=uiza-event" method="post">
    <input type="hidden" name="h_status" id="h_status" value="">
    <input type="hidden" name="h_id" id="h_id" value="">
</form>
<script type="text/javascript">
    $('#start_live_btn, #stop_live_btn').click(function(e){
        $('#h_status').val($(this).attr('val'));
        $('#h_id').val($(this).attr('live'));
        $('#form1').submit();
    });
</script>