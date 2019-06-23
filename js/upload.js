var fileSelected = null;
var token =null;
var domain = 'https://ap-southeast-1-api.uiza.co/';

var getExtFile = (filename)=>{
  if(!filename)
    return '.mp4';
  return '.'+filename.split('.').pop();
};

var changeFile = ($event)=>{
  console.log('$event', $event.target.files);
  if($event.target.files && $event.target.files[0]){
    var tmp = $event.target.files[0];
    token = $('#api-key-h').val();
    fileSelected = {
      name : tmp.name,
      body : tmp,
      size : tmp.size,
      inputType : 's3-uiza', //require
      url : ""
    };
  }
  console.log('fileSelected',fileSelected);
};

var createEntity = ()=>{
  return new Promise((resolve, reject)=>{
    var tmpFile = Object.assign({}, fileSelected);
    delete tmpFile.body;
    console.log('tmpFile',tmpFile);
    $.ajax({
      type: "POST",
      beforeSend: function(request) {
        request.setRequestHeader("Authorization", token);
      },
      url: domain + "api/public/v4/media/entity",
      data: tmpFile,
      success: function(data) {
        return resolve(data);
      },
      error: function(data) {
        return reject(data);
      }
    });
  });
};

var getConfigAws = ()=>{
  let url = domain + 'api/public/v4/admin/app/config/aws';
  return new Promise((resolve, reject)=>{
    $.ajax({
      type: "GET",
      beforeSend: function(request) {
        request.setRequestHeader("Authorization", token);
      },
      url: url,
      success: function(data) {
        resolve(data);
      },
      error: function(data) {
        reject(data);
      }
    });
  });
};

var uploadAWS = (configAWS, idCreated)=>{
  let config = {
    accessKeyId: configAWS.temp_access_id,
    secretAccessKey: configAWS.temp_access_secret,
    region: configAWS.region_name,
    sessionToken : configAWS.temp_session_token
  };
  AWS.config.update(config);
  var s3 = (new (AWS.S3)());

  return new Promise((resolve, reject)=>{
    let bucketName = configAWS.bucket_name;
    let bucketInfo = bucketName.split('/');

    let paramsUploadAws = {
      Key:        bucketInfo[1] + '/'+ bucketInfo[2] + '/s3+uiza+'+idCreated+getExtFile(fileSelected.name),
      Bucket:     bucketInfo[0],
      Body:       fileSelected.body, //file stream
    };
    console.log('paramsUploadAws',paramsUploadAws);
    s3.upload(paramsUploadAws, (error, result) => {
      if(error) {
        console.error(error);
        reject(error);
        return;
      }
      console.log('update to s3 DONE', result);
      resolve(result);
    }).on('httpUploadProgress', (event) => {
        $('#loading').hide();
        $('.progress').show();
        this.progress = Math.round((event.loaded / event.total) * 100);
        $('.progress-bar').css("width", this.progress + "%");
        return event;
    });
  });
};

var updateEntity = (idCreated, process='error', progress = 0)=>{
  return new Promise((resolve, reject)=>{
    $.ajax({
      type: "PUT",
      beforeSend: function(request) {
        request.setRequestHeader("Authorization", token);
      },
      url: domain + "api/public/v4/media/entity",
      data: {
        id: idCreated,
        "uploadDetail": { "process": process, "progress": progress }
      },
      success: function(data) {
        return resolve(data);
      },
      error: function(data) {
        return reject(data);
      }
    });
  });
};

var getEntity = (id)=>{
  return new Promise((resolve, reject)=>{
    $.ajax({
      type: "GET",
      beforeSend: function(request) {
        request.setRequestHeader("Authorization", token);
      },
      url: domain + "api/public/v4/media/entity?id="+id,
      success: function(data) {
        return resolve(data);
      },
      error: function(data) {
        return reject(data);
      }
    });
  });
};

var submitUpload = async ()=>{
  if(!fileSelected)
    return alert('File select empty');
  console.log('fileSelected',fileSelected);
  $('#loading').show();
  var idCreated = null;
  var configAWS = null;
  var dataAWS = null;

  //step 1 create entity
  try{
    dataCreated = await createEntity();
    if(dataCreated && dataCreated.data && dataCreated.data.id){
      idCreated = dataCreated.data.id;
    }
    console.log('idCreated', idCreated);
    if(!idCreated) return alert('create entity fail');
  }catch(error){
    console.error(error);
    return
  }

  //step 2 get config aws
  try{
    configAWS = await getConfigAws();
    if(configAWS && configAWS.data) configAWS = configAWS.data;
    console.log('configAWS',configAWS);
  }catch(error){
    console.error(error);
    return
  }

  //step 3 upload to aws
  try{
    dataAWS = await uploadAWS(configAWS, idCreated);
  }catch(error){
    console.error(error);
    updateEntity(idCreated, 'error', 50);
    return
  }

  //step 4 update entity
  if(dataAWS ){
    try{
      await updateEntity(idCreated, 'success', 100);
    }catch(error){
      console.error(error);
    }
  }
  var entityDetail = null;
  try{
    entityDetail = await getEntity(idCreated);
    console.log('entity detail',entityDetail);
  }catch(error){
    console.error(error);
  }
  //$('#show_embed_video_play_single').html(showEmbledPlayer(entityDetail, $('#api-app-id-h').val()));
  $('#info_public_single').html('<td><a href="admin.php?page=uiza-entities&id=' + entityDetail['data']['id'] + '">' + entityDetail['data']['name'] + '</a></td><td id="publish_to_cdn">' + entityDetail['data']['publishToCdn'] + '</td><td><button id="public_single_act" class="btn btn-success btn-sm" entity_id="' + entityDetail['data']['id'] + '">Publish</button></td>');
  $('#table_show_single_video').show();
  $('.progress').hide();
  $('.progress-bar').css("width", "0%");
  $('#embed-code-copy').show();
  $("#select_file_upload").replaceWith($("#select_file_upload").val('').clone(true));
  fileSelected = '';
  //step 5 done
  console.log('ALL DONE');
};

$(document).ready(async ()=>{
  console.log('document ready');
});