// Display the name of the file when selected
const fileInput = document.querySelector('#file input[type=file]');
fileInput.onchange = () => {
    if (fileInput.files.length > 0) {
        const fileName = document.querySelector('#file .file-name');
        fileName.textContent = fileInput.files[0].name;
    }
}

function validate(formData, jqForm, options) {
    var form = jqForm[0];
    if (!form.video.value || !form.name.value) {
        if(!form.video.value){        
            document.getElementById("video").style = "border: 2px solid #ff7675";
        }
        if(!form.name.value){
            document.getElementById("name").style = "border: 2px solid #ff7675";
        }
        return false;
    }

}
// Progress bar
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
