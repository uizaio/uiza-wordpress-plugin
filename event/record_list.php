<?php
$records = listRecords();
?>
<div _ngcontent-c12="" class="card-body">
<h5 _ngcontent-c11="" class="card-title">Record Stream</h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">eventType</th>
      <th scope="col">entityName</th>
      <th scope="col">startTime</th>
      <th scope="col">endTime</th>
      <th scope="col">Convert</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($records->body->data as $record) {?>
    <tr>
      <th scope="row"><?=$record->id?></th>
      <td><?=$record->eventType?></td>
      <td><?=$record->entityName?></td>
      <td><?=date('m/d/Y H:i', strtotime($record->startTime))?></td>
      <td><?=date('m/d/Y H:i', strtotime($record->endTime))?></td>
      <td><button type="button" class="btn btn-link" id="convert_to_vod" val="<?=$record->id?>">Convert into VOD</button></td>
    </tr>
    <?php }?>
  </tbody>
</table>
</div>
<form name="form5" id="form5" action="admin.php?page=uiza-event" method="post">
    <input type="hidden" name="h_cid" id="h_cid" value="">
</form>
<script type="text/javascript">
    $('#convert_to_vod').click(function(e){
        $('#h_cid').val($(this).attr('val'));
        $('#form5').submit();
    });
</script>