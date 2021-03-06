<?php
require_once __DIR__ . "/../lib/common.php";
$id = $_GET['id'];
if ($id == '' || !preg_match('/^\w{8}-\w{4}-\w{4}-\w{4}-\w{12}$/', $id)) {
    die(showErrorMessage('You should correct id as example: b55a899e-4c40-44ed-96c1-c767227366f4.'));
}
if (isset($_POST['h_publish']) && $_POST['h_publish'] == 1) {
    publicEntity($id);
    wailPublicStatus($id, 1, 'success', 10);
}
$detail = getEntityDetail($id);
$info = [
    'id' => $id,
    'api' => get_option('uiza-authorization'),
    'app_id' => getAppId(),
    'name' => $detail->name,
    'description' => $detail->description,
    'publishToCdn' => $detail->publishToCdn,
    'createdAt' => $detail->createdAt,
    'updatedAt' => $detail->updatedAt,

];
?>
<div id="message_display"></div>
<div class="container">
<p>
<div class="alert alert-success alert-dismissible" id="embed-code-copy" style="display: none;">
  <button type="button" class="close" id="close-show-embed">&times;</button>
  <strong>Embed Code!</strong>  Copied success.
</div>
</p>
<div class="progress" style="display: none;">
  <div class="progress-bar" style="width:0%"></div>
</div>
<p><h4>Detail</h4></p>
<div class="row">
	<?php
echo '<div class="col-sm" id="show_embed_video_play">';
if (isset($info) && $info['publishToCdn'] == 'success') {
    echo '<iframe class="embed-responsive-item" id="iframe-' . $info['id'] . '" src="https://sdk.uiza.io/#/' . $info['app_id'] . '/publish/' . $info['id'] . '/embed?iframeId=iframe-' . $info['id'] . '&env=prod&version=4" allowfullscreen="allowfullscreen" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allow="autoplay; fullscreen; encrypted-media" width="560" height="315" frameborder="0"></iframe>';
} else {
    echo '<div class="col-sm" style="background-image: url(' . plugin_dir_url(__FILE__) . '../images/imageHolder.jpg);height: 315px;background-position: 50% center;">
    <span class="badge badge-pill badge-secondary video-not-ready">Not Ready</span>
    <div class="img-tracking"></div>
</div>';
}
echo '</div>';
?>
    <div class="col-sm">
      <h4>Entity's information</h4>
      <div class="row">
        <div _ngcontent-c39="" class="col-md-5">
            <button class="btn btn-success btn-sm" id="publish-entity" type="button"><i class="icon-publish"></i> Publish</button>
            <button class="btn btn-outline-secondary btn-sm btn-control px-2" data-target="#myModal" type="button" id="show_embed_button">Get Embed</button>
        </div>
      </div>
      <div class="row">
          <div class="col-md-5">
              <label>ID</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items" id="entity_id_text" status="<?=$info['publishToCdn']?>"><?=$info['id']?></span></div>
      </div>
      <div class="row">
          <div class="col-md-5">
              <label>Created at</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items"><?=date('m/d/Y H:i', strtotime($info['createdAt']))?></span></div>
      </div>
      <div class="row">
          <div class="col-md-5">
              <label>Updated at</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items"><?=date('m/d/Y H:i', strtotime($info['updatedAt']))?></span></div>
      </div>
      <div class="row">
          <div class="col-md-5">
              <label>Name</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items"><?=$info['name']?></span></div>
      </div>
      <div class="row">
          <div class="col-md-5">
              <label>Description</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items"><?=$info['description']?></span></div>
      </div>
    </div>
  </div>
</div>

<form name="form1" id="form1" action="admin.php?page=uiza-entities&id=<?=$id?>" method="post">
    <input type="hidden" name="h_publish" id="h_publish" value="1">
</form>
<?=showWaiting()?>
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
          <?=isset($info) ? getEmbed($info) : ''?>
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
  $('#show_embed_button').click(function(e) {
      if ($('#entity_id_text').attr('status') == 'success') {
        $('#myModal').show();
      } else {
        $('#message_display').html(showMessage('The entity is not ready, please wait....', 'warning'));
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
  // $('#publish-entity').click(function(e) {
  //     if ($('#entity_id_text').attr('status') == 'success') {
  //       alert('The entity has already puslished!');
  //     } else {
  //         $('#form1').submit();
  //     }
  // });
  $('#close-modal, .close').click(function(e) {
    $('#myModal').hide();
  });
  jQuery(document).ready(function($) {
    $('#publish-entity').click(function(e){
        $('#loading').show();
        $.ajax({
          url: ajaxurl,
          data: {
              'action': 'publish_entity_ajax',
              'entity_id' : '<?=$id?>'
          },
          type: 'POST',
          dataType: 'json',
          async: true,
          success:function(data) {
            var jsonDecode = JSON.parse(data);
            var war_flg = false;
            console.log(jsonDecode);
            // //showEmbledPlayer
            if (jsonDecode['error'] == '0') {
              $('#entity_id_text').attr('status', 'success');
              $('#show_embed_video_play').html(showEmbledPlayer(JSON.parse(jsonDecode['data'])['data'], '<?=get_option('uiza-app-id')?>'));
              $('#show_embed_text').text(showEmbledPlayer(JSON.parse(jsonDecode['data'])['data'], '<?=get_option('uiza-app-id')?>'));
              $('#message_display').html(showMessage(jsonDecode['message'], 'success'));
            } else {
              $('#message_display').html(showMessage(jsonDecode['message'], 'warning'));
              war_flg = true;
            }
            if (jsonDecode['error'] != '1') {
              setInterval(function(){
                $.ajax({
                  url: ajaxurl,
                  data: {
                      'action': 'check_entity_status_ajax',
                      'entity_id' : '<?=$id?>'
                  },
                  type: 'POST',
                  dataType: 'json',
                  async: true,
                  success:function(data) {
                    var jsonDecode = JSON.parse(data);
                    console.log(jsonDecode['data']['progress']);
                    $('#loading').hide();
                    $('.progress').show();
                    $('.progress-bar').css("width", jsonDecode['data']['progress'] + "%");
                    if (jsonDecode['data']['progress'] == 100) {
                      window.location.href = 'admin.php?page=uiza-entities&id=' + '<?=$id?>';
                    }
                  }
                });
              }, 100);
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