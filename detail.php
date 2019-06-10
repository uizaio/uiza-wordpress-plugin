<?php
require_once "common.php";
$id = $_GET['id'];
if ($id == '' || !preg_match('/^\w{8}-\w{4}-\w{4}-\w{4}-\w{12}$/', $id)) {
    die('<div class="wrap"><div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Wrong format!</strong> You should correct id as example: b55a899e-4c40-44ed-96c1-c767227366f4.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div></div>');
}
if (isset($_GET['publish']) && $_GET['publish'] == 1) {
    publicEntity($id);
}
$detail = getEntityDetail($id);
$info = [
    'id' => $id,
    'api' => get_option('uiza-authorization'),
    'app_id' => getAppId(),
    'name' => $detail->name,
    'description' => $detail->description,
    'createdAt' => $detail->createdAt,
    'updatedAt' => $detail->updatedAt,

];
?>
<div class="container">
<p>
<div class="alert alert-success alert-dismissible" id="embed-code-copy" style="display: none;">
  <button type="button" class="close" id="close-show-embed">&times;</button>
  <strong>Embed Code!</strong>  Copied success.
</div>
</p>
<p><h4>Detail</h4></p>
  <div class="row">
    <div class="col-sm">
    <div class="embed-responsive embed-responsive-16by9">
	<?php
if (isset($info)) {
    echo '<iframe class="embed-responsive-item" id="iframe-' . $info['id'] . '" src="https://sdk.uiza.io/#/' . $info['app_id'] . '/publish/' . $info['id'] . '/embed?iframeId=iframe-' . $info['id'] . '&env=prod&version=4" allowfullscreen="allowfullscreen" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allow="autoplay; fullscreen; encrypted-media" width="100%" height="100%" frameborder="0"></iframe>';
}
?>
	</div>
</div>
    <div class="col-sm">
      <h4>Entity's information</h4>
      <div _ngcontent-c39="" class="pull-right">
          <button class="btn btn-success btn-sm" id="publish-entity" type="button"><i class="icon-publish"></i> Publish</button>
          <button class="btn btn-outline-secondary btn-sm btn-control px-2" data-toggle="modal" data-target="#myModal" type="button">Get Embed</button>
      </div>
      <div class="row">
          <div class="col-md-5">
              <label>ID</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items" id="entity_id_text"><?=$info['id']?></span></div>
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
            <button class="btn btn-secondary mr-right-10" data-dismiss="modal" type="button"> Close </button>
            <button class="btn btn-primary" type="button" id="copy"> Copy </button>
          </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$("#copy").click(function(){
    $("#show_embed_text").select();
    document.execCommand('copy');
    $('#myModal').modal('toggle');
    $('#embed-code-copy').show();
});
$("#close-show-embed").click(function(e) {
  $("#embed-code-copy").hide();
});
$('#publish-entity').click(function(e) {
    var url = new URL($(location).attr("href"));
    url.searchParams.set('publish', 1);
    setTimeout(function() {
      window.location.href = url;
    }, 2000);
});
</script>