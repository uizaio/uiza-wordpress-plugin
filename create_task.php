<p>
<div class="alert alert-success alert-dismissible" id="embed-code-copy" style="display: none;">
  <button type="button" class="close" id="close-show-embed">&times;</button>
    Upload video success.
</div>
</p>
<div class="row">
    <div class="col-md-6">
        <div class="form-group files">
            <label>Upload Your Video </label>
            <input type="file" class="form-control" onchange="changeFile(event)">
            <input type="hidden" id="api-key-h" value="<?=get_option('uiza-api-key')?>">
        </div>
        <button type="submit" onclick="submitUpload()" class="btn btn-primary">Process</button>
    </div>
</div>
<script type="text/javascript">
    $("#close-show-embed").click(function(e) {
        $("#embed-code-copy").hide();
    });
</script>
