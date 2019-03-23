$(function() {
  var $input = $("#fileUpload");

  $input.on("filebatchselected", function(event, files) {
    $input.fileinput("upload");
  }).on('filebatchuploadsuccess', function(event, data) {
    var responsedata = data.response;
    if (responsedata.urlForSave) {
      let images = $('#article-images').val() === "" ? JSON.parse('{}') : JSON.parse($('#article-images').val());
      let imagesArray = images.urls ? images.urls : [];
      let imageObj = {}
      imageObj.url = responsedata.urlForSave
      imageObj.caption = responsedata.initialPreviewConfig[0].caption
      imageObj.size = responsedata.initialPreviewConfig[0].size
      imagesArray.push(imageObj)
      images.urls = imagesArray
      $('#article-images').val(JSON.stringify(images))
    }
  }).on('fileclear', function(event) {
    //console.log("fileclear");
  }).on('filesuccessremove', function(event, id) {
    //console.log(id);
  }).on('filesorted', function(event, params) {
    var sort = [];
    for (i=0; i<params.stack.length; i++) {
      sort[i] = params.stack[i].key;
    }

    $.ajax({
      method: "POST",
      data: {'sort' : JSON.stringify(sort)},
      url: '/photostorage/sort',
    }).done(function( response ) {

    });
  }).on('filedeleted', function(event, id, index) {
    let images = $('#article-images').val() === "" ? JSON.parse('{}') : JSON.parse($('#article-images').val());
    let imagesArray = images.urls ? images.urls : [];
    imagesArray = imagesArray.filter(x => x.url !== id);
    images.urls = imagesArray
    $('#article-images').val(JSON.stringify(images))
  })
});
