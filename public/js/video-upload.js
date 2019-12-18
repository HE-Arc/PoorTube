/**
* Scripts used for the upload of a video.
*/

// Display the name of the file when selected
const fileInput = document.querySelector('#file input[type=file]');
fileInput.onchange = () => {
    if (fileInput.files.length > 0) {
        const fileName = document.querySelector('#file .file-name');
        fileName.textContent = fileInput.files[0].name;
    }
}

// Progress bar with ajaxForm
function validate(formData, jqForm, options) {
    var form = jqForm[0];
    var file = document.getElementById("video_input");
    var allowedExtensions = /(.+\.mp4|.+\.mkv|.+\.webm|.+\.ogg|.+\.ogv)$/ig;
    if (!form.video.value || !form.name.value) {
        if(!form.video.value){
            file.style = "border: 2px solid #ff7675";
        }
        if(!form.name.value){
            document.getElementById("name").style = "border: 2px solid #ff7675";
        }
        return false;
    }
    else if(!allowedExtensions.exec(file.value)){
        file.style = "border: 2px solid #ff7675";
        return false;
    }

}

(function() {
    var bar = document.getElementById("bar");

    $('form').ajaxForm({
        beforeSubmit: validate,
        beforeSend: function() {
            var posterValue = $('input[name=video]').fieldValue();
            bar.style = "display:online";
            bar.value = 0;
        },
        uploadProgress: function(event, position, total, percentComplete) {
            bar.value = percentComplete;
        },
        success: function() {
            bar.value = 100;
        },
        complete: function(xhr) {
            window.location.href = "/videos";
        }
    });
})();
