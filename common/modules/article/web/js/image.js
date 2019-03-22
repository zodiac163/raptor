$(function() {
  var $input = $("#fileUpload");

  $input.on("filebatchselected", function(event, files) {

    $input.fileinput("upload");
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
  })
    .on("filedelete", function(jqXHR) {
      alert();
      var abort = true;
      if (confirm("Удалить изображение?")) {
        abort = false;
      }
      return abort;
    });
});
