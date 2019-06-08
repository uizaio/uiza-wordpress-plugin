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
      <div class="row">
          <div class="col-md-5">
              <label>ID</label>
          </div>
          <div class="col-md-7"><span class="ellipsis-items"><?=$info['id']?></span></div>
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