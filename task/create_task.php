<p>
<div id="message_display"></div>
<div class="alert alert-success alert-dismissible" id="embed-code-copy" style="display: none;">
  <button type="button" class="close" id="close-show-embed">&times;</button>
    Upload video success.
</div>
</p>
<div class="progress" style="display: none;">
  <div class="progress-bar" style="width:0%"></div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="form-group files">
            <label>Upload Your Video</label>
            <input type="file" class="form-control" id="select_file_upload" data-validation-allowing="mp4, avi, mov, flv, wmv, kmv" accept=".mp4,.avi,.mov,.flv,.wmv, .kmv" onchange="changeFile(event)">
            <input type="hidden" id="api-key-h" value="<?=get_option('uiza-api-key')?>">
            <input type="hidden" id="api-app-id-h" value="<?=get_option('uiza-app-id')?>">
        </div>
        <div class="col text-center">
            <a href="admin.php?page=uiza-entities"><button class="btn btn-primary">Go To Entities</button></a>
            <button type="submit" onclick="submitUpload()" class="btn btn-primary">Process</button>
        </div>
    </div>
</div>
<br />
<table id="table_show_single_video" class="table w-50" style="display: none;">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Publish Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr id="info_public_single">
    </tr>
  </tbody>
</table>
<p>
    <div class="col-sm" id="show_embed_video_play_single"></div>
</p>
<?=showWaiting()?>
<script type="text/javascript">
    $(function() {
        $("#close-show-embed").click(function(e) {
            $("#embed-code-copy").hide();
        });
        $.validate({
            lang: 'en',
            errorMessagePosition: 'top',
            errorMessageClass: 'form-error'
        });
        $(document).on('click', '#public_single_act', function(e){
            $('#embed-code-copy').hide();
            $('#show_embed_video_play_single').hide();
            $('#loading').show();
            $.ajax({
              url: ajaxurl,
              data: {
                  'action': 'publish_entity_ajax',
                  'entity_id' : $(this).attr('entity_id'),
              },
              type: 'POST',
              dataType: 'json',
              async: false,
              success:function(data) {
                var jsonDecode = JSON.parse(data);
                $('#publish_to_cdn').text(JSON.parse(jsonDecode['data'])['data']['publishToCdn']);
                //showEmbledPlayer
                if (jsonDecode['error'] == '0') {
                  $('#show_embed_video_play_single').html(showEmbledPlayer(JSON.parse(jsonDecode['data'])['data'], '<?=get_option('uiza-app-id')?>'));
                  $('#show_embed_video_play_single').show();
                  $('#message_display').html(showMessage(jsonDecode['message'], 'success'));
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
    $('#close-modal, .close').click(function(e) {
        $('#myModal').hide();
    });
</script>
