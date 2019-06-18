<p>
<div class="alert alert-success alert-dismissible" id="embed-code-copy" style="display: none;">
  <button type="button" class="close" id="close-show-embed">&times;</button>
    Upload video success.
</div>
</p>
<div class="row">
    <div class="col-md-6">
        <div class="form-group files">
            <label>Upload Your Video</label>
            <input type="file" class="form-control" id="select_file_upload" data-validation-allowing="mp4, avi, mov, flv, wmv, kmv" accept=".mp4,.avi,.mov,.flv,.wmv, .kmv" onchange="changeFile(event)">
            <input type="hidden" id="api-key-h" value="<?=get_option('uiza-api-key')?>">
        </div>
        <div class="col text-center">
            <a href="admin.php?page=uiza-entities"><button class="btn btn-primary">Back To Entities</button></a>
            <button type="submit" onclick="submitUpload()" class="btn btn-primary">Process</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#close-show-embed").click(function(e) {
        $("#embed-code-copy").hide();
    });
    $.validate({
        lang: 'en',
        errorMessagePosition: 'top',
        errorMessageClass: 'form-error'
    });
</script>
