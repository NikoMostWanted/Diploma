function handleFileSelect(evt) {
    document.getElementById('output').innerHTML = "";
    var files = evt.target.files; // FileList object
    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {
        // Only process image files.
        if (!f.type.match('image.*')) {
            alert("Image only please....");
        }
        var reader = new FileReader();
        // Closure to capture the file information.
        reader.onload = (function (theFile) {
            return function (e) {
                // Render thumbnail.
                var span = document.createElement('span');
                span.innerHTML = ['<img class="img-thumbnail" title="', escape(theFile.name), '" src="', e.target.result, '" />'].join('');
                document.getElementById('output').insertBefore(span, null);
            };
        })(f);
        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }
}

function deleteImage(id)
{
    $.ajax({
       url: "/site/delete-image",
       type: 'post',
       data: {
                 id : id
             },
       success: function (data) {
         var image_x = document.getElementById('img-'+data.answer);
         image_x.parentNode.removeChild(image_x);
         $('.img-'+data.answer).hide();
       }
  });
}

document.getElementById('lessonform-imagefiles').addEventListener('change', handleFileSelect, false);
