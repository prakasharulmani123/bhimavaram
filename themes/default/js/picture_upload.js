$(function () {
	jQuery('#progress').slideUp();
/*    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo(document.body);
            });
        }
    });*/

 

	
  var url = (window.location.hostname === 'blueimp.github.io' ||
                window.location.hostname === 'blueimp.github.io') ?
                '//jquery-file-upload.appspot.com/' : 'server/php/';
    $('#fileupload').fileupload({
        dataType: 'json',
		maxFileSize: 3000000,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        done: function (e, data) {
			//alert(data);
            $.each(data.result.files, function (index, file) {
				
                $('<p/>').text(file.name).appendTo('#files');
				jQuery('.controls .avatar').attr('src',baseUrl+'uploader/files/thumbnail/'+file.name);
				jQuery('input[name=picture]').val(file.name);
            });
        },		 
        progressall: function (e, data) {
			//alert(data);
			//console.log(data);
            var progress = parseInt(data.loaded / data.total * 100, 10);
			jQuery('#progress').slideDown();
            $('#progress .bar').css(
                'width',
                progress + '%'
            );
        }
    });
	
 	
});